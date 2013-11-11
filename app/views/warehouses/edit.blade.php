@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-md-4 col-md-offset-4" style="margin-top: 50px">
		<div class="panel panel-info">
			<div class="panel-heading">Update Warehouse</div>
			<div class="panel-body">
				{{ Form::model($warehouse, array('method' => 'PATCH', 'route' => array('warehouses.update', $warehouse->id))) }}
				@if($errors->any())
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</div>
				@endif
				<div>
						{{ Form::label('name', 'Warehouse: ') }}
						{{ Form::text('name', Input::old('name'), array('placeholder' => 'Warehouse', 'class' => 'form-control')) }}
				</div><br />
				<!-- div>
						{{ Form::label('completed', 'Completed? ') }}
						{{ Form::hidden('completed', 0) }}
						{{ Form::checkbox('completed', 1) }}
				</div><br / -->
				{{ Form::submit('Update', array('class' => 'btn btn-success')) }}
				{{ link_to_route('warehouses.index', 'Cancel', null, array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>

@stop