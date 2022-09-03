@extends('masterCopy.masterProductDetails')

@section('content')
<style>
    .right-side-pro-detail .price-pro {
        color: #E45641;
    }

    .right-side-pro-detail .tag-section {
        font-size: 18px;
        color: #5D4C46;
    }

    .pro-box-section .pro-box img {
        width: 100%;
        height: 200px;
    }

    .fa-cart-plus{
        background:#0652DD;
    }

    .addtocart{
        display:block;

        padding:0.5em 1em 0.5em 1em;
        border-radius:100px;
        border:none;
        font-size:1.5em;
        position:relative;
        background:#0652DD;
        cursor:pointer;
        height:2em;
        width:10em;
        overflow:hidden;
        transition:transform 0.1s;
        z-index:1;
    }
    .addtocart:hover{
        transform:scale(1.1);
    }
    .pretext{
        color:#fff;
        background:#0652DD;
        position:absolute;
        top:0;
        left:0;
        height:100%;
        width:100%;
        display:flex;
        justify-content:center;
        align-items:center;
        /*font-family: 'Quicksand', sans-serif;*/
    }
</style>

    @if ($errors->any())    {{--!{{ error message container }} --}}
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session()->has('message'))  {{-- session message to show instant message container  --}}
    <div class="alert alert-{{session('type')}}">
        {{session('message')}}
    </div>

    @endif
{{--    <div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">--}}
{{--        @if (session()->has('status'))--}}
{{--            <div class="p-3 text-green-700 bg-green-300 rounded">--}}
{{--                {{ session()->get('status') }}--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}

            <div class="row m-0">
                <div class="col-lg-4 left-side-product-box pb-3">
                    @if(is_file('uploads/products/'.$product->image_prod ))
                        <img src="{{ asset('/uploads/products/'.$product->image_prod ) }}" class="border p-3" alt="">
                    @else
                        <img src="{{url($product->image_prod )}}" class="border p-3" alt="">
                    @endif
                    <span class="sub-img">
{{--                        @dd($product->productImages)--}}
                        @foreach($product->productImages as $productimage)
                            @if(is_file('uploads/products/'.$productimage->pi_sub_image ))
                                <img src="{{ asset('/uploads/products/'.$productimage->pi_sub_image ) }}" class="border p-2" alt="">
                            @else
                                <img src="{{url($productimage->pi_sub_image )}}" class="border p-2" alt="">
                            @endif
                        @endforeach
                </span>
                </div>
                <div class="col-lg-8">
                    <div class="right-side-pro-detail border p-3 m-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <span>{{$product->category->cat_name}}</span>
                                <p class="m-0 p-0">{{ $product->title  }}</p>
                            </div>
                            <div class="col-lg-12">
                                <p class="m-0 p-0 price-pro">
                                    @if($product->sale_price != null || $product->sale_price > 0)
                                        <strike>BDT {{ $product->price  }}</strike><br>
                                        <strong>BDT {{ $product->sale_price}}</strong>
                                    @else
                                       <strong>BDT {{ $product->price  }}</strong>
                                    @endif
                                </p>
                                <hr class="p-0 m-0">
                            </div>
                            <div class="col-lg-12 pt-2">
                                <h5>Product Detail</h5>
                                <span>{{ $product->description  }}</span>
                                <hr class="m-0 pt-2 mt-2">
                            </div>
                            <div class="col-lg-12">
                                <p class="tag-section"><strong>In stock : </strong><a href="#">{{$product->status ==1 ? 'Available' : 'Unavailable' }}</a></p>
                            </div>
                            <div class="col-lg-12">
                                <h6>Quantity :</h6>
                                <input type="number" class="form-control text-center w-100" value="1">
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="row">
                                    <div class="col-lg-6 pb-2" style="display: flex;justify-content: center;">
                                        <form method="POST" action="{{route('cart.addToCart')}}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <button class="addtocart" type="submit">
                                                <div class="pretext">
                                                    <i class="fa fa-cart-plus"></i> ADD TO CART
                                                </div>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-lg-6" style="display: flex;justify-content: center;">
                                        <form method="POST" action="{{route('cart.buynow')}}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <button class="addtocart" type="submit">
                                                <div class="pretext" style="background:#2fa360;">
                                                    <i class="fa fa-cart-plus" style="background:#2fa360;"></i> SHOP NOW
                                                </div>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center pt-3">
                    <h4>More Product</h4>
                </div>
            </div>
            <div class="row mt-3 p-0 text-center pro-box-section">
                @foreach($randomproducts as $random)
                <div class="col-lg-3 pb-2">
                    <div class="pro-box border p-0 m-0">
                            @if(is_file('uploads/products/'.$random->image_prod ))
                                <img src="{{ asset('/uploads/products/'.$random->image_prod ) }}"  alt="">
                            @else
                                <img src="{{url($random->image_prod )}}" alt="">
                            @endif

                    </div>
                </div>
                @endforeach
{{--                <div class="col-lg-3 pb-2">--}}
{{--                    <div class="pro-box border p-0 m-0">--}}
{{--                        <img src="http://nicesnippets.com/demo/pd-b-images2.jpg">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 pb-2">--}}
{{--                    <div class="pro-box border p-0 m-0">--}}
{{--                        <img src="http://nicesnippets.com/demo/pd-b-images3.jpg">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 pb-2">--}}
{{--                    <div class="pro-box border p-0 m-0">--}}
{{--                        <img src="http://nicesnippets.com/demo/pd-b-images4.jpg">--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
@if(\Illuminate\Support\Facades\Auth::user())
    @if(Auth::user()->role_as == '1')
    <div>
        <a href="{{route('products.edit', $product->id)}}" class="btn btn-info btn-block">
            Edit
        </a>
    </div>
    <p></p>
    <div>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" >
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-block " style="margin: auto">
                Delete
            </button>
        </form>
    </div>
    @endif
@endif
@stop
