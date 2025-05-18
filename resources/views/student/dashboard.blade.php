@extends('layouts.student')

@section('content')
    <h2>أهلاً بك يا {{ $student->name }}</h2>
    <p>معدل الـ GPA الحالي: {{ $student->gpa }}</p>
    <p>عدد الساعات المنجزة: {{ $student->total_credits }}</p>

    <a href="{{ route('student.register.show') }}" class="btn btn-primary mt-3">تسجيل مواد جديدة</a>
@endsection
