@extends('layouts.scaffold')

@section('main')

<h1>Show StockMove</h1>

<p>{{ link_to_route('stockmoves.index', 'Return to all stockmoves') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Document</th>
				<th>Price</th>
				<th>Quantity</th>
		</tr>
	</thead>

	<tbody>
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
	</tbody>
</table>

@stop
