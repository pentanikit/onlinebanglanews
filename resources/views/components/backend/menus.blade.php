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