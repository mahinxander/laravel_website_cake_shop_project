{{--@extends('masterCopy.masterCartDetails')--}}
@extends('master')

@section('content')

    <style>
        .titled{
            margin-bottom: 5vh;
        }
        .card{
            margin: auto;
            max-width: 950px;
            width: 90%;
            box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 1rem;
            border: transparent;
        }
        @media(max-width:767px){
            .card{
                margin: 3vh auto;
            }
        }
        .cart{
            background-color: #fff;
            padding: 4vh 5vh;
            border-bottom-left-radius: 1rem;
            border-top-left-radius: 1rem;
        }
        @media(max-width:767px){
            .cart{
                padding: 4vh;
                border-bottom-left-radius: unset;
                border-top-right-radius: 1rem;
            }
        }
        .summary{
            background-color: #ddd;
            border-top-right-radius: 1rem;
            border-bottom-right-radius: 1rem;
            padding: 4vh;
            color: rgb(65, 65, 65);
        }
        @media(max-width:767px){
            .summary{
                border-top-right-radius: unset;
                border-bottom-left-radius: 1rem;
            }
        }
        .summary .col-2{
            padding: 0;
        }
        .summary .col-10
        {
            padding: 0;
        }.row{
             margin: 0;
         }
        .title b{
            font-size: 1.5rem;
        }
        .main{
            margin: 0;
            padding: 2vh 0;
            width: 100%;
        }
        .col-2, .col{
            padding: 0 1vh;
        }
        a{
            padding: 0 1vh;
        }
        .close{
            margin-left: auto;
            font-size: 0.7rem;
        }
        img{
            width: 3.5rem;
        }
        .back-to-shop{
            margin-top: 4.5rem;
        }
        h5{
            margin-top: 4vh;
        }
        hr{
            margin-top: 1.25rem;
        }
        form{
            padding: 2vh 0;
        }
        select{
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1.5vh 1vh;
            margin-bottom: 4vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247);
        }
        input{
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1vh;
            /*margin-bottom: 4vh;*/
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247);
        }
        input:focus::-webkit-input-placeholder
        {
            color:transparent;
        }
        .btna{
            background-color: #000;
            border-color: #000;
            color: white;
            width: 100%;
            font-size: 0.7rem;
            margin-top: 4vh;
            padding: 1vh;
            border-radius: 0;
        }
        .btna:focus{
            box-shadow: none;
            outline: none;
            box-shadow: none;
            color: white;
            -webkit-box-shadow: none;
            -webkit-user-select: none;
            transition: none;
        }
        .btna:hover{
            color: white;
        }

        .buttonx {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 1px 3px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 10px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }
        .button2 {
            background-color: white;
            color: black;
            border: 2px solid #008CBA;
        }

        .button2:hover {
            background-color: #008CBA;
            color: white;
        }

        #code{
            background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253) , rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
            background-repeat: no-repeat;
            background-position-x: 95%;
            background-position-y: center;
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

{{--    @if(empty($cart['products']))--}}
    @if(empty($cart['products']))

        <div class="alert alert-danger">
            Please Add Some Product to Cart!
        </div>
        <div class="back-to-shop"><a href="{{route('products.index')}}">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
    @else

    <div class="card">
        <div class="row">
            <div class="col-md-8 cart">
                <div class="titled">
                    <div class="row">
                        <div class="col"><h4><b>Your Cart</b></h4></div>
                        <div class="col align-self-center text-right text-muted">{{count($cart['products'])}} items</div>
                    </div>
                </div>

                @foreach($cart['products'] as $product)
                <div class="row border-top border-bottom">
                    <div class="row main align-items-center">
                        <div class="col-2">
                            @if(is_file('uploads/products/'.$product['image_prod'] ))
                                <img src="{{ asset('/uploads/products/'.$product['image_prod'] ) }}" class="img-fluid" alt="">
                            @else
                                <img src="{{url($product['image_prod'] )}}" class="img-fluid" alt="">
                            @endif
                        </div>
                        <div class="col">
                            <div class="row text-muted">{{$product['category']}}</div>
                            <div class="row">{{$product['title']}}</div>
                        </div>
                        <form method="POST" action="{{route('cart.addToCart')}}">
                            @csrf
                        <div class="col">

                                    <a href="#" class="border btn btn-link">{{$product['quantity']}}</a>

                                <input type="hidden" name="product_id" value="{{$product['product_id']}}">
                                <button class="btn btn-link" type="submit">
                                    +
                                </button>
                        </div>
                        </form>
                        <div class="col">BDT {{$product['product_total']}}
                            <a  href="{{route('cart.remove', $product)}}">
                                <span class="close">&#10005;</span></a></div>
                    </div>
                </div>
                @endforeach

                <div class="back-to-shop"><a href="{{route('products.index')}}">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
            </div>
            <div class="col-md-4 summary">
                <div><h5><b>Summary</b></h5></div>
                <hr>
                <div class="row">
                    <div class="col" style="padding-left:0;">TOTAL ITEMS: {{$cart['quantity_total']}}</div>
                    <div class="col text-right">BDT {{$cart['total']}}</div>
                </div>
                <form>
                    <p>SHIPPING</p>
                    <select>
                        <option class="text-muted">Standard-Delivery- 150.00 BDT</option>
                    </select>

                </form>
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col">TOTAL PRICE</div>
                    <div class="col text-right">BDT {{$cart['total']+150}}</div>
                </div>
               <button class="btna"><a href="{{route('cart.checkout')}}">CHECKOUT</a></button>
            </div>
        </div>

    </div>
<br>


    @endif

@stop
