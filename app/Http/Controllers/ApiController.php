<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ApiController extends Controller
{
	/*
	* key : 1409199511041995
	* enc : AES-256
	* contoh : wiradh7890$10987
	* contoh : yPtUr1xcENVlBTv9+5+FP85eUiWqUhLzSQpWS0ppRe4=
	*
	*/

    public static function encrypt($sValue, $sSecretKey)
	{
	    return rtrim(
	        base64_encode(
	            mcrypt_encrypt(
	                MCRYPT_RIJNDAEL_256,
	                $sSecretKey, $sValue, 
	                MCRYPT_MODE_ECB, 
	                mcrypt_create_iv(
	                    mcrypt_get_iv_size(
	                        MCRYPT_RIJNDAEL_256, 
	                        MCRYPT_MODE_ECB
	                    ), 
	                    MCRYPT_RAND)
	                )
	            ), "\0"
	        );
	}

	public static function decrypt($sValue, $sSecretKey)
	{
		// $sValue = $_POST['val'];
		// $sSecretKey = $_POST['key'];
	    return rtrim(
	        mcrypt_decrypt(
	            MCRYPT_RIJNDAEL_256, 
	            $sSecretKey, 
	            base64_decode($sValue), 
	            MCRYPT_MODE_ECB,
	            mcrypt_create_iv(
	                mcrypt_get_iv_size(
	                    MCRYPT_RIJNDAEL_256,
	                    MCRYPT_MODE_ECB
	                ), 
	                MCRYPT_RAND
	            )
	        ), "\0"
	    );
	}

	public static function getUsername($token) {
		$sValue = $token;
		$sSecretKey = 1409199511041995;

		$token = rtrim(
	        mcrypt_decrypt(
	            MCRYPT_RIJNDAEL_256, 
	            $sSecretKey, 
	            base64_decode($sValue), 
	            MCRYPT_MODE_ECB,
	            mcrypt_create_iv(
	                mcrypt_get_iv_size(
	                    MCRYPT_RIJNDAEL_256,
	                    MCRYPT_MODE_ECB
	                ), 
	                MCRYPT_RAND
	            )
	        ), "\0"
	    );

		$token = explode("0987", $token)[0];
		$toko = explode("7890$", $token)[0];

		return $toko;
	}

	public static function getId($token) {
		$sValue = $token;
		$sSecretKey = 1409199511041995;

		$token = rtrim(
	        mcrypt_decrypt(
	            MCRYPT_RIJNDAEL_256, 
	            $sSecretKey, 
	            base64_decode($sValue), 
	            MCRYPT_MODE_ECB,
	            mcrypt_create_iv(
	                mcrypt_get_iv_size(
	                    MCRYPT_RIJNDAEL_256,
	                    MCRYPT_MODE_ECB
	                ), 
	                MCRYPT_RAND
	            )
	        ), "\0"
	    );

		$token = explode("0987", $token)[0];
		$toko = explode("7890$", $token)[1];

		return $toko;
	}

	function logout(){
		\SSO\SSO::logout();
	}

	function documentation() {
		\SSO\SSO::authenticate();

		$sso = \SSO\SSO::getUser();

		if($sso->username != "putu.wira31" && $sso->username != "bimo.prasetyo" && $sso->username != "putu.wira31")
			return "forbidden";

		return \View::make('api/docs');
	}
}
