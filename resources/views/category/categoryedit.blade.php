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
        <div class="card-header">{{ __('Edit Category') }}</div>

        <div class="card-body">
            <form method="POST" action="{{route('categories.update', $category->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="cat_name">Category Name</label>
                    <input name="cat_name" type="text" class="form-control" id="cat_name"  placeholder="Enter category name" value="{{$category->cat_name}}">
                </div>
                <div class="form-group">
                    <label for="category_id">Alternative Category Name(optional)</label>
                    <select class="form-control" name="category_id">
                        <option value="">Select a category</option>
                        @foreach($categories_name as $category_name)
                            <option value="{{ $category_name->id }}">{{ $category_name->cat_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Category Description</label>
                    <textarea name="description" type="text" class="form-control" id="description"  placeholder="Enter category description" value="{{$category->description}}"></textarea>
                </div>
                <div class="form-group">
                    <label for="image_cat">Category Image</label>
                    <input name="image_cat" type="file" class="form-control" id="image_cat"  placeholder="Upload category image">

                    @error('image_cat')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Enter Status</label>
                    <select name="status" class="form-control">
                        <option value="1" @if($category->status==1) selected @endif>Available</option>
                        <option value="0"@if($category->status==0) selected @endif>Unavailable</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>


            </form>
        </div>
    </div>

@stop
