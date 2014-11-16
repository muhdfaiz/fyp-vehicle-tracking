<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="author" content="">
    <title>People Tracker Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url() . 'public/css/bootstrap.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'public/css/styles.css'; ?>" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link media="screen" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,300italic">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo base_url() . 'public/js/bootstrap.js'; ?>"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASm3CwaK9qtcZEWYa-iQwHaGi3gcosAJc&amp;sensor=false"></script>
    <script src="<?php echo base_url(). 'public/js/map.js'; ?>"></script>
    <script src="<?php echo base_url(). 'public/js/jquery.form.js'; ?>"></script>
    <script src="<?php echo base_url(). 'public/js/gmap.js'; ?>"></script>
    <script src="<?php echo base_url(). 'public/js/bootstrap-datepicker.js'; ?>"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style="background: #fafafa;">
<div class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="" href="index.html"><span class="navbar-brand">People Tracker</span></a></div>

    <div class="navbar-collapse collapse" style="height: 1px;">
        <ul id="main-menu" class="nav navbar-nav navbar-right">
            <li class="dropdown hidden-xs">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span> <?php echo $firstname . ' ' . $lastname; ?>
                    <i class="fa fa-caret-down"></i>
                </a>

                <ul class="dropdown-menu">
                    <li><a href="<?=base_url().'dashboard/admin_profile';?>">My Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url() . 'dashboard/user'; ?>">View & Add User</a></li>
                    <li><a href="<?php echo base_url() . 'dashboard/track_user'; ?>">Track Active User</a></li>
                    <li><a tabindex="-1" href="<?php echo base_url() . 'dashboard/user_status'; ?>">User Status</a></li>
                    <li class="divider"></li>
                    <li><a href="<?=base_url().'login/logout';?>">Log Out</a></li>
                </ul>
            </li>
        </ul>

    </div>
</div>
<div class="sidebar-nav">
    <ul>
        <li><a href="<?php echo base_url() . 'dashboard/admin_profile'; ?>" class="nav-header collapsed"><i class="fa fa-fw fa-user"></i> Admin Profile</a></li>
        <li><a href="<?php echo base_url() . 'dashboard/user'; ?>" class="nav-header collapsed"><i class="fa fa-fw fa-briefcase"></i> Add & View User</a></li>
        <li><a href="<?php echo base_url() . 'dashboard/user_status'; ?>" class="nav-header collapsed"><i class="fa fa-fw fa-legal"></i> User Status</a></li>
        <li><a href="<?php echo base_url() . 'dashboard/track_user'; ?>" class="nav-header"><i class="fa fa-fw fa-question-circle"></i> Track User</a></li>
        <li><a href="<?php echo base_url() . 'dashboard/view_route'; ?>" class="nav-header"><i class="fa fa-fw fa-comment"></i> User Route</a></li>
        <li><a href="<?php echo base_url() . 'dashboard/view_report'; ?>" class="nav-header"><i class="fa fa-fw fa-heart"></i> User Report</a></li>
    </ul>
</div>
</body>