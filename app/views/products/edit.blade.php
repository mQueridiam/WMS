@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-md-4 col-md-offset-4" style="margin-top: 50px">
		<div class="panel panel-info">
			<div class="panel-heading">Update Product</div>
			<div class="panel-body">
				{{ Form::model($product, array('method' => 'PATCH', 'route' => array('products.update', $product->id))) }}
				@if($errors->any())
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</div>
				@endif
				<div>
						{{ Form::label('name', 'Product: ') }}
						{{ Form::text('name', Input::old('name'), array('placeholder' => 'Product', 'class' => 'form-control')) }}
				</div><br />
				<div>
						{{ Form::label('active', 'Active? ') }}
						{{ Form::hidden('active', 0) }}
						{{ Form::checkbox('active', 1) }}
				</div><br />
				{{ Form::submit('Update', array('class' => 'btn btn-success')) }}
				{{ link_to_route('products.index', 'Cancel', null, array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>

@stop