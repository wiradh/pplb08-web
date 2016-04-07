@if(isset($msg)) {{$msg}} @endif

<form action="{{url('/login')}}" method="post">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

	Username : <input type="text" name="name"/><br/>
	Password : <input type="password" name="password"/><br/>
	<input type="submit" value="Submit"/><br/>
</form>