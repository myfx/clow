<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo $this->pageTitle; ?></title>
<meta name="description" content="<?php echo $this->pageDescription; ?>">
<meta name="keywords" content="<?php echo $this->pageKeywords; ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/img/favicon.ico" />
<!-- CSS FILES -->
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/rs-plugin/css/settings.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/boxme.responsive.css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

<!-- Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="js/respond.min.js"></script>
<![endif]-->
</head>
<body>
<!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->

<div id="wrapper">
	<!-- HEADER -->
	<header>
		<div id="inside-header" class="style2">
			<div class="container">
				<div class="header-wrapper margint10">
					<div class="pull-left logo">
						<a href="/"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/inside-logo.png" class="img-responsive" alt="BoxMe!" /></a>
					</div>
					<div class="pull-right menu">
						<nav class="pull-left menu-bar" id="responsive-menu">
							<ul class="site-menu" id="site-menu">
                                                                <?php if(Yii::app()->user->isGuest) { ?>
								<li>
									<a href="<?php echo Yii::app()->createUrl('index/index') ?>">Home</a>
								</li>
                                                                <?php } ?>
								<?php if(Yii::app()->user->isGuest) { ?>
                                                                <li>
                                                                    <a href="<?php echo Yii::app()->createUrl('index/login') ?>">Sign In</a>
								</li>
                                                                 <?php } else { ?>
                                                                 <li>
                                                                    <a href="<?php echo Yii::app()->createUrl('profile/user', array('id' => Yii::app()->user->id)) ?>">Profile</a>
								</li>
                                                                 <?php } ?>
								<li>
									<a href="<?php echo Yii::app()->createUrl('pet/search'); ?>">Pet Search</a>								
								</li>
								<!--<li>
									<a href="#">Articles</a>									
								</li>-->
								<li>
									<a href="<?php echo Yii::app()->createUrl('index/contact') ?>">Contact</a>
								</li>
                                                                <?php if(!Yii::app()->user->isGuest) { ?>
                                                                <li>
                                                                        <a href="<?php echo Yii::app()->createUrl('index/logout') ?>">Logout</a>
                                                                </li>
                                                                <?php } ?>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</header>
	<?php echo $content; ?>
	<div id="footer-last">
		<div class="container footer-text">
			<div class="pull-left footer-info">
				<p>© 2013 <a href="http://4claw.com">4Claw.com</a></span></p>
			</div>
			<div class="pull-right footer-social">
				<ul id="social" class="margint20 clearfix">
					<li><a  target='blank' href="https://www.facebook.com/pages/4Clawcom/181786425365389"><i class="icon-facebook"></i></a></li>
					<li><a   target='blank' href="https://twitter.com/4Clawcom"><i class="icon-twitter"></i></a></li>
					<li><a  target='blank'  href="https://plus.google.com/communities/103234469114965487677?partnerid=ogpy0"><i class="icon-google-plus"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- SCROLL TO TOP -->
	<a href="#" class="scrollup"><i class="icon-angle-up"></i></a>
</div>
<!-- JS FILES -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery-1.10.1.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/retina-1.1.0.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/hoverIntent.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/superfish.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/supersubs.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.carouFredSel.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/responsive-nav.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.prettyPhoto.js"></script>
<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>-->
<!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/gmaps.js"></script>-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.parallax-1.1.3.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.isotope.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/excanvas.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.easy-pie-chart.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js.js"></script>

<script>
$(function() {
    $( "#datepicker" ).datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: 'yy-mm-dd' 
    });
});
</script>
</body>
</html>
