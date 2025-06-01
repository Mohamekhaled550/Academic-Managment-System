@extends('admin.layouts.app')

@section('content')
    <h2>إضافة صلاحية جديدة</h2>
    <form action="{{ route('admin.permissions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>اسم الصلاحية</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
@endsection
