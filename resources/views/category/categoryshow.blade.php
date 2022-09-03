@extends('master')

@section('content')

    @if(session()->has('message'))  {{-- session message to show instant message container  --}}
    <div class="alert alert-{{session('type')}}">
        {{session('message')}}
    </div>
    @endif

    <h3>{{ $category->cat_name }}</h3>
    <p style="color: green">
        ID: {{ $category->id }}
    </p>
    <p style="color: blue">
        Slug: {{ $category->slug }}
    </p>
    <p style="color: firebrick">
        Status: {{ $category->status==1 ? 'Available' :'Unavailable' }}
    </p>
    <p style="color: firebrick">
        Created At: {{ $category->created_at }}
    </p>
    <p style="color: firebrick; overflow: hidden; text-overflow: ellipsis;">
        Description: {{ $category->description }}
    </p>
    <h2>Products under {{$category->cat_name}}</h2>
    <table class="table table-bordered table-condensed">
        <h3>Products List</h3>

        <thead>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Category Id</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        @foreach($category->products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->title}}</td>
                <td>{{$product->category_id}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->status =='draft' ? 'Inactive' : 'Active' }}</td>
                <td>
                    <a  href="{{route('products.show', $product->id)}}" class="btn btn-info">
                        Details
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

    <div>
        <a href="{{route('categories.edit', $category->id)}}" class="btn btn-info btn-block">
            Edit
        </a>
    </div>
    <p></p>
    <div>
        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" >
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-block " style="margin: auto">
                Delete
            </button>
        </form>
    </div>

@stop
