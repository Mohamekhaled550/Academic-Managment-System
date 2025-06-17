@extends('admin.layouts.app')

@section('content')
    <h1>الطلاب</h1>

    <a href="{{ route('admin.students.create') }}" class="btn btn-primary mb-3">إضافة طالب</a>
<form action="{{ route('admin.students.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="input-group mb-3">
        <input type="file" name="file" class="form-control" accept=".csv, .xlsx" required>
        <button class="btn btn-primary">استيراد</button>
    </div>
</form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>الرقم القومي</th>
                <th>البريد الإلكتروني</th>
                <th>المستوى</th>
                <th>المعدل</th>
                <th>الساعات المجتازة</th>
                <th>الحالة</th>
                <th>القسم</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->national_id }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->level }}</td>
                    <td>{{ $student->gpa }}</td>
                    <td>{{ $student->total_credits }}</td>
                    <td>{{ $student->status }}</td>
                    <td>{{ $student->department->name }}</td>
                    <td>
                        <a href="{{ route('admin.students.show', $student->id) }}" class="btn btn-sm btn-info">عرض</a>
                        <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('admin.students.destroy', $student) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
