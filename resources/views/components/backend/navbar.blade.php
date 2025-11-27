  <!-- Top Navbar -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top border-bottom">
    <div class="container-fluid">
      <button class="btn btn-outline-secondary d-lg-none me-2" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar"><i class="bi bi-list"></i></button>
      <a class="navbar-brand fw-bold" href="#dashboard"><span class="badge text-bg-primary me-2">BN</span>Admin</a>
      <div class="d-none d-md-flex align-items-center gap-2">
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-search"></i></span>
          <input class="form-control" id="topSearch" placeholder="সার্চ করুন...">
        </div>
      </div>
      <div class="ms-auto d-flex align-items-center gap-2">
        <button class="btn btn-outline-secondary" id="toggleTheme" title="Dark/Light"><i class="bi bi-moon-stars"></i></button>
        <div class="dropdown">
          <button class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-person-circle me-1"></i>Admin</button>
          <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="#profile">প্রোফাইল</a>
            <a class="dropdown-item" href="{{ route('logout') }}">লগআউট</a>
          </div>
        </div>
      </div>
    </div>
  </nav>