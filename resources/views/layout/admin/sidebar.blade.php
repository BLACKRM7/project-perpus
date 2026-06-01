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
      <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
      </li>

      <li class="menu-header">Management</li>

      <li class="dropdown {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Users</span></a>
        <ul class="dropdown-menu">
          <li class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.users.index') }}">Daftar User</a></li>
          <li class="{{ request()->routeIs('admin.users.create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.users.create') }}">Tambah User</a></li>
        </ul>
      </li>

      <li class="dropdown {{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book"></i> <span>Buku</span></a>
        <ul class="dropdown-menu">
          <li class="{{ request()->routeIs('admin.books.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.books.index') }}">Daftar Buku</a></li>
          <li class="{{ request()->routeIs('admin.books.create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.books.create') }}">Tambah Buku</a></li>
        </ul>
      </li>

      <li class="dropdown {{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-building"></i> <span>Ruangan</span></a>
        <ul class="dropdown-menu">
          <li class="{{ request()->routeIs('admin.rooms.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.rooms.index') }}">Daftar Ruangan</a></li>
          <li class="{{ request()->routeIs('admin.rooms.create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.rooms.create') }}">Tambah Ruangan</a></li>
        </ul>
      </li>

      <li class="dropdown {{ request()->routeIs('admin.borrowings.*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-exchange-alt"></i> <span>Peminjaman</span></a>
        <ul class="dropdown-menu">
          <li class="{{ request()->routeIs('admin.borrowings.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.borrowings.index') }}">Daftar Peminjaman</a></li>
          <li class="{{ request()->routeIs('admin.borrowings.create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.borrowings.create') }}">Tambah Peminjaman</a></li>
        </ul>
      </li>

      <li class="{{ request()->routeIs('admin.returns.*') ? 'active' : '' }}">
        <a href="{{ route('admin.returns.index') }}" class="nav-link"><i class="fas fa-undo"></i> <span>Pengembalian</span></a>
      </li>

      <li class="menu-header">Settings</li>
      <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-danger w-100" style="margin-top: 5px; text-decoration: none; display: inline-block; text-align: center;">
          Logout
        </a>
      </div>
    </ul>
  </aside>
</div>
