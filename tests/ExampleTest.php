<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
* Melakukan pengecekkan dengan PHPUnit
*
* @author Putu Wira Astika Dharma
* @version 01/05/2016 
*/
class ExampleTest extends TestCase
{
	/**
	* Melakukan pengecekkan fungsi getCompletedOrderByPenyedia
	*/
    public function testGetCompletedOrderByPenyedia()
    {       
    	// kasus semuanya fine
		$arr = $this->post('http://localhost/PPL/sandbox/getCompletedOrderByPenyedia', ['token' => 'MUNGn9\\\/8WwSnE\\\/UWytq1HN4Geur3nbZa0c7WkIeuHXM=']);
        $this->assertContains('"status": "1"', $arr);
    }

	/**
	* Melakukan pengecekkan fungsi getOrderByPenyedia
	*/
    public function testGetOrderByPenyedia()
    {       
    	// kasus semuanya fine
		$arr = $this->post('http://localhost/PPL/sandbox/getOrderByPenyedia', ['id_penyedia' => 3, 'token' => 'MUNGn9\\\/8WwSnE\\\/UWytq1HN4Geur3nbZa0c7WkIeuHXM=']);
        $this->assertContains('"status": "1"', $arr);
    }

	/**
	* Melakukan pengecekkan fungsi getCompletedOrder
	*/
    public function testGetCompletedOrder()
    {       
    	// kasus semuanya fine
		$arr = $this->post('http://localhost/PPL/sandbox/getCompletedOrder', ['token' => 'yPtUr1xcENVlBTv9+5+FP85eUiWqUhLzSQpWS0ppRe4=']);
        $this->assertContains('"status": "1"', $arr);
    }

	/**
	* Melakukan pengecekkan fungsi getActiveOrder
	*/
    public function testGetActiveOrder()
    {       
    	// kasus semuanya fine
		$arr = $this->post('http://localhost/PPL/sandbox/getActiveOrder', ['token' => 'yPtUr1xcENVlBTv9+5+FP85eUiWqUhLzSQpWS0ppRe4=']);
        $this->assertContains('"status": "1"', $arr);
    }

	/**
	* Melakukan pengecekkan fungsi getPendingOrder
	*/
    public function testGetPendingOrder()
    {       
    	// kasus semuanya fine
		$arr = $this->post('http://localhost/PPL/sandbox/getPendingOrder', ['token' => 'yPtUr1xcENVlBTv9+5+FP85eUiWqUhLzSQpWS0ppRe4=']);
        $this->assertContains('"status": "1"', $arr);
    }


	/**
	* Melakukan pengecekkan fungsi getOrderById
	*/
    public function testGetOrderById()
    {       
    	// kasus semuanya fine
		$arr = $this->post('http://localhost/PPL/sandbox/getOrderById', ['token' => 'yPtUr1xcENVlBTv9+5+FP85eUiWqUhLzSQpWS0ppRe4=', 'order_id' => '2']);
        $this->assertContains('"status": "1"', $arr);

        // kasus semuanya order tidak ditemukan
		$arr = $this->post('http://localhost/PPL/sandbox/getOrderById', ['token' => 'yPtUr1xcENVlBTv9+5+FP85eUiWqUhLzSQpWS0ppRe4=', 'order_id' => '10000']);
        $this->assertContains('"status": "0"', $arr);
    }

	/**
	* Melakukan pengecekkan fungsi takeOrder
	*/
    public function testTakeOrder()
    {       
    	// kasus semuanya fine
		$arr = $this->post('http://localhost/PPL/sandbox/changeOrder', ['status' => '3', 'order_id' => '2', 'token' => 'MUNGn9\\\/8WwSnE\\\/UWytq1HN4Geur3nbZa0c7WkIeuHXM=']);
        $this->assertContains('"status": "1"', $arr);

        // kasus order masih pending
		$arr = $this->post('http://localhost/PPL/sandbox/changeOrder', ['status' => '3', 'order_id' => '0', 'token' => 'MUNGn9\\\/8WwSnE\\\/UWytq1HN4Geur3nbZa0c7WkIeuHXM=']);
        $this->assertContains('"status": "0"', $arr);

        // kasus order tidak ada
		$arr = $this->post('http://localhost/PPL/sandbox/changeOrder', ['status' => '3', 'order_id' => '1000', 'token' => 'MUNGn9\\\/8WwSnE\\\/UWytq1HN4Geur3nbZa0c7WkIeuHXM=']);
        $this->assertContains('"status": "0"', $arr);

        // kasus order sudah completed
		$arr = $this->post('http://localhost/PPL/sandbox/changeOrder', ['status' => '3', 'order_id' => '5', 'token' => 'MUNGn9\\\/8WwSnE\\\/UWytq1HN4Geur3nbZa0c7WkIeuHXM=']);
        $this->assertContains('"status": "1"', $arr);

        // kasus order sudah done
		$arr = $this->post('http://localhost/PPL/sandbox/changeOrder', ['status' => '3', 'order_id' => '4', 'token' => 'MUNGn9\\\/8WwSnE\\\/UWytq1HN4Geur3nbZa0c7WkIeuHXM=']);
        $this->assertContains('"status": "1"', $arr);

        // kasus order sudah take oleh penyedia lain
		$arr = $this->post('http://localhost/PPL/sandbox/changeOrder', ['status' => '3', 'order_id' => '3', 'token' => 'MUNGn9\\\/8WwSnE\\\/UWytq1HN4Geur3nbZa0c7WkIeuHXM=']);
        $this->assertContains('"status": "1"', $arr);
    }

