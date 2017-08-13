<?php
require_once "variables.php";
require_once "recaptchalib.php";
$response = null;
if($captchaKey!==""){
	$reCaptcha = new ReCaptcha($captchaKey);
}

function recaptchaCheck($response){
	global $captchaKey, $reCaptcha;
	if($captchaKey===""){
		//When recaptcha key is empty captcha is always correct
		return true;
	}
	if ($response) {
		//verify
		$response = $reCaptcha->verifyResponse(
		$_SERVER["REMOTE_ADDR"],
		$response
		);
		//verify
      if ($response == null || !$response->success) {
        echo $response;
        return false;
      }
      return true;
  } else {
  	//no response
    return false;
  }
}

?>