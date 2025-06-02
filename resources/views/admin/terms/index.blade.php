@extends('admin.layouts.app')

@section('content')
    <h3>كل الترمات</h3>
    <a href="{{ route('admin.terms.create') }}" class="btn btn-primary mb-3">إضافة ترم جديد</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>السنة</th>
                <th>الفصل</th>
                <th>المستوى</th>
                <th>الترم نشط؟</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($terms as $term)
                <tr>
                    <td>{{ $term->name }}</td>
                    <td>{{ $term->year }}</td>
                    <td>{{ $term->semester }}</td>
                    <td>{{ $term->level }}</td>
                    <td>{{ $term->is_active ? 'نعم' : 'لا' }}</td>
                    <td>
                        <a href="{{ route('admin.terms.edit', $term) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('admin.terms.destroy', $term) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $terms->links() }}
@endsection