	/**
	* Melakukan pengecekkan fungsi acceptOrder
	*/
    public function testAccept()
    {       
    	// kasus semuanya blom
		$arr = $this->post('http://localhost/PPL/sandbox/changeOrder', ['status' => '2', 'order_id' => '1', 'token' => 'MUNGn9\\\/8WwSnE\\\/UWytq1HN4Geur3nbZa0c7WkIeuHXM=']);
        $this->assertContains('"status": "0"', $arr);

        // kasus order bisa
		$arr = $this->post('http://localhost/PPL/sandbox/changeOrder', ['status' => '2', 'order_id' => '2', 'token' => 'MUNGn9\\\/8WwSnE\\\/UWytq1HN4Geur3nbZa0c7WkIeuHXM=']);
        $this->assertContains('"status": "1"', $arr);

        // kasus order tidak ada
		$arr = $this->post('http://localhost/PPL/sandbox/changeOrder', ['status' => '2', 'order_id' => '1000', 'token' => 'MUNGn9\\\/8WwSnE\\\/UWytq1HN4Geur3nbZa0c7WkIeuHXM=']);
        $this->assertContains('"status": "0"', $arr);
    }


	// /**
	// * Melakukan pengecekkan fungsi order
	// */
 //    public function testOrder()
 //    {       
 //    	// kasus semuanya fine
	// 	$arr = $this->post('http://localhost/PPL/sandbox/order', ['token' => 'yPtUr1xcENVlBTv9+5+FP85eUiWqUhLzSQpWS0ppRe4=', 'jam_antar' => '12.00', 'jam_ambil' => '13.00', 'longitude' => '212', 'latitude' => '11', 'tipe' => '1', 'id_penyedia' => '1', 'detail_lokasi' => 'testtt', 'harga' => '1']);
 //        $this->assertContains('"status": "1"', $arr);
 //    }

	/**
	* Melakukan pengecekkan Fungsi getLaundry
	*/
    public function testLaundry()
    {       
		$arr = $this->post('http://localhost/PPL/sandbox/getLaundry', []);
        $this->assertContains('"status": "1"', $arr);
    }


	/**
	* Melakukan pengecekkan Fungsi getDetails
	*/
    public function testDetails()
    {       
    	// kasus token diterima benar
		$arr = $this->post('http://localhost/PPL/sandbox/getDetails', ['token' => 'yPtUr1xcENVlBTv9+5+FP85eUiWqUhLzSQpWS0ppRe4=', 'id' => '3']);
        $this->assertContains('"status": "1"', $arr);
    }

	/**
	* Melakukan pengecekkan Fungsi register
	*/
    public function testRegister()
    {       
    	// kasus kalo username dan email sudah terdaftar
		$arr = $this->post('http://localhost/PPL/sandbox/register', ['name' => 'wiradh', 'password' => 'asdfqwer', 'email' => 'wira@wira.com']);
        $this->assertContains('"status": "0"', $arr);

        // kasus kalo username dan email unique belum ada
		$arr = $this->post('http://localhost/PPL/sandbox/register', ['name' => 'aaaaaaa', 'password' => 'asdfqwer', 'email' => 'wiaara@wira.com']);
        $this->assertContains('"status": "1"', $arr);
    }

	/**
	* Melakukan pengecekkan User Login
	*/
    public function testLogin()
    {       
    	// test apabila username dan passwordnya benar
		$arr = $this->post('http://localhost/PPL/sandbox/login', ['email' => 'wira@wira.com', 'password' => 'asdfqwer']);
        $this->assertContains('"status": "1"', $arr);

        // test apabila password salah
        $arr = $this->post('http://localhost/PPL/sandbox/login', ['email' => 'wira@wira.com', 'password' => 'aaaa']);
        $this->assertContains('"status": "0"', $arr);

        // test apabila user dan password tidak diteumukan
        $arr = $this->post('http://localhost/PPL/sandbox/login', ['email' => 'asas', 'password' => 'asal']);
        $this->assertContains('"status": "0"', $arr);

        // login with email
        $arr = $this->post('http://localhost/PPL/sandbox/login', ['email' => 'wira@wira.com', 'password' => 'asdfqwer']);
        $this->assertContains('"status": "1"', $arr);
    }

    /**
	* POST request Method
	* berguna untuk return hasil keluaran/response content dari POST requests 
	*/
    public function post($url, $data) {
	    // selalu gunakan http, termasuk jika ingin https tetap gunakan http
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
}