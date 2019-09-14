<?php include 'header.php'; ?>


<div class="container">
	<div class="row">
		<h1 style="text-align: center;">Basket</h1>
		<hr>
    </div>
</div>


<?php
$userses='user';
session_start($userses);
if($_SESSION['status']!="Active")
	header("location:login.php");

$id=$_SESSION['varname'];
$connection=mysqli_connect("localhost","root","");
if ($connection)
{
	mysqli_select_db($connection,"test");
	$var112=mysqli_query($connection,"SELECT * from wishlist where username='$id'");
	while($row = mysqli_fetch_array($var112))
	{
		$product=$row['product_id'] ;
		$select_product=mysqli_query($connection,"SELECT * FROM items WHERE product_id='$product'");
		$row0 = mysqli_fetch_array($select_product);
		$count10=mysqli_num_rows($select_product);
		if ($count10)
		{
			if ($row0['finaldate']>date("Y-m-d", strtotime("today")))
			{ 
			?>
				<div class="container">
					<div class="row">
						<h2 style="text-align: center;"><?php echo $row0['name']; ?></h2>
					</div>
					<div style="width: 30%; margin: 20px auto;">
						<div class="form-group">
						    <span class="form-control">#<?php echo $row0['category']; ?></span>
						</div>
						<div class="form-group">
						    <p class="form-control"><?php echo $row0['description']; ?></p>
						</div>
						<div class="form-group">
							    <p class="form-control">Ammount: <?php echo $row['useramount']; ?></p>
						</div>
						<div class="form-group">
						    <button class="btn btn-md btn-warning btn-block"><?php echo $row0['finaldate']; ?></button>
						</div>
						<form name="DelFromCart" method="GET" action="basket.php">
						    <input type = "hidden" name ="key1" value =<?php echo $row['key1'];?>>
						    <div class="form-group">
						    	<input class="btn btn-md btn-success btn-block" type="submit" name="dl" value="Delete">
						    </div>
						</form>	
					</div>        
				</div> 
	            <?php
	        }
	        else if ($row0['finaldate']==date("Y-m-d", strtotime("today")))
	        {
				if ($row0['price']<=$row0['maxprice'])
				{
				?>
					<div class="container">
						<div class="row">
							<h2 style="text-align: center;"><?php echo $row0['name']; ?></h2>
						</div>
						<div style="width: 30%; margin: 20px auto;">
							<div class="form-group">
							    <span class="form-control">#<?php echo $row0['category']; ?></span>
							</div>
							<div class="form-group">
							    <p class="form-control"><?php echo $row0['description']; ?></p>
							</div>
							<div class="form-group">
							    <p class="form-control">Ammount: <?php echo $row['useramount']; ?></p>
							</div>
							<div class="form-group">
							    <button class="btn btn-md btn-warning btn-block"><?php echo $row0['finaldate']; ?></button>
							</div>
							<div class="form-group">
								<button class="btn btn-md btn-default btn-block">Final price: <?php echo $row0['price']; ?></button>
							</div>
							<div class="form-group">
								<button class="btn btn-md btn-danger btn-block">Δεν επιτρέπεται ακύρωση</button>
							</div>
						</div>        
					</div>
					<?php
					$key=$row['key1'];
					$temp=1;
					$insert= " UPDATE wishlist SET  flag='$temp' where key1='$key'";
				    if (mysqli_query($connection,$insert)) 
						echo "";
				}
				else if ($row0['price']>$row0['maxprice'] && $row['flag']==0)
				{
				?>
					<div class="container">
						<div class="row">
							<h2 style="text-align: center;"><?php echo $row0['name']; ?></h2>
						</div>
						<div style="width: 30%; margin: 20px auto;">
							<div class="form-group">
							    <span class="form-control">#<?php echo $row0['category']; ?></span>
							</div>
							<div class="form-group">
							    <p class="form-control"><?php echo $row0['description']; ?></p>
							</div>
							<div class="form-group">
								    <p class="form-control">Ammount: <?php echo $row['useramount']; ?></p>
							</div>
							<div class="form-group">
							    <button class="btn btn-md btn-warning btn-block"><?php echo $row0['finaldate']; ?></button>
							</div>
							<div class="form-group">
							    <button class="btn btn-md btn-info btn-block">Final Price: <?php echo $row0['price']; ?></button>
							</div>
							<div class="form-group">
								    <p class="form-control">You have 3 days to decide if you wish to continue with the purchase</p>
							</div>
							<form name="DelFromCart" method="GET" action="basket.php">
							    <input type = "hidden" name ="key1" value =<?php echo $row['key1'];?>>
							    <div class="form-group">
							    	<input class="btn btn-md btn-danger btn-block" type="submit" name="dl" value="Delete">
							    </div>
							</form>
							<form name="Done" method="GET" action="basket.php">
							    <input type = "hidden" name ="key1" value =<?php echo $row['key1'];?>>
							    <div class="form-group">
							    	<input class="btn btn-md btn-success btn-block" type="submit" name="dl2" value="Accept">
							    </div>
							</form>	
						</div>        
					</div> 
				<?php
				}
			}
			if ($row0['finaldate']<=date("Y-m-d", strtotime("today")))
			{
                if ($row['flag']==1)
                {?>
					<div class="container">
						<div class="row">
							<h2 style="text-align: center;"><?php echo $row0['name']; ?></h2>
						</div>
						<div style="width: 30%; margin: 20px auto;">
							<div class="form-group">
							    <span class="form-control">#<?php echo $row0['category']; ?></span>
							</div>
							<div class="form-group">
							    <p class="form-control"><?php echo $row0['description']; ?></p>
							</div>
							<div class="form-group">
							    <p class="form-control">Ammount: <?php echo $row['useramount']; ?></p>
							</div>
							<div class="form-group">
							    <button class="btn btn-md btn-warning btn-block"><?php echo $row0['finaldate']; ?></button>
							</div>
							<div class="form-group">
								<button class="btn btn-md btn-default btn-block">Final price: <?php echo $row0['price']; ?></button>
							</div>
							<div class="form-group">
								<button class="btn btn-md btn-success btn-block">Η παραγγελία πραγματοποιήθηκε</button>
							</div>
						</div>        
					</div>
				<?php
				}
				else
				{
					$dat=$row0['finaldate'];
					if (date("Y-m-d", strtotime("today"))>$row0['finaldate'] && date("Y-m-d", strtotime("today"))<=date('Y-m-d', strtotime($dat. ' + 3 days'))&& $row0['price']>$row0['maxprice'])
					{ 
					?>
						<div class="container">
							<div class="row">
								<h2 style="text-align: center;"><?php echo $row0['name']; ?></h2>
							</div>
							<div style="width: 30%; margin: 20px auto;">
								<div class="form-group">
								    <span class="form-control">#<?php echo $row0['category']; ?></span>
								</div>
								<div class="form-group">
								    <p class="form-control"><?php echo $row0['description']; ?></p>
								</div>
								<div class="form-group">
									    <p class="form-control">Ammount: <?php echo $row['useramount']; ?></p>
								</div>
								<div class="form-group">
								    <button class="btn btn-md btn-warning btn-block"><?php echo $row0['finaldate']; ?></button>
								</div>
								<div class="form-group">
								    <button class="btn btn-md btn-info btn-block">Final Price: <?php echo $row0['price']; ?></button>
								</div>
								<div class="form-group">
									    <p class="form-control">You have 3 days to decide if you wish to continue with the purchase</p>
								</div>
								<form name="DelFromCart" method="GET" action="basket.php">
								    <input type = "hidden" name ="key1" value =<?php echo $row['key1'];?>>
								    <div class="form-group">
								    	<input class="btn btn-md btn-danger btn-block" type="submit" name="dl" value="Delete">
								    </div>
								</form>
								<form name="Done" method="GET" action="basket.php">
								    <input type = "hidden" name ="key1" value =<?php echo $row['key1'];?>>
								    <div class="form-group">
								    	<input class="btn btn-md btn-success btn-block" type="submit" name="dl2" value="Accept">
								    </div>
								</form>	
							</div>        
						</div> 
					<?php			 
					}
				}		
			}	
		}
		if(isset($_GET['dl']))
		{
			$key=$_GET['key1'];
			$delete_wishlist="DELETE FROM wishlist WHERE key1='$key'";
			if(mysqli_query($connection,$delete_wishlist))
				echo "Deleted";
			else 
				echo "Delete failed";
                        	
		}
		if(isset($_GET['dl2']))
		{
			$key=$_GET['key1'];
			$temp=1;
		    $insert= "UPDATE wishlist SET  flag='$temp' where key1='$key'";		
		    if(mysqli_query($connection,$insert))
				echo "Done";
			else 
				echo "Insert failed";
                        	
		}			 			
	}
}
?>

<?php include 'footer.php'; ?>