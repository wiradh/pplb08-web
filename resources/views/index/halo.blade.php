@extends('index/templage')

@section('isi')

	@foreach($user as $e)
		@if($e->foto != "") <img src="{{url('./foto/'.$e->foto)}}" style="width:200px;"/><br/> @endif
		Nama : {{$e->nama}}<br/>
		User : {{$e->name}}<br/>
		Email : {{$e->email}}<br/>
		<a href="{{url('/getUser/'.$e->id)}}">[DETAILS]</a><br/>
		<a href="{{url('/editUser/'.$e->id)}}">[EDIT]</a><br/>
		<a href="{{url('/removeUser/'.$e->id)}}">[X]</a>
		<br/><br/>
	@endforeach

@endsection