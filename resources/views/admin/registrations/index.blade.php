@extends('admin.layouts.app')
@section('content')
    <h2>قائمة تسجيل المواد</h2>
    <a href="{{ route('admin.registrations.create') }}" class="btn btn-primary">تسجيل مادة جديدة</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>الطالب</th>
                <th>المادة</th>
                <th>الترم</th>
                <th>الدرجة</th>
                <th>إعادة</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrations as $reg)
                <tr>
                    <td>{{ $reg->student->name }}</td>
                    <td>{{ $reg->course->name }}</td>
                    <td>{{ $reg->term->name }}</td>
                    <td>{{ $reg->grade ?? '---' }}</td>
                    <td>{{ $reg->is_retake ? 'نعم' : 'لا' }}</td>
                    <td>
                        <a href="{{ route('admin.registrations.edit', $reg->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('admin.registrations.destroy', $reg->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('هل أنت متأكد؟')" class="btn btn-sm btn-danger">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $registrations->links() }}
@endsection
