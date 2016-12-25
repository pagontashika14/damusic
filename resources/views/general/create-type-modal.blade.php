<!-- Modal -->
<div id="create-type-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tạo mới thể loại</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="ctm-name">Tên:</label>
              <input type="text" class="form-control" id="ctm-name">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="ctm-sample">Tên đã có tương tự:</label>
              <input type="text" class="form-control" id="ctm-sample" disabled>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button onclick="appController.createType()" type="button" class="btn btn-success">Create</button>
      </div>
    </div>

  </div>
</div>