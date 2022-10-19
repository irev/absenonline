<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>
    <title>Absensi Online Kabupaten Pasaman Barat</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Absensi Online Pasaman Barat." />
    <meta name="keywords" content="absensi online, persensi online, absen"/>
    <meta name="author" content="Kominfo Pasaman Barat"/>
    <meta name="city" content="Simpang Empat"/>

    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="auth-bg">
                <span class="r"></span>
                <span class="r s"></span>
                <span class="r s"></span>
                <span class="r"></span>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="feather icon-unlock auth-icon"></i>
                    </div>
                    <h3 class="mb-4">Login</h3>
                    <?php echo form_open_multipart('login_controller/login');?>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name = "username" id = "password">
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" class="form-control" placeholder="Password" name = "password" id="password">
                    </div>
                    
                    <button class="btn btn-primary shadow-2 mb-4" name="submit" id="submit">Login</button>
                    <!-- <?php echo form_submit('submit','Simpan');?> -->
                    <?php
                        echo form_close();
                    ?>
                    <center><a href="https://kominfopasbar.github.io/doc-absen" target="_blank">Petunjuk Pemakaian</a></center>
                     <hr>
                    <div class="row">
                        <a href="https://simpel.pasamanbaratkab.go.id/" class="btn btn btn-sm btn-success">Simpel</a>
                        <a href="http://mobileabsensi1.pasamanbaratkab.go.id/" class="btn btn-sm btn-success">Server 1</a>
                        <a href="http://mobileabsensi3.pasamanbaratkab.go.id/" class="btn btn-sm btn-success">Server 2</a>
                        <a href="http://mobileabsensi4.pasamanbaratkab.go.id/" class="btn btn-sm btn-success">Server 3</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
