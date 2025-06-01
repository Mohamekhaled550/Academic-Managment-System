@extends('admin.layouts.app')

@section('content')
    <h2>إضافة دور جديد</h2>
    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>اسم الدور</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>الصلاحيات</label>
            @foreach($permissions as $permission)
                <div>
                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"> {{ $permission->name }}
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
@endsection
