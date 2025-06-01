@extends('admin.layouts.app')

@section('content')
    <h3>تعديل مجموعة المقررات</h3>

    <form action="{{ route('admin.course-groups.update', $courseGroup) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="code">الكود</label>
            <input type="number" name="code" class="form-control" value="{{ $courseGroup->code }}" required>
        </div>
        <div class="mb-3">
            <label for="name">الاسم</label>
            <input type="text" name="name" class="form-control" value="{{ $courseGroup->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">تحديث</button>
    </form>
@endsection
