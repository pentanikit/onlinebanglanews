      <!-- Main -->
      <main class="col-lg-9 col-xl-10 p-3 p-lg-4">

        <!-- Dashboard -->
        <section id="view-dashboard" class="view d-none">
          <div class="row g-3 mb-3">
            <div class="col-6 col-md-3">
              <div class="card h-100">
                <div class="card-body">
                  <div class="text-secondary small">আজকের ভিজিট</div>
                  <div class="display-6 fw-bold">12,480</div>
                  <span class="badge text-bg-success"><i class="bi bi-graph-up"></i> +4.2%</span>
                </div>
              </div>
            </div>
            <div class="col-6 col-md-3">
              <div class="card h-100">
                <div class="card-body">
                  <div class="text-secondary small">মোট পোস্ট</div>
                  <div id="statTotalPosts" class="display-6 fw-bold">342</div>
                </div>
              </div>
            </div>
            <div class="col-6 col-md-3">
              <div class="card h-100">
                <div class="card-body">
                  <div class="text-secondary small">ড্রাফট</div>
                  <div id="statDrafts" class="display-6 fw-bold">28</div>
                </div>
              </div>
            </div>
            <div class="col-6 col-md-3">
              <div class="card h-100">
                <div class="card-body">
                  <div class="text-secondary small">কমেন্ট অপেক্ষমাণ</div>
                  <div class="display-6 fw-bold">19</div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">সাম্প্রতিক পোস্ট</h5>
              <a class="btn btn-sm btn-outline-secondary" href="#posts"><i class="bi bi-newspaper"></i> সব দেখুন</a>
            </div>
            <div class="card-body card-table">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>শিরোনাম</th>
                    <th>ক্যাটাগরি</th>
                    <th>স্ট্যাটাস</th>
                    <th>তারিখ</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="latestPostsTbody"></tbody>
              </table>
            </div>
          </div>
        </section>

        <!-- Posts -->
        <section id="view-posts" class="view d-none">
          <div class="card">
            <div class="card-header">
              <div class="row g-2 align-items-center">
                <div class="col"><h5 class="mb-0">পোস্ট ম্যানেজ</h5></div>
                <div class="col-12 col-md-auto">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input id="postSearch" class="form-control" placeholder="শিরোনাম/ট্যাগ">
                  </div>
                </div>
                <div class="col-6 col-md-auto">
                  <select id="postStatus" class="form-select">
                    <option value="">সব স্ট্যাটাস</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="pending">Pending</option>
                  </select>
                </div>
                <div class="col-6 col-md-auto text-end">
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postModal"><i class="bi bi-plus-lg"></i> নতুন পোস্ট</button>
                </div>
              </div>
            </div>
            <div class="card-body card-table">
              <table class="table table-striped align-middle">
                <thead>
                  <tr>
                    <th>শিরোনাম</th>
                    <th>ক্যাটাগরি</th>
                    <th>ট্যাগ</th>
                    <th>স্ট্যাটাস</th>
                    <th>তারিখ</th>
                    <th class="text-end">একশন</th>
                  </tr>
                </thead>
                <tbody id="postsTbody"></tbody>
              </table>
            </div>
            <div class="card-footer d-flex justify-content-between small text-secondary">
              <div id="postsSummary">0 ফলাফল</div>
              <div class="btn-group">
                <button class="btn btn-outline-secondary" id="prevPage">পূর্ববর্তী</button>
                <button class="btn btn-outline-secondary" id="nextPage">পরবর্তী</button>
              </div>
            </div>
          </div>
        </section>

        <!-- Categories -->
        <section id="view-categories" class="view d-none">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">ক্যাটাগরি</h5>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal"><i class="bi bi-plus-lg"></i> নতুন ক্যাটাগরি</button>
            </div>
            <div class="card-body card-table">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>নাম</th>
                    <th>স্লাগ</th>
                    <th>টাইপ</th>
                    <th>স্ট্যাটাস</th>
                    <th>ক্রম</th>
                    <th class="text-end">একশন</th>
                  </tr>
                </thead>
                <tbody id="categoriesTbody"></tbody>
              </table>
            </div>
          </div>
        </section>

        <!-- Tags -->
        <section id="view-tags" class="view d-none">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">ট্যাগ</h5>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tagModal"><i class="bi bi-plus-lg"></i> নতুন ট্যাগ</button>
            </div>
            <div class="card-body card-table">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>নাম</th>
                    <th>স্লাগ</th>
                    <th class="text-end">একশন</th>
                  </tr>
                </thead>
                <tbody id="tagsTbody"></tbody>
              </table>
            </div>
          </div>
        </section>

        <!-- Media -->
        <section id="view-media" class="view d-none">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">মিডিয়া লাইব্রেরি</h5>
              <label class="btn btn-primary mb-0">
                <i class="bi bi-upload"></i> আপলোড <input type="file" id="mediaUpload" class="d-none" multiple accept="image/*">
              </label>
            </div>
            <div class="card-body">
              <div id="mediaGrid" class="row g-3"></div>
            </div>
          </div>
        </section>

        <!-- Menus -->
        <section id="view-menus" class="view d-none">
          <div class="card">
            <div class="card-body">
              <div class="row g-4">
                <div class="col-lg-6">
                  <h5 class="mb-3">মেনুসমূহ</h5>
                  <div class="row g-2 align-items-center">
                    <div class="col-12 col-sm"><input id="menuName" class="form-control" placeholder="মেনুর নাম (Main Menu)"></div>
                    <div class="col-12 col-sm"><input id="menuLocation" class="form-control" placeholder="লোকেশন (header/footer)"></div>
                    <div class="col-12 col-sm-auto"><button id="createMenuBtn" class="btn btn-primary"><i class="bi bi-plus-lg"></i> যোগ</button></div>
                  </div>
                  <ul id="menuList" class="list-group list-group-flush mt-3"></ul>
                </div>
                <div class="col-lg-6">
                  <h5 class="mb-3">মেনু আইটেম</h5>
                  <div id="menuItemsPanel" class="border border-dashed rounded-3 p-4 text-secondary">একটি মেনু সিলেক্ট করুন…</div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Pages -->
        <section id="view-pages" class="view d-none">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">পেইজ</h5>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pageModal"><i class="bi bi-plus-lg"></i> নতুন পেইজ</button>
            </div>
            <div class="card-body card-table">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>শিরোনাম</th>
                    <th>স্লাগ</th>
                    <th>স্ট্যাটাস</th>
                    <th>আপডেট</th>
                    <th class="text-end">একশন</th>
                  </tr>
                </thead>
                <tbody id="pagesTbody"></tbody>
              </table>
            </div>
          </div>
        </section>

        <!-- Users -->
        <section id="view-users" class="view d-none">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">ইউজার ম্যানেজমেন্ট</h5>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal"><i class="bi bi-person-plus"></i> নতুন ইউজার</button>
            </div>
            <div class="card-body card-table">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>নাম</th>
                    <th>ইমেইল</th>
                    <th>রোল</th>
                    <th>স্ট্যাটাস</th>
                    <th class="text-end">একশন</th>
                  </tr>
                </thead>
                <tbody id="usersTbody"></tbody>
              </table>
            </div>
          </div>
        </section>

        <!-- Comments -->
        <section id="view-comments" class="view d-none">
          <div class="card">
            <div class="card-header"><h5 class="mb-0">কমেন্ট</h5></div>
            <div class="card-body card-table">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>পোস্ট</th>
                    <th>কমেন্ট</th>
                    <th>অবস্থা</th>
                    <th class="text-end">একশন</th>
                  </tr>
                </thead>
                <tbody id="commentsTbody"></tbody>
              </table>
            </div>
          </div>
        </section>

        <!-- Settings -->
        <section id="view-settings" class="view d-none">
          <div class="card">
            <div class="card-header"><h5 class="mb-0">সেটিংস</h5></div>
            <div class="card-body">
              <form id="settingsForm" class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">সাইটের নাম</label>
                  <input class="form-control" name="site_name" placeholder="Bangla Newspaper">
                </div>
                <div class="col-md-6">
                  <label class="form-label">ট্যাগলাইন</label>
                  <input class="form-control" name="site_tagline" placeholder="সত্যের পথে">
                </div>
                <div class="col-md-6">
                  <label class="form-label">ফেসবুক লিংক</label>
                  <input class="form-control" name="facebook_link" placeholder="https://facebook.com/...">
                </div>
                <div class="col-md-6">
                  <label class="form-label">লোগো URL</label>
                  <input class="form-control" name="logo_path" placeholder="/storage/logo.png">
                </div>
                <div class="col-12"><button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> সেভ</button></div>
              </form>
            </div>
          </div>
        </section>

      </main>