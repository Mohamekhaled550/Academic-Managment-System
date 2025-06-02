<div class="mb-3">
    <label>اسم الترم</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', optional($term)->name) }}" required>
</div>

<div class="mb-3">
    <label>السنة</label>
    <input type="text" name="year" class="form-control" value="{{ old('year', optional($term)->year) }}" required>
</div>

<div class="mb-3">
    <label>الفصل</label>
    <select name="semester" class="form-control" required>
        <option value="first" {{ old('semester', optional($term)->semester) == 'first' ? 'selected' : '' }}>الأول</option>
        <option value="second" {{ old('semester', optional($term)->semester) == 'second' ? 'selected' : '' }}>الثاني</option>
        <option value="summer" {{ old('semester', optional($term)->semester) == 'summer' ? 'selected' : '' }}>الصيفي</option>
    </select>
</div>

<div class="mb-3">
    <label>المستوى</label>
    <input type="number" name="level" class="form-control" value="{{ old('level', optional($term)->level) }}" min="1" max="4" required>
</div>

<div class="mb-3">
    <label>تاريخ بدء التسجيل</label>
    <input type="datetime-local" name="registration_start_date" class="form-control" value="{{ old('registration_start_date', optional($term)?->registration_start_date?->format('Y-m-d\TH:i')) }}">
</div>

<div class="mb-3">
    <label>تاريخ انتهاء التسجيل</label>
    <input type="datetime-local" name="registration_end_date" class="form-control" value="{{ old('registration_end_date', optional($term)?->registration_end_date?->format('Y-m-d\TH:i')) }}">
</div>

<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ old('is_active', optional($term)->is_active) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">ترم نشط</label>
</div>
