<!DOCTYPE html>
<html>
<head>
    <title>تسجيل دخول الطالب</title>
</head>
<body>
    <h2>تسجيل دخول الطالب</h2>

    <form method="POST" action="{{ route('student.login.submit') }}">
        @csrf
        <label>الرقم القومي:</label>
        <input type="text" name="national_id" required>
        @error('national_id')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <br><br>
        <button type="submit">دخول</button>
    </form>
</body>
</html>
