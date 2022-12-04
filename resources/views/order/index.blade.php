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
        <div class="col-md-2" id="seat_number"></div>
        <div class="col-md-10"></div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            @csrf
            <table id="dataTable" class="display" style="min-width: 845px">
                <thead>
                    <tr>
                        <th>No</th>
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

<div class="card">
    <div class="card-header flex-wrap border-0 pb-0 align-items-end">
        <div class="mb-3 me-3">
            <h5 class="fs-20 text-black font-w500">Total Harga</h5>
            <span class="text-num text-black fs-36 font-w500"><div id="total_price"></div></span>
        </div>
        <div class="me-3 mb-3">
        </div>
        <div class="mb-3">
            <button type="button" class="btn btn-rounded btn-warning btn-reload"><span class="btn-icon-start text-warning"><i class="fa fa-redo-alt color-warning"></i>
            </span>Reload data</button>
            <button type="button" class="btn btn-rounded btn-primary" data-bs-toggle="modal" data-bs-target="#orderModal" ><span class="btn-icon-start text-primary"><i class="fa fa-shopping-cart color-primary"></i>
            </span>Order</button>
            <button type="button" class="btn btn-rounded btn-success btn-payment"><span class="btn-icon-start text-success"><i class="fa fa-id-card-alt color-success"></i>
            </span>Payment</button>

        </div>
    </div>
</div>

{{-- order Modal --}}
<div class="modal fade" id="orderModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" id="orderForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="basic-form">

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Seat Number</label>
                            <div class="col-sm-9">
                                <select class="default-select form-control wide" name="seatnumber">
                                    <option value='1'>1</option>
                                    <option value='2'>2</option>
                                    <option value='3'>3</option>
                                    <option value='4'>4</option>
                                    <option value='5'>5</option>
                                    <option value='6'>6</option>
                                    <option value='7'>7</option>
                                    <option value='8'>8</option>
                                    <option value='9'>9</option>
                                    <option value='10'>10</option>
                                </select>
                                <span class="error-text text-danger status-error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-order">Save Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('custom-script')

<script>
    var user_id = 0;
    var gross_amount = 0;
    var item_details = {};
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
                item_details = result.data.data;
                user_id = result.data.data[0].user_id;
                $('#total_price').html(result.data.total_price);
                var seat = result.data.data[0].seat_number ?? 0;
                $('#seat_number').html("Seat Number : "+seat);
                gross_amount = result.data.default_total_price;
                if (result.data.data.length == result.data.check_status) {
                    $('.btn-payment').removeAttr('disabled');
                }else {
                    $('.btn-payment').attr('disabled', 'true');
                }

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
                    "data":result.data.data,
                    "columns":[
                        {"data":"no"},
                        {"data":"data_menu.name"},
                        {"data":"amount"},
                        {"data":"price"},
                        {"data":"status"},
                        {"data":"total"},
                        {"data":"id"},
                    ],
                    "columnDefs":[
                        {
                            "targets":6,
                            "data":"id",
                            "render":function(data, type, row){
                                return '<div class="btn-group mb-1">'+
                                    '<button type="button" class="btn btn-primary">Action</button>'+
                                    '<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">'+
                                    '</button>'+
                                    '<div class="dropdown-menu">'+
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

    $(document).on('click', '.btn-order', function (e) {
        e.preventDefault();
        var form = $('#orderForm');
        var inputToken = $("input[name=_token]");
        $.ajax({
            type: "POST",
            url: "{{ route('order-update','') }}/"+user_id,
            data: {
                _token: inputToken.val(),
                user_id: user_id,
                status: 'proses',
                seat_number: form.find('select[name=seatnumber]').val()
            },
            success: function (result) {
                $('#orderModal').modal('hide');
                inputToken.val(result.newtoken);
                swal("Success", "Order menu was proses!!", "success")
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

    $(document).on('click', '.btn-payment', function(e){
        e.preventDefault();
        var token = $('input[name=_token]')
        $.ajax({
        type: "POST",
        url: "{{ route('mywallet-payment') }}",
        data: {
            _token: token.val(),
            gross_amount: gross_amount,
            item_details: item_details,
        },
            success: function (result) {
                token.val(result.newtoken);

                // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                window.snap.pay(result.data, {
                    onSuccess: function(result){
                    /* You may add your own implementation here */
                    swal("Success", "payment success!", "success").then(function (){
                        dataTransaksi(result);
                    });
                    },
                    onPending: function(result){
                    /* You may add your own implementation here */
                    swal("Notification", "wating your payment!", "warning").then(function (){
                        dataTransaksi(result);
                    });
                    },
                    onError: function(result){
                    /* You may add your own implementation here */
                    swal("Notification", "payment failed!", "warning").then(function (){
                        dataTransaksi(result);
                    });
                    },
                    onClose: function(){
                    /* You may add your own implementation here */
                    swal("Notification", "you closed the popup without finishing the payment", "warning").then(function (){
                    });

                    }
                })
                $('#topUpModal').modal('hide');
            },
            error: function(xhr, error){
                var message = xhr.responseJSON.errors;
                var gross_amount = message.gross_amount ?? '';
                $('.gross_amount-error').text(gross_amount);
            }
        });
    })

    function payment_confirmation(){
        var token = $('input[name=_token]')
        $.ajax({
            type: "POST",
            url: "{{ route('order-update','') }}/"+user_id,
            data: {
                _token: token.val(),
                user_id: user_id,
                status: 'success',
                payment_confirmation: '1',
            },
            success: function (result) {
                token.val(response.newToken);

            }
        });
    }

    function dataTransaksi(result){
      var token = $('input[name=_token]')
      var dataTrans = {dataTrans: result};
      $.ajax({
          type: "POST",
          url: "{{ route('transaction-create') }}",
          data: {
              _token: token.val(),
              dataTrans: dataTrans,
          },
          success: function (response) {
            payment_confirmation();
            token.val(response.newToken);
            window.location.reload();
          }
      });
    }

</script>
@endpush
