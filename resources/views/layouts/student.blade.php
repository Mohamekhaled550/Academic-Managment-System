<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة الطالب</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('student.dashboard') }}">نظام الطالب</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.dashboard') }}">الرئيسية</a>
                    </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.status') }}">حالة الطالب</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.profile') }}">الملف الشخصي</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.register.show') }}">تسجيل المواد</a>
                    </li>
                </ul>
                <form method="POST" action="{{ route('student.logout') }}">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">تسجيل الخروج</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
    @yield('scripts')

</body>
</html>
