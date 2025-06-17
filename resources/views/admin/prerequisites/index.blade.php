@extends('admin.layouts.app')
@section('title', 'المتطلبات السابقة')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>المتطلبات السابقة</h2>
    <a href="{{ route('admin.prerequisites.create') }}" class="btn btn-primary">إضافة متطلب</a>
</div>
<form action="{{ route('admin.prerequisites.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="input-group mb-3">
        <input type="file" name="file" class="form-control" accept=".csv, .xlsx" required>
        <button class="btn btn-primary">استيراد</button>
    </div>
</form>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>المقرر</th>
            <th>المتطلب السابق</th>
            <th>إجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($prerequisites as $p)
        <tr>
            <td>{{ $p->course->name }}</td>
            <td>{{ $p->prerequisiteCourse->name }}</td>
            <td>
                <a href="{{ route('admin.prerequisites.edit', $p->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                <form action="{{ route('admin.prerequisites.destroy', $p->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    {{ $prerequisites->links() }}

@endsection
