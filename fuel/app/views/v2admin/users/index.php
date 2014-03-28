<div style="padding-bottom: 10px">
    <?php echo Html::anchor('v2admin/users/create', '添加管理员', array('class' => 'btn btn-success pull-right')); ?>
    <div class="clearfix"></div>
</div>
<div class="panel panel-default">
    <?php if ($users): ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">用户名</th>
                <th class="text-center">用户邮箱</th>
                <th class="text-center">用户手机</th>
                <th class="text-center">用户组</th>
                <th class="text-center">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $item): ?>
            <tr>
                <td class="text-center"><?php echo $item->username; ?></td>
                <td class="text-center"><?php echo $item->email; ?></td>
                <td class="text-center"><?php echo $item->mobile; ?></td>
                <td class="text-center"><?php echo Auth::group()->get_name($item->group); ?></td>
                <td class="text-center">
                    <?php echo Html::anchor('v2admin/users/edit/'.$item->id, '编辑'); ?> |
                    <?php echo Html::anchor('v2admin/users/delete/'.$item->id, '删除', array('onclick' => "return confirm('确定要删除?')")); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p style="padding: 40px; text-align: center">没有管理员。</p>
    <?php endif; ?>
</div>
