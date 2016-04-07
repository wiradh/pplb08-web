@extends('index/templage')

@section('isi')
<a href="{{url('/getAllUser')}}">[All Users]</a>
<form action="{{url('/addUser')}}" method="post" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

	Username : <input type="text" name="name"/><br/>
	Password : <input type="password" name="password"/><br/>
	Email : <input type="email" name="email"/><br/>
	Nama : <input type="text" name="nama"/><br/>
	Foto : <input type="file" name="logo" accept="image/*"><br/>
	<br/>
	<input type="submit" value="Submit"/>
</form>
@endsection