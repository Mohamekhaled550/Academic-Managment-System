@extends('admin.layouts.app')

@section('content')
    <h3>إضافة قسم جديد</h3>

    <form action="{{ route('admin.departments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="code">الكود</label>
            <input type="text" name="code" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="name">الاسم</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">حفظ</button>
    </form>
@endsection
