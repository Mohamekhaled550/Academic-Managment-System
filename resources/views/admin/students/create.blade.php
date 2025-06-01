@extends('admin.layouts.app')

@section('content')
    <h1>إضافة طالب جديد</h1>

    <form action="{{ route('admin.students.store') }}" method="POST">
        @csrf

        @include('admin.students.form')

        <button type="submit" class="btn btn-success">حفظ</button>
    </form>
@endsection
