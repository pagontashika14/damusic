<!-- Modal -->
<div id="create-image-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title w3-text-blue">Upload Image</h4>
      </div>
      <div class="modal-body">
        <input type="file" id="image-file" name="image-file" accept="image/*">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button onclick="appController.createImage()" type="button" class="btn btn-success">Upload</button>
      </div>
    </div>
  </div>
</div>