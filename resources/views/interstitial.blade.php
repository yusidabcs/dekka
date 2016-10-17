<!DOCTYPE html>
<html>
<head>
	<title>Dekka - News Reader</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Baca berita bali, aplikasi baca berita, berita bali" />
	<meta name="description" content="Dekkanews adalah Aplikasi yang membantu kamu untuk mencari dan membaca berita khususnya di Bali dan Indonesia. Ratusan berita dan topik terbaru dari beberapa sumber berita terpecaya akan memenuhi kebutuhan informasi harian kamu. Tanpa harus repot lagi membuat masing-masing website berita tapi cukup dengan satu aplikasi saja." />
	<link rel="shortcut icon" href="{{ url('images/favicon.ico') }}" type="image/x-icon">
	<link rel="icon" href="{{ url('images/favicon.ico') }}" type="image/x-icon">
	<link href="{{ url('css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all">
	<style type="text/css">
		#map {
			width: 100%;
			height: 100%;
			min-height: 100%;
		}

		html, body {
			height: 100%;
			background: #eee;
			padding-top: 64px;
		}

		.fill { 
			min-height: 100%;
			height: 100%;
		}

	</style>
</head>
<body>
	@if(@$news)
	<div style="position: absolute;top: 0;left: 0;z-index: 1;width: 100%;text-align: center;">
		<div class="row">
			<div class="col-md-12">
				<div style="background: #f7f7f7;padding: 16px;width: 100%">
					<a href="{{ url($news->url) }}?source=dekkanews">Lanjutkan ke detail berita..</a>
				</div>
			</div>
		</div>
	</div>
	@else

	<script type="text/javascript">
		
		setTimeout(function(){
			window.location.replace("https://play.google.com/store/apps/details?id=net.ngide.dekka23");
		},1000);
		
	</script>
	@endif
	<div class="container fill">
		<div id="map">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-xs-6 col-xs-offset-3">
							<img src="{{ url('images/logo.png') }}" class="img img-responsive">
						</div>
					</div>
					<div class="row">
						<div class="col-xs-8 col-xs-offset-2">
							<h1 class="text-center">
								Dekka News
							</h1>

							<p class="text-center">Baca berita seputar Bali dalam genggaman kamu!</p>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xs-6 col-xs-offset-3">
							<center><a href="https://play.google.com/store/apps/details?id=net.ngide.dekka23"><img src="{{ url('images/2.png') }}" alt="" class="img img-responsive" /></a></center>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div> <!-- This one wants to be 100% height -->
	</div>
	<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-85341349-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
