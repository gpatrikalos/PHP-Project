<!DOCTYPE html>
<html>
    <head>
    	<title>E-Bid</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
 
     <nav class="navbar navbar-default">
        
        <div class="container-fluid">
            <div ="navbar-header">
                <a class="navbar-brand" href="home.php"><i class="fas fa-balance-scale"></i>E-Bid</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php //if(session_status() == PHP_SESSION_DISABLED){ ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="index.php">Sign Up</a></li>
                    <?php //} else { ?>
                        <li><a href="logout.php">Logout</a></li>
                    <?php// } ?>
                </ul>
            </div>
        </div>
    </nav>