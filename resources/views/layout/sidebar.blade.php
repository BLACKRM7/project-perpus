<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ route('beranda') }}">Perpus</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('beranda') }}">PK</a>
          </div>
          <ul class="sidebar-menu">
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
            <li class="{{ request()->routeIs('buku') ? 'active' : '' }}"><a class="nav-link" href="{{ route('buku') }}"><i class="fas fa-book"></i> <span>Buku</span></a></li>
            <li class="{{ request()->routeIs('anggota') ? 'active' : '' }}"><a class="nav-link" href="{{ route('anggota') }}"><i class="fas fa-users"></i> <span>Anggota</span></a></li>
            <li class="{{ request()->routeIs('peminjaman') ? 'active' : '' }}"><a class="nav-link" href="{{ route('peminjaman') }}"><i class="fas fa-money-bill"></i> <span>Peminjaman</span></a></li>
            <li class="{{ request()->routeIs('petugas') ? 'active' : '' }}"><a class="nav-link" href="{{ route('petugas') }}"><i class="fas fa-user-shield"></i> <span>Petugas</span></a></li>
          </ul>
          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Documentation
            </a>
          </div>
        </aside>
      </div>