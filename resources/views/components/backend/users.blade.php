        <!-- Users -->
        <section id="view-users" class="view">
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