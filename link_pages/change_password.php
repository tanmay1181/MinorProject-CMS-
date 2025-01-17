<?php
 extract($_POST);
?>
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="alert">
                       
                    </div>
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Reset Password</h4>
                        </div>
                            <div class="card-body">
                                <form action="reset_password_code.php" method="POST">
                                <input type="hidden" value = "<?php if(isset($_GET['token'])){echo $_GET['token'];}?>" name = "token" class = "form-control">

                                    <div class="form-group mb-3">
                                        <label for="">Email Address</label>
                                        <input type="text" name = "email" value = "<?php if(isset($_GET['email'])){echo $_GET['email'];}?>" class = "form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Password</label>
                                        <input type="password" name = "password" class = "form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="">Confirm Password</label>
                                        <input type="password" name = "confirm_password" class = "form-control">
                                    </div>
                                
                                    <div class="form-group mb-3">
                                        <button type = "submit" name = "update_password_btn" class = "btn btn-primary">Update Password</button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php

?>
