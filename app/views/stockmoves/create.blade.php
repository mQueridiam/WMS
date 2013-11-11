@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-md-4 col-md-offset-4" style="margin-top: 50px">
		<div class="panel panel-info">
			<div class="panel-heading">Add a new Stock Movement</div>
			<div class="panel-body">
				{{ Form::open(array('route' => 'stockmoves.store')) }}
				@if($errors->any())
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</div>
				@endif
	
        <div>
            {{ Form::label('date', 'Date:') }}
            {{ Form::text('date', '2013-10-09') }}
        </div><br />
		
        <div>
            {{ Form::label('warehouse_id', 'Warehouse:') }}
            {{ Form::text('warehouse_id') }}
        </div><br />
		
        <div>
            {{ Form::label('product_id', 'Product:') }}
            {{ Form::text('product_id') }}
        </div><br />

        <div>
            {{ Form::label('quantity', 'Quantity:') }}
            {{ Form::input('number', 'quantity') }}
        </div><br />

        <div>
            {{ Form::label('price', 'Price:') }}
            {{ Form::text('price') }}
        </div><br />
		
        <div>
            {{ Form::label('document', 'Document:') }}
            {{ Form::text('document') }}
        </div><br />

				{{ Form::submit('Add', array('class' => 'btn btn-success')) }}
				{{ link_to_route('stockmoves.index', 'Cancel', null, array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}

			</div>
		</div>
	</div>
</div>

@stop


