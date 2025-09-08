@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', 'Admin Girişi')

@section('auth_body')
    <x-success-alert />
    <x-error-alert />

    <form action="{{ route('admin.login.post') }}" method="POST">
        @csrf

        <div class="input-group mb-3">
            <input type="text" name="email" class="form-control" placeholder="E-posta" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            <x-validation-error column="email" />
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Şifre">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            <x-validation-error column="password" />
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            Giriş Yap
        </button>
    </form>
@endsection

@section('auth_footer')
    {{-- No registration or password reset links for admin --}}
@endsection