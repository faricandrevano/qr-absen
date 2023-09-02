<?PHP @session_start();
$expired_cookie = time()+60*60*24*3;
if(empty($_COOKIE['COOKIES_MEMBER'])){
	setcookie("COOKIES_MEMBER", "", time()-3600);
    setcookie("COOKIES_COOKIES", "", time()-3600);
    setcookie('COOKIES_COOKIES', '', 0, '/');
    setcookie('COOKIES_MEMBER', '', 0, '/');
	//session_destroy();
	//echo'gak login';
}
else{
    $COOKIES_MEMBER='';$COOKIES_COOKIES ='';
    if(!empty($_COOKIE['COOKIES_COOKIES'])){$COOKIES_COOKIES=  $_COOKIE['COOKIES_COOKIES'];}
    if(!empty($_COOKIE['COOKIES_MEMBER'])){$COOKIES_MEMBER  =  epm_decode($_COOKIE['COOKIES_MEMBER']);}
	$query_user = "SELECT * FROM employees where id='$COOKIES_MEMBER'";
    $result_user = $connection->query($query_user);
    $row_user     = $result_user->fetch_assoc();
    extract($row_user);

	if($result_user->num_rows > 0){
		//echo'Login';
		//echo $row_user['created_cookies'];
	}

	else {
		//echo'gak login2';
		setcookie('COOKIES_MEMBER', '', 0, '/');
		setcookie('COOKIES_COOKIES', '', 0, '/');
		// Login tidak ditemukan
		setcookie("COOKIES_MEMBER", "", time()-$expired_cookie);
    	setcookie("COOKIES_COOKIES", "", time()-$expired_cookie);
		session_destroy();
	}

}