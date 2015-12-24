@extends('app')
@section('header')
	<title>ARSE PAGE</title>
@stop
@section('content')
		<h1>{{ $name }}</h1>
		<p>{{ $name }} was a terrorist and lived in the forest!</p>
		@if (count($people))
			<p>He liked:</p>
			<ul>
				@foreach ($people as $person)
					<li>{{ $person }}</li>
				@endforeach
			</ul>
		@endif
		{!! Form::open(['url' => 'athletes']) !!}
		{!! Form::label('name', 'Name:') !!}
		{!! Form::text('name') !!}
		{!! Form::submit('Add a name!') !!}
		{!! Form::close() !!}
@stop