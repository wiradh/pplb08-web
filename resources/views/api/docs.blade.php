@extends("api/api")
@section("content")
<br/>

    {{createAPI("login", array('name' => 'wiradh', 'password' => 'asdfqwer'))}}

    {{createAPI("register", array('name' => 'wiradh', 'password' => 'asdfqwer', 'email' => 'wira@wira.com'))}}

    <hr/>

    {{createAPI("getDetails", array('token' => 'yPtUr1xcENVlBTv9+5+FP85eUiWqUhLzSQpWS0ppRe4='))}}

@endsection


<?php
function createAPI ($api, $data){
	$url = url('/sandbox/'.$api);    

    $req = json_encode($data, JSON_PRETTY_PRINT);
    $arr = post($url, $data);
	echo '<div class="row">
      <div class="col s12">
        <div class="card-panel white">
          <h5>'.$api.'</h5>
          	<p>URL : '.url("/api/".$api).' [POST]</p>
          	<p>Sandbox : '.url("/sandbox/".$api).' [POST]</p>
          	<p>Content-type : application/x-www-form-urlencoded</p>
          	<p>Data : <pre>'.$req.'</pre></p>
          	<p>Response : <pre>'.$arr.'</pre></p>
        </div>
      </div>
    </div>';

    return;
}
function post($url, $data) {
	// use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    $arr = $result;

    $temp = JSON_decode($arr);
    $arr = json_encode($temp, JSON_PRETTY_PRINT);

    return $arr;
}
?>

@section("title")
	API Documentation
@endsection