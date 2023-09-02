<?PHP session_start(); 
    require_once'../../sw-library/sw-config.php';
    setcookie('cook_login', $hsl['nama'], 0);
    $expired_cookie = time()+60*60*24*3;
    $COOKIES_MEMBER='';$COOKIES_COOKIES ='';
    // if(!empty($_COOKIE['COOKIES_COOKIES'])){$COOKIES_COOKIES =  $_COOKIE['COOKIES_COOKIES'];}

	// $query_user = "SELECT * FROM employees where id='$COOKIES_MEMBER' AND created_cookies='$COOKIES_COOKIES'";
    // $result_user  = $connection->query($query_user);
    // $row_user     = $result_user->fetch_assoc();
    // $employees_id = $row_user['id'];

    // $save=mysqli_query($connection,"UPDATE employees set created_cookies='-' where id='$employees_id'");
    // // header("location:./");
    // unset($_SESSION['COOKIES_MEMBER']);
    // unset($_SESSION['COOKIES_MEMBER']);
    // setcookie("COOKIES_MEMBER", "", time()-3600);
    // setcookie("COOKIES_COOKIES", "", time()-3600);
    // setcookie('COOKIES_COOKIES', '', 0, '/');
    // setcookie('COOKIES_MEMBER', '', 0, '/');
	session_destroy();
    header('Location:./');


// session_destroy();
// header("Location: ./login");
?>

		
