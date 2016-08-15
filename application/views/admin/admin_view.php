<div class="container">
    <table class="table">
        <caption>All comments</caption>
        <thead>
        <tr>
            <th>#</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Site</th>
            <th>Text</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $comment): ?>
    <tr>
        <th scope="row"></th>
        <td><?= $comment->username ?></td>
        <td><?= $comment->email ?></td>
        <td><?= $comment->site ?></td>
        <td><?= $comment->text ?></td>
        <td>
            <?php if ($comment->isApproved): ?>
                <a href="/admin/unapprove/<?= $comment->id?>" class="btn btn-danger">Unapprove</a>
            <?php else: ?>
                <a href="/admin/approve/<?= $comment->id?>" class="btn btn-info">Approve</a>
            <?php endif; ?>

        </td>
        <td>
            <button name="show-remove-modal-btn" class="btn btn-danger" data-id="<?= $comment->id?>">Remove</button>
        </td>
        <td>
            <a href="/admin/update/<?= $comment->id?>" class="btn btn-primary">Change</a>
        </td>
    </tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<input type="hidden" id="removed-comment">
<div class="modal fade" tabindex="-1" role="dialog" id="remove-comment-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Are you really want to remove this comment?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="remove-comment-btn">OK</button>
            </div>
        </div>
    </div>
</div>