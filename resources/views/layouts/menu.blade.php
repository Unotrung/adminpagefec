<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('system') }}" class="nav-link {{ Request::is('system') ? 'active' : '' }}">
        <i class="nav-icon fas fa-screwdriver-wrench"></i>
        <p>System</p>
    </a>
</li>
