<?php
echo Asset::js(['admin/items/list.js']);
?>
<div class="panel panel-default" style="padding: 10px 0">
    <form class="navbar-form navbar-left" role="search" action="" method="get">
        <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon">分类</span>
              <select class="form-control" name="cateId" id="form_cate_id">
                  <option value=''>--请选择分类--</option>
                  <?php 
                      foreach($cates as $key => $cate):
                          $select = '';
                          if(Input::get('cateId') == $key):
                              $select = 'selected="seelcted"';
                          endif;
                          echo '<option value="'.$key.'" ' .$select . '>'.$cate.'</option>';
                      endforeach;
                  ?>
              </select>
            </div>
        </div>
        <div class="col-sm-3">
            <?php
                $brands = $getBrands(Input::get('cateId'));
            ?>
            <div class="input-group">
              <span class="input-group-addon">品牌</span>
              <select class="form-control" name="brandId" id="form_brand_id">
                  <option value=''>--请选择品牌--</option>
                  <?php
                    foreach($brands as $key => $brand):
                        $select = '';
                        if(Input::get('brandId') == $key):
                            $select = 'selected="seelcted"';
                        endif;
                        echo '<option value="'.$key.'" ' . $select . '>'.$brand . '</option>';;
                    endforeach;
                  ?>
              </select>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon">标题</span>
              <input type="text" class="form-control" value="<?php echo !empty(Input::get('title')) ? Input::get('title') : ''; ?>" name="title" placeholder="商品标题">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">搜索</button>
        <a type="submit" class="btn btn-default" href="<?php echo Uri::create('v2admin/items/list/'.$type); ?>">重置</a>
        </form>
    <div class="clearfix"></div>
</div>
<div class="panel panel-default">
<?php if ($items): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>图片</th>
            <th width="45%">标题</th>
            <th>价格</th>
            <th>进度</th>
            <th>推荐</th>
            <th>状态</th>
            <th>是否删除</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php Config::load('common'); ?>
        <?php foreach ($items as $item): ?>
          <tr>
            <td><img src="<?php echo \Helper\Image::showImage($item->image, '80x80'); ?>" style="width: 40px; height: 40px"/></td>
            <td><a href="<?php echo Uri::create('m/'.$item->id); ?>" target="_blank"><?php echo '(第'.$item->phase_id.'期)'.$item->title; ?></a></td>
            <td><?php echo '￥' . sprintf('%.2f', $item->cost/Config::get('point')); ?></td>
            <td><?php echo $item->joined, '/', $item->amount; ?></td>
            <td title="点击即可修改">
                <select class="form-control recommend" data-id="<?php echo $item->item_id;?>">
                  <?php
                    $recommends = ['否', '首页', '列表'];
                    foreach($recommends as $k => $recommend) {
                        $selected = ($k == $item->is_recommend) ? 'selected=true' : '';
                        echo "<option value='{$k}' {$selected}>{$recommend}</option>";
                    }
                  ?>
                </select>
            </td>
            <td><?php echo $getStatus($item->status);  ?></td>
            <td><?php echo $item->is_delete == 1 ? '<span style="color:red">是</span>':'否';  ?></td>
            <td>
            <?php echo $getOperate($type, $item->item_id, $item->id); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<script>
  OPERATE_URL = '<?php echo Uri::base() . 'v2admin/items/operate'?>';

  $(function(){
      $('.recommend').change(function(){
          var obj = $(this);
          var id = obj.attr('data-id');
          var state = obj.val();
          $.ajax({
                url: '<?php echo Uri::create('v2admin/items/isRecommend');?>',
                type: 'post',
                dataType: 'json',
                data: {id:id, status:state},
                success: function(data) {
                    if(data.code != 0) {
                        alert(data.msg)
                    }
                },
                error: function() {
                    alert('请求失败');
                }
          });
      });
  })
</script>
<?php else: ?>
<p style='text-align:center; padding: 40px'>还没有商品.</p>
<?php endif; ?>
</div>
<?php echo Pagination::instance('mypagination')->render();?>
<script>
    CATE_URL = '<?php echo Uri::create('v2admin/cates/brands'); ?>';
</script>
