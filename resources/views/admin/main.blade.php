<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lumino - Dashboard</title>

<link href="{{ url('admin/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ url('admin/css/datepicker3.css') }}" rel="stylesheet">
<link href="{{ url('admin/css/styles.css') }}" rel="stylesheet">
<!--Icons-->
<script src="{{ url('admin/js/lumino.glyphs.js') }}"></script>

<!--[if lt IE 9]>
<script src="admin/js/html5shiv.js"></script>
<script src="admin/js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Lumino</span>Admin</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> User <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
							<li><a href="{{ url('admin/logout') }}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	@include('admin.sidebar')
		
	@yield('content')


	<script src="{{ url('admin/js/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ url('admin/js/bootstrap.min.js') }}"></script>
	<script src="{{ url('admin/js/chart.min.js') }}"></script>
	<script src="{{ url('admin/js/chart-data.js') }}"></script>
	<script src="{{ url('admin/js/easypiechart.js') }}"></script>
	<script src="{{ url('admin/js/easypiechart-data.js') }}"></script>
	<script src="{{ url('admin/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ url('admin/js/bootstrap-table.js') }}"></script>
	<script>

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
