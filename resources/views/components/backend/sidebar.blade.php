      <!-- Sidebar (desktop) -->
      <aside class="col-lg-3 col-xl-2 p-3 border-end d-none d-lg-block">
        <nav class="nav flex-column gap-1 sidebar">
          <a class="nav-link" data-nav href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>ড্যাশবোর্ড</a>
          <a class="nav-link" data-nav href="{{ route('siteicons') }}"><i class="bi bi-images me-2"></i>লোগো এন্ড ফেভিকন</a>
          <a class="nav-link" data-nav href="{{ route('adminposts') }}"><i class="bi bi-newspaper me-2"></i>পোস্ট</a>
          <a class="nav-link" data-nav href="{{ route('admincategories') }}"><i class="bi bi-list-ul me-2"></i>ক্যাটাগরি</a>
          <a class="nav-link" data-nav href="#tags"><i class="bi bi-tags me-2"></i>ট্যাগ</a>
          <a class="nav-link" data-nav href="{{ route('adminmedias') }}"><i class="bi bi-images me-2"></i>মিডিয়া</a>
          <a class="nav-link" data-nav href="#menus"><i class="bi bi-menu-button-wide me-2"></i>মেনু</a>
          <a class="nav-link" data-nav href="#pages"><i class="bi bi-file-earmark-text me-2"></i>পেইজ</a>
          <a class="nav-link" data-nav href="#users"><i class="bi bi-people me-2"></i>ইউজার</a>
          <a class="nav-link" data-nav href="#comments"><i class="bi bi-chat-square-text me-2"></i>কমেন্ট</a>
          <a class="nav-link" data-nav href="#settings"><i class="bi bi-gear me-2"></i>সেটিংস</a>
        </nav>
      </aside>

      <!-- Offcanvas Mobile Sidebar -->
      <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title">নেভিগেশন</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <nav class="nav flex-column gap-1 sidebar">
          <a class="nav-link" data-nav href="{{ route('dashboard') }}" data-bs-dismiss="offcanvas"><i class="bi bi-speedometer2 me-2"></i>ড্যাশবোর্ড</a>
          <a class="nav-link" data-nav href="{{ route('siteicons') }}" data-bs-dismiss="offcanvas"><i class="bi bi-images me-2"></i>লোগো এন্ড ফেভিকন</a>
          <a class="nav-link" data-nav href="{{ route('adminposts') }}" data-bs-dismiss="offcanvas"><i class="bi bi-newspaper me-2"></i>পোস্ট</a>
          <a class="nav-link" data-nav href="{{ route('admincategories') }}" data-bs-dismiss="offcanvas"><i class="bi bi-list-ul me-2"></i>ক্যাটাগরি</a>
            <a class="nav-link" data-nav href="#tags" data-bs-dismiss="offcanvas"><i class="bi bi-tags me-2"></i>ট্যাগ</a>
            <a class="nav-link" data-nav href="{{ route('adminmedias') }}" data-bs-dismiss="offcanvas"><i class="bi bi-images me-2"></i>মিডিয়া</a>
            <a class="nav-link" data-nav href="#menus" data-bs-dismiss="offcanvas"><i class="bi bi-menu-button-wide me-2"></i>মেনু</a>
            <a class="nav-link" data-nav href="#pages" data-bs-dismiss="offcanvas"><i class="bi bi-file-earmark-text me-2"></i>পেইজ</a>
            <a class="nav-link" data-nav href="#users" data-bs-dismiss="offcanvas"><i class="bi bi-people me-2"></i>ইউজার</a>
            <a class="nav-link" data-nav href="#comments" data-bs-dismiss="offcanvas"><i class="bi bi-chat-square-text me-2"></i>কমেন্ট</a>
            <a class="nav-link" data-nav href="#settings" data-bs-dismiss="offcanvas"><i class="bi bi-gear me-2"></i>সেটিংস</a>
          </nav>
        </div>
      </div>