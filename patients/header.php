<?php
// if form submitted

if (isset($_POST['login'])) {
  try {
    // validate input
    $username = filter_var($_POST['username'], FILTER_SANITIZE_EMAIL);
    $password = strip_tags(trim($_POST['password']));
    
    // set login credentials
    $credentials = array(
      'email'    => $username,
      'password' => $password,
    );

    // authenticate
    // if authentication fails, capture failure message
    Cartalyst\Sentry\Facades\Native\Sentry::authenticate($credentials, false);
echo 'test';
    header('Location: ./');  
  } catch (Exception $e) {
    // $failMessage = $e->getMessage();
   $failMessage = "Username or password are incorrect. If you forgot your password, click 'Forgot your password?'";
  } 
}
?>

<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<Title>Crestar Patient Portal</title>
<link rel="shortcut icon" href="/img/logo.ico">

<script type="text/javascript" src="/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>



<link rel="stylesheet" id="bootstrap" href="/css/bootstrap.css">
<link rel="stylesheet" id="bootstrap" href="/css/jquery-ui.min.css">
<link rel="stylesheet" id="bootstrap" href="/css/jquery-ui.structure.min.css">
<link rel="stylesheet" id="bootstrap" href="/css/jquery-ui.theme.min.css">
<link rel="stylesheet" id="bootstrap" href="/css/inline.css">


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>

<?php
if(isset($currentUser)){include 'user-nav.php';}
else{include 'public-nav.php';}
?>