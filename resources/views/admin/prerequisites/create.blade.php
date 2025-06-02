@extends('admin.layouts.app')
@section('title', 'إدارة المتطلبات')

@section('content')
<h2>{{ isset($prerequisite) ? 'تعديل' : 'إضافة' }} متطلب</h2>

<form action="{{ isset($prerequisite) ? route('admin.prerequisites.update', $prerequisite) : route('admin.prerequisites.store') }}" method="POST">
    @csrf
    @if(isset($prerequisite)) @method('PUT') @endif

    <div class="mb-3">
        <label for="course_id">المقرر</label>
        <select name="course_id" class="form-control" required>
            <option value="">اختر</option>
            @foreach($courses as $course)
                <option value="{{ $course->id }}" {{ (isset($prerequisite) && $prerequisite->course_id == $course->id) ? 'selected' : '' }}>
                    {{ $course->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="prerequisite_id">المتطلب السابق</label>
        <select name="prerequisite_id" class="form-control" required>
            <option value="">اختر</option>
            @foreach($courses as $course)
                <option value="{{ $course->id }}" {{ (isset($prerequisite) && $prerequisite->prerequisite_id == $course->id) ? 'selected' : '' }}>
                    {{ $course->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">{{ isset($prerequisite) ? 'تحديث' : 'إضافة' }}</button>
</form>
@endsection
