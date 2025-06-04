<div class="mb-3">
    <label for="name">اسم الترم</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', optional($term)->name) }}" required>
</div>

<div class="mb-3">
    <label for="year">السنة</label>
    <input type="number" name="year" id="year" class="form-control" value="{{ old('year', optional($term)->year) }}" min="2000" max="2100" required>
</div>

<div class="mb-3">
    <label for="semester">الفصل الدراسي</label>
    <select name="semester" id="semester" class="form-control" required>
        <option value="" disabled {{ old('semester', optional($term)->semester) === null ? 'selected' : '' }}>اختر الفصل</option>
        <option value="1" {{ old('semester', optional($term)->semester) == 1 ? 'selected' : '' }}>الفصل الأول</option>
        <option value="2" {{ old('semester', optional($term)->semester) == 2 ? 'selected' : '' }}>الفصل الثاني</option>
        <option value="3" {{ old('semester', optional($term)->semester) == 3 ? 'selected' : '' }}>الصيفي</option>
    </select>
</div>

<div class="mb-3">
    <label for="level">المستوى</label>
    <input type="number" name="level" id="level" class="form-control" value="{{ old('level', optional($term)->level) }}" min="1" max="4" required>
</div>

<div class="mb-3">
    <label for="registration_start_date">تاريخ بدء التسجيل</label>
    <input type="datetime-local" name="registration_start_date" id="registration_start_date" class="form-control"
        value="{{ old('registration_start_date', optional($term)?->registration_start_date?->format('Y-m-d\TH:i')) }}">
</div>

<div class="mb-3">
    <label for="registration_end_date">تاريخ انتهاء التسجيل</label>
    <input type="datetime-local" name="registration_end_date" id="registration_end_date" class="form-control"
        value="{{ old('registration_end_date', optional($term)?->registration_end_date?->format('Y-m-d\TH:i')) }}">
</div>

<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
        {{ old('is_active', optional($term)->is_active) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">ترم نشط</label>
</div>
