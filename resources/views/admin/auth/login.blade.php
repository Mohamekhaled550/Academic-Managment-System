@extends('admin.layouts.app')

@section('title', 'تسجيل الدخول')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h4>Admin control unit</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.login.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" class="form-control" required autofocus placeholder="Enter your email ">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password </label>
                            <input type="password" name="password" class="form-control" required placeholder="Enter your password">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">دخول</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
