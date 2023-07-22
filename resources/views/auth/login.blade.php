@extends('login.app')

@section('content')

<div class="authincation h-100" style="background-image: url('https://institutointesa.edu.co/login2/images/MesaIntesa7.png')">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <b>{{ __('Login') }}</b><br>
                            <small>Instituto Tecnico Del Saber</small>
                        
                            
                    </div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
    
                            <div class=" mb-3">
                                <label for="email" class="col-form-label text-md-end"><i class="fa-solid fa-envelope mr-2"></i>{{ __('Correo Electronico') }}</label>
    
                                <div class="">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="mb-3">
                                <label for="password" class="col-form-label text-md-end"><i class="fa-sharp fa-solid fa-key mr-2"></i>{{ __('Contraseña') }}</label>
    
                                <div class="">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3 d-none">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row mb-0">
                                <div class="col-md-8 ">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fa-solid fa-user"></i> {{ __('Iniciar Sesión') }}
                                    </button>
    
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
