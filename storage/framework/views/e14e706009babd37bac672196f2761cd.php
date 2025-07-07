<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-ACCOUNT | Control Panel</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/adminlte.min.css')); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <style>
    .parsley-errors-list {
        list-style: none;
        padding-left: 0px;
    }

    .parsley-errors-list li {
        background: #0000002e;
        padding: 0px;
        border-bottom: 1px solid black;
        color: #ca303f;
        border-radius: 5px;
        margin-top: 5px;
    }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo e(url('/admin')); ?>"><b>E - Accounting</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to your panel</p>

                <!-- <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Email" name="email"
                            value="<?php echo e(old('email')); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                    </div>

                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="errorServer">
                        <ul class="parsley-errors-list filled">
                            <li class="parsley-required"><?php echo e($message); ?></li>
                        </ul>
                    </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="errorServer">
                        <ul class="parsley-errors-list filled">
                            <li class="parsley-required"><?php echo e($message); ?></li>
                        </ul>
                    </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                            <br>

                         
                            <div class="g-recaptcha" data-sitekey="6Ld-PZ4qAAAAAL12RD-Hp6RREYhSf_WJpciwDkjk"
                                data-callback="enableSubmitbtn"></div>

                     
                            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                            <script>
                            function enableSubmitbtn() {
                                document.getElementById("enableSubmit").disabled = false;
                            }
                            </script>

                        </div>
                     
                        <div class="col-4">
                            <button type="submit" id="enableSubmit" disabled="disabled"
                                class="btn btn-primary btn-block">Sign In</button>
                        </div>
                  
                    </div>
                </form> -->
                <form method="POST" action="<?php echo e(route('login')); ?>">
    <?php echo csrf_field(); ?>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Email or User ID" name="login"
            value="<?php echo e(old('login')); ?>">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>

    <?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="errorServer">
        <ul class="parsley-errors-list filled">
            <li class="parsley-required"><?php echo e($message); ?></li>
        </ul>
    </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <div class="input-group mb-3">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>

    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="errorServer">
        <ul class="parsley-errors-list filled">
            <li class="parsley-required"><?php echo e($message); ?></li>
        </ul>
    </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <div class="row">
        <div class="col-8">
            <div class="icheck-primary">
                <input type="checkbox" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                <label for="remember">
                    Remember Me
                </label>
            </div>
            <br>

            <!-- reCAPTCHA Widget
            <div class="g-recaptcha" data-sitekey="6Ld-PZ4qAAAAAL12RD-Hp6RREYhSf_WJpciwDkjk"
                data-callback="enableSubmitbtn"></div>

         
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            <script>
            function enableSubmitbtn() {
                document.getElementById("enableSubmit").disabled = false;
            }
            </script> -->
        </div>
        <!-- /.col -->
        <div class="col-4">
            <button type="submit" id="enableSubmit" class="btn btn-primary btn-block">Sign In</button>
        </div>
        <!-- /.col -->
    </div>
</form>


            </div>
            <!-- /.login-card-body -->
            <div class="social-auth-links text-center mt-2">
                <p> <strong>Your IP Address: </strong> <span class="" id="user-ip">
                        Loading...
                    </span></p>

            </div>

            <script>
            // Fetch IP Address using ipify API
            fetch('https://api.ipify.org?format=json')
                .then(response => response.json())
                .then(data => {
                    // Display the IP address in the HTML element
                    document.getElementById('user-ip').textContent = data.ip;
                })
                .catch(error => {
                    console.error('Error fetching IP address:', error);
                    document.getElementById('user-ip').textContent = 'IP Address not available';
                });
            </script>


        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo e(asset('assets/plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo e(asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('assets/dist/js/adminlte.min.js')); ?>"></script>

</body>

</html><?php /**PATH C:\laragon\www\eco\resources\views/auth/login.blade.php ENDPATH**/ ?>