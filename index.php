<?php include 'header.php'; ?>

<div class="container">
	<div class="row">
		<h1 style="text-align: center;">Register</h1>
		<hr>
    </div>
    <div style="width: 30%; margin: 20px auto;">
    	<form action="index.php">
    		<div class="form-group">
				<input class="form-control" type="text" name="uname" value="" placeholder="Username">
			</div>
			<div class="form-group">
				<input class="form-control" type="password" name="psw" value="" placeholder="Password">
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="name" value="" placeholder="Name">
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="surn" value="" placeholder="Surname">
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="date" value="" placeholder="Date">
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="email" value="" placeholder="Email">
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="add" value="" placeholder="Address">
			</div>
			<div class="form-group">
				<input class="btn btn-lg btn-primary btn-block" type="submit" value="Register" name="act" >
			</div>
			<input class="btn btn-md" type="button" value="Back" name="rgr" ONCLICK="window.location.href='login.php'"/>
    	</form>
    </div>
</div>

<?php
    if(isset($_GET['act']))
    {
        $var1=mysqli_connect("localhost","root","");
		if($var1 === false)
		{
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        mysqli_select_db($var1,"test");
			 
		if((isset($_GET['uname']))=='' && (isset ($_GET['name']))==''&& (isset ($_GET['surn']))==''&& (isset ($_GET['psw']))==''&& (isset ($_GET['email']))==''&& (isset ($_GET['add']))==''&& (isset ($_GET['date']))=='')
                 echo "Please Enter Values";
		else
		{
            $user1=$_GET['uname'];
			$name1=$_GET['name'];
		    $Password1=$_GET['psw'];
            $Surn1=$_GET['surn'];
			$email1=$_GET['email'];
			$Add1=$_GET['add'];
			$Date1=$_GET['date'];
				
			$pos="INSERT INTO users VALUES('$user1','$name1','$Surn1','$Date1','$Password1','$email1','$Add1','0')";
			if (mysqli_query($var1,$pos)) 
			{
                echo "New record created successfully";
            } 
            else 
            {
                echo "Failed";
			}
		}
    }
    echo "  ";
?>           

<?php include 'footer.php'; ?>