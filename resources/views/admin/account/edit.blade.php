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
				<h1 class="page-header">RSS Account</h1>
			</div>
		</div><!--/.row-->
						
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading"><svg class="glyph stroked email"><use xlink:href="#stroked-email"></use></svg> New Account</div>
					<div class="panel-body">
						{{Form::open(['url' => url('admin/account/'.$account->id), 'method' => 'put', 'class' => 'form-horizontal'])}}
							<fieldset>
								<!-- Name input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Website Name</label>
									<div class="col-md-9">
									<input id="name" name="name" type="text" class="form-control" value="{{$account->name}}">
									</div>
								</div>
							
								<!-- Email input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="email">Your Feed Url</label>
									<div class="col-md-9">
										<input id="email" name="feed_url" type="text" placeholder="" class="form-control" value="{{$account->feed_url}}">
									</div>
								</div>

								<!-- Email input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="email">Logo Url</label>
									<div class="col-md-9">
										<input id="email" name="logo" type="text" placeholder="" class="form-control" value="{{$account->logo}}">
									</div>
								</div>

								<!-- Email input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="email">Type</label>
									<div class="col-md-9">
										<select name="feed_type">
											<option value="1" {{ $account->feed_type == 1 ? 'selected' : '' }}>Feed</option>
											<option value="2" {{ $account->feed_type == 2 ? 'selected' : '' }}>Rss</option>
										</select>
									</div>
								</div>
								<!-- Form actions -->
								<div class="form-group">
									<div class="col-md-12 widget-right">
										<button type="submit" class="btn btn-default btn-md pull-right">Edit</button>
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