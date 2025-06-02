@extends('admin.layouts.app')
@section('content')
    <h2>{{ isset($registration) ? 'تعديل تسجيل' : 'تسجيل مادة جديدة' }}</h2>
    <form method="POST" action="{{ isset($registration) ? route('admin.registrations.update', $registration->id) : route('admin.registrations.store') }}">
        @csrf
        @if(isset($registration)) @method('PUT') @endif

        <div class="mb-3">
            <label>الطالب</label>
            <select name="student_id" class="form-control">
                @foreach($students as $student)
                    <option value="{{ $student->id }}" @selected(isset($registration) && $registration->student_id == $student->id)>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>المادة</label>
            <select name="course_id" class="form-control">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" @selected(isset($registration) && $registration->course_id == $course->id)>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>الترم</label>
            <select name="term_id" class="form-control">
                @foreach($terms as $term)
                    <option value="{{ $term->id }}" @selected(isset($registration) && $registration->term_id == $term->id)>
                        {{ $term->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>الدرجة</label>
            <input type="number" name="grade" step="0.01" class="form-control" value="{{ old('grade', $registration->grade ?? '') }}">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_retake" class="form-check-input" id="is_retake" {{ old('is_retake', $registration->is_retake ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_retake">إعادة المادة</label>
        </div>

        <button class="btn btn-success">حفظ</button>
    </form>
@endsection
