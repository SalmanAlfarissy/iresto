@extends('layouts.main')
@section('title','iResto')
@section('page-title','User')

@section('breadcrump')
<div class="row page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
    </ol>
</div>
@endsection
@section('content')
<div class="card">

    <div class="card-header row">
        <div class="col-md-10"><h4 class="card-title">Table User</h4></div>
        <div class="col-md-2">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#createModal">+ Create</button>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class="display" style="min-width: 845px">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Create At</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>

<!-- Modal Create-->
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" id="createForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">First Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="First Name" name="firstname">
                                <span class="error-text text-danger firstname-error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Last Name" name="lastname">
                                <span class="error-text text-danger lastname-error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" placeholder="Email" name="email">
                                <span class="error-text text-danger email-error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Phone Number</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Phone Number" name="phone">
                                <span class="error-text text-danger phone-error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" placeholder="Address" name="address"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                                <span class="error-text text-danger password-error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="default-select form-control wide" name="status">
                                    <option value='admin'>Admin</option>
                                    <option value='user'>User</option>
                                    <option value='customer'>Customer</option>
                                </select>
                                <span class="error-text text-danger status-error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Update-->
<div class="modal fade" id="updateModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" id="updateForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="basic-form">
                        <input type="hidden" name="id">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">First Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="First Name" name="firstname">
                                <span class="error-text text-danger firstname-error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Last Name" name="lastname">
                                <span class="error-text text-danger lastname-error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" placeholder="Email" name="email">
                                <span class="error-text text-danger email-error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Phone Number</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Phone Number" name="phone">
                                <span class="error-text text-danger phone-error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" placeholder="Address" name="address"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                                <span class="error-text text-danger password-error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="select form-control wide" name="status">
                                    <option value='admin'>Admin</option>
                                    <option value='user'>User</option>
                                    <option value='customer'>Customer</option>
                                </select>
                                <span class="error-text text-danger status-error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update-data">Update Data</button>
                </div>
            </form>
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
            url: "{{ route('user-getData') }}",
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
                        {"data":"firstname"},
                        {"data":"email"},
                        {"data":"status"},
                        {"data":"date"},
                        {"data":"id"}
                    ],
                    "columnDefs":[
                        {
                            "targets":5,
                            "data":"id",
                            "render":function(data, type, row){
                                return '<div class="btn-group mb-1">'+
                                    '<button type="button" class="btn btn-primary">Action</button>'+
                                    '<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">'+
                                    '</button>'+
                                    '<div class="dropdown-menu">'+
                                        '<button class="dropdown-item btn-edit" data-id="'+data+'">Edit</button>'+
                                        '<button class="dropdown-item btn-delete" data-id="'+data+'">Delete</button>'+
                                    '</div>'+
                                '</div>';
                            },

                        },
                        {
                            "targets":1,
                            "data":"firstname",
                            "render":function(data, type, row){
                                return row.firstname+" "+row.lastname;
                            },

                        },
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

    $(document).on('submit','#createForm', function(e){
        e.preventDefault();
        var form = $(this);
        $.ajax({
            type: "POST",
            url: "{{ route('user-create') }}",
            data: form.serialize(),
            success: function (result) {
                $('#createModal').modal('hide');
                form.trigger('reset');
                $('.firstname-error').text();
                $('.lastname-error').text();
                $('.email-error').text();
                $('.phone-error').text();
                $('.password-error').text();
                $('.status-error').text();
                swal("Proses Success!!", "Data user Berhasil di Tambahkan..", "success");
                readData();
            },
            error: function(xhr, error){
                var message = xhr.responseJSON.errors;
                var firstname = message.firstname ?? '';
                var lastname = message.lastname ?? '';
                var email = message.email ?? '';
                var phone = message.phone ?? '';
                var password = message.password ?? '';
                var status = message.status ?? '';
                $('.firstname-error').text(firstname);
                $('.lastname-error').text(lastname);
                $('.email-error').text(email);
                $('.phone-error').text(phone);
                $('.password-error').text(password);
                $('.status-error').text(status);
            }
        });
    });

    $(document).on('click', '.btn-edit', function(){
        $.ajax({
            type: "GET",
            url: "{{ route('user-getData') }}",
            data: {
                id: $(this).data('id'),
            },
            success: function (result) {
                var data = result.data;
                var form = $('#updateForm');
                form.find('input[name=id]').val(data.id);
                form.find('input[name=firstname]').val(data.firstname);
                form.find('input[name=lastname]').val(data.lastname);
                form.find('input[name=email]').val(data.email);
                form.find('input[name=phone]').val(data.phone);
                form.find('textarea[name=address]').val(data.address);
                form.find('input[name=password]').val(data.password);
                form.find('select[name=status]').val(data.status);
                $('#updateModal').modal('show');
            },
            error: function(err){
                console.log(err);
            }
        });
    });

    $(document).on('submit','#updateForm', function(e){
        e.preventDefault();
        var form = $(this);
        $.ajax({
            type: "POST",
            url: "{{ route('user-update','') }}/"+form.find("input[name=id]").val(),
            data: form.serialize(),
            success: function (result) {
                $('#updateModal').modal('hide');
                $('.firstname-error').text();
                $('.lastname-error').text();
                $('.email-error').text();
                $('.phone-error').text();
                $('.password-error').text();
                $('.status-error').text();
                swal("Proses Success!!", "Data user Berhasil di Update..", "success")
                readData();
            },
            error: function(xhr, error){
                var message = xhr.responseJSON.errors;
                var firstname = message.firstname ?? '';
                var lastname = message.lastname ?? '';
                var email = message.email ?? '';
                var phone = message.phone ?? '';
                var password = message.password ?? '';
                var status = message.status ?? '';
                $('.firstname-error').text(firstname);
                $('.lastname-error').text(lastname);
                $('.email-error').text(email);
                $('.phone-error').text(phone);
                $('.password-error').text(password);
                $('.status-error').text(status);
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
                    url: "{{ route('user-delete','') }}/"+form.data('id'),
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
