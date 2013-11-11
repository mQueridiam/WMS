@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-md-4 col-md-offset-4" style="margin-top: 50px">
		<div class="panel panel-info">
			<div class="panel-heading">Add a new Warehouse</div>
			<div class="panel-body">
				{{ Form::open(array('route' => 'warehouses.store')) }}
				@if($errors->any())
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</div>
				@endif
				<div>
						{{ Form::label('name', 'Warehouse: ') }}
						{{ Form::text('name', '', array('placeholder' => 'Add a Warehouse', 'class' => 'form-control')) }}
				</div><br />
				{{ Form::submit('Add', array('class' => 'btn btn-success')) }}
				{{ link_to_route('warehouses.index', 'Cancel', null, array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>

@stop