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
                    <a href="main/show/<?= $comment->id?>" class="btn btn-info">Show</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/main/add" class="btn btn-primary">Add your comment!</a>
</div>

