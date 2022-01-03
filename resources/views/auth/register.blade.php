@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class=" form-group">
                                    <input id="name" type="text"
                                        class="form-control form-control-user @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name"
                                        placeholder="First Name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input id="email" type="email"
                                        class="form-control form-control-user @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required placeholder="Email Address"
                                        autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input id="password" type="password"
                                            class="form-control form-control-user @error('password') is-invalid @enderror"
                                            name="password" required placeholder="Password" autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="password-confirm" type="password" class="form-control form-control-user"
                                            name="password_confirmation" placeholder="Repeat Password" required
                                            autocomplete="new-password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Register') }}
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                @if (Route::has('password.request'))
                                    <a class="small" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="text-center">
                                <a class="small" href="/login">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
