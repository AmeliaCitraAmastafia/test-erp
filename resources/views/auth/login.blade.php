@extends('layouts.app')

@section('content')
    <section>
        <h1>Login</h1>
        <p class="muted">Masuk menggunakan akun Google untuk membuka layanan inventory.</p>

        @if ($googleConfigured)
            <a class="button" href="{{ route('auth.google.redirect') }}">Login Google</a>
        @else
            <p class="danger">Google Client ID dan Client Secret belum diisi di file .env.</p>
        @endif
    </section>
@endsection
