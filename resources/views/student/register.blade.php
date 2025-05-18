@extends('layouts.student')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">تسجيل المواد</h5>
            <span>الترم الحالي: <strong>{{ $term->name }}</strong></span>
        </div>

        <div class="card-body">
            {{-- تنبيه خاص للطالب المستجد --}}
            @if($maxHours == 18 && $minHours == 12)
                <div class="alert alert-success">
                    🟢 طالب مستجد – تم السماح بتسجيل حتى <strong>18</strong> ساعة.
                </div>
            @endif

            <p class="mb-3">مسموح بالتسجيل من <strong>{{ $minHours }}</strong> إلى <strong>{{ $maxHours }}</strong> ساعة معتمدة.</p>

            <form action="{{ route('student.register.store') }}" method="POST" id="registrationForm">
                @csrf
                <input type="hidden" name="term_id" value="{{ $term->id }}">

                <table class="table table-bordered table-striped table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>تسجيل</th>
                            <th>اسم المادة</th>
                            <th>رمز المادة</th>
                            <th>عدد الساعات</th>
                            <th>المستوى</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($availableCourses as $course)
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input course-checkbox"
                                        name="courses[]" value="{{ $course->id }}"
                                        data-hours="{{ $course->credit_hours }}">
                                </td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->code ?? '-' }}</td>
                                <td>{{ $course->credit_hours }}</td>
                                <td>{{ $course->level }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">لا توجد مواد متاحة للتسجيل حالياً.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="alert alert-info mt-3">
                    إجمالي الساعات المختارة: <span id="selectedHours">0</span> ساعة
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">تسجيل المواد</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const checkboxes = document.querySelectorAll('.course-checkbox');
        const selectedHoursSpan = document.getElementById('selectedHours');
        const form = document.getElementById('registrationForm');
        const maxHours = {{ $maxHours }};
        const minHours = {{ $minHours }};

        function updateSelectedHours() {
            let total = 0;
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    total += parseInt(checkbox.dataset.hours);
                }
            });
            selectedHoursSpan.textContent = total;

            checkboxes.forEach(checkbox => {
                if (!checkbox.checked && total >= maxHours) {
                    checkbox.disabled = true;
                } else {
                    checkbox.disabled = false;
                }
            });
        }

        checkboxes.forEach(cb => cb.addEventListener('change', updateSelectedHours));

        // منع إرسال الفورم إذا الساعات المختارة أقل من المسموح
        form.addEventListener('submit', function (e) {
            let total = 0;
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    total += parseInt(checkbox.dataset.hours);
                }
            });

            if (total < minHours) {
                e.preventDefault();
                alert(`يجب اختيار مواد بعدد لا يقل عن ${minHours} ساعة.`);
            }
        });
    });
</script>
@endsection
