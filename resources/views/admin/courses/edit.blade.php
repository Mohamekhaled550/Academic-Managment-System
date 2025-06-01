@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>تعديل مقرر</h2>
        <form action="{{ route('admin.courses.update', $course) }}" method="POST">
            @csrf
            @method('PUT')

            @include('admin.courses._form', ['course' => $course])

            <button class="btn btn-primary">تحديث</button>
        </form>
    </div>
@endsection
