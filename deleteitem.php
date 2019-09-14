<?php include 'header.php'; ?>

<div class="container">
	<a class="btn btn-md btn-danger" href="admin.php">Home</a>
	<div class="row">
	<a class="btn btn-md btn-primary" href="newitem.php">New Item</a>
		<h1 style="text-align: center;">Delete Form</h1>
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
	$var99=mysqli_query($var1,"SELECT * from items");
	while($row = mysqli_fetch_array($var99))
	{
		$var=$row['product_id'] ;
		$var100=mysqli_query($var1,"SELECT * from items");
		$count9=mysqli_num_rows($var100);
        if ($count9)
		{
		?>
			<div class="container">
				<div class="row">
					<h2 style="text-align: center;"><?php echo $row['name']; ?></h2>
				</div>
				<div style="width: 30%; margin: 5px auto;">
				    <div class="form-group">
					    <span class="form-control">#<?php echo $row['category']; ?></span>
					</div>
					<div class="form-group">
					    <p class="form-control"><?php echo $row['description']; ?></p>
					</div>
					<div class="form-group">
					    <button class="btn btn-md btn btn-block">Price: <?php echo $row['price']; ?></button>
					</div>
					<?php 
					if($var47['flag']==2)
					{
					?>
					<div class="form-group">
					    <button class="btn btn-md btn-info btn-block">Freezed</button>
					</div>
					<?php } else { ?>
					<div class="form-group">
					    <button class="btn btn-md btn-warning btn-block"><?php echo $row['finaldate']; ?></button>
					</div>
					<?php }	?> 
					<form name="DelfromcartCart" method="get" action="deleteitem.php">
						<input type = "hidden" name = "var3" value = <?php echo $row['product_id'] ; ?>>
							
						<div class="form-group">
							<input class="form-control" type="text" name="var80" placeholder="Enter Price" onfocus="if(this.value=='Enter Price')this.value='';">
						</div>
							<div class="form-group">
								<input class="btn btn-md btn-danger btn-block" type="submit" name="del" value="Delete">
							</div>
						</form>
					</div>          
				</div> 
				<?php 
		}
         
    }
	if(isset($_GET['del']))
	{
		$var60=$_GET['var3'];
		$var61="DELETE FROM items WHERE product_id='$var60'";
		if (mysqli_query($var1,$var61))
		{
			$var61="DELETE FROM wishlist WHERE product_id='$var60'";
			mysqli_query($var1,$var61);
			echo "Record deleted successfully";
		}
        else 
            echo "Failed";
	}									
}									
?>
<?php include 'footer.php'; ?>
