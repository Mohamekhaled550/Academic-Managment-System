@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>الصلاحيات</h1>
        <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary mb-3">إضافة صلاحية جديدة</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                            <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
            {{ $permissions->links() }}

    </div>
@endsection
