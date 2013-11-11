@extends('layouts.scaffold')

@section('main')

<h1>All Stockmoves</h1>

<p>{{ link_to_route('stockmoves.create', 'Add new stockmove') }}</p>

@if ($stockmoves->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Document</th>
				<th>Price</th>
				<th>Quantity</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($stockmoves as $stockmove)
				<tr>
					<td>{{{ $stockmove->document }}}</td>
					<td>{{{ $stockmove->price }}}</td>
					<td>{{{ $stockmove->quantity }}}</td>
                    <td>{{ link_to_route('stockmoves.edit', 'Edit', array($stockmove->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('stockmoves.destroy', $stockmove->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no stockmoves
@endif

@stop
