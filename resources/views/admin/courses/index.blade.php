@extends('admin.layouts.app')

@section('content')
    <h2>قائمة المقررات</h2>
    <a href="{{ route('admin.courses.create') }}"class="btn btn-primary mb-3">إضافة مقرر جديد</a>

     @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>الكود</th>
                <th>القسم</th>
                <th>المجموعة</th>
                <th>السنة</th>
                <th>الساعات المعتمدة</th>
                <th>التحكم</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->code }}</td>
                    <td>{{ $course->department->name }}</td>
                    <td>{{ $course->courseGroup->name }}</td>
                    <td>{{ $course->level }}</td>
                    <td>{{ $course->credit_hours }}</td>
                    <td>
                        <a href="{{ route('admin.courses.edit', $course) }}"class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $courses->links() }}
@endsection
