<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$page_title?></title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<link rel="stylesheet" href="<?=site_url('assets/css/style.css')?>" type="text/css" />

</head>
<body>
<div class="container">
<div id="login-form">
    <!-- BEGIN LOGIN FORM -->
        <?php
            $attributes = array('class' => 'login-form');
            echo form_open('backoffice/login', $attributes); 
        ?>

        <div class="animated slideInUp col-md-5 centered">
            <div class="form-group">
                <h2 class="">Sign In.</h2>
            </div>

            <div class="form-group">
                <hr />
            </div>

            <?php if ( validation_errors() ) { ?>
                <div class="alert alert-danger">
                    <span> <?php echo validation_errors(); ?> </span>
                </div>
                <?php } ?>

                <?php if ( $display_message ) { ?>
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span> <?php echo $display_message; ?> </span>
                </div>
            <?php } ?>
                    
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <?php
                        $attributes = array('class' => 'control-label visible-ie8 visible-ie9',);
                        echo form_label('Email', 'email', $attributes);
                    ?>

                    <?php
                        $txtUsername = array(
                            'name'         => 'txtEmail',
                            'class'        => 'form-control form-control-solid placeholder-no-fix',
                            'value'        => set_value('txtEmail'),
                            'autocomplete' => 'off',
                            'placeholder'  => 'me@example.com',
                        );
                        echo form_input($txtUsername);
                    ?>
                </div>

                <div class="form-group">
                    <?php
                        $txtPassword = array(
                            'name'         => 'txtPassword',
                            'class'        => 'form-control form-control-solid placeholder-no-fix',
                            'autocomplete' => 'off',
                            'placeholder'  => 'Password',
                        );
                        echo form_password($txtPassword);
                    ?>
                </div>
                <div class="form-group">
                    <hr />
                </div>

                <div class="form-group">
                    <?php
                        $attributes = array(
                            'value' => 'Login',
                            'class' => 'btn btn-block btn-primary',
                        );
                        echo form_submit($attributes);
                    ?>
                </div>

                <div class="form-group">
                    <hr />
                </div>
        </div>
    <?=form_close()?>
    <!-- END LOGIN FORM -->
</div>
<?php $this->load->view('_blocks/footer')?>