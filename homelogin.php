<?php include 'header.php'; ?>

	<?php

    session_start();
		
		    
	if(isset($_GET['home10']))
	{
        session_destroy();
		$_SESSION = array();
		header('location:login.php');
	}
	if($_SESSION['status']!="Active")
		header("location:login.php");

	    $id=$_SESSION['varname'];
		$connection=mysqli_connect("localhost","root","");
		if ($connection)
		{
			mysqli_select_db($connection,"test");
			$notification_num=mysqli_query($connection,"SELECT count_notifications FROM users where username='$id'");
			$notification_num=mysqli_fetch_array($notification_num);
			?>
			<script>
			function NotFunq()
			{
				<?php
				$notification_zero="UPDATE users SET count_notifications='0' where username='$id'";
				mysqli_query($connection,$notification_zero) 

				?>
			}
			</script>

			<div class="dropdown">
				<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" onclick="NotFunq()" >Notifications 
				<?php
				if ($notification_num['count_notifications'] != 0)
					echo $notification_num['count_notifications'];
				?>
				<span class="caret"></span></button>
				<ul class="dropdown-menu">
				<?php
					$message_query=mysqli_query($connection,"SELECT * from notifications ORDER BY length(notif_id) desc, notif_id desc");
						$product=mysqli_query($connection,"SELECT product_id from wishlist where username='$id'");

					while ($row_message=mysqli_fetch_array($message_query))
					{
						while ($row_product=mysqli_fetch_array($product))
						{
							if($row_product['product_id']==$row_message['product_id'])
							{
						?>
							<li>
								<a href="homelogin.php"><?php echo $row_message['message'];  ?></a>
							</li>
							<?php
							}
						}
						$product=mysqli_query($connection,"SELECT product_id from wishlist where username='$id'");
					}
					?>
				</ul>
			</div>
		
			<div class="container">
				<div class="row">
					<a class="btn btn-md btn-primary" href="basket.php">Καλάθι</a>
					<h1 style="text-align: center;">Προϊόντα</h1>
					<hr>
				</div>
			</div>
			<?php

			$var25=mysqli_query($connection,"SELECT * from items");
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
						    <form name="AddToCart" method="get" action="homelogin.php">
						    	<input type = "hidden" name = "var3" value = <?php $row['product_id']; ?>>
						    	<div class="form-group">
						    		<input class="form-control" type = "text" name = "var80" placeholder="Enter amount" onfocus="if (this.value=='Enter amount') this.value='';">
						    	</div>
						    	<div class="form-group">
						    		<input class="btn btn-md btn-success btn-block" type="submit" name="but3" value="Add to cart">
						    	</div>
						    </form>	
					    </div>        
					</div> 
	                <?php
	            }
			}
			
			if(isset($_GET['but3']))
			{
				$var27=$_GET['var3'];
				$var108=$_GET['var80'];
				$wishlist_query="insert into wishlist values ('$var27','$id','$var108','',0)";
			    $var26=mysqli_query($connection,$wishlist_query);
				$va5=mysqli_query($connection,"select amount from items where product_id='$var27'");
				$va5=mysqli_fetch_assoc($va5);
				$var108=$var108+$va5['amount'];
				$amount="UPDATE items SET amount='$var108' where product_id='$var27'";
				if (mysqli_query($connection,$amount)) 
	                 echo "Item added to basket";
				else
					echo"Cant do it";
				  
				 
				
			}
	  
		} 
	
?>

<?php include 'footer.php'; ?>