@extends('master')
{{--@section('contents')--}}
{{--    @include('partials.jumbotron')--}}
{{--@stop--}}
@section('content')

    @if(session()->has('message'))  {{-- session message to show instant message container  --}}
    <div class="alert alert-{{session('type')}}">
        {{session('message')}}
    </div>
    @endif
<div class="container-fluid">
    <table class="table table-bordered table-condensed">
        <h3>Product List</h3>

        <thead>
        <tr>

            <th>Product Name</th>
            <th>Image</th>
            <th>Availability</th>
{{--            <th>Description</th>--}}
        </tr>

        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>

                <td>{{$product->title }}</td>
{{--                <td>{{$category->image_cat}}</td>--}}
                <td>
                    @if(is_file('uploads/categories/'.$product->image_prod ))
                    <img src="{{ asset('/uploads/categories/'.$product->image_prod ) }}" width="100px" height="100px" alt="">
                    @else
                    <img src="{{url($product->image_prod )}}" width="100px" height="100px" alt="">
                    @endif
                </td>
                <td>{{$product->status ==1 ? 'Active' : 'Inactive' }}</td>
{{--                <td>{{Str::replace(['a','e','i','o','u'], ' ', $category->description)}}</td>--}}
{{--                <td>{{Str::limit($category->description, 20)}}</td>--}}
                <td>
                    <a  href="{{route('products.show', $product->id)}}" class="btn btn-info">
                        Details
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <div class="row">
<div class="col-md-6 blog-main">
    {{ $products->links() }}
</div>
    <div class="col-md-6 blog-main">
    <a  href="{{route('products.create')}}" class="btn btn-success" style="float: right">
            Add Product
        </a>
</div>
    </div>
</div>


@stop

