<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{$news->title}}</title>
		<!-- Start SmartBanner configuration -->
	<meta name="smartbanner:title" content="Dekka News">
	<meta name="smartbanner:author" content="Bcodes">
	<meta name="smartbanner:price" content="GRATIS">
	<meta name="smartbanner:price-suffix-apple" content=" - On the App Store">
	<meta name="smartbanner:price-suffix-google" content=" - Download Sekarang di Play Store">
	<meta name="smartbanner:icon-google" content="https://lh3.googleusercontent.com/BrXuHpSBsp9n_FDYRv-Cr0Z_Owj_9GzdENlHJvwBa2dDTVlRK0A1ovAIF6Fd4ACR1Rc=w300-rw">
	<meta name="smartbanner:button" content="VIEW">
	<meta name="smartbanner:button-url-google" content="https://play.google.com/store/apps/details?id=net.ngide.dekka23">
	<meta name="smartbanner:enabled-platforms" content="android">
	<!-- End SmartBanner configuration -->

	<!-- Facebook Open Graph Meta Tags -->
	<meta property="og:title" content="{{ $news->title }}" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="{{ url()->current() }}" />
	<meta property="og:image" content="{{ $news->image }}" />
	<meta property="og:site_name" content="dekkanews.com" />
	<meta property="fb:admins" content="" />
	<meta property="fb:app_id" content="1651021911881015" />
	<?php 
	$n = new App\Transformer\NewsTransformer();
	?>
	<meta property="og:description" content="{{ $n->short($news->content) }}" />

</head>
<link rel="stylesheet" href="{{ url('css/smartbanner.min.css') }}">

<style type="text/css">
	body{
		margin: 0;
		padding: 0;
	}
	.wrapper {
    width: 100%;
}
.container {
    height: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}
.container iframe {
	border: 0;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    position: absolute;
}
.visit_original{
	position: absolute;
	bottom: 0;
	width: 125px;
	padding:8px 16px;
	text-align: center;
	background-color: #eee;
	left: 40%;
	z-index: 100;
}

</style>
<script src="{{ url('js/smartbanner.min.js') }}"></script>
<body>
<div class="visit_original">
	<a href="">Kunjungi Website</a>
</div>
<div class="wrapper">
    <div class="container">
        <iframe src="{{$news->url}}"></iframe>
    </div>
</div>

</body>
</html>