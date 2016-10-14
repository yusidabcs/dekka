<!DOCTYPE html>
<html>
<head>
<title>Dekka - News Reader</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Baca berita bali, aplikas baca berita, berita bali" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="css/styles.css?v=1.6" rel="stylesheet">
<!-- js -->
<script src="js/jquery.min.js"></script>
<script src="js/scripts.js?v=1.7"></script>
<!-- //js -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
</head>
	<body class="cbp-spmenu-push">
		<!-- header -->
		<div class="header-bg">
			<div class="banner-info">
				<!-- container -->
				<div class="container">
					<div class="col-md-4 col-md-offset-1 slid">
						<!--- banner Slider starts Here --->
							<script src="js/responsiveslides.min.js"></script>
						 <script>
							// You can also use "$(window).load(function() {"
							$(function () {
							  // Slideshow 4
							  $("#slider4").responsiveSlides({
								auto: true,
								pager: true,
								nav: true,
								speed: 500,
								namespace: "callbacks",
								before: function () {
								  $('.events').append("<li>before event fired.</li>");
								},
								after: function () {
								  $('.events').append("<li>after event fired.</li>");
								}
							  });
						
							});
						  </script>
						<!----//End-slider-script---->
						<div  id="top" class="callbacks_container">
							<ul class="rslides" id="slider4">
								<li>
									<div class="mobile-device">
										<img src="images/slide1.png" alt="" />
									</div>
								</li>
								<li>
									<div class="mobile-device">
										<img src="images/slide2.png" alt="" />
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-7 banner-info-left">
						<h1>
							Dekka News Feed
						</h1>

						<h2>Dekka adalah <span>Aplikasi</span> yang membantu kamu untuk mencari dan membaca berita khususnya di Bali dan Indonesia.</h2>
						<p>Ratusan berita dan topik terbaru dari beberapa sumber berita terpecaya akan memenuhi kebutuhan informasi harian kamu. Tanpa harus repot lagi membuat masing-masing website berita tapi cukup dengan satu aplikas dekka saja.</p>
						<div class="banner-buttons">
							<!-- <div class="banner-button">
								<a href="#"><img src="images/1.png" alt="" /></a>
							</div> -->
							<div class="banner-button">
								<a href="https://play.google.com/store/apps/details?id=net.ngide.dekka23"><img src="images/2.png" alt="" /></a>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<!-- //container -->
			</div>
		</div>
		<!-- //header -->
		<!-- footer -->
		<!-- <div class="footer">
			<div class="container">
				<div class="footer-info">
					<img src="images/8.png" alt="" />
					<h3>Get Notified of any updates!</h3>
					<p>Subscribe to our newsletter to be notified about new version release</p>
					<form>
						<input type="text" value="Your email address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Your email address';}">
						<input type="submit" value="Subscribe">
						<div class="clearfix"> </div>
					</form>
				</div>
				<div class="copyright">
					<p> © 2015 Appload. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
				</div>
			</div>
		</div> -->
		<!-- //footer -->
		<script type="text/javascript">
									$(document).ready(function() {
										/*
										var defaults = {
								  			containerID: 'toTop', // fading element id
											containerHoverID: 'toTopHover', // fading element hover id
											scrollSpeed: 1200,
											easingType: 'linear' 
								 		};
										*/
										
										$().UItoTop({ easingType: 'easeOutQuart' });
										
									});
								</script>
									<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<!-- content-Get-in-touch -->
	</body>
</html>