@extends('admin.layouts.app')

@section('content')
    <h2>تعديل الصلاحية: {{ $permission->name }}</h2>
    <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>اسم الصلاحية</label>
            <input type="text" name="name" class="form-control" value="{{ $permission->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">تحديث</button>
    </form>
@endsection
