@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">		
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">List News</h1>
			</div>
		</div><!--/.row-->
						
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Advanced Table</div>
					<div class="panel-body">
						<table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="created_at" data-sort-order="desc">
						    <thead>
						    <tr>
						        <th data-field="state" data-checkbox="true" >Item ID</th>
						        <th data-field="name"  data-sortable="true">Title</th>
						        <th data-field="created_at"  data-sortable="true">Created</th>
						        <th data-field="price" data-sortable="true">Author</th>
						        <th data-field="read" data-sortable="true">Read</th>
						        <th></th>
						    </tr>
						    </thead>
						    <tbody>
						    @foreach($news as $n)
						    	<tr>
						    		<td>{{ $n->id}}</td>
						    		<td>{{ $n->title}}</td>
						    		<td>{{ $n->created_at}}</td>
						    		<td>{{ ($n->author) ? $n->author->name : ''}}</td>
						    		<td>{{ $n->view }}</td>
						    		<td>
						    			<a href="{{ url('admin/news/'.$n->id.'/edit') }}" class="btn btn-success">edit</a>
						    			<a href="{{ url('news/'.$n->id) }}" target="_blank" class="btn btn-info">show</a>

						    			{{Form::open(['url' => url('admin/news/'.$n->id), 'method' => 'delete'])}}
						    			<input type="submit" value="hapus">
						    			{{Form::close()}}
						    		</td>
						    	</tr>
						    @endforeach
						    </tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
	</div>	<!--/.main-->
@endsection