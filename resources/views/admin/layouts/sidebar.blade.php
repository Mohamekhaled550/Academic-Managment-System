<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">لوحة التحكم</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">

                @can('view dashboard')
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @endcan

                @can('manage admins')
                <li class="nav-item">
                    <a href="{{ route('admin.admins.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>المسؤولين</p>
                    </a>
                </li>
                @endcan

                @can('manage roles')
                <li class="nav-item">
                    <a href="{{ route('admin.roles.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-tag"></i>
                        <p>الأدوار</p>
                    </a>
                </li>
                @endcan

                @can('manage permissions')
                <li class="nav-item">
                    <a href="{{ route('admin.permissions.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>الصلاحيات</p>
                    </a>
                </li>
                @endcan

                @can('manage courses')
                <li class="nav-item">
                    <a href="{{ route('admin.courses.index') }}" class="nav-link">                        <i class="nav-icon fas fa-book"></i>
                        <p>المقررات</p>
                    </a>
                </li>
                @endcan

                @can('manage students')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>الطلاب</p>
                    </a>
                </li>
                @endcan

            </ul>
        </nav>
    </div>
</aside>
