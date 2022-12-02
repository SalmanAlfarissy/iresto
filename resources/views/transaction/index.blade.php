@extends('layouts.main')
@section('title','iResto')
@section('page-title','Transaction')

@section('breadcrump')
<div class="row page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Transaction</a></li>
    </ol>
</div>
@endsection
@section('content')
<div class="card">

    <div class="card-header row g-2">
        <div class="col-md-4"></div>
        <div class="col-md-2" style="text-align: right">
            Filter by date :
        </div>
        <div class="col-md-2">
            <input type="date" class="form-control" placeholder="start date" id="startdate">
        </div>
        <div class="col-md-auto" style="text-align: center">-</div>
        <div class="col-md-2">
            <input type="date" class="form-control" placeholder="end date" id="enddate">
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-primary filterdate">Filter</button>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class="display" style="min-width: 845px">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Payment Type</th>
                        <th>Date & Time</th>
                        <th>Order ID</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


@endsection

@push('custom-script')

<script>
    var fillter = {};
    $(function(){
        readData(fillter);
    });

    $(document).on('click', '.filterdate', function(e){
        e.preventDefault();
        fillter = {
            'startdate': $('#startdate').val(),
            'enddate': $('#enddate').val(),
        }
        readData(fillter)
    });

    function readData(filter){
        $.ajax({
            type: "GET",
            url: "{{ route('transaction-getData') }}",
            data: {
                filterdate: fillter,
            },
            success: function (result) {
               var table = $('#dataTable').DataTable({
                    "ordering":true,
                    "responsive":true,
                    "destroy":true,
                    "language": {
                        "paginate": {
                        "next": '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                        "previous": '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                        },
                    },
                    "createdRow": function ( row, data, index ) {
                        $(row).addClass('selected')
                    },
                    "data":result.data,
                    "columns":[
                        {"data":"no"},
                        {"data":"payment_type"},
                        {"data":"date"},
                        {"data":"order_id"},
                        {"data":"gross_amount"},
                        {"data":"transaction_status"},
                    ],
                    "columnDefs":[
                        {
                            "targets":5,
                            "data":"transaction_status",
                            "render":function(data, type, row){
                                return '<span class="badge light badge-'+(data == "settlement" ? "success" : "warning")+'">'+data+'</span>';
                            },
                        },
                    ]
                });
                table.on('click', 'tbody tr', function() {
                    var $row = table.row(this).nodes().to$();
                    var hasClass = $row.hasClass('selected');
                    if (hasClass) {
                        $row.removeClass('selected')
                    } else {
                        $row.addClass('selected')
                    }
                })

                table.rows().every(function() {
                    this.nodes().to$().removeClass('selected')
                });

            },
            error: function(err){
                console.log(err);

            }
        });
    }

</script>
@endpush
