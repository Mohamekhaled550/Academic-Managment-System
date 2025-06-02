<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - @yield('title')</title>

    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

   <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f5f7fa;
    }
    .sidebar {
        width: 240px;
        height: 100vh;
        background-color: #1f2937;
        color: #fff;
        position: fixed;
        top: 0;
        right: 0; /* تغيير الاتجاه لليمين */
    }
    .sidebar .nav-link {
        color: #cbd5e1;
        padding: 12px 20px;
    }
    .sidebar .nav-link.active,
    .sidebar .nav-link:hover {
        background-color: #374151;
        color: #fff;
    }
    .sidebar .nav-link i {
        margin-left: 10px;
    }
    .top-navbar {
        margin-right: 240px; /* تغيير الاتجاه لليمين */
        background-color: #fff;
        border-bottom: 1px solid #e5e7eb;
        padding: 10px 20px;
        height: 60px;
    }
    .main-content {
        margin-right: 240px; /* تغيير الاتجاه لليمين */
        padding: 30px;
    }
</style>

</head>
<body>
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')

   <div class="main-content">
        @yield('content')
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
