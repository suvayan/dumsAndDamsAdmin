<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <!-- Title -->
        <title>DudeAndDamsels</title>
        <link rel="icon" href="<?= base_url(); ?>assets/images/brand/favicon.ico" type="image/x-icon"/>
        <link href="<?= base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet" />
        <link href="<?= base_url(); ?>assets/plugins/icons/icons.css" rel="stylesheet" />
        <link id="theme" href="<?= base_url(); ?>assets/colors/color1.css" rel="stylesheet" type="text/css"/>
        <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
        <style>
            .error{
                color: red;
            }
        </style>
    </head>
    <body class="h-100vh error-bg">
        <div class="register-2">
            <div id="global-loader">
                <img src="<?= base_url(); ?>assets/images/common/loader.svg" alt="loader">
            </div>
            <div class="page">
                <div class="page-content">
                    <div class="container">
                        <div class="row">
                            <div class="col mx-auto">
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <!-- <div class="text-center mb-5">
                                            <img src="<?= base_url(); ?>assets/images/brand/logo1.png" class="header-brand-img desktop-lgo" alt="Azea logo">
                                        </div> -->
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="text-center mb-3">
                                                    <h1 class="mb-2">Log In</h1>
                                                    <a href="javascript:void(0);" class="">Welcome Back !</a>
                                                    <?php
                                                        if($this->session->flashdata('item')):
                                                    ?>
                                                        <div class="alert alert-danger"><?php echo $this->session->flashdata('item'); ?></div>
                                                    <?php
                                                        endif;
                                                    ?>
                                                </div>
                                                <form class="mt-5" id="loginForm" method="post" action="<?php echo base_url('home/auth');?>">
                                                    <div class="form-group">
                                                        <input 
                                                            type="text" 
                                                            class="form-control" 
                                                            id="username" 
                                                            name="username" 
                                                            placeholder="Username" 
                                                            value="<?php echo !empty(get_cookie('set_username'))? get_cookie('set_username') : '';?>"
                                                        >
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo !empty(get_cookie('set_password'))? get_cookie('set_password') : '';?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="remember" <?php echo (!empty(get_cookie('set_username')) && !empty(get_cookie('set_password')))? "checked" : ""; ?>/>
                                                        <span class="custom-control-label">Remember me</span>
                                                        </label>
                                                    </div>
                                                    <div class="form-group text-center mb-3">
                                                        <button class="btn btn-primary btn-lg w-100 br-7">Log In</button>
                                                    </div>
                                                    <!-- <div class="form-group fs-13 text-center">
                                                        Forget Password ?
                                                    </div>
                                                    <div class="form-group fs-14 text-center font-weight-bold">
                                                        <a href="javascript:void(0);">Click Here To Backup Mail</a>
                                                    </div> -->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="<?= base_url(); ?>assets/plugins/validate/jquery.validate.min.js"></script>
            <script src="<?= base_url(); ?>assets/plugins/bootstrap/popper.min.js"></script>
            <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/custom.js"></script>
            <script>
                $(document).ready(function(){
                    $('#loginForm').validate({
                        rules:{
                            username:{
                                required: true
                            },
                            password:{
                                required: true
                            }
                        },
                        message:{
                            username:{
                                required: "Username is required"
                            },
                            password:{
                                required: "Password is required"
                            } 
                        }
                    })
                })
            </script>
        </div>
    </body>
</html>
