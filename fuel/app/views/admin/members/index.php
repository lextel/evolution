<h2>Listing Members</h2>
<br>
<?php if ($members): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($members as $item): ?>
        <tr>
            <td>
                <?php echo Html::anchor('admin/members/view/'.$item->id, 'View'); ?> |
                <?php echo Html::anchor('admin/members/edit/'.$item->id, 'Edit'); ?> |
                <?php echo Html::anchor('admin/members/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
</table>
<?php else: ?>
<p>No Members.</p>
<?php endif; ?>
<p>
    <?php echo Html::anchor('admin/members/create', 'Add new Member', array('class' => 'btn btn-success')); ?>
</p>
