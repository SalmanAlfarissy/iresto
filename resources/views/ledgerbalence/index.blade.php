@extends('layouts.main')
@section('title','iResto')
@section('page-title','Ledger Balence')

@section('breadcrump')
<div class="row page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Ledger Balence</a></li>
    </ol>
</div>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class="display" style="min-width: 845px">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection

@push('custom-script')
<script>
    $(function(){
        readData();
    });

    function readData(){
        $.ajax({
            type: "GET",
            url: "{{ route('ledger-balance-getData') }}",
            data: {},
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
                        {"data":"tanggal"},
                        {"data":"debet"},
                        {"data":"kredit"},
                        {"data":"saldo"}
                    ],
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
