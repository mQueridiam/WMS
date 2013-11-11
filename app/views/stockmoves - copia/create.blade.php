@extends('layouts.scaffold')

@section('main')

<h1>Create StockMove</h1>

{{ Form::open(array('route' => 'stockmoves.store')) }}
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
			{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


