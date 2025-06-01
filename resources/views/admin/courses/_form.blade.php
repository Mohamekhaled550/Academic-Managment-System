<div class="mb-3">
    <label>اسم المقرر</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $course->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>كود المقرر</label>
    <input type="text" name="code" class="form-control" value="{{ old('code', $course->code ?? '') }}" required>
</div>

<div class="mb-3">
    <label>القسم</label>
    <select name="department_id" class="form-control" required>
        <option value="">اختر القسم</option>
        @foreach($departments as $dept)
            <option value="{{ $dept->id }}" {{ old('department_id', $course->department_id ?? '') == $dept->id ? 'selected' : '' }}>
                {{ $dept->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>مجموعة المقرر</label>
    <select name="course_group_id" class="form-control" required>
        <option value="">اختر المجموعة</option>
        @foreach($courseGroups as $group)
            <option value="{{ $group->id }}" {{ old('course_group_id', $course->course_group_id ?? '') == $group->id ? 'selected' : '' }}>
                {{ $group->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>المستوى</label>
    <input type="number" name="level" class="form-control" value="{{ old('level', $course->level ?? 1) }}" min="1" max="4" required>
</div>

<div class="mb-3">
    <label>عدد الساعات المعتمدة</label>
    <input type="number" name="credit_hours" class="form-control" value="{{ old('credit_hours', $course->credit_hours ?? '') }}" required>
</div>

<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" name="is_elective" value="1" {{ old('is_elective', $course->is_elective ?? false) ? 'checked' : '' }}>
    <label class="form-check-label">اختياري</label>
</div>

<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" name="is_project" value="1" {{ old('is_project', $course->is_project ?? false) ? 'checked' : '' }}>
    <label class="form-check-label">مشروع</label>
</div>
