<script type="text/javascript">
function isEmpty(obj)
{
    for (var name in obj) 
    {
        return false;
    }
    return true;
};
function getParse(queryString){
    var params = {}, queries, temp, i, l;
    if ( queryString.length == 0 ){
        return params;
    }
    
    queries = queryString.split("&");
    for ( i = 0, l = queries.length; i < l; i++ ) {
        temp = queries[i].split('=');
        params[temp[0]] = temp[1];
    }
    return params;
};
function locateUrl(url, val, key, params){
    var queryString = window.location.search;
    queryString = queryString.substring(1);
    var res = getParse(queryString);
    if (!isEmpty(res)){
        if (res[key] == undefined ){
            res[key] = val;
        }else{
            res[key] = val;
        }
        window.location.href = url + '?' + $.param(res);
    }else{
        window.location.href = url + '?' + key + '='+ val;
    }
};
$(function(){
   
   $(".postactive").change(function(){
       var val = $(this).val();
       var url = window.location.pathname;       
       locateUrl(url, val, 'active');
   });
   $(".poststatus").change(function(){
       var val = $(this).val();
       var url = window.location.pathname;
       locateUrl(url, val, 'status');
   });
});
</script>
<div class="input-group">
    <span class="input-group-addon">选择分类</span>
    <?php echo Form::select('active', Input::param('active'),[
        '0' => '所有',
        '1' => '投诉建议',
        '2' => '商品配送',
        '3' => '售后服务',
        ],
        ['class'=>'form-control postactive', 'style'=>'height:34px; width: 200px']
    );?>
    <span class=""></span>
    <?php echo Form::select('status', Input::param('status'),[
        '0' => '未阅',
        '1' => '已阅',
        ],
        ['class'=>'form-control poststatus', 'style'=>'height:34px; width: 200px']
    );?>
</div>
<br>
<?php if ($suggests): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th width="5%">#ID</th>
            <th width="5%">类型</th>
            <th width="40%">内容</th>
            <th width="10%">提交人</th>
            <th width="10%">状态</th>
            <th width="10%">操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($suggests as $item){ ?>
         <tr>
            <th><?php echo $item->id; ?></th>
            <td>
                <?php echo $item->type;?>
            </td>
            <td><?php echo $item->title ? $item->title.'<p>'.mb_substr($item->text, 0, 42,'utf-8').'</p>' : mb_substr($item->text, 0, 42,'utf-8'); ?></td>
            <td><?php echo $item->nickname ? $item->nickname.'<br />'.$item->email : $item->email; ?></td>
            <td><?php echo is_null($item->status) ? '未阅': '已阅'; ?></td>
            <td>               
                <?php echo Html::anchor('/v2admin/suggests/view/'.$item->id, '查看'); ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php echo Pagination::instance('suggestpage')->render(); ?>
<?php else: ?>
<p>该分类没晒单.</p>
<?php endif; ?><p>
</p>
