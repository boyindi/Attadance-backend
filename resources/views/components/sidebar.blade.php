<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Regware</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">RG</a>
        </div>
        <ul class="sidebar-menu">

            <li class="nav-item">
                <a href="{{ route('home') }}"
                    class="nav-link "><i class="fas fa-fire"></i><span>Dashboard</span></a>

            </li>

            <li class="nav-item  ">
                <a href="{{ route('users.index') }}"
                    class="nav-link"><i class="fas fa-user"></i> <span>Users</span></a>

            </li>
            <li class="nav-item  ">
                <a href="{{ route('company.show',1) }}"
                    class="nav-link"><i class="fas fa-columns"></i> <span>Company</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="{{ route('attendance.index') }}"
                    class="nav-link"><i class="fas fa-calendar-check"></i> <span>Attendances</span></a>
            </li>
            <li class="nav-item  ">
                <a href="{{ route('permission.index') }}"
                    class="nav-link"><i class="fas fa-user-shield"></i> <span>Permissions</span></a>



    </aside>
</div>
