<div class="mb-3">
    <label>الاسم</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $student->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>الرقم القومي</label>
    <input type="text" name="national_id" class="form-control" value="{{ old('national_id', $student->national_id ?? '') }}" required>
</div>

<div class="mb-3">
    <label>البريد الإلكتروني</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $student->email ?? '') }}" required>
</div>

<div class="mb-3">
    <label>القسم</label>
    <select name="department_id" class="form-control" required>
        @foreach($departments as $dept)
            <option value="{{ $dept->id }}" {{ (old('department_id', $student->department_id ?? '') == $dept->id) ? 'selected' : '' }}>
                {{ $dept->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>المستوى</label>
    <input type="number" name="level" min="1" max="4" class="form-control" value="{{ old('level', $student->level ?? 1) }}" required>
</div>

<div class="mb-3">
    <label>المعدل التراكمي</label>
    <input type="number" step="0.01" name="gpa" class="form-control" value="{{ old('gpa', $student->gpa ?? 0) }}" required>
</div>

<div class="mb-3">
    <label>إجمالي الساعات</label>
    <input type="number" name="total_credits" class="form-control" value="{{ old('total_credits', $student->total_credits ?? 0) }}" required>
</div>

<div class="mb-3">
    <label>الحالة</label>
    <select name="status" class="form-control" required>
        <option value="active" {{ old('status', $student->status ?? '') == 'active' ? 'selected' : '' }}>نشط</option>
        <option value="graduated" {{ old('status', $student->status ?? '') == 'graduated' ? 'selected' : '' }}>متخرج</option>
        <option value="suspended" {{ old('status', $student->status ?? '') == 'suspended' ? 'selected' : '' }}>موقوف</option>
    </select>
</div>
