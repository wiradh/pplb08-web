<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    public function testBasicExample()
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

    public function post($url, $data) {
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
}
