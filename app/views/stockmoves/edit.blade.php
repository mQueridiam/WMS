@extends('layouts.scaffold')

@section('main')

<h1>Edit StockMove</h1>
{{ Form::model($stockmove, array('method' => 'PATCH', 'route' => array('stockmoves.update', $stockmove->id))) }}
	<ul>
        <li>
            {{ Form::label('document', 'Document:') }}
            {{ Form::text('document') }}
        </li>

        <li>
            {{ Form::label('price', 'Price:') }}
            {{ Form::text('price') }}
        </li>

        <li>
            {{ Form::label('quantity', 'Quantity:') }}
            {{ Form::input('number', 'quantity') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('stockmoves.show', 'Cancel', $stockmove->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
