@extends('master')
@section('content')
    <h3 class="text-center mt-4" >Register Your Account</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session()->has('message'))
    @endif
    <div class="card">
        <div class="card-header">{{session('message')}}</div>

        <div class="card-body">
    <form method="POST" action="{{route('register')}}">
        @csrf
        <div class="form-group">
            <label for="name">Enter Your Name</label>
            <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Name" value="{{ old('name') }}">

        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{ old('email') }}">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input name="phone_number" type="text" class="form-control" id="phone_number" placeholder="Phone Number">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input name="password" type="password" class="form-control" id="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm your Password</label>
            <input name="password_confirmation" type="password" class="form-control" id="confirm_password" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
        </div>
    </div>

@stop
