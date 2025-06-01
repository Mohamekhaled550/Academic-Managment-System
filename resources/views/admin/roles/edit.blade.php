@extends('admin.layouts.app')

@section('content')
    <h2>تعديل الدور: {{ $role->name }}</h2>
    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>اسم الدور</label>
            <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
        </div>
        <div class="form-group">
            <label>الصلاحيات</label>
            @foreach($permissions as $permission)
                <div>
                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}> {{ $permission->name }}
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">تحديث</button>
    </form>
@endsection
