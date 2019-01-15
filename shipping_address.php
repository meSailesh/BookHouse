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
	<div class="card-header text-dark" style="background: lightgreen;">Enter Delivery Address</div>
	<div class="card-body">
	 <form class="form" role="form" autocomplete="off" method="POST" action="payment.php">
                         
      
                                <div class="form-group">
                                    <label for="inputName">Full Name</label>
                                    <input type="text" class="form-control" id="inputName" placeholder="full name" name="fullname" >
                                </div>
                                
                                <div class="form-group">
                                    <label for="inputEmail">Mobile Number</label>
                                    <input type="number" class="form-control" id="inputEmail3"  placeholder="email@gmail.com" name="mobile">
                                </div>
                              
                                <div class="form-group">
                                    <label for="Pincode">Pincode</label>
                                    <input type="number" class="form-control" id="inputPassword3"  placeholder="560035" name="pincode"  >
                                </div>
                            
                                <div class="form-group">
                                    <label for="inputVerify3">Flat, House no., Building, Company, Apartment </label>
                                    <input type="text" class="form-control" id="inputVerify3" name="flat" placeholder="F-05 BTI BOYS HOSTEL" >
                                </div>
                               
                                <div class="form-group">
                                    <label for="inputPhone">Area, Colony, Street, Sector, Village</label>
                                    <input type="text" class="form-control" id="phone" name="area"  placeholder="Kodathi">
                                </div>
                              
                                <div class="form-group">
                                    <label for="inputAddress">Landmark</label>
                                    <input type="text" class="form-control" id="address" name="landmark"  placeholder="Bangalore Technological Institute">
                                </div>
                         
                            <div class="form-group">
                                    <label for="inputName">Town/City</label>
                                    <input type="text" class="form-control" id="inputName" placeholder="Bengaluru" name="town" >
                                </div>
                               <div class="form-group">
                                    <label for="inputName">State</label>
                                    <input type="text" class="form-control" id="inputName" placeholder="Karnataka" name="state" >
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-success btn-lg float-right">Proceed</button>
                                </div>
                            </form>
	
</div>
</div>
</div>
<p></br></p>
<p></br></p>
<?php include ('includes/footer.inc.php');?>