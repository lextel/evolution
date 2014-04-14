<?php echo Asset::js(['jquery.zclip.min.js']); ?>
<div class="content-inner" style="min-height: 565px;">
    <!--邀请开始-->
    <div class="lead">邀请好友</div>
    <div class="show-box">
        <div class="remind" style="line-height: 40px;height:40px">
            <?php if(!empty($current_user->is_mobile)):?>
            邀请链接： <input type="text" id="copyShareText"  value="<?php echo Uri::create('/invite/'.base64_encode($current_user->id)); ?>" style="margin-right: 10px; line-height: 28px; width: 400px"/>
            <a href="javascript:;" id="btnCopy" class="btn btn-red" style="text-align:center;width: 60px;height: 28px;line-height: 28px;padding-right: 14px;font-size:12px">复制</a>
            <span style="color:green"></span>
            <?php else: ?>
            提示：您还没有验证手机，请您验证之后获取邀请链接。
            <?php endif;?>
        </div>
        <script>
            $(document).ready(function(){
                $("#btnCopy").zclip({
                    path:'<?php echo Uri::create('/assets/js/ZeroClipboard.swf');?>',
                    copy:$('#copyShareText').text(),
                    beforeCopy:function(){
                        $(this).next('span').html();
                    },
                    afterCopy:function(){
                        $(this).next('span').html('复制成功!');
                    }
                });
            });
        </script>
        <br />
        <div class="show-c">
            <table>
                <thead>
                <tr>
                    <th width="50%">会员</th>
                    <th>注册时间</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!isset($invits) || empty($invits)) {
                        echo '<tr><td colspan="2" style="text-align:center">亲，还没有您的邀请好友哦！</td></tr>';
                } else {?>
                <?php foreach($invits as $invit) { ?>
                <tr>
                    <td>
                        <div><a target="_blank" class="b" href="<?php echo Uri::create('u/'.$invit->invit_id); ?>" ><?php echo $members[$invit->invit_id]->nickname;?></a></div>
                    </td>
                    <td><div><?php echo date('Y-m-d H:i:s', $members[$invit->invit_id]->created_at);?></div></td>
                </tr>
               <?php };?>
               <?php };?>
                </tbody>
            </table>
            <?php echo Pagination::instance('page')->render(); ?>
        </div>
    </div>
    <!--获晒单结束-->
</div>
