<div class="panel panel-default" style="padding: 10px 0">
    <form class="navbar-form navbar-left" role="search" action="" method="get">
        <div class="col-sm-5">
            <div class="input-group">
              <span class="input-group-addon">开始ID</span>
              <input type="text" class="form-control" value="0" id="startId" placeholder="开始ID">
              <span class="input-group-addon">结束ID</span>
              <?php Config::load('common');?>
              <input type="text" class="form-control" value="0" id="endId" placeholder="结束ID">
              <span class="input-group-addon"><img src="/assets/img/jinbi.png"></span>
            </div>
        </div>
        <a class="btn btn-primary" id="load">导出</a>
        </form>
        <a class="btn btn-info" id="return" style="margin-left: 31px;">返回</a>
    <div class="clearfix"></div>
</div>

<script>
    $(function(){
        $('#return').click(function(){
            history.go(-1);
        });
        
        $('#load').click(function(){
            var startId = $('#startId').val();
            var endId = $('#endId').val();
            var url = '<?php echo Uri::create('v2admin/invitcodes/outcsvfile/')?>' + '?startId=' + startId + '&endId=' + endId;
            window.open(url);
        });
    });
</script>

