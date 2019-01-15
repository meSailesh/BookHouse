<?php include('includes/header.inc.php');
if(!($_SESSION['user']))
	{
		header("location:index.php");
	}
?>
<div class="container">
<p></br></p>
<p></br></p>
<div class="card m-2">
	<div class="card-header text-dark" style="background: lightgreen;">My Orderbox</div>
	<div class="card-body">
	<div class="row px-1" id="cardtitle">
		<div class="col-sm-1"><b>Book Image</b></div>
		<div class="col-sm-3"><b>Book Title</b></div>
		<div class="col-sm-2"><b>Book Price in Rs</b></div>
		<div class="col-sm-2"><b>Quantity</b></div>
		<div class="col-sm-2"><b>Total Price in Rs</b></div>
		<div class="col-sm-2"><b>Action</b></div>
	</div>
	
	<hr>
	<div id="cart_item">
	
	</div>
	<a href="shipping_address.php" class="btn btn-success float-right">Proceed To Checkout</a>
</div>
</div>
</div>
<p></br></p>
<p></br></p>
<?php include ('includes/footer.inc.php');?>