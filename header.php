<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<Title>Portal</title>


<script type="text/javascript" src="/js/jquery-2.1.4.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>



<link rel="stylesheet" id="bootstrap" href="/css/bootstrap.css">
<link rel="stylesheet" id="bootstrap" href="/css/jquery-ui.min.css">
<link rel="stylesheet" id="bootstrap" href="/css/jquery-ui.structure.min.css">
<link rel="stylesheet" id="bootstrap" href="/css/jquery-ui.theme.min.css">
<link rel="stylesheet" id="bootstrap" href="/css/inline.css">
<link rel="stylesheet" href="css/signature-pad.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/ju/jszip-2.5.0,pdfmake-0.1.18,dt-1.10.11,af-2.1.1,b-1.1.2,b-colvis-1.1.2,b-html5-1.1.2,b-print-1.1.2,cr-1.3.1,r-2.0.2/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/t/ju/jszip-2.5.0,pdfmake-0.1.18,dt-1.10.11,af-2.1.1,b-1.1.2,b-colvis-1.1.2,b-html5-1.1.2,b-print-1.1.2,cr-1.3.1,r-2.0.2/datatables.min.js"></script>
<script type="text/javascript" src="./js/table_style.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body>


    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./">Portal</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="./">Home</a></li>
            <!-- <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li> -->
          </ul>
		    <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="./add_acct.php">Add Account</a></li>
                <li><a href="./edit_acct.php">Edit Account</a></li>
				<li><a href="./add_phy.php">Add/Edit Provider</a></li>
                <li><a href="./add_ins.php">Add/Edit Insurance</a></li>
                <li role="separator" class="divider"></li>
				<li><a href="#"><a>Delete Sample</a></li>
				<li><a href="#"><a>Edit Manifest</a></li>
				<li role="separator" class="divider"></li>
                <li class="dropdown-header">User info</li>
                <li><a href="#">Edit Profile</a></li>
                <li><a href="#">Reset Password</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	
