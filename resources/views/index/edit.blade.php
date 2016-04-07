@extends('index/templage')

@section('isi')
<a href="{{url('/getAllUser')}}">[All Users]</a>
<form action="{{url('/editUser/'.$user->id)}}" method="post"" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

	Username : <input type="text" name="name" value="{{$user->name}}"/><br/>
	Email : <input type="email" name="email" value="{{$user->email}}"/><br/>
	Nama : <input type="text" name="nama" value="{{$user->nama}}"/><br/>
	Foto : <input type="file" name="logo" accept="image/*"><br/>
	<br/>
	<input type="submit" value="Submit"/>
</form>
@endsection