@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>إدارة المسؤولين</h1>
        <a href="{{ route('admin.admins.create') }}" class="btn btn-primary mb-3">إضافة مسؤول جديد</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الأدوار</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ implode(', ', $admin->getRoleNames()->toArray()) }}</td>
                        <td>
                            <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                            <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
