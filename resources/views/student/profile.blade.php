@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">👤 بيانات الطالب</h2>

    <div class="card">
        <div class="card-header">معلومات أساسية</div>
        <div class="card-body">
            <p><strong>الاسم:</strong> {{ $student->name }}</p>
            <p><strong>البريد الإلكتروني:</strong> {{ $student->email ?? 'غير مسجل' }}</p>
            <p><strong>الرقم القومي:</strong> {{ $student->national_id }}</p>
            <p><strong>القسم:</strong> {{ $student->department->name }}</p>
            <p><strong>المعدل التراكمي (GPA):</strong> {{ $student->gpa }}</p>
            <p><strong>عدد الساعات المجتازة:</strong> {{ $student->total_credits }}</p>
        </div>
    </div>
</div>
@endsection
