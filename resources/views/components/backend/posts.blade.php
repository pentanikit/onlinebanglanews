

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