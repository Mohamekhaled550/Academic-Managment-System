<div class="sidebar d-flex flex-column">
    <div class="p-4 border-bottom">
        <h4 class="text-white mb-0">Control Unit</h4>
    </div>
    <nav class="mt-3">
        <ul class="nav flex-column">

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i> لوحة التحكم
                </a>
            </li>

            @can('manage students')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}" href="{{ route('admin.students.index') }}">
                    <i class="fas fa-user-graduate"></i> إدارة الطلاب
                </a>
            </li>
            @endcan

            @can('manage courses')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}" href="{{ route('admin.courses.index') }}">
                    <i class="fas fa-book"></i> المقررات
                </a>
            </li>
            @endcan

            @can('manage terms')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.terms.*') ? 'active' : '' }}" href="{{ route('admin.terms.index') }}">
                    <i class="fas fa-calendar-alt"></i> الترمات
                </a>
            </li>
            @endcan

             @can('manage offerings')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.offerings.*') ? 'active' : '' }}" href="{{ route('admin.offerings.index') }}">
                    <i class="fas fa-lock"></i> مجموعة الترمات
                </a>
            </li>
            @endcan

             @can('manage course groups')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.course_groups.*') ? 'active' : '' }}" href="{{ route('admin.course-groups.index') }}">
                    <i class="fas fa-lock"></i> مجموعة الكورسات
                </a>
            </li>
            @endcan

             @can('manage departments')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.departments.*') ? 'active' : '' }}" href="{{ route('admin.departments.index') }}">
                    <i class="fas fa-lock"></i> الاقسام
                </a>
            </li>
            @endcan

             @can('manage prerequisites')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.prerequisites.*') ? 'active' : '' }}" href="{{ route('admin.prerequisites.index') }}">
                    <i class="fas fa-lock"></i> المواد المترتبة
                </a>
            </li>
            @endcan


             @can('manage admins')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}" href="{{ route('admin.admins.index') }}">
                    <i class="fas fa-user-shield"></i> المسؤولين
                </a>
            </li>
            @endcan

            @can('manage roles')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
                    <i class="fas fa-user-tag"></i> الأدوار
                </a>
            </li>
            @endcan

            @can('manage permissions')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}" href="{{ route('admin.permissions.index') }}">
                    <i class="fas fa-lock"></i> الصلاحيات
                </a>
            </li>
            @endcan
        </ul>
    </nav>
</div>
