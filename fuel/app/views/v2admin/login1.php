<div class="row">
    <div class="col-md-3">
        <?php echo Form::open(array('')); ?>
            <?php if (isset($_GET['destination'])): ?>
                <?php echo Form::hidden('destination',$_GET['destination']); ?>
            <?php endif; ?>

            <?php if (isset($login_error)): ?>
                <div class="error"><?php echo $login_error; ?></div>
            <?php endif; ?>

            <div class="form-group <?php echo ! $val->error('email') ?: 'has-error' ?>">
                <label for="email">手机号:</label>
                <?php echo Form::input('mobile', Input::post('mobile'), array('class' => 'form-control', 'placeholder' => '手机号', 'autofocus')); ?>
                
                <?php if ($val->error('mobile')): ?>
                    <span class="control-label"><?php echo $val->error('mobile')->get_message('请输入手机号'); ?></span>
                <?php endif; ?>
                <span class="btn btn-info get_pwd">获取密码</span>
            </div>

            <div class="form-group <?php echo ! $val->error('password') ?: 'has-error' ?>">
                <label for="password">密码:</label>
                <?php echo Form::password('password', null, array('class' => 'form-control', 'placeholder' => '密码')); ?>

                <?php if ($val->error('password')): ?>
                    <span class="control-label"><?php echo $val->error('password')->get_message('请输入密码'); ?></span>
                <?php endif; ?>
            </div>

            <div class="actions">
                <?php echo Form::submit(array('value'=>'登陆', 'name'=>'submit', 'class' => 'btn btn-lg btn-primary btn-block')); ?>
            </div>

        <?php echo Form::close(); ?>
    </div>
</div>
<script type="text/javascript">
$(function(){
    $(".get_pwd").click(function(){
        var mobile = $("input[name=mobile]").val();        
        alert(mobile);
    });
});
</script>
