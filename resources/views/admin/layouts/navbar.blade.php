<nav class="top-navbar d-flex justify-content-between align-items-center">
    <div>
        <h5 class="mb-0">مرحبًا {{ Auth::guard('admin')->user()->name ?? 'مسؤول' }}</h5>
    </div>

    <div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button class="btn btn-outline-dark btn-sm"><i class="fas fa-sign-out-alt me-1"></i> تسجيل الخروج</button>
        </form>
    </div>
</nav>
