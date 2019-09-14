<?php include 'header.php'; ?>

<?php

$var1=mysqli_connect("localhost","root","");
if($var1)
{
			
    mysqli_select_db($var1,"test");
	$var25=mysqli_query($var1,"SELECT * from items");
	
	while($row = mysqli_fetch_array($var25))
	{
		if ($row['finaldate']>date("Y-m-d", strtotime("today")))
		{	  
		?>
			<div class="container">
				<div class="row">
					<h2 style="text-align: center;"><?php echo $row['name']; ?></h2>
			    </div>
			    <div style="width: 30%; margin: 20px auto;">
			    	<div class="form-group">
				    	<span class="form-control">#<?php echo $row['category']; ?></span>
				    </div>
				    <div class="form-group">
				    	<p class="form-control"><?php echo $row['description']; ?></p>
				    </div>
				    <div class="form-group">
				    	<button class="btn btn-md btn-warning btn-block"><?php echo $row['finaldate']; ?></button>
				    </div>
			    </div>
			                
			</div> 
			 

		<?php	
		}
	}
}
?>

<?php include 'footer.php'; ?>