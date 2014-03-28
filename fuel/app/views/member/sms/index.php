<div class="content-inner">
        <div class="message-box">
            <?php if ($member_sms): ?>
            <table>
                <thead>

                    <tr>
                        <th>标题</th>
                        <th>时间</th>
                        <th>发布人</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($member_sms as $item): ?>
                    <tr>
                        <?php if ($item->type == 'win') { ?>
                        <td style="text-align:left;">恭喜您获得了商品 <b><?php echo $item->title;?></b> </td>
                        <?php }else { ?>
                        <td><?php echo $item->title;?></td>
                        <?php }?>
                        <td><?php echo Date('Y-m-d H:i:s', $item->created_at);?></td>
                        <td><?php echo $item->user_name;?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br />
            <?php echo Pagination::instance('message')->render();?>
            <?php else: ?>
            <p>暂无任何系统信息</p>
            <?php endif; ?>
        </div>
    </div>
