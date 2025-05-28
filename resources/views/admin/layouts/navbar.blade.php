<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Control Unit</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarAdmin">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.admins.index') }}">Admins</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.roles.index') }}">Roles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.permissions.index') }}">Permissions</a>
                </li>
            </ul>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="btn btn-outline-light">Logout</button>
            </form>
        </div>
    </div>
</nav>
