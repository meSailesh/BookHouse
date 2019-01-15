<?php 
include ('includes/header.inc.php');?>
<div class="container-fluid ">
<div class="row">
  <div class="col-sm-3 pr-5 pl-0" >
  <div class="lists">
    <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link text-white" href="#" id="allBooks"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#"><i class="fas fa-clipboard-list mr-2"></i>Manage Categories<span class="arrow"></span></a>
      <ul class="submenu">
      	<li class="nav-item">
      <a class="nav-link text-white" href="#" id="add_categories">Add Categories</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#" id="update_cat">Update Categories</a>
    </li>
      </ul>
    </li>
     <li class="nav-item">
      <a class="nav-link text-white" href="#"><i class="fas fa-clipboard-list mr-2"></i>Manage Sub-categories<span class="arrow"></span></a>
      <ul class="submenu">
      	<li class="nav-item">
      <a class="nav-link text-white" href="#">Add Sub-categories</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#">Update Sub-categories</a>
    </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#"><i class="fas fa-book mr-2"></i>Manage Books<i class="fas fa-angle-down float-right pt-1"></i></a>
       <ul class="submenu">
      	<li class="nav-item">
      <a class="nav-link text-white" id="add_books" href="#">Add Book</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#">Update Book</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#">Delete Book</a>
    </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white " href="#"><i class="fas fa-envelope mr-2"></i>View Feedbacks</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white " href="#"><i class="fas fa-box-open mr-2"></i>View Orders</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white pt-1" href="#"><i class="fas fa-users mr-2"></i>View Users</a>
    </li>
    
  </ul>
  </div>
  </div>
  <div class="col-sm-9 content" style="padding-top: 75px;">

  </div>
</div>
  
</div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top" style="opacity: 0.9;">
  <i class="fas fa-cog text-light mr-1" style="font-size:25px; "></i><a class="navbar-brand" href="#" id="allBooks">Book House</a>
  <a class="link-item text-white ml-auto" href="../logout.php" style="text-decoration: none;">Logout</a>
</nav>