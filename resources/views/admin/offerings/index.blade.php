@extends('admin.layouts.app')
@section('title', 'إتاحة المقررات')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>إتاحة المقررات</h2>
    <a href="{{ route('admin.offerings.create') }}" class="btn btn-primary">إضافة إتاحة</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>المقرر</th>
            <th>الترم</th>
            <th>المستوى</th>
            <th>شعبة</th>
            <th>اختياري؟</th>
            <th>إجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($offerings as $offering)
        <tr>
            <td>{{ $offering->course->name }}</td>
            <td>{{ $offering->term->name }}</td>
            <td>{{ $offering->level }}</td>
            <td>{{ $offering->section ?? '-' }}</td>
            <td>{{ $offering->is_elective ? 'نعم' : 'لا' }}</td>
            <td>
                <a href="{{ route('admin.offerings.edit', $offering->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                <form action="{{ route('admin.offerings.destroy', $offering->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
