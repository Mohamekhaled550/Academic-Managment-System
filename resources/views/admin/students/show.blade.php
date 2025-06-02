@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h3>بيانات الطالب</h3>
    <p><strong>الاسم:</strong> {{ $student->name }}</p>
    <p><strong>الرقم القومي:</strong> {{ $student->national_id }}</p>
    <p><strong>الإيميل:</strong> {{ $student->email }}</p>
    <p><strong>المعدل التراكمي:</strong> {{ $student->gpa }}</p>
    <p><strong>إجمالي الساعات:</strong> {{ $student->total_credits }}</p>
    <p><strong>القسم:</strong> {{ $student->department->name }}</p>
    <p><strong>المستوى:</strong> {{ $student->level }}</p>
    <p><strong>الحالة:</strong> {{ $student->status }}</p>

    <hr>

    <h4>المقررات المسجلة في كل ترم</h4>

    @foreach($student->registrations->groupBy('term.name') as $termName => $registrations)
        <div class="card mt-3">
            <div class="card-header">
                <strong>الترم: {{ $termName }}</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>المقرر</th>
                            <th>كود المقرر</th>
                            <th>الدرجة</th>
                            <th>إعادة تسجيل؟</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrations as $registration)
                            <tr>
                                <td>{{ $registration->course->name }}</td>
                                <td>{{ $registration->course->code }}</td>
                                <td>{{ $registration->grade ?? 'لم ترصد بعد' }}</td>
                                <td>{{ $registration->is_retake ? 'نعم' : 'لا' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>
@endsection
