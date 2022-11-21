<?php ob_start() ?>
    <div class="container">
        <?php require_once 'partials/_errors.php' ?>
        <!-- register form with email and password repeat -->
        <form action="register.php" method="post" id="register" enctype="multipart/form-data">
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
            <!-- input for password repeat -->
            <div class="form-group">
                <label for="password_repeat">Repeat Password</label>
                <input type="password" name="password_repeat" id="password_repeat" class="form-control">
            </div>
           
            <!-- input for Submit -->
            <div class="form-group">
                <input type="submit" name="submit" value="Register" class="btn btn-primary">
            </div>
        </form>
    </div>

    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>

    <script>/*
        const validation = new window.JustValidate('#register');
        validation
        .addField('#email', [
            {
            rule: 'required',
            errorMessage: 'Email is required',
            },
            {
            rule: 'email',
            errorMessage: 'Email is invalid!',
            },
        ])  
        .addField('#password', [
            {
            rule: 'strongPassword',
            },
        ])
        .addField('#password_repeat', [
            {
                validator: (value, fields) => {
                    if (fields['#password'] && fields['#password'].elem) {
                        const repeatPasswordValue = fields['#password'].elem.value;

                        return value === repeatPasswordValue;
                    }

        return true;
        },
        errorMessage: 'Passwords should be the same',
    },
    ]);*/
    </script>

<?php 
$content = ob_get_clean() ;
$title = "Register Page";
include 'layout.php'
?>
