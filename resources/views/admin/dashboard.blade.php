@extends('admin.layouts.app')

@section('title')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold">مرحبًا بك في لوحة التحكم 👋</h2>
        <p class="text-muted">هنا يمكنك إدارة كل شيء بسهولة.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded-circle p-3 me-3">
                            <i class="fas fa-user-graduate fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1">الطلاب</h5>
                            <h4 class="fw-bold">{{ \App\Models\Student::count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success text-white rounded-circle p-3 me-3">
                            <i class="fas fa-book fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1">المقررات</h5>
                            <h4 class="fw-bold">{{ \App\Models\Course::count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning text-white rounded-circle p-3 me-3">
                            <i class="fas fa-calendar-alt fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1">الترمات</h5>
                            <h4 class="fw-bold">{{ \App\Models\Term::count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-dark text-white rounded-circle p-3 me-3">
                            <i class="fas fa-user-shield fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1">الإداريين</h5>
                            <h4 class="fw-bold">{{ \App\Models\Admin::count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- يمكنك إضافة قسم آخر لآخر تسجيلات أو التنبيهات هنا لاحقًا --}}
</div>
@endsection
