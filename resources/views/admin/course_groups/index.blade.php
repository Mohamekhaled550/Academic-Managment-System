@extends('admin.layouts.app')

@section('content')
    <h3>مجموعات المقررات</h3>
    <a href="{{ route('admin.course-groups.create') }}" class="btn btn-primary mb-3">إضافة مجموعة جديدة</a>
<form action="{{ route('admin.course-groups.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="input-group mb-3">
        <input type="file" name="file" class="form-control" accept=".csv, .xlsx" required>
        <button class="btn btn-primary">استيراد</button>
    </div>
</form>
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
            @foreach($groups as $group)
                <tr>
                    <td>{{ $group->code }}</td>
                    <td>{{ $group->name }}</td>
                    <td>
                        <a href="{{ route('admin.course-groups.edit', $group) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('admin.course-groups.destroy', $group) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
