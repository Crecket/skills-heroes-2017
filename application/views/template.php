<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="TopShop">

    <base href="<?= site_url(); ?>"/>


    <title>TopShop > <?= $page_title; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
          rel='stylesheet' type='text/css'>

</head>

<? $body_class = ($page_title == "Home") ? "home" : "page"; ?>
<body class="<?= $body_class ?>">

<!-- Navigation -->
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="<?= site_url(); ?>">
                <img src="assets/img/logo.png" class="logo" alt="Logo" title="Logo"/>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?= site_url(); ?>">Home</a>
                </li>
                <li>
                    <a href="/webshop">Webshop</a>
                </li>
                <li>
                    <a href="/shoppingcart">Winkelwagen</a>
                </li>
                <li>
                    <a href="/about_us">Over Ons</a>
                </li>
                <li>
                    <a href="/contact">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Header -->
<? $header_image = ($page_title == "Home") ? "home-bg" : "page-bg"; ?>
<header class="intro-header" style="background-image: url('assets/img/<?= $header_image; ?>.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>TopShop</h1>
                    <hr class="small">
                    <span class="subheading">De plek voor alle LEGO!</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container page-container">
    <?php $_SESSION['notifications'] = !empty($_SESSION['notifications']) ? $_SESSION['notifications'] : array() ?>
    <?php foreach ($_SESSION['notifications'] as $key => $notification): ?>
        <div class="alert alert-<?php echo $notification['type']; ?>" role="alert">
            <?php echo $notification['message']; ?>
        </div>
        <?php
        unset($_SESSION['notifications'][$key]);
    endforeach;
    ?>
    <? $this->load->view($view); ?>
</div>

<hr>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <ul class="list-inline text-center">
                    <li>
                        <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-pinterest fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                </ul>
                <p class="copyright text-muted">Copyright &copy; TopShop <?= date("Y"); ?></p>
            </div>
        </div>
    </div>
</footer>

<script>
    // csrf helpers for the automatic JS updates
    var csrfName = <?=json_encode(!empty($csrf['name']) ? $csrf['name'] : null)?>;
    var csrfHash = <?=json_encode(!empty($csrf['hash']) ? $csrf['hash'] : null)?>;
</script>

<!-- jQuery -->
<script src="assets/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Theme JavaScript -->
<script src="assets/js/clean-blog.min.js"></script>
<script src="assets/js/bootstrap_validator.min.js"></script>
<script src="assets/js/custom.js"></script>

</body>

</html>