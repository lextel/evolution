<h2><span class='muted'></span></h2>
<br>
<div class="content-inner">
        <div class="message-box">
            <?php if ($member_sms): ?>
            <table>
                <thead>
                    
                    <tr>
                        <th>编号</th>
                        <th>标题</th>
                        <th>时间</th>
                        <th>发布人</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($member_sms as $item): ?>
                    <tr>
                        <td><?php echo $item->id;?></td>
                        <td><?php echo $item->title;?></td>
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
