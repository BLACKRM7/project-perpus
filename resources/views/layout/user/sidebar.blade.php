<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('home') }}">Mini Project</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('home') }}">MP</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
        <a href="{{ route('user.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
      </li>

      <li class="menu-header">Menu</li>

      <li class="{{ request()->routeIs('user.books.*') ? 'active' : '' }}">
        <a href="{{ route('user.books.index') }}" class="nav-link"><i class="fas fa-laptop"></i> <span>Buku Tersedia</span></a>
      </li>

      <li class="{{ request()->routeIs('user.borrowings.*') ? 'active' : '' }}">
        <a href="{{ route('user.borrowings.index') }}" class="nav-link"><i class="fas fa-exchange-alt"></i> <span>Peminjaman Saya</span></a>
      </li>

      <li class="menu-header">Settings</li>
      <li class="{{ request()->routeIs('user.profile.*') ? 'active' : '' }}">
        <a href="{{ route('user.profile.index') }}" class="nav-link"><i class="fas fa-user"></i> <span>Profil Saya</span></a>
      </li>

      <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-danger w-100" style="margin-top: 5px; text-decoration: none; display: inline-block; text-align: center;">
          Logout
        </a>
      </div>
    </ul>
  </aside>
</div>
