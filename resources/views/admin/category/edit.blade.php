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
				<h1 class="page-header">Category</h1>
			</div>
		</div><!--/.row-->
						
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading"><svg class="glyph stroked email"><use xlink:href="#stroked-email"></use></svg> Edit Category</div>
					<div class="panel-body">
						{{Form::open(['url' => url('admin/categories/'.$category->id), 'method' => 'put', 'class' => 'form-horizontal'])}}
							<fieldset>
								<!-- Name input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="name"> Name</label>
									<div class="col-md-9">
									<input id="name" name="name" type="text" class="form-control" value="{{$category->name}}">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="name"> Logo</label>
									<div class="col-md-9">
									<input id="name" name="logo" type="text" class="form-control" value="{{$category->logo}}">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="name"> Status</label>
									<div class="col-md-9">
										<div class="form-group checkbox">
										  <label>
										    <input type="checkbox" value="1" name="status" {{ ($category->status == 1 ? 'checked' : '') }}> Top category</label>
										</div>
									</div>
								</div>

								<!-- Form actions -->
								<div class="form-group">
									<div class="col-md-12 widget-right">
										<button type="submit" class="btn btn-default btn-md pull-right">Save</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			
				
			</div><!--/.col-->
		</div><!--/.row-->
	</div>	<!--/.main-->
@endsection