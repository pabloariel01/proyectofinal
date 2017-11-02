<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>INICNE</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('public/bower_components/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet">
    <!-- <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('public/bower_components/metisMenu/dist/metisMenu.min.css');?>" rel="stylesheet">

    <!-- <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <link href="<?php echo base_url('public/dist/css/sb-admin-2.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <!-- <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
<link href="<?php echo base_url('public/bower_components/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">INICNE</h3>
                    </div>
                    <div class="panel-body">
                      <?php if (isset($error) && $error): ?>
                        <div class="alert alert-error">
                          <a class="close" data-dismiss="alert" href="#">×</a>Usuario o contraseña incorrectos!
                        </div>
                      <?php endif; ?>
                      <?php echo validation_errors(); ?>
                      <?php echo form_open('Login/login_user') ?>

                      <input type="text" id="usuario" class="span4 form-control" name="usuario" placeholder="Usuario">
                      <input type="password" id="password" class="span4 form-control" name="password" placeholder="contraseña">

                      <!--<label class="checkbox">
                        <input type="checkbox" name="remember" value="1"> Remember Me
                      </label>-->

                      <button type="submit" name="submit" class="btn btn-info btn-block">Iniciar Sesion</button>

                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->

    <!-- <script src="../bower_components/jquery/dist/jquery.min.js"></script> -->
  <script src="<?php echo base_url('public/bower_components/jquery/dist/jquery.min.js');?>"></script>
    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
    <script src="<?php echo base_url('public/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <!-- <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script> -->
    <script src="<?php echo base_url('public/bower_components/metisMenu/dist/metisMenu.min.js');?>"></script>
    <!-- Custom Theme JavaScript -->
    <!-- <script src="../dist/js/sb-admin-2.js"></script> -->
    <script src="<?php echo base_url('public/dist/js/sb-admin-2.js');?>"></script>

</body>

</html>
