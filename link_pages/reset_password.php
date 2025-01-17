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
                                    <div class="form-group mb-3">
                                        <label for="">Email Address</label>
                                        <input type="text" name = "email" class = "form-control">
                                    </div>
                                
                                    <div class="form-group mb-3">
                                        <button type = "submit" name = "reset" class = "btn btn-primary">Reset</button>
                                    </div>

                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
?>

