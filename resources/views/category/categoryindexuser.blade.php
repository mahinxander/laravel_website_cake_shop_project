@extends('master')
@section('contents')
    @include('partials.header')
@stop
@section('content')

    @if(session()->has('message'))  {{-- session message to show instant message container  --}}
    <br>
    <div class="alert alert-{{session('type')}}">
        {{session('message')}}
    </div>
    @endif

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                @foreach($categories as $category)
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        @if(is_file('uploads/categories/'.$category->image_cat))
                        <img class="card-img-top" src="{{ asset('/uploads/categories/'.$category->image_cat) }}" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
                        @else
                            <img class="card-img-top" src="{{url($category->image_cat)}}" width="150px" height="200px" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">

                        @endif

                            <div class="card-body">
                            <p class="card-text">{{Str::limit($category->description, 50)}}...</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a  href="{{route('categories.show', $category->id)}}" class="btn btn-sm btn-outline-secondary">
                                        Details
                                    </a>
                                    @if(\Illuminate\Support\Facades\Auth::user())
                                   @if(\Illuminate\Support\Facades\Auth::user()->role_as==1)
                                    <a href="{{route('categories.edit', $category->id)}}" class="btn btn-sm btn-outline-secondary">
                                        Edit
                                    </a>
                                    @endif
                                    @endif
                                </div>
                                <small class="text-muted" style="color: #2fa360 !important;">{{$category->cat_name}}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 blog-main">
            {{ $categories->links() }}
        </div>
        @if(\Illuminate\Support\Facades\Auth::user())
        @if(\Illuminate\Support\Facades\Auth::user()->role_as==1)

        <div class="col-md-6 blog-main">
            <a  href="{{route('categories.create')}}" class="btn btn-success" style="float: right">
                 Add a New Category
            </a>
        </div>
        @endif
        @endif
    </div>
    <br>

@stop

