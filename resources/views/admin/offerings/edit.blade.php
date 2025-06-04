@extends('admin.layouts.app')
@section('title', isset($offering) ? 'تعديل الإتاحة' : 'إضافة إتاحة')

@section('content')
<h2>{{ isset($offering) ? 'تعديل' : 'إضافة' }} إتاحة مقرر</h2>

<form action="{{ isset($offering) ? route('admin.offerings.update', $offering->id) : route('admin.offerings.store') }}" method="POST">
    @csrf
    @if(isset($offering)) @method('PUT') @endif

    <div class="mb-3">
        <label for="course_id">المقرر</label>
        <select name="course_id" class="form-control" required>
            <option value="">اختر</option>
            @foreach($courses as $course)
                <option value="{{ $course->id }}" {{ isset($offering) && $offering->course_id == $course->id ? 'selected' : '' }}>
                    {{ $course->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="term_id">الترم</label>
        <select name="term_id" class="form-control" required>
            <option value="">اختر</option>
            @foreach($terms as $term)
                <option value="{{ $term->id }}" {{ isset($offering) && $offering->term_id == $term->id ? 'selected' : '' }}>
                    {{ $term->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="level">المستوى</label>
        <select name="level" class="form-control" required>
            <option value="">اختر</option>
            @for($i = 1; $i <= 4; $i++)
                <option value="{{ $i }}" {{ isset($offering) && $offering->level == $i ? 'selected' : '' }}>المستوى {{ $i }}</option>
            @endfor
        </select>
    </div>

    <div class="mb-3">
        <label for="section">الشعبة (اختياري)</label>
        <input type="text" name="section" class="form-control" value="{{ $offering->section ?? '' }}">
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" name="is_elective" class="form-check-input" id="is_elective" {{ isset($offering) && $offering->is_elective ? 'checked' : '' }}>
        <label class="form-check-label" for="is_elective">مقرر اختياري</label>
    </div>

    <button class="btn btn-success">{{ isset($offering) ? 'تحديث' : 'إضافة' }}</button>
</form>
@endsection
