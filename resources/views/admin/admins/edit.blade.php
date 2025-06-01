@extends('admin.layouts.app')

@section('content')
    <h2>تعديل المسؤول: {{ $admin->name }}</h2>
    <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>الاسم</label>
            <input type="text" name="name" class="form-control" value="{{ $admin->name }}" required>
        </div>
        <div class="form-group">
            <label>البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control" value="{{ $admin->email }}" required>
        </div>
        <div class="form-group">
            <label>الصلاحيات</label>
            @foreach($roles as $role)
                <div>
                    <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                        {{ $admin->hasRole($role->name) ? 'checked' : '' }}> {{ $role->name }}
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">تحديث</button>
    </form>
@endsection
