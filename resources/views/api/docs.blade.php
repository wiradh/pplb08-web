@extends("api/api")
@section("content")
<br/>

    {{createAPI("login", array('name' => 'wiradh', 'password' => 'asdfqwer'))}}

    {{createAPI("register", array('name' => 'wiradhaa', 'password' => 'asdfqwer', 'email' => 'wiraa@wira.com', 'nomor_hp' => '0812313123'))}}

    <hr/>

    {{createAPI("getDetails", array('token' => 'yPtUr1xcENVlBTv9+5+FP85eUiWqUhLzSQpWS0ppRe4=', 'id' => '3'))}}
    {{createAPI("setDetails", array('token' => 'yPtUr1xcENVlBTv9+5+FP85eUiWqUhLzSQpWS0ppRe4=', 'name' => 'wiradh', 'password' => 'asdfqwer', 'email' => 'wira@wira.com', 'nomor_hp' => '12345'))}}

    <hr/>

    {{createAPI("getLaundry", array())}}

    <hr/>

    {{createAPI("order", array('token' => 'yPtUr1xcENVlBTv9+5+FP85eUiWqUhLzSQpWS0ppRe4=', 'jam_antar' => '12.00', 'jam_ambil' => '13.00', 'longitude' => '212', 'latitude' => '11', 'detail_lokasi' => 'rumah biru', 'harga' => '120000 ', 'tipe' => '1', 'id_penyedia' => '2'))}}

    {{createAPI("changeOrder", array('order_id' => '2', 'status' => '2', 'token' => 'MUNGn9\/8WwSnE\/UWytq1HN4Geur3nbZa0c7WkIeuHXM='))}}



    <hr/>
    {{createAPI("getOrderById", array('id' => '1', 'token' => 'MUNGn9\/8WwSnE\/UWytq1HN4Geur3nbZa0c7WkIeuHXM='))}}

    {{createAPI("getPendingOrder", array('token' => 'yPtUr1xcENVlBTv9+5+FP85eUiWqUhLzSQpWS0ppRe4='))}}

    {{createAPI("getActiveOrder", array('token' => 'yPtUr1xcENVlBTv9+5+FP85eUiWqUhLzSQpWS0ppRe4='))}}

    {{createAPI("getCompletedOrder", array('token' => 'yPtUr1xcENVlBTv9+5+FP85eUiWqUhLzSQpWS0ppRe4='))}}

    {{createAPI("getOrderByPenyedia", array('token' => 'MUNGn9\/8WwSnE\/UWytq1HN4Geur3nbZa0c7WkIeuHXM='))}}

    {{createAPI("getCompletedOrderByPenyedia", array('token' => 'MUNGn9\/8WwSnE\/UWytq1HN4Geur3nbZa0c7WkIeuHXM='))}}

@endsection

@section("title")
	API Documentation
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