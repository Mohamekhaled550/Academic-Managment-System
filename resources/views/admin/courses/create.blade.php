@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>إضافة مقرر</h2>
        <form action="{{ route('admin.courses.store') }}" method="POST">
            @csrf

            @include('admin.courses._form', ['course' => null])

            <button class="btn btn-success">حفظ</button>
        </form>
    </div>
@endsection
