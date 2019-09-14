<?php include 'header.php'; ?>

<div class="container">
	<div class="row">
		<h1 style="text-align: center;">Login</h1>
        <hr> 
    </div>
    <div style="width: 30%; margin: 20px auto;">
    	<form action="login.php" method="get">
    		<div class="form-group">
				<input class="form-control" type="text" name="uname" value="" placeholder="Username">
			</div>
			<div class="form-group">
				<input class="form-control" type="password" name="psw" value="" placeholder="Password">
			</div>
			<div class="form-group">
				<input class="btn btn-lg btn-primary btn-block" type="submit" value="Login" name="lgn" >
			</div>
			<div class="form-group">
				<input class="btn btn-md " type="button" value="Register" name="rgr" ONCLICK="window.location.href='index.php'"/>
			</div>
    	</form>
    </div>



</div>

<?php
session_start();
if(isset($_GET['lgn']))
{
    if(($_GET['uname'])=='' && ($_GET['psw'])=='')
    {
        echo '<br><td>Please enter Username and Password <br> ';  
    } 
    else if($_GET['uname']=='' && $_GET['psw']=='')
    {
        echo '<br><td> Enter Username  <br> ';  
    }
    else if($_GET['uname'] && $_GET['psw']=='')
    {
        echo '<br><td> Enter Password <br> ';  
    }
    else
	{
        $var1=mysqli_connect("localhost","root","");
        mysqli_select_db($var1,"test");
	
        $user=$_GET['uname'];
        $pass=$_GET['psw'];
        $_SESSION['login']=$user;
        $_SESSION['login1']=$pass;
            
	
        $Login=mysqli_query($var1,"SELECT * FROM `users` WHERE username='$user' and password='$pass'");
        $count1=mysqli_num_rows($Login);
        $_SESSION['varname'] = $_GET['uname'];
           
         
           
        if($count1>0 && ($_GET['uname']=='admin'))
        {
			$_SESSION['statusA']="Active";
			$_SESSION['varnameA'] = $_GET['uname'];
			header('location:admin.php');
		}
        else if ($count1>0)
        {
			$_SESSION['status']="Active";
			$_SESSION['varname'] = $_GET['uname'];
			header('location:homelogin.php');
		}    
 		else   
     	{
    		echo "<td>Login Failed" ;
     	}
        
        

	}
}

?>


<?php include 'footer.php'; ?>
