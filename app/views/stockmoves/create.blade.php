@extends('layouts.master')

@section('customcss')

{{ HTML::style('http://codeorigin.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css') }}

@stop

@section('content')

<div class="row">
	<div class="col-md-4 col-md-offset-4" style="margin-top: 50px">
		<div class="panel panel-info" ng-app="app">
			<div class="panel-heading">Add a new Stock Movement</div>
			<div class="panel-body" ng-controller="MainCtrl">
				{{ Form::open(array('route' => 'stockmoves.store')) }}
				@if($errors->any())
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</div>
				@endif
	
        <div>
            {{ Form::label('date', 'Date:') }}
            {{-- Form::text('date', '2013-10-09') --}}
            <input type="text" name="date" id="date" readonly ng-model="date" jqdatepicker value="" />
        </div><br />
		
        <div>
            {{ Form::label('warehouse_id', 'Warehouse:') }}
            {{-- Form::text('warehouse_id') --}}
            {{ Form::select('warehouse_id', array('-1' => '-- Select --') + $whList, '-1') }}
        </div><br />
		
        <div>
            {{ Form::label('product_id', 'Product:') }}
            {{-- Form::text('product_id') --}}
            <input
                        type="text"
                        id="user-input"
                        class="span6"
                        placeholder="Product Name..."
                        autocomplete="off"
                        data-provide="typeahead"
            />
            <br/>
            <input type="hidden" class="span1" name="product_id" id="product_id" value="" />
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

@section('customjs')

    <script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
    <script src="//underscorejs.org/underscore-min.js"></script>
    {{-- HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js') --}}
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.5/angular.js"></script>

    <script type="text/javascript">
    // See: http://fusiongrokker.com/post/heavily-customizing-a-bootstrap-typeahead
    // See: http://tatiyants.com/how-to-use-json-objects-with-twitter-bootstrap-typeahead/
    //      http://blattchat.com/2013/01/09/bootstrap-typeahead/
        $(function(){

            var productObjs = {};
            var productNames = [];

            //get the data to populate the typeahead (plus an id value)
            var throttledRequest = _.debounce(function(query, process){

                    //get the data to populate the typeahead (plus an id value)
                    // $.get( '/api/users/search.json', { q: query }, function ( data ) {
                    $.ajax({
                        url: '{{ URL::to('productsjson') }}',
                        data : { 'query' : query },
                        cache: false,
                        success: function(data){
                            //reset these containers every time the user searches
                            //because we're potentially getting entirely different results from the api
                            productObjs = {};
                            productNames = [];

                            //Using underscore.js for a functional approach at looping over the returned data.
                            _.each( data, function(item, ix, list){

                                //for each iteration of this loop the "item" argument contains
                                //1 product object from the array in our json, such as:
                                // { "id":7, "name":"Pierce Brosnan" }

                                //add the label to the display array
                                productNames.push( item.name );

                                //also store a hashmap so that when bootstrap gives us the selected
                                //name we can map that back to an id value
                                productObjs[ item.name ] = item.id;
                            });

                            // alert( productNames );
                            //send the array of results to bootstrap for display
                            process( productNames );
                        }
                    });
                }, 300);

                $("#user-input").typeahead({
                    source: function ( query, process ) {

                    //here we pass the query (search) and process callback arguments to the throttled function
                    throttledRequest( query, process );

                    },
                    highlighter: function( item ){
                      var product = productObjs[ item ];
                      
                      // return '<div class="product">'
                      //       +'<img src="' + product.photo + '" />'
                      //       +'<br/><strong>' + product.name + '</strong>'
                      //       +'</div>';
                      var regex = new RegExp( '(' + this.query + ')', 'gi' );
                      return item.replace( regex, "<strong><u>$1</u></strong>" );
                    },
                    updater: function ( selectedName ) {
          
                    //note that the "selectedName" has nothing to do with the markup provided
                    //by the highlighter function. It corresponds to the array of names
                    //that we sent from the source function.

                    //save the id value into the hidden field
                    // $( "#product_id" ).val( productObjs[ selectedName ] );
                    $( "#product_id" ).val( productObjs[ selectedName ] );

                    //return the string you want to go into the textbox (the name)
                    return selectedName;
                }
            });
        });

// Datepicker
// See: http://www.abequar.net/jquery-ui-datepicker-with-angularjs/
//      http://www.desarrolloweb.com/articulos/jquery-ui-datepicker.html
//      http://www.bufa.es/jquery-ui-datepicker-espanol/
//      http://trentrichardson.com/examples/timepicker/
//      http://www.hongkiat.com/blog/jquery-ui-datepicker/

    var datePicker = angular.module('app', []);

    datePicker.controller('MainCtrl', function($scope) {
      
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth()+1; //January is 0!

      var yyyy = today.getFullYear();
      if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} 
      today = yyyy+'-'+mm+'-'+dd;

      $scope.date = today;
    });

    datePicker.directive('jqdatepicker', function () {
        return {
            restrict: 'A',
            require: 'ngModel',
             link: function (scope, element, attrs, ngModelCtrl) {
                element.datepicker({
                    firstDay: 1,
                    dateFormat:'yy-mm-dd',
                    // dateFormat: 'DD, d  MM, yy',
                    // dateFormat:'dd/mm/yy',
                    onSelect: function (date) {
                        scope.date = date;
                        // ngModelCtrl.$setViewValue(date);
                        scope.$apply();
                    }
                });
            }
        };
    });

    </script>

@stop


