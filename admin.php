<?php include 'header.php'; ?>

<div class="container">
	<a class="btn btn-md btn-primary" href="newitem.php">New Item</a>
	<a class="btn btn-md btn-danger" href="deleteitem.php">Delete Item</a>
	<div class="row">
		<h1 style="text-align: center;">Τα είδη που θέλουν οι πελάτες</h1>
		<hr>
	</div>
</div>


 <?php
session_start();
if($_SESSION['statusA']!="Active")
	header("location:login.php");

$id=$_SESSION['varname'];
$var1=mysqli_connect("localhost","root","");
	if ($var1)
	{
		mysqli_select_db($var1,"test");
		$var25=mysqli_query($var1,"SELECT * from items");
		while($row = mysqli_fetch_array($var25))
		{
			$var=$row['product_id'] ;
			$var30=mysqli_query($var1,"SELECT * FROM wishlist WHERE product_id='$var'");
			$var40=mysqli_fetch_array($var30);				   
			$v=mysqli_query($var1,"SELECT amount FROM items WHERE product_id='$var'");
			$v=mysqli_fetch_assoc($v);
			$count2=mysqli_num_rows($var30);
            if ($count2 && ($row['finaldate']>date("Y-m-d", strtotime("today"))))
			{
			?>
				<div class="container">
					<div class="row">
						<h2 style="text-align: center;"><?php echo $row['name']; ?></h2>
				    </div>
				    <div style="width: 30%; margin: 5px auto;">
				    	<div class="form-group">
					    	<span class="form-control">Amount <?php echo $v['amount']; ?></span>
					    </div>
				    	<div class="form-group">
					    	<span class="form-control">#<?php echo $row['category']; ?></span>
					    </div>
					    <div class="form-group">
					    	<p class="form-control"><?php echo $row['description']; ?></p>
					    </div>
					    <div class="form-group">
					    	<button class="btn btn-md btn btn-block">Price: <?php echo $row['price']; ?></button>
					    </div>
					    <div class="form-group">
					    	<button class="btn btn-md btn-primary btn-block">Max Price: <?php echo $row['maxprice']; ?></button>
					    </div>
					    <div class="form-group">
					    	<button class="btn btn-md btn-warning btn-block"><?php echo $row['finaldate']; ?></button>
					    </div>
					    <form name="AddToCart" method="get" action="admin.php">
							<input type="hidden" name="var3" value="<?php echo $row['product_id'];?>">
							<input type="hidden" name="pname" value="<?php echo $row['name']; ?>">
							<div class="form-group">
								<input class="form-control" type="text" name="var80" placeholder="Enter Price" onfocus="if(this.value=='Enter Price')this.value='';">
							</div>
							<div class="form-group">
								<input class="btn btn-md btn-success btn-block" type="submit" name="but3" value="Update">
							</div>
						</form>
					</div>          
				</div> 
				<?php

			}
			if($row['finaldate']<=date("Y-m-d", strtotime("+3 day")))
			{
				$dat=$row['finaldate'];
				if (date("Y-m-d", strtotime("today"))>=$row['finaldate'] && date("Y-m-d", strtotime("today"))<=date('Y-m-d', strtotime($dat. ' + 3 days'))&& $var40['flag']!=2)
				{
					if($count2)
					{
					?>
						<div class="container">
							<div class="row">
								<h2 style="text-align: center;"><?php echo $row['name']; ?></h2>
						    </div>
						    <div style="width: 30%; margin: 5px auto;">
						    	<div class="form-group">
							    	<span class="form-control">Amount <?php echo $v['amount']; ?></span>
							    </div>
						    	<div class="form-group">
							    	<span class="form-control">#<?php echo $row['category']; ?></span>
							    </div>
							    <div class="form-group">
							    	<p class="form-control"><?php echo $row['description']; ?></p>
							    </div>
							    <div class="form-group">
							    	<button class="btn btn-md btn btn-block">Price: <?php $row['price']; ?></button>
							    </div>
							    <div class="form-group">
							    	<button class="btn btn-md btn-primary btn-block">Max Price: <?php echo $row['maxprice']; ?></button>
							    </div>
							    <div class="form-group">
							    	<button class="btn btn-md btn-warning btn-block"><?php echo $row['finaldate']; ?></button>
							    </div>
							    <form name="Freeze" method="get" action="admin.php">
									<input type="hidden" name="var31" value="<?php echo $row['product_id'];?>">
									<input type="hidden" name="pname" value="<?php echo $row['name']; ?>">
									<div class="form-group">
										<input class="form-control" type="text" name="var80" placeholder="Enter Price" onfocus="if(this.value=='Enter Price')this.value='';">
									</div>
									<div class="form-group">
										<input class="btn btn-md btn-info btn-block" type="submit" name="but4" value="Freeze">
									</div>
								</form>
						    </div>           
						</div> 
						<?php			   
			  		}
			  	}
			}
		}
			
		if(isset($_GET['but3']))
		{
			$var31=$_GET['var3'];
			$var80=$_GET['var80'];
			$proname=$_GET['pname'];
			$var32="UPDATE items SET  price='$var80' where product_id='$var31' ";
			if (mysqli_query($var1,$var32))
			{
                $message_entry="INSERT INTO notifications VALUES ('','$var31','New price on product $var31 $proname set on $var80')";
				mysqli_query($var1,$message_entry);
				echo "New record updated successfully";

			}
            else 
                echo "Failed";
		}
		if(isset($_GET['but4']))
		{
			$var31=$_GET['var31'];
			$proname=$_GET['pname'];
			$var80=2;
			$var32="UPDATE wishlist SET  flag='$var80' where product_id='$var31' ";
			if (mysqli_query($var1,$var32))
			{
				$message_entry="INSERT INTO notifications VALUES ('','$var31','New price on product $var31 $proname set on $var80')";
					mysqli_query($var1,$message_entry);					
                echo "Freezed transaction";
			}
            else 
                echo "Freeze failed";
		}
			
	}								    
?>

<?php include 'footer.php'; ?>