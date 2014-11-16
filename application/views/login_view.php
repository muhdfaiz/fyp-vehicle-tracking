<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="author" content="">

    <title>People Tracker Login</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url() . 'public/css/bootstrap.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'public/css/styles.css'; ?>" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link media="screen" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,300italic">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="mainWrap">
    <div id="loggit">
        <h1><i class="fa fa-lock"></i> People Tracker</h1>
        <h4 style="margin-top: 20px;">Please <strong>Login</strong> or <strong>to view control panel</strong></h4>

        <form action="#" id="logForm" method="post" class="form-horizontal">
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                        <input type="text" name="email" id="email" class="form-control input-md" placeholder="Email" autocomplete="on">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                        <input type="password" name="password" id="password" class="form-control input-md" placeholder="Password" autocomplete="on">
                    </div>
                </div>
            </div>
            <?php if (isset($login_fail)) : ?>
                <div class="login-error"><p>Email or Password is incorrect,
                        please try again.</p></div>
            <?php endif; ?>
            <div class="form-group formSubmit">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Log In</button>
                </div>
            </div>
        </form>
    </div>
</div>
<footer class="clearfix">
    <p>Copyright © 2014 Realtime People Tracker. All Rights Reserved</p>
</footer>


<!-- Bootstrap core JavaScript
================================================== -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#submit").click(function(){
            $("#form-login").submit();
        });
    });
</script>
</body>
</html>