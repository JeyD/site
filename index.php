<?php

session_start();

define('BASEURL', dirname($_SERVER['SCRIPT_NAME']));

//echo "HELLO WORLD";

require_once 'models/model.php';

$servername = "localhost";
$username = "video_database";
$password = "339624991";

try {
    $conn = new PDO("mysql:host=$servername;dbname=videos_database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
	
Model_Base::set_db($conn);
ob_start();

//echo "what's your prob yo";

$found = false;

if(isset($_SERVER['PATH_INFO'])) {
	$args = explode('/', $_SERVER['PATH_INFO']);

	if(count($args) >= 3) {
		$controller = $args[1];
		$method = $args[2];
		$params = array();
		for ($i=3; $i < count($args); $i++) { 
			$params[] = $args[$i];
		}

		$controller_file = dirname(__FILE__).'/controllers/'.$controller.'.php';
		//echo $controller_file;
		if (is_file($controller_file)) {
			//echo $controller_file;
			require_once $controller_file;
			
			$controller_name = 'Controller_'.ucfirst($controller);
			
			//echo "CTRL: $controller_name";
			
			if (class_exists($controller_name)) {
				$c = new $controller_name;
				if (method_exists($c, $method)) {
					//echo "$method";
					$found = true;
					call_user_func_array(array($c, $method), $params);
				}
			}
		}
	}

	if($found == false){// = false){
		echo "i didnt fiiiind it";
		echo "<p> Page inddisponible<p>";
	}
}// path_info

	//echo "I MADE IT TILL HERE";
	$content = ob_get_clean();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<!--<link rel="stylesheet" href="<?php echo BASEURL?>/css/normalize.css" type="text/css">-->
	<!--<link rel="stylesheet" href="<?php echo BASEURL?>/css/style.css" type="text/css">-->
	<title> ALPHA TV </title>
</head>
<body>
	
<?php
 include 'views/header.php';
 include 'views/nav.php';
?>

<p class="text-center">
<?php if (isset($_SESSION['message'])) 
 { echo $_SESSION['message']; unset($_SESSION['message']);}
 ?>
</p>
<h1 class="text-center">Bienvenue</h1>
<p class="text-center">
 <?php echo $content ?>
</p>

</body>
</html>
