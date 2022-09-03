@extends('master')

@section('content')

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
    <div class="card">
        <div class="card-header">{{ __('Add New Product') }}</div>

        <div class="card-body">
            <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Product Name</label>
                    <input name="title" type="text" class="form-control" id="title"  placeholder="Enter product name" value="{{old('title')}}">
                </div>
                <div class="form-group">
                    <label for="category_id">Category the product belongs to</label>
{{--                    <input name="cat_alter_name" type="text" class="form-control" id="cat_alter_name"  placeholder="Enter alternative name" value="{{old('cat_alter_name')}}">--}}

                    <select class="form-control" name="category_id">
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                            @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <label for="description">Product Description</label>
                    <textarea name="description" type="text" class="form-control" id="description"  placeholder="Enter product description"></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Product Price</label>
                    <input name="price" type="number" class="form-control" id="price"  placeholder="Enter product price">
                </div>
                <div class="form-group">
                    <label for="sale_price">Product Sale Price</label>
                    <input name="sale_price" type="number" class="form-control" id="sale_price"  placeholder="Enter product sale price">
                </div>
                <div class="form-group">
                    <label for="image_prod">Product  Main Image</label>
                    <input name="image_prod" type="file" class="form-control" id="image_prod"  placeholder="Upload product image">

                    @error('image_prod')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image_prods">Product Side Images (multiple file allowed)</label>
                    <input multiple="multiple" name="image_prods[]" type="file" class="form-control" id="image_prods"  placeholder="Upload product image">

                    @error('image_prods')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Enter Status</label>
                    <select name="status" class="form-control">
                        <option value="1">Available</option>
                        <option value="0">Unavailable</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>


            </form>
        </div>
    </div>

@stop
