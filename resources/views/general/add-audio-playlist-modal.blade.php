<!-- Modal -->
<div id="add-audio-playlist-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Thêm nhạc vào playlist</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="aapm-playlist">Chọn playlist:</label>
              <select id="aapm-playlist" name="aapm-playlist" style="width:100%;"></select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button onclick="playAudioController.hiddenAudioPlaylist()" type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button onclick="playAudioController.addAudioPlaylist()" type="button" class="btn btn-success">Add</button>
      </div>
    </div>

  </div>
</div>