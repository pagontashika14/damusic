<!-- Modal -->
<div id="create-singer-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title w3-text-blue">Tạo mới nghệ sĩ</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="csm-stage-name">Nghệ danh:</label>
              <input type="text" class="form-control" id="csm-stage-name">
            </div>
            <div class="form-group">
              <label for="csm-sample">Nghệ danh tương tự:</label>
              <input type="text" class="form-control" id="csm-sample" disabled>
            </div>
            <div class="form-group">
              <label for="csm-nation">Quốc gia:</label>
              <select id="csm-nation" name="csm-nation" style="width:100%;"></select>
            </div>
            <div class="form-group">
              <label for="csm-image">Ảnh:</label>
              <select id="csm-image" name="csm-image" style="width:100%;"></select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="csm-name">Tên thật:</label>
              <input type="text" class="form-control" id="csm-name">
            </div>
            <div class="form-group">
              <label for="csm-birthday">Ngày sinh/ Năm thành lập:</label>
              <input type="text" class="form-control" id="csm-birthday">
            </div>
            <img id='csm-image-view' src="/api/image/index/124794cb4fbbca1a578d2d474998096a" alt="image" style="width:180px;height:180px;">
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="csm-description">Mô tả:</label>
              <textarea class="form-control" rows="5" id="csm-description"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button onclick="appController.createSinger()" type="button" class="btn btn-success">Create</button>
      </div>
    </div>
  </div>
</div>