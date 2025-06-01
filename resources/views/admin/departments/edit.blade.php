@extends('admin.layouts.app')

@section('content')
    <h3>تعديل القسم</h3>

    <form action="{{ route('admin.departments.update', $department) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="code">الكود</label>
            <input type="text" name="code" class="form-control" value="{{ $department->code }}" required>
        </div>
        <div class="mb-3">
            <label for="name">الاسم</label>
            <input type="text" name="name" class="form-control" value="{{ $department->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">تحديث</button>
    </form>
@endsection

