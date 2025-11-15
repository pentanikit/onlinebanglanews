<!doctype html>
<html lang="bn">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bangla Newspaper Admin</title>
  <!-- Bootstrap 5.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root { color-scheme: light dark; }
    body { background-color: var(--bs-body-bg); }
    .sidebar { width: 280px; }
    .sidebar .nav-link { border-radius: .5rem; }
    .sidebar .nav-link.active { background: rgba(var(--bs-primary-rgb), .15); color: var(--bs-primary); }
    .content-wrap { min-height: 100dvh; }
    .card-table { overflow:auto; }
    .table th, .table td { vertical-align: middle; }
    .chip { display:inline-flex; align-items:center; gap:.25rem; padding:.1rem .5rem; border:1px solid var(--bs-border-color); border-radius: 1rem; font-size:.75rem; }
    .status-dot { width:.5rem; height:.5rem; border-radius: 50%; display:inline-block; }
    .status-published { background: #22c55e; }
    .status-draft { background: #64748b; }
    .status-pending { background: #eab308; }
    @media (max-width: 991.98px){ .sidebar { width: 100%; } }
  </style>
</head>
<body>

    <x-backend.navbar />

      <div class="container-fluid">
        <div class="row content-wrap">
            <x-backend.sidebar />
            <!-- Main -->
            <main class="col-lg-9 col-xl-10 p-3 p-lg-4">
                 @yield('pages')
            </main>
           
        </div>
      </div>

        <!-- Modals: Post / Category / Tag / Page / User -->
  <div class="modal fade" id="postModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <form id="postForm">
          <div class="modal-header"><h5 class="modal-title">নতুন পোস্ট</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
          <div class="modal-body row g-3">
            <div class="col-12">
              <label class="form-label">শিরোনাম</label>
              <input class="form-control" name="title" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">ক্যাটাগরি</label>
              <select class="form-select" name="category_id" id="postCategory"></select>
            </div>
            <div class="col-md-6">
              <label class="form-label">স্ট্যাটাস</label>
              <select class="form-select" name="status" required>
                <option value="draft">Draft</option>
                <option value="pending">Pending</option>
                <option value="published">Published</option>
              </select>
            </div>
            <div class="col-12"><label class="form-label">সাবহেড/ইনট্রো</label><input class="form-control" name="subheading"></div>
            <div class="col-12"><label class="form-label">এক্সসার্প্ট</label><textarea class="form-control" name="excerpt" rows="2"></textarea></div>
            <div class="col-12"><label class="form-label">কনটেন্ট</label><textarea class="form-control" name="content" rows="6"></textarea></div>
            <div class="col-md-6 form-check ms-2"><input class="form-check-input" type="checkbox" name="is_breaking" id="isBreaking"><label class="form-check-label" for="isBreaking">ব্রেকিং</label></div>
            <div class="col-md-6 form-check ms-2"><input class="form-check-input" type="checkbox" name="is_featured" id="isFeatured"><label class="form-check-label" for="isFeatured">ফিচার্ড</label></div>
          </div>
          <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">ক্যানসেল</button><button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> সেভ</button></div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="categoryModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="categoryForm">
          <div class="modal-header"><h5 class="modal-title">নতুন ক্যাটাগরি</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
          <div class="modal-body row g-3">
            <div class="col-12"><label class="form-label">নাম</label><input class="form-control" name="name" required></div>
            <div class="col-12"><label class="form-label">স্লাগ</label><input class="form-control" name="slug"></div>
            <div class="col-md-6"><label class="form-label">টাইপ</label><input class="form-control" name="type" placeholder="news/photo/video"></div>
            <div class="col-md-6"><label class="form-label">ক্রম</label><input class="form-control" name="order_column" type="number" value="0"></div>
            <div class="col-12 form-check ms-2"><input class="form-check-input" type="checkbox" name="is_active" id="catActive" checked><label for="catActive" class="form-check-label">অ্যাক্টিভ</label></div>
          </div>
          <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">ক্যানসেল</button><button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> সেভ</button></div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="tagModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="tagForm">
          <div class="modal-header"><h5 class="modal-title">নতুন ট্যাগ</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
          <div class="modal-body row g-3">
            <div class="col-12"><label class="form-label">নাম</label><input class="form-control" name="name" required></div>
            <div class="col-12"><label class="form-label">স্লাগ</label><input class="form-control" name="slug"></div>
          </div>
          <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">ক্যানসেল</button><button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> সেভ</button></div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="pageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form id="pageForm">
          <div class="modal-header"><h5 class="modal-title">নতুন পেইজ</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
          <div class="modal-body row g-3">
            <div class="col-12"><label class="form-label">শিরোনাম</label><input class="form-control" name="title" required></div>
            <div class="col-md-6"><label class="form-label">স্লাগ</label><input class="form-control" name="slug"></div>
            <div class="col-md-6"><label class="form-label">স্ট্যাটাস</label><select class="form-select" name="status"><option value="draft">Draft</option><option value="published">Published</option></select></div>
            <div class="col-12"><label class="form-label">কনটেন্ট</label><textarea class="form-control" name="content" rows="6"></textarea></div>
          </div>
          <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">ক্যানসেল</button><button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> সেভ</button></div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="userModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="userForm">
          <div class="modal-header"><h5 class="modal-title">নতুন ইউজার</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
          <div class="modal-body row g-3">
            <div class="col-12"><label class="form-label">নাম</label><input class="form-control" name="name" required></div>
            <div class="col-12"><label class="form-label">ইমেইল</label><input class="form-control" name="email" type="email" required></div>
            <div class="col-12"><label class="form-label">রোল</label><input class="form-control" name="role" placeholder="admin/editor/reporter"></div>
          </div>
          <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">ক্যানসেল</button><button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> সেভ</button></div>
        </form>
      </div>
    </div>
  </div>
      <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Theme toggle
    (function(){
      const btn = document.getElementById('toggleTheme');
      const key = 'bn-admin-theme';
      const set = (mode) => {
        document.documentElement.setAttribute('data-bs-theme', mode);
        localStorage.setItem(key, mode);
        btn.innerHTML = mode === 'dark' ? '<i class="bi bi-sun"></i>' : '<i class="bi bi-moon-stars"></i>';
      };
      set(localStorage.getItem(key) || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark':'light'));
      btn.addEventListener('click', () => set((document.documentElement.getAttribute('data-bs-theme')==='dark')?'light':'dark'));
    })();

    // SPA-like navigation
    const views = Array.from(document.querySelectorAll('.view'));
    const navLinks = Array.from(document.querySelectorAll('[data-nav]'));
    function showView(id){
      views.forEach(v=>v.classList.add('d-none'));
      document.querySelectorAll('.nav-link').forEach(n=>n.classList.remove('active'));
      const el = document.getElementById('view-'+id);
      if(el) el.classList.remove('d-none');
      document.querySelectorAll(`[data-nav][href="#${id}"]`).forEach(n=>n.classList.add('active'));
      history.replaceState(null, '', '#'+id);
    }
    window.addEventListener('hashchange', ()=>showView(location.hash.replace('#','')||'dashboard'));
    document.addEventListener('DOMContentLoaded', ()=>showView(location.hash.replace('#','')||'dashboard'));

    // Dummy data + renderers (replace with API calls)
    const state = {
      categories:[{id:1,name:'জাতীয়',slug:'national',type:'news',active:true,order:1},{id:2,name:'আন্তর্জাতিক',slug:'international',type:'news',active:true,order:2}],
      tags:[{id:1,name:'বাংলাদেশ',slug:'bangladesh'},{id:2,name:'অর্থনীতি',slug:'economy'}],
      posts:[{id:1,title:'আজকের প্রধান শিরোনাম',category:'জাতীয়',tags:['বাংলাদেশ'],status:'published',date:'2025-11-15'},{id:2,title:'খেলার খবর',category:'খেলা',tags:['বাংলাদেশ'],status:'draft',date:'2025-11-14'}],
      pages:[{id:1,title:'About',slug:'about',status:'published',updated:'2025-11-14'}],
      users:[{id:1,name:'Admin',email:'admin@example.com',role:'admin',status:'active'}],
      comments:[{id:1,post:'আজকের প্রধান শিরোনাম',body:'দারুন',status:'pending'}],
      media:[]
    };

    function renderLatest(){
      const tbody = document.getElementById('latestPostsTbody');
      tbody.innerHTML = state.posts.slice(0,5).map(p=>`
        <tr>
          <td>${p.title}</td>
          <td>${p.category||'-'}</td>
          <td>
            <span class="status-dot ${p.status==='published'?'status-published':(p.status==='pending'?'status-pending':'status-draft')}"></span>
            <span class="ms-1 text-capitalize">${p.status}</span>
          </td>
          <td>${p.date}</td>
          <td class="text-end"><button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button></td>
        </tr>`).join('');
    }

    function renderPosts(){
      const tbody = document.getElementById('postsTbody');
      const q = (document.getElementById('postSearch').value||'').toLowerCase();
      const st = document.getElementById('postStatus').value;
      let list = state.posts.filter(p=>(!st||p.status===st) && (!q || p.title.toLowerCase().includes(q)));
      document.getElementById('postsSummary').textContent = `${list.length} ফলাফল`;
      tbody.innerHTML = list.map(p=>`
        <tr>
          <td>${p.title}</td>
          <td>${p.category||'-'}</td>
          <td>${(p.tags||[]).map(t=>`<span class="chip">${t}</span>`).join(' ')}</td>
          <td><span class="status-dot ${p.status==='published'?'status-published':(p.status==='pending'?'status-pending':'status-draft')}"></span> <span class="text-capitalize">${p.status}</span></td>
          <td>${p.date}</td>
          <td class="text-end">
            <div class="btn-group btn-group-sm">
              <button class="btn btn-outline-secondary"><i class="bi bi-pencil"></i></button>
              <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
            </div>
          </td>
        </tr>`).join('');
    }

    function renderCategories(){
      const tbody = document.getElementById('categoriesTbody');
      tbody.innerHTML = state.categories.map(c=>`
        <tr>
          <td>${c.name}</td><td>${c.slug}</td><td>${c.type||'-'}</td>
          <td>${c.active?'<span class="badge text-bg-success">Active</span>':'<span class="badge text-bg-secondary">Off</span>'}</td>
          <td>${c.order}</td>
          <td class="text-end">
            <div class="btn-group btn-group-sm">
              <button class="btn btn-outline-secondary"><i class="bi bi-pencil"></i></button>
              <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
            </div>
          </td>
        </tr>`).join('');
      // fill category select in post form
      document.getElementById('postCategory').innerHTML = '<option value="">—</option>' + state.categories.map(c=>`<option value="${c.id}">${c.name}</option>`).join('');
    }

    function renderTags(){
      const tbody = document.getElementById('tagsTbody');
      tbody.innerHTML = state.tags.map(t=>`
        <tr>
          <td>${t.name}</td><td>${t.slug}</td>
          <td class="text-end">
            <div class="btn-group btn-group-sm">
              <button class="btn btn-outline-secondary"><i class="bi bi-pencil"></i></button>
              <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
            </div>
          </td>
        </tr>`).join('');
    }

    function renderPages(){
      const tbody = document.getElementById('pagesTbody');
      tbody.innerHTML = state.pages.map(p=>`
        <tr>
          <td>${p.title}</td><td>${p.slug}</td><td><span class="badge ${p.status==='published'?'text-bg-success':'text-bg-secondary'}">${p.status}</span></td><td>${p.updated}</td>
          <td class="text-end">
            <div class="btn-group btn-group-sm">
              <button class="btn btn-outline-secondary"><i class="bi bi-pencil"></i></button>
              <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
            </div>
          </td>
        </tr>`).join('');
    }

    function renderUsers(){
      const tbody = document.getElementById('usersTbody');
      tbody.innerHTML = state.users.map(u=>`
        <tr>
          <td>${u.name}</td><td>${u.email}</td><td><span class="chip">${u.role}</span></td><td><span class="badge text-bg-success">${u.status}</span></td>
          <td class="text-end">
            <div class="btn-group btn-group-sm">
              <button class="btn btn-outline-secondary"><i class="bi bi-pencil"></i></button>
              <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
            </div>
          </td>
        </tr>`).join('');
    }

    function renderComments(){
      const tbody = document.getElementById('commentsTbody');
      tbody.innerHTML = state.comments.map(c=>`
        <tr>
          <td>${c.post}</td><td>${c.body}</td><td><span class="badge ${c.status==='pending'?'text-bg-warning':'text-bg-success'}">${c.status}</span></td>
          <td class="text-end">
            <div class="btn-group btn-group-sm">
              <button class="btn btn-outline-success"><i class="bi bi-check2"></i></button>
              <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
            </div>
          </td>
        </tr>`).join('');
    }

    function renderMedia(){
      const grid = document.getElementById('mediaGrid');
      if(!grid) return;
      if(!state.media.length){ grid.innerHTML = '<div class="text-center text-secondary">কোনো মিডিয়া নেই</div>'; return; }
      grid.innerHTML = state.media.map((m,i)=>`
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card h-100">
            <img src="${m.src}" class="card-img-top" alt="media-${i}">
            <div class="card-body p-2 small text-truncate">${m.name||'image'}</div>
          </div>
        </div>`).join('');
    }

    // Simple handlers for demo
    document.getElementById('postStatus').addEventListener('change', renderPosts);
    document.getElementById('postSearch').addEventListener('input', renderPosts);
    document.getElementById('postForm').addEventListener('submit', function(e){
      e.preventDefault();
      const fd = new FormData(this);
      state.posts.unshift({ id: Date.now(), title: fd.get('title'), category: state.categories.find(c=>c.id==fd.get('category_id'))?.name, tags: [], status: fd.get('status')||'draft', date: new Date().toISOString().slice(0,10) });
      renderPosts(); renderLatest();
      bootstrap.Modal.getInstance(document.getElementById('postModal')).hide();
      this.reset();
    });
    document.getElementById('categoryForm').addEventListener('submit', function(e){
      e.preventDefault();
      const fd = new FormData(this);
      state.categories.push({ id: Date.now(), name: fd.get('name'), slug: fd.get('slug')||fd.get('name'), type: fd.get('type')||'news', active: !!fd.get('is_active'), order: Number(fd.get('order_column')||0) });
      renderCategories();
      bootstrap.Modal.getInstance(document.getElementById('categoryModal')).hide();
      this.reset();
    });
    document.getElementById('tagForm').addEventListener('submit', function(e){
      e.preventDefault();
      const fd = new FormData(this);
      state.tags.push({ id: Date.now(), name: fd.get('name'), slug: fd.get('slug')||fd.get('name') });
      renderTags();
      bootstrap.Modal.getInstance(document.getElementById('tagModal')).hide();
      this.reset();
    });
    document.getElementById('pageForm').addEventListener('submit', function(e){
      e.preventDefault();
      const fd = new FormData(this);
      state.pages.push({ id: Date.now(), title: fd.get('title'), slug: fd.get('slug')||fd.get('title'), status: fd.get('status')||'draft', updated: new Date().toISOString().slice(0,10) });
      renderPages();
      bootstrap.Modal.getInstance(document.getElementById('pageModal')).hide();
      this.reset();
    });
    document.getElementById('userForm').addEventListener('submit', function(e){
      e.preventDefault();
      const fd = new FormData(this);
      state.users.push({ id: Date.now(), name: fd.get('name'), email: fd.get('email'), role: fd.get('role')||'editor', status: 'active' });
      renderUsers();
      bootstrap.Modal.getInstance(document.getElementById('userModal')).hide();
      this.reset();
    });
    document.getElementById('settingsForm').addEventListener('submit', function(e){
      e.preventDefault();
      const fd = new FormData(this);
      console.log('Settings saved', Object.fromEntries(fd.entries()));
      const toast = document.createElement('div');
      toast.className = 'toast align-items-center text-bg-success border-0 position-fixed bottom-0 end-0 m-3';
      toast.innerHTML = '<div class="d-flex"><div class="toast-body">সেটিংস সেভ হয়েছে</div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button></div>';
      document.body.appendChild(toast); new bootstrap.Toast(toast,{delay:1500}).show();
    });

    document.getElementById('mediaUpload').addEventListener('change', function(){
      const files = Array.from(this.files||[]);
      files.forEach(f=>{
        const url = URL.createObjectURL(f);
        state.media.push({src:url,name:f.name});
      });
      renderMedia();
      this.value = '';
    });

    // Menus demo
    const menuList = document.getElementById('menuList');
    const menuPanel = document.getElementById('menuItemsPanel');
    const menus = []; let selectedMenu = null;
    document.getElementById('createMenuBtn').addEventListener('click', ()=>{
      const name = document.getElementById('menuName').value.trim();
      const loc = document.getElementById('menuLocation').value.trim();
      if(!name) return;
      const m = { id: Date.now(), name, location: loc, items: [] };
      menus.push(m); renderMenus();
      document.getElementById('menuName').value=''; document.getElementById('menuLocation').value='';
    });
    function renderMenus(){
      menuList.innerHTML = menus.map(m=>`<li class="list-group-item d-flex justify-content-between align-items-center">
        <span>${m.name} <small class="text-secondary">(${m.location||'-'})</small></span>
        <button class="btn btn-sm btn-outline-primary" data-id="${m.id}"><i class="bi bi-pencil-square"></i> ম্যানেজ</button>
      </li>`).join('');
      menuList.querySelectorAll('button').forEach(btn=>btn.addEventListener('click',()=>{
        selectedMenu = menus.find(x=>x.id==btn.dataset.id);
        renderMenuItems();
      }));
    }
    function renderMenuItems(){
      if(!selectedMenu){ menuPanel.innerHTML = 'একটি মেনু সিলেক্ট করুন…'; return; }
      const itemList = selectedMenu.items.map((it,i)=>`<li class="list-group-item d-flex justify-content-between align-items-center">${it.label}<span class="text-secondary small">${it.url||''}</span></li>`).join('');
      menuPanel.innerHTML = `
        <div class="mb-2">সিলেক্টেড: <strong>${selectedMenu.name}</strong></div>
        <div class="row g-2 align-items-center mb-2">
          <div class="col-12 col-sm"><input id="miLabel" class="form-control" placeholder="লেবেল"></div>
          <div class="col-12 col-sm"><input id="miUrl" class="form-control" placeholder="URL (/news)"></div>
          <div class="col-12 col-sm-auto"><button id="addMiBtn" class="btn btn-outline-primary"><i class="bi bi-plus-lg"></i> যোগ</button></div>
        </div>
        <ul class="list-group">${itemList || '<li class="list-group-item text-secondary">কোনো আইটেম নেই</li>'}</ul>`;
      const addBtn = document.getElementById('addMiBtn');
      if(addBtn){ addBtn.addEventListener('click',()=>{ const l=document.getElementById('miLabel').value.trim(); const u=document.getElementById('miUrl').value.trim(); if(!l) return; selectedMenu.items.push({label:l,url:u}); renderMenuItems(); }); }
    }

    // Initial render
    renderLatest(); renderPosts(); renderCategories(); renderTags(); renderPages(); renderUsers(); renderComments(); renderMedia();
  </script>
</body>
</html>