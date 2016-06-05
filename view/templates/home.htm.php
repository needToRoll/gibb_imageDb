<?php
// print "test";
/**
 * @var View $parent_view
 */
$parent_view->insideRender("header.htm");
?>
    <div class="container">
        <div class="col-lg-6 col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Login</h3>
                </div>
                <div class="panel-body">
                    <form action="/user/login" method="post">
                        <div class="input-group">
                            <label for="login_username" class="control-label">Username (Email)</label>
                            <input type="text" class="form-control" id="login_username" name="email">
                        </div>
                        <div class="input-group">
                            <label for="login_password" class="control-label">Password</label>
                            <input type="password" class="form-control" id="login_password" name="password">
                        </div>
                        <div class="input-group">
                            <input type="submit" value="Login" class="btn btn-primary" id="login_send">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Register</h3>
                </div>
                <div class="panel-body">
                    <form action="/user/register" method="post">
                        <div class="input-group">
                            <label for="register_username" class="control-label">Username (Email)</label>
                            <input type="text" class="form-control" id="register_username" name="email">
                        </div>
                        <div class="input-group">
                            <label for="register_password" class="control-label">Password</label>
                            <input type="password" class="form-control" id="register_password" name="password">
                        </div>

                        <input type="submit" value="Register" class="btn btn-info" id="register_send">
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<?php
$parent_view->insideRender("footer.htm");
?>