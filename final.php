<?php include('includes/header.inc.php');
if(!($_SESSION['user']))
	{
		header("location:index.php");
	}
?>
<div class="container">
<div class="jumbotron"><center>
  <h1>Thank you!</h1> 
  <p>Your order has been placed successfully.</p> </center>
</div>
<a class="btn btn-success pull-left btn-fyi" href="book_collection.php"><span class="glyphicon glyphicon-chevron-left"></span> CONTINUE SHOPPING</a>
</div>
<p></br></p>
<p></br></p>
<?php include ('includes/footer.inc.php');?>