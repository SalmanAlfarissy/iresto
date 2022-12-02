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
<div class="row">

    @foreach ($data as $index => $item)
    <div class="col-xl-3 col-lg-6 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="new-arrival-product">
                    <div class="new-arrivals-img-contnent">
                        <img class="img-fluid" src="{{ asset('image/content/'.$item->image) }}" alt="">
                    </div>
                    <div class="new-arrival-content text-center mt-3">
                        <h6><span>{{ $item->category }}</span></h6>
                        <h4><a href="javascript:void(0)">{{ $item->name }}</a></h4>
                        <ul class="star-rating">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                        </ul>
                        <span class="price">{{ $item->price }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

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
