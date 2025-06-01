@extends('admin.layouts.app')

@section('content')
    <h3>الأقسام</h3>
    <a href="{{ route('admin.departments.create') }}" class="btn btn-primary mb-3">إضافة قسم جديد</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الكود</th>
                <th>الاسم</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $department)
                <tr>
                    <td>{{ $department->code }}</td>
                    <td>{{ $department->name }}</td>
                    <td>
                        <a href="{{ route('admin.departments.edit', $department) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('admin.departments.destroy', $department) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
