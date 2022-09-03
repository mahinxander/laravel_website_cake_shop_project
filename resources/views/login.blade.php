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

    @if(session()->has('message') )  {{-- session message to show instant message container  --}}
        <div class="alert alert-{{session('type')}}">
                        {{session('message')}}
        </div>
    @endif
    <div class="card" style="max-width:600px; margin: 0 auto; float: none; margin-bottom: 10px;">
        <div class="card-header">{{ __('Login') }}</div>

        <div class="card-body">
            <form method="POST" action="{{route('login')}}">
                @csrf
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>


            </form>
        </div>
    </div>


@stop
