@extends('layouts.main')
@section('title','iResto')
@section('page-title','Order')

@section('breadcrump')
<div class="row page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Order</a></li>
    </ol>
</div>
@endsection
@section('content')
<div class="card">

    <div class="card-header row g-2">
        @csrf
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class="display" style="min-width: 845px">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Seat Number</th>
                        <th>Name</th>
                        <th>List Menu</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


@endsection

@push('custom-script')

<script>
    var user_id = 0;
    var gross_amount = 0;
    $(document).ready(function () {
        readData();
    });

    $('.btn-reload').on('click', function () {
        readData()
    });

    function readData(){
        $.ajax({
            type: "GET",
            url: "{{ route('order-getData') }}",
            data: {
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
                        {"data":"seat_number"},
                        {"data":"data_user.firstname"},
                        {"data":"data_menu.name"},
                        {"data":"amount"},
                        {"data":"price"},
                        {"data":"status"},
                        {"data":"total"},
                        {"data":"id"},
                    ],
                    "columnDefs":[
                        {
                            "targets":8,
                            "data":"id",
                            "render":function(data, type, row){
                                return '<div class="btn-group mb-1">'+
                                    '<button type="button" class="btn btn-primary">Action</button>'+
                                    '<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">'+
                                    '</button>'+
                                    '<div class="dropdown-menu">'+
                                        '<button class="dropdown-item btn-update" data-id="'+data+'">Complate</button>'+
                                        '<div class="dropdown-divider"></div>'+
                                        '<button class="dropdown-item btn-delete" data-id="'+data+'">Delete</button>'+
                                    '</div>'+
                                '</div>';
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

    $(document).on('click', '.btn-update', function (e) {
        e.preventDefault();
        var form = $(this);
        var inputToken = $("input[name=_token]");
        $.ajax({
            type: "POST",
            url: "{{ route('order-update','') }}/"+form.data('id'),
            data: {
                _token: inputToken.val(),
                id: form.data('id')
            },
            success: function (result) {
                inputToken.val(result.newtoken);
                swal("Success", "Order menu was complate!!", "success")
                readData();
            },
            error: function(xhr, error){
                console.log(xhr);
            }
        });
    });

    $(document).on('click','.btn-delete', function(e){
        e.preventDefault();
        var form = $(this);
        var inputToken = $("input[name=_token]");
        swal({
            title: "Are you sure to delete ?",
            text: "You will not be able to recover this imaginary file !!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it !!",

        }).then((willDelete)=>{
            if (willDelete.value == true) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('order-delete','') }}/"+form.data('id'),
                    data: {
                        _token: inputToken.val(),
                    },
                    success: function (result) {
                        inputToken.val(result.newtoken);
                        swal("Success", "Delete data was success!!", "success")
                        readData();
                    }
                });

            }else if(willDelete.dismiss == 'cancel'){
                sweetAlert("Cancel", "Delete data was cancel!!", "error")
            }
        });

    });
</script>
@endpush
