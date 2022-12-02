@extends('layouts.main')
@section('title','iResto')
@section('page-title','Menu')

@section('breadcrump')
<div class="row page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Menu</a></li>
    </ol>
</div>
@endsection
@section('content')
<div class="card">

    <div class="card-header row">
        <div class="col-md-10"><h4 class="card-title">Menu</h4></div>
        <div class="col-md-2">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#createModal">+ Create</button>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="display" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Created At</th>
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
        <form method="POST" id="createForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Name" name="name">
                                <span class="error-text text-danger name-error"></span>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9">
                                <select class="default-select form-control wide" name="category">
                                    <option value="makanan">Makanan</option>
                                    <option value="minuman">Minuman</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" placeholder="Price" name="price">
                                <span class="error-text text-danger price-error"></span>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="4" name="description"></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <div class="form-file">
                                        <input type="file" name="image" class="form-file-input form-control">
                                    </div>
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary update-data">Save Data</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Update-->
<div class="modal fade" id="updateModal">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" id="updateForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="basic-form">
                        <input type="hidden" name="id">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Name" name="name">
                                <span class="error-text text-danger name-error"></span>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9">
                                <select class="form-control wide" name="category">
                                    <option value="makanan">Makanan</option>
                                    <option value="minuman">Minuman</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" placeholder="Price" name="price">
                                <span class="error-text text-danger price-error"></span>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="4" name="description"></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <div class="form-file">
                                        <input type="file" name="image" class="form-file-input form-control">
                                    </div>
                                    <span class="input-group-text">Upload</span>
                                </div>
                                <img class="display-image" width="100" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </div>
            </div>
        </form>
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
            url: "{{ route('menu-getData') }}",
            data: {},
            success: function (result) {
                // return console.log(result);
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
                        {"data":"name"},
                        {"data":"category"},
                        {"data":"price"},
                        {"data":"description"},
                        {"data":"image"},
                        {"data":"date"},
                        {"data":"id"}
                    ],
                    "columnDefs":[
                        {
                            "targets":7,
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
                            "targets":5,
                            "data":"gambar",
                            "render":function(data, type, row){
                                return '<img src="{{ asset('image/content') }}/'+data+'" width="50" alt="">';
                            },

                        }
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
        let form = $(this);
        let formData = new FormData(form[0]);

        $.ajax({
            type: "POST",
            url: "{{ route('menu-create') }}",
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            success: function (result) {
                console.log(result);
                $('#createModal').modal('hide');
                swal("Proses Success!!", "The addition of menu data was successful!", "success")
                $('.name-error').text();
                $('.price-error').text();
                form.trigger('reset');
                readData();
            },
            error: function(xhr, error){
                var message = xhr.responseJSON.errors;
                var name = message.name ?? '';
                var price = message.price ?? '';

                $('.name-error').text(name);
                $('.price-error').text(price);

            }
        });
    });

    $(document).on('click', '.btn-edit', function(e){
        e.preventDefault()
        $.ajax({
            type: "GET",
            url: "{{ route('menu-getData') }}",
            data: {
                id: $(this).data('id'),
            },
            success: function (result) {

                var form = $('#updateForm');
                var data = result.data;
                form.find('input[name=id]').val(data.id);
                form.find('input[name=name]').val(data.name);
                form.find('select[name=category]').val(data.category);
                form.find('input[name=price]').val(data.price);
                form.find('textarea[name=description]').val(data.description);
                $(".display-image").attr("src", "image/content/" + data.image);

                $('#updateModal').modal('show');
            },
            error: function(xhr, error){
                console.log(err);
            }
        });
    });

    $(document).on('submit','#updateForm', function(e){
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);

        $.ajax({
            type: "POST",
            url: "{{ route('menu-update','') }}/"+form.find("input[name=id]").val(),
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            success: function (result) {
                console.log(result);
                $('#updateModal').modal('hide');
                swal("Proses Success!!", "The update of menu data was successful!", "success")
                readData();
            },
            error: function(err){
                console.log(err);
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
                    url: "{{ route('menu-delete','') }}/"+form.data('id'),
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
