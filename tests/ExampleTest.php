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
	* Melakukan pengecekkan User Login
	*/
    public function testLogin()
    {       
    	// test apabila username dan passwordnya benar
		$arr = $this->post('http://localhost/PPL/sandbox/login', ['name' => 'wiradh', 'password' => 'asdfqwer']);
        $this->assertContains('"status": "1"', $arr);

        // test apabila password salah
        $arr = $this->post('http://localhost/PPL/sandbox/login', ['name' => 'wiradh', 'password' => 'aaaa']);
        $this->assertContains('"status": "0"', $arr);

        // test apabila user dan password tidak diteumukan
        $arr = $this->post('http://localhost/PPL/sandbox/login', ['name' => 'asas', 'password' => 'asal']);
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
