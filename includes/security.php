<?php
include("connection_string.php");

function ggc_session() 
{
    // Gives session a name
	$session_name = 'sec_session_id'; 
    $secure = false;

    // no client side minipulation
    $httponly = true;

    // Tracks the session through a single cookie
    if (ini_set('session.use_only_cookies', 1) === FALSE) 
	{
        header("Location: ../error.php?message=AH! I DONT TRUST THE SESSION THAT WAS MADE");
        exit();
    }

    // pulls the current cookies params off of the clients machine
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);

    session_name($session_name);

    session_start();
    session_regenerate_id();
}

function login($email, $password, $mysqli) 
{
    // filtering for sql injection 
    if ($login_stmt = $mysqli->prepare(
									"SELECT user_id, firstname, lastname, email, phone, carrier, password, salt, s_code
				  					FROM user 
                                  	WHERE email = ? LIMIT 1"
								)) 
	{
        $login_stmt->bind_param('s', $email);  // binds "$email" as a string to the question mark
        $login_stmt->execute();
        $login_stmt->store_result();

        // get variables from result
        $login_stmt->bind_result($user_id, $firstname, $lastname, $email1, $phone, $carrier, $real_password, $salt, $s_code);
        $login_stmt->fetch();

        // hash the password with the unique salt for the final step to check if they are who they say the are
        $password = hash('sha512', $password . $salt);
        if ($login_stmt->num_rows == 1) 
		{
            if (bruteattack($user_id, $mysqli) == true) 
			{ 
                return false;
				mail($phone.$carrier,"Review account Lockout","You have exceeeded your max login attempts in 10 mins. Please reset your password and try again.");
            } 
			else 
			{
                if ($real_password == $password) {
                    // Password is correct!
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];

                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;

                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);

					$_SESSION['firstname'] = $firstname;
					$_SESSION['lastname'] = $lastname;
                    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
					$_SESSION['email'] = $email1;
					$_SESSION['phone'] = $phone;
					$_SESSION['carrier'] = $carrier;
					$_SESSION['s_code'] = $s_code;
                    return true;
					
                } 
				else 
				{
                    $now = time();
                    if (!$mysqli->query(
										"INSERT INTO attempted_logins(user, time) 
                                    	VALUES ('$user_id', '$now')"
										)) 
					{
                        header("Location: ../error.php?message=I CANT HOLD THE BRUTE ANYMORE");
                        exit();
                    }

                    return false;
                }
            }
        } 
		else 
		{
            header("Location: ../error.php?message=ARE YOU REALLY WHO YOU SAY YOU ARE");
            return false;
        }
    } 
	else 
	{
        header("Location: ../error.php?message=YOU DONE GOOFED ON YOUR LOGIN QUERY");
        exit();
    }
}

function login_checker($mysqli) 
{
    if (isset($_SESSION['user_id'], $_SESSION['firstname'], $_SESSION['login_string'], $_SESSION['s_code'])) 
	{
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $firstname = $_SESSION['firstname'];
		$s_code = $_SESSION['s_code'];

        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        if ($checker_stmt = $mysqli->prepare(
										"SELECT password 
				      					FROM user 
				      					WHERE user_id = ? LIMIT 1")) {
            $checker_stmt->bind_param('i', $user_id);
            $checker_stmt->execute();
            $checker_stmt->store_result();

            if ($checker_stmt->num_rows == 1) 
			{
                $checker_stmt->bind_result($password);
                $checker_stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);

                if ($login_check == $login_string) 
				{
                    return true;
                } 
				else 
				{
                    echo("strings dont match");
					return false;
                }
            } 
			else 
			{
                echo("more than one");
				return false;
            }
        } 
		else 
		{
            header("Location: ../error.php?message=I CANT CHECK IF YOU ARE LOGGED IN");
            exit();
        }
    } 
	else 
	{
        echo("session missing");
		return false;
    }
}

function bruteattack($user_id, $mysqli) 
{
   	$now = time();

    // failed login attempts in the past 10 minutes. 
    $valid_attempts = $now - (10 * 60);

    if ($brute_stmt = $mysqli->prepare(
								"SELECT time 
                                  FROM attempted_logins 
                                  WHERE user = ? AND time > '$valid_attempts'"
								)) 
	{
        $brute_stmt->bind_param('i', $user_id);
		$brute_stmt->execute();
        $brute_stmt->store_result();

        // If there have been more than 6 failed logins 
        if ($brute_stmt->num_rows > 6) 
		{
            return true;
        } 
		else 
		{
            return false;
        }
    } 
	else 
	{
        header("Location: ../error.php?message=THE BRUTE! THE BRUTE!");
        exit();
    }
}

function esc_url($url) {

    if ('' == $url) {
        return $url;
    }

    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
    
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
    
    $count = 1;
    while ($count) 
	{
        $url = str_replace($strip, '', $url, $count);
    }
    
    $url = str_replace(';//', '://', $url);

    $url = htmlentities($url);
    
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);

    if ($url[0] !== '/') {
        return '';
    } 
	else 
	{
        return $url;
    }
}
