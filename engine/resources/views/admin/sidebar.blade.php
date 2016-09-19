<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li class="active">
			<a href="{{ url('admin/dashboard') }}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a>
			</li>
			<li>
				<a href="{{ url('admin/account') }}"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> RSS Account</a>
			</li>
			<li>
				<a href="{{ url('admin/news') }}"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> News</a>
			</li>

			<li>
				<a href="{{ url('admin/users') }}"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Member</a>
			</li>
			
		</ul>

	</div><!--/.sidebar-->