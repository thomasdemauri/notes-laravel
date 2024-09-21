@extends('layouts.main_layout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-8">
            <div class="card p-5">
                
                <!-- logo -->
                <div class="text-center p-3">
                    <img src="assets/images/logo.png" alt="Notes logo">
                </div>

                <!-- form -->
                <div class="row justify-content-center">
                    <div class="col-md-10 col-12">
                        <form action="/login" method="POST" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="text_username" class="form-label">Username</label>
                                <input type="email" class="form-control bg-dark text-info" name="text_username" value="{{ old('text_username') }}" required>
                                {{-- error --}}
                                @error('text_username')
                                    {{-- caso tenha algum erro relacionado com esse input, mostre a mensagem vinculada a ele --}}
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="text_password" class="form-label">Password</label>
                                <input type="password" class="form-control bg-dark text-info" name="text_password" required>
                                {{-- error --}}
                                @error('text_password')
                                    {{-- caso tenha algum erro relacionado com esse input, mostre a mensagem vinculada a ele --}}
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-secondary w-100">LOGIN</button>
                            </div>
                        </form>

                        {{-- invalid login --}}
                        @if (session('login_error'))
                            <div class="alert alert-danger text-center">{{ session('login_error') }}</div>
                        @endif

                    </div>
                </div>

                <!-- copy -->
                <div class="text-center text-secondary mt-3">
                    <small>&copy; <?= date('Y') ?> Notes</small>
                </div>

                {{-- erros maneira alternativa --}}
                {{-- @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul class="m-0">
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>                    
                @endif --}}


            </div>
        </div>
    </div>
</div>
@endsection