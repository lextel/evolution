<form action="" role="form" class="form-horizontal">
    <div class="form-group">
              <div class="col-md-5 rigth" id="images">

              </div>
          </div>
            <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>选择图片...</span>
                <input id="fileupload" type="file" name="files[]" multiple>
            </span>
            <br>
            <br>
            <div id="files" class="files">
              <?php 
                if(isset($item)) {
                    $images = unserialize($item->images);
                    foreach($images as $image) {
                        echo '<p><img style="width: 60px; height: 60px; margin:5px; float: left" src="/'.$image.'"><input type="hidden" name="images[]" value="'.$image.'"></p>';
                    }
                }
              ?>
            </div>
            <br>
        </div>
    <div class="form-group">
        <div class="col-lg-4 col-md-offset-1">
            <button type="button" class="btn btn-primary">确定</button>
            <button type="button" class="btn btn-default">取消</button>
        </div>
    </div>
</form>
