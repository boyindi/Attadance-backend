@extends('layouts.auth')

@section('title', 'Login')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')

    <!-- ⬅️ DIUBAH: card-primary → card-success (HIJAU) -->
    <div class="card card-success">
        <div class="card-header">
            <!-- ⬅️ DIUBAH: tambah text-success -->
            <h4 class="text-success">Login</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" tabindex="1">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2">
                </div>

                <div class="form-group">
                    <!-- ⬅️ DIUBAH: btn-primary → btn-success -->
                    <button type="submit" class="btn btn-success btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="text-muted mt-5 text-center">
        <!-- ⬅️ DIUBAH: tambah text-success -->
        Don't have an account? <a href="#" class="text-success">Create One</a>
    </div>

@endsection
