@extends('Front.layouts.front-layout',['title'=>'Login'])
@section('content')
    <div class="untree_co-section">
        <div class="container">
            <div class="block">

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-8 pb-4">
                        @if(session('success'))
                            <div class="alert alert-success text-center">
                                {{session('success')}}
                            </div>
                        @endif
                        <div class="row mb-5">
                            <h1>
                                Login
                            </h1>
                        </div>
                        <form action="{{route('login')}} " method="POST">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-8">
                                    <div class="form-group mb-2">
                                        <label class="text-black" for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" value="{{old('email')}}" name="email">
                                        @if(session()->has('errors'))
                                            <div class="text-danger">
                                                {{session('errors')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label class="text-black" for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                        @if(session()->has('errors'))
                                            <div class="text-danger">
                                                {{session('errors')}}
                                            </div>
                                        @endif


                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <a href="{{route('forget-password')}}">Forget Password ?</a>
                            </div>
                            <div class="form-group mb-3">
                                <a href="{{route('register')}}">Don't Have an account ?</a>
                            </div>
                            <button type="submit" class="btn btn-primary-hover-outline">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
