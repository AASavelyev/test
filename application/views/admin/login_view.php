<div class="container">
    <h3 class="text-center">Add your comment</h3>
    <form class="form-horizontal" action="/admin/index" method="post">
        <div class="form-group">
            <label for="inputUserName" class="col-sm-2 control-label">User Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="username" id="inputUserName" placeholder="User Name">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Login</button>
            </div>
        </div>
    </form>
</div>