@extends('admin.layouts.app')

@section('content')
    <h1>تعديل بيانات الطالب</h1>

    <form action="{{ route('admin.students.update', $student) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin.students._form', ['student' => $student])

        <button type="submit" class="btn btn-primary">تحديث</button>
    </form>
@endsection
