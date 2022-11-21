<?php ob_start() ?>

<div class="container">
        <?php require_once 'partials/_errors.php' ?>
        <!-- register form with email and password repeat -->
        <form action="" method="post" id="register">
            <!-- input for email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <!-- input for password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>  
          
            <!-- input for Submit -->
            <div class="form-group">
                <input type="submit" name="submit" value="Register" class="btn btn-primary">
            </div>
        </form>
    </div>



<?php 

$content = ob_get_clean();
include 'layout.php' 

?>