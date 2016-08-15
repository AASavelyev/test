<div class="container">
    <h3 class="text-center">Add your comment</h3>
    <h3 class="text-success hide text-center"></h3>
    <h3 class="text-danger hide text-center"></h3>
    <form class="form-horizontal" action="/main/save" method="post">
        <input type="hidden" name="id" value="<?= $data->id ?>">
        <div class="form-group">
            <label for="inputUserName" class="col-sm-2 control-label">User Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="username" id="inputUserName" placeholder="User Name" value="<?= $data->username ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email" value="<?= $data->email ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputSite" class="col-sm-2 control-label">Site</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="site" id="inputSite" placeholder="Site" value="<?= $data->site ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputText" class="col-sm-2 control-label">Text</label>
            <div class="col-sm-10">
                <textarea placeholder="Text" class="form-control" name="comment" id="inputText" rows="5"><?= $data->text ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="submit-btn" class="btn btn-default">Save</button>
            </div>
        </div>
    </form>
</div>