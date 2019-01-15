<?php include('includes/header.inc.php');?>
 <!-- Login and Signup Modal Modal -->
<div class="modal fade" id="loginModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Attention!</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body p-3">
     <p class="title"> Dear user, we request you to login first. Logging lets you to add books to your order box and gets you access to your orders and recommendations.</p>
      <p class="sub">It only takes few seconds...</p>
     <p class="buttons"> <a href="login.php" class="btn btn-success">Login</a>&nbspor&nbsp<a href="register.php" class="btn btn-success">Sign Up</a></p>
        </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<!-- carousel starts here-->
<div class="container pt-2" id="carousel">
    <!-- feature books-->
<div id="demo" class="carousel slide mt-2 pt-4" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
    <li data-target="#demo" data-slide-to="3"></li>
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="uploaded_images/496.jpg" alt="Los Angeles" >
    </div>
    <div class="carousel-item">
      <img src="uploaded_images/603.jpg" alt="Chicago" >
    </div>
    <div class="carousel-item">
      <img src="uploaded_images/123.png" alt="New York" >
    </div>
     <div class="carousel-item">
      <img src="uploaded_images/574.jpg" alt="New York" >
    </div>
      </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>

<!-- feature books end-->
<!-- best seller -->
<div class="row border p-3 my-4" id="bestseller">
<h3>Best Seller <hr></h3>
<?php include('includes/bestseller.inc.php');?>
</div>
<!-- Bestseller end -->
<!-- upcoming -->
<div class="row border p-3 my-4">
 <h3>Upcoming Books  <hr></h3>
<?php include('includes/upcoming.inc.php');?>
</div>
</div>
<!-- Upcoming end -->
<?php include ('includes/footer.inc.php');?>