@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>الأدوار</h1>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary mb-3">إضافة دور جديد</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>الصلاحيات</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ implode(', ', $role->permissions->pluck('name')->toArray()) }}</td>
                        <td>
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:inline-block">
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
