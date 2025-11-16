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