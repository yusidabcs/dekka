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
				<h1 class="page-header">Category
				<a href="{{ url('admin/categories/create') }}" class="btn btn-success pull-right">New</a>
				</h1>
			</div>
		</div><!--/.row-->
						
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Advanced Table</div>
					<div class="panel-body">
						<table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        <th data-field="state" data-checkbox="true" >Item ID</th>
						        <th data-field="name"  data-sortable="true">Category Name</th>
						        <th data-field="price" data-sortable="true">Status</th>
						        <th></th>
						    </tr>
						    </thead>
						    <tbody>
						    @foreach($categories as $category)
						    	<tr>
						    		<td>{{ $category->id}}</td>
						    		<td>{{ $category->name}}</td>
						    		<td>{{ $category->status}}</td>
						    		<td>
						    			{{Form::open(['url' => url('admin/categories/'.$category->id),'method'=>'delete', 'class' => 'form-inline'])}}
						    			<a class="btn btn-info btn-sm" href="{{ url('admin/categories/'.$category->id.'/edit') }}">edit</a>
						    			<button type="submit" class="btn btn-danger btn-sm" href="{{ url('admin/categories/'.$category->id) }}">delete</button>
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