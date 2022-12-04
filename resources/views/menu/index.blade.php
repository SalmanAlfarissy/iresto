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
@csrf
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
                        <h4><span>{{ $item->name }}</span></h4>
                        <ul class="star-rating">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                        </ul>
                        <span class="price">{{ $item->price }}</span>
                        <div class="mb-2 mt-2 row center">
                            <div class="col-sm-12">
                                <input type="number" class="form-control" placeholder="Amount" id="amount{{ $item->id }}" required>
                                <span class="error-text text-danger amount-error"></span>
                            </div>
                        </div>
                        <a href="javascript:order({{ $item->id }})" class="btn btn-rounded btn-primary">
                            <span class="btn-icon-start text-primary">
                                <i class="fa fa-shopping-cart"></i>
                            </span> Order
                        </a>
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
    function order(menu_id){
        var inputToken = $("input[name=_token]");
        swal({
            title: "Are you sure to order this ?",
            text: "Your order will be saved in the order menu!!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#008000",
            confirmButtonText: "Yes, order it !!",

        }).then((willDelete)=>{
            if (willDelete.value == true) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('order-create') }}",
                    data: {
                        _token: inputToken.val(),
                        menu_id: menu_id,
                        amount: $('#amount'+menu_id).val(),
                    },
                    success: function (result) {
                        console.log(result);
                        inputToken.val(result.newtoken);
                        swal("Success", "Order menu was success!!", "success")
                    },
                    error: function(xhr, error){
                        console.log(xhr);
                    }
                });

            }else if(willDelete.dismiss == 'cancel'){
                sweetAlert("Cancel", "Order menu was cancel!!", "error")
            }
        });

    }
</script>

@endpush
