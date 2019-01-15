<?php session_start();
require('includes/mysql.inc.php');
$user=$email="";
?>
<!DOCTYPE html>
<html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Book House</title>
   <link rel="icon" href="images/title-logo.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
	 <link rel="stylesheet" type="text/css" href="css/style.css">
	 <link href="https://fonts.googleapis.com/css?family=Nunito+Sans|Fjalla+One|Quicksand|Hind+Madurai|Noticia+Text|PT+Sans|Roboto|Ubuntu|Roboto+Condensed|Open+Sans|Prosto+One|Changa|Ropa+Sans" rel="stylesheet">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
  <script src="js/bootstrap.min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="js/default.js"></script>
  
</head>
<body>
<nav class="navbar navbar-expand-md bg-success navbar-dark">
 <!-- Brand -->
  <a class="navbar-brand  mx-0" id="logo" href="index.php" style="font-family:'Changa', sans-serif;"><img src="images/logo.png "  > </a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler navbar-toggler-right " type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse " id="collapsibleNavbar">
    <ul class="navbar-nav ml-5">
      <li class="nav-item">
        <a class="nav-link text-white px-3 " href="index.php" >Home</a>
      </li>
       <li class="nav-item">
        <a class="nav-link text-white px-3" href="book_collection.php" >Browse Books</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white px-3" href="catalog.php" >Price List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white px-3" href="#" >Contact Us</a>
      </li>
    </ul>
    </div>
   <div class='socialicons'>
  <div class='icon social fb'><i class='fa fa-facebook'></i></div>
  <div class='icon social tw'><i class='fa fa-twitter'></i></div>
  <div class='icon social in'><i class='fa fa-google'></i></div>
</div>  
</nav>
<!-- search box -->
<div class="container-fluid bg-success p-2 m-0" id="getFixed">
<div class="row">
<div class="col-sm-8">
<div class="input-group " id="search-bar">
   <input type="text" name="Book" id="book" class="form-control " autocomplete="off" placeholder="Type Book Name" />
   <div class="input-group-addon" id="search_button"><i class="fa fa-search"></i></div>
   </div>
   </div>
   <div class="col-sm-4 mx-0">
    <?php 
if(isset($_SESSION['user']))
{
  $email=$_SESSION['user'];
  $sql="SELECT name FROM user_info WHERE email='$email'";
  $result = $conn->query($sql);
  $user=$result->fetch_assoc();
echo ' 
<ul class="nav float-right">
<li class="nav-item">
    <a class=" nav-link text-white" href="cart.php">Order Box <i class="fas fa-box-open"></i><span class="badge text-white bg-danger"></span></a>
  </li>
<li class="nav-item dropdown">
    <a class="nav-link text-white dropdown-toggle" data-toggle="dropdown">Hello&nbsp'.$user['name'].'</a>
 <ul class="dropdown-menu" style="background:lightgreen;">
<li class="dropdown-item">
    <a class="nav-link text-dark" href="profile.php">My Account</a>
  </li>
   <div class="dropdown-divider"></div>
 <li class="dropdown-item">
    <a class="nav-link text-dark" href="logout.php">Logout</a>
  </li>
  </ul>
   </li>
   </ul>
  ';
}
else{
   echo ' 
   <ul class="nav float-right">
   <li class="btn btn-success">
    <a class="text-white" href="login.php" > <i class="fas fa-sign-in-alt"></i> Login</a>
  </li>
  <li class=" btn btn-success">
    <a class="text-white" href="register.php" > <i class="fas fa-user-plus"></i> Sign Up</a>
  </li>
  </ul>
  ';
}
  ?> 
  </div>
  </div>
    </div>