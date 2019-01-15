<?php include('includes/header.inc.php');
if(!($_SESSION['user']))
	{
		header("location:index.php");
	}
if(isset($_POST['submit']))
{
	$_SESSION['fullname']=$_POST['fullname'];
	$_SESSION['mobile']=$_POST['mobile'];
	$_SESSION['pincode']=$_POST['pincode'];
	$_SESSION['flat']=$_POST['flat'];
	$_SESSION['area']=$_POST['area'];
	$_SESSION['landmark']=$_POST['landmark'];
	$_SESSION['town']=$_POST['town'];
	$_SESSION['state']=$_POST['state'];
	
}
?>
<div class="container">
<div class="card">
	<div class="row m-4">
<div class="col-sm-3"></div>
<div class="col-sm-6">
		<div class="paymentCont">
						<div class="headingWrap">
								<h3 class="headingTop text-center">Select Your Payment Method</h3>	
								
						</div>
						<div class="paymentWrap">
						<form class="form" role="form" autocomplete="off" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<div class="btn-group paymentBtnGroup btn-group-justified" data-toggle="buttons">
					            <label class="btn paymentMethod active">
					            	<div class="method visa"></div>
					                <input type="radio" name="options" checked> 
					            </label>
					            <label class="btn paymentMethod">
					            	<div class="method master-card"></div>
					                <input type="radio" name="options"> 
					            </label>
					            <label class="btn paymentMethod">
				            		<div class="method amex"></div>
					                <input type="radio" name="options">
					            </label>
					             <label class="btn paymentMethod">
				             		<div class="method vishwa"></div>
					                <input type="radio" name="options"> 
					            </label>
					            <label class="btn paymentMethod">
				            		<div class="method ez-cash"></div>
					                <input type="radio" name="options" value="1"> 
					            </label>
					           
					         
					        </div>        
						</div>
						<div class="footerNavWrap clearfix">
							<a class="btn btn-success pull-left btn-fyi" href="book_collection.php"><span class="glyphicon glyphicon-chevron-left"></span> CONTINUE SHOPPING</a>
							<input type="submit" value="CHECKOUT" name="final" class="btn btn-success pull-right btn-fyi"><span class="glyphicon glyphicon-chevron-right"></span>
						</div>
						</form>
					</div>
					</div>
					<div class="col-sm-3"></div>
		
	</div>
</div>
</div>
<?php include ('includes/footer.inc.php');
if(isset($_POST['final']))
{
	if ($_POST['options']==1)
	{
	$total=$_SESSION['total'];
	$email=$_SESSION['user'];   
		$fname=$_SESSION['fullname'];
	$mobile=$_SESSION['mobile'];
	$pincode=$_SESSION['pincode'];
	$flat=$_SESSION['flat'];
	$area=$_SESSION['area'];
	$landmark=$_SESSION['landmark'];
	$town=$_SESSION['town'];
	$state=$_SESSION['state'];  
	$booking_id=rand(1,100);
	$date=date('Y-m-d H:i:s a');
	$sql="INSERT into shipping values('$booking_id','$fname','$mobile','$pincode','$flat','$area','$landmark','$town','$state')";
	$result=mysqli_query($conn,$sql);
	$query="INSERT INTO booking values('$booking_id','$email','$total','$date')";
	$res=mysqli_query($conn,$query);
		if($result and $res)
	{
		echo "<script>window.location = 'final.php';</script>";
	}
	
}
}
?>