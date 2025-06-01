@extends('admin.layouts.app')

@section('content')
    <h2>إضافة مسؤول جديد</h2>
    <form action="{{ route('admin.admins.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>الاسم</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>كلمة المرور</label>
            <input type="password" name="password" class="form-control" required>
        </div>
         <div class="form-group">
            <label>تاكيد كلمة المرور </label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <div class="form-group">
            <label>الصلاحيات</label>
            @foreach($roles as $role)
                <div>
                    <input type="checkbox" name="roles[]" value="{{ $role->name }}"> {{ $role->name }}
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
@endsection
