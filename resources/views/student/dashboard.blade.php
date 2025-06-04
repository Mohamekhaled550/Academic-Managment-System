@extends('layouts.student')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">لوحة تحكم الطالب</h4>
        </div>

        <div class="card-body">
            <h5>👋 أهلاً بك، {{ $student->name }}</h5>
            <hr>

            <div class="row text-center">
                <div class="col-md-4 mb-3">
                    <div class="border rounded p-3 bg-light">
                        <h6>📊 المعدل التراكمي (GPA)</h6>
                        <p class="fs-4 fw-bold text-primary">{{ $student->gpa ?? 'غير متوفر' }}</p>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="border rounded p-3 bg-light">
                        <h6>🎓 الساعات المنجزة</h6>
                        <p class="fs-4 fw-bold text-success">{{ $student->total_credits ?? 0 }}</p>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="border rounded p-3 bg-light">
                        <h6>⚠️ الحالة الأكاديمية</h6>
                        <p class="fs-5 fw-bold {{ $student->gpa < 2.0 ? 'text-danger' : 'text-success' }}">
                            {{ $student->gpa < 2.0 ? 'تحذير أكاديمي' : 'منتظم' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-center gap-3">
                <a href="{{ route('student.register.show') }}" class="btn btn-success">
                    📚 تسجيل مواد جديدة
                </a>

                <a href="{{ route('student.myRegistrations') }}" class="btn btn-outline-primary">
                    🗂️ السجل الأكاديمي
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
