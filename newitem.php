<?php include 'header.php'; ?>


<div class="container">
	<div class="row">
		<h1 style="text-align: center;">New Item</h1>
		<hr>
    </div>
    <div style="width: 30%; margin: 20px auto;">
		<form action="newitem.php" method="GET">
			<div class="form-group">
				<input class="form-control" type="text" name="nam" value="" placeholder="Name">
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="cate" value="" placeholder="Category">
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="des" value="" placeholder="Description">
			</div>
			<div class="form-group">
				<input class="form-control" type="test" name="maxprice" value="" placeholder="Max Price">
			</div>
			<div class="form-group">
				<input class="form-control" type="date" name="date" value="" placeholder="Date">
			</div>
			<div class="form-group">
	            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Submit" name="act1" >
	        </div>
	    </form>
		<a class="btn btn-md btn-default" href="admin.php">Go Back</a>
	</div>
</div>


<?php
	$adminses='admin';
    session_start($adminses);
	if($_SESSION['statusA']!="Active")
		header("location:login.php");
	if(isset($_GET['act1']))
	{
	    $var1=mysqli_connect("localhost","root","");
		if($var1 === false)
		{
	        die("ERROR: Could not connect. " . mysqli_connect_error());
	    }
	    mysqli_select_db($var1,"test");		 
		if((isset ($_GET['nam']))==''&& (isset ($_GET['cate']))==''&& (isset ($_GET['des']))==''&& (isset($_GET['maxprice'])) =='' && (isset($_GET['date'])) == '')
	        echo "Please Enter Values";
		else
			{
	                
				$name=$_GET['nam'];
				$name2=$_GET['cate'];
			    $Password=$_GET['des'];
				$Surn=0;	
				$maxprice=$_GET['maxprice'];
				$finaldate=$_GET['date'];
				$amount=0;
				$pos="INSERT INTO items VALUES('','$name','$name2','$Password','$Surn','$amount','$maxprice','$finaldate')";
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
?>



<?php include 'footer.php'; ?>