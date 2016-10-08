<!DOCTYPE html>
<html>
<head>
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

</head>
<link rel="stylesheet" href="{{ url('css/smartbanner.min.css') }}">
<script src="{{ url('js/smartbanner.min.js') }}"></script>
<body>
<iframe src="{{$news->url}}" style="border: 0; position:absolute; top:0; left:0; right:0; bottom:0; width:100%; height:100%">

</body>
</html>