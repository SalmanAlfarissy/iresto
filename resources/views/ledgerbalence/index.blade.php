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

    <div class="card-header row g-2">
        <div class="col-md-5"></div>
        <div class="col-md-2" style="text-align: right">
            Filter by date :
        </div>
        <div class="col-md-2">
            <input type="date" class="form-control" placeholder="start date">
        </div>
        <div class="col-md-auto" style="text-align: center">-</div>
        <div class="col-md-2">
            <input type="date" class="form-control" placeholder="end date">
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class="display" style="min-width: 845px">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Dusun/Korong</th>
                        <th>RT</th>
                        <th>RW</th>
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
                    <h5 class="modal-title">Tambah Data Dusun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Dusun/Korong" name="nama">
                                <span class="error-text text-danger nama-error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">RT</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" placeholder="RT" name="rt">
                                <span class="error-text text-danger rt-error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">RW</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" placeholder="RW" name="rw">
                                <span class="error-text text-danger rw-error"></span>
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
                    <h5 class="modal-title">Tambah Data Dusun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Dusun/Korong" name="nama">
                                <span class="error-text text-danger nama-error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">RT</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" placeholder="RT" name="rt">
                                <span class="error-text text-danger rt-error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">RW</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" placeholder="RW" name="rw">
                                <span class="error-text text-danger rw-error"></span>
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

@endsection

@push('custom-script')
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
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
    });
</script>
{{-- <script>
    $(function(){
        readData();
    });

    function readData(){
        $.ajax({
            type: "GET",
            url: "{{ route('getdata-dusun') }}",
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
                        {"data":"nama"},
                        {"data":"rt"},
                        {"data":"rw"},
                        {"data":"id"}
                    ],
                    "columnDefs":[
                        {
                            "targets":4,
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
            url: "{{ route('create-dusun') }}",
            data: form.serialize(),
            success: function (result) {
                $('#createModal').modal('hide');
                swal("Proses Success!!", result.message, "success")
                readData();
            },
            error: function(xhr, error){
               console.log(xhr);
            }
        });
    });

    $(document).on('click', '.btn-edit', function(){
        $.ajax({
            type: "GET",
            url: "{{ route('getdata-dusun') }}",
            data: {
                id: $(this).data('id'),
            },
            success: function (result) {
                var data = result.data;
                var form = $('#updateForm');
                form.find('input[name=id]').val(data.id);
                form.find('input[name=nama]').val(data.nama);
                form.find('input[name=rt]').val(data.rt);
                form.find('input[name=rw]').val(data.rw);
                $('#updateModal').modal('show');
            },
            error: function(err){
                console.log(err);
            }
        });
    });

    $(document).on('click','.update-data', function(e){
        e.preventDefault();
        var form = $('.updateForm');

        $.ajax({
            type: "POST",
            url: "/user/updateData/"+form.find("input[name=id]").val(),
            data: form.serialize(),
            success: function (result) {
                $('#updateModal').modal('hide');
                swal("Proses Success!!", "Data user Berhasil di Update..", "success")
                readData();
            },
            error: function(err){
                if(err.responseJSON.errors.name){
                    $(".name-error").show().text(err.responseJSON.errors.name);
                    $(".email-error").hide();
                    $(".level-error").hide()
                    $(".password-error").hide()
                }else if(err.responseJSON.errors.email){
                    $(".email-error").show().text(err.responseJSON.errors.email);
                    $(".name-error").hide();
                    $(".level-error").hide();
                    $(".password-error").hide()
                }else if(err.responseJSON.errors.level){
                    $(".level-error").show().text(err.responseJSON.errors.level);
                    $(".email-error").hide();
                    $(".name-error").hide();
                    $(".password-error").hide()
                }else if(err.responseJSON.errors.password){
                    $(".password-error").show().text(err.responseJSON.errors.password);
                    $(".level-error").hide();
                    $(".email-error").hide();
                    $(".name-error").hide();
                }
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
                    url: "{{ route('delete-dusun','') }}/"+form.data('id'),
                    data: {
                        _token: inputToken.val(),
                    },
                    success: function (result) {
                        inputToken.val(result.data.newToken);
                        swal("Success", "Delete data was success!!", "success")
                        readData();
                    }
                });

            }else if(willDelete.dismiss == 'cancel'){
                sweetAlert("Cancel", "Delete data was cancel!!", "error")
            }
        });

    });

</script> --}}
@endpush
