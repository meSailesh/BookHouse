<?php
require('includes/mysql.inc.php');
session_start();
if(!($_SESSION['user']))
	{
		header("location:index.php");
	}
//get registered users
if(isset($_POST["get_users"]))
{
  $sql="SELECT * FROM  user_info";
  $result=$conn->query($sql);
  echo mysqli_num_rows($result)-1;
  
}
if(isset($_POST["get_books_count"]))
{
  $sql="SELECT * FROM  book";
  $result=$conn->query($sql);
  echo mysqli_num_rows($result);
}
if(isset($_POST["get_sales"]))
{
  $sql="SELECT * FROM  cart";
  $result=$conn->query($sql);
  echo mysqli_num_rows($result);
}
if(isset($_POST["dashboard"]))
{
	echo'
    <h2 class="dash">Dashboard</h2><span><small>Summary of My Business</small></span>
    <div class="row stats mx-auto ">
    	<div class="col-sm-3 text-dark mt-5">
    	<i class="fas fa-user-circle text-success ml-3 mt-1" style="font-size: 80px;"></i><span class="float-right reg_usr
    	" style="color:#049e63;font-size:3rem;margin:15px 30px 0 0;"></span>
    	<p><center style="font-size:18px; font-weight: bold;font-family: "Nunito Sans", sans-serif;color:#21ef5b; ">Registered Users</center></p>
    	</div>
    	<div class="col-sm-3 text-dark mt-5">
    	<i class="fas fa-book text-warning ml-3"  style="font-size: 70px;margin-top: 5px;"></i><span class="float-right books_count" style="color:#f4ce42;font-size:3rem;margin:15px 20px 0 0;"></span>
    	<p><center style="font-size:18px; font-weight: bold;font-family: "Nunito Sans", sans-serif;color:#ebef20; ">Different Books</center></p>
    	</div>
    	<div class="col-sm-3 text-dark mt-5">
    	<i class="fas fa-chart-line text-primary ml-3"  style="font-size: 70px;"></i><span class="float-right sales_count
    	" style="color:#08a3db;font-size:3rem;margin:15px 20px 0 0;"></span>
    	<p><center style="font-size:18px; font-weight: bold;font-family: "Nunito Sans", sans-serif;color:#05dffc; ">Sales</center></p>
    	</div>
    	<div class="col-sm-3 text-dark mt-5">
    	<i class="fas fa-envelope text-danger ml-3"  style="font-size: 70px;"></i><span class="float-right
    	" style="color:#ce2f2f;font-size:3rem;margin:15px 20px 0 0;">100</span>
    	<p><center style="font-size:18px; font-weight: bold;font-family: "Nunito Sans", sans-serif;color:red; ">Feedbacks</center></p>
    	</div>
    	<div class="col-sm-3 text-dark mt-5">
    	<i class="fas fa-eye text-info ml-3"  style="font-size: 70px;"></i><span class="float-right" 
    	style="color:#4ec4bf;font-size:3rem;margin:15px 20px 0 0;">100</span>
    	<p><center style="font-size:18px; font-weight: bold;font-family: "Nunito Sans", sans-serif;color:skyblue; ">Daily Visitors</center></p>
    	</div>
    </div>
	';
}
//add categories
if(isset($_POST["add_cat"]))
{
	$name=$_POST["cat_name"];
	$query="SELECT * FROM category WHERE cat_name='$name'";
  	$res = $conn->query($query);
  	if(mysqli_num_rows($res)>0)
  	{
  		echo '<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Success!</strong> Category already present.
</div>';
  	}
  	else{
  $sql="INSERT INTO category(cat_id,cat_name) VALUES (NULL,'$name')";
  if($conn->query($sql))
       {
       echo '<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Success!</strong>Successfully Added.
</div>';
       }    
       else{
       	  echo '<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Success!</strong>Try Again.
</div>';
       }
   }
  
}
//update categories
if(isset($_POST["update_cat"]))
{
  $name=$_POST["cat_name"];
    $ids=$_POST['old_cat'];
  $sql="UPDATE category SET cat_name='$name' WHERE cat_id='$ids'";
  if($conn->query($sql))
       {
       echo '<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Successfully Updated.</strong>
</div>';
       }    
       else{
          echo '<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Try Again.</strong>
</div>';
       }
   
  
}
//add books
if(isset($_POST["add_book"]))
{
	$name=$_POST["book_name"];
	$query="SELECT * FROM book WHERE book_name='$name'";
  	$res = $conn->query($query);
  	if(mysqli_num_rows($res)>0)
  	{
  		echo '<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Success!</strong> Category already present.
</div>';
  	}
  	else{
  $sql="INSERT INTO book(book_id,book_name) VALUES (NULL,'$name')";
  if($conn->query($sql))
       {
       echo '<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Success!</strong>Successfully Added.
</div>';
       }    
       else{
       	  echo '<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Try Again.</strong>
</div>';
       }
   }
  
}
if(isset($_POST["add_categories"]))
{
	echo'  <div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-6">
      <div class="msg"></div>
      <div class="card">
      <div class="card-header">Add Categories</div>
      <div class="card-body"><input type="text" id="cat_name" class="form-control" placeholder="Enter the Categories Name" required=""></div>
      <div class="card-footer">
        <button class="btn btn-primary" id="add_cat_btn">Add</button>
      </div>
      </div>
  <div class="col-sm-4"></div>
    
    </div>
  </div>';
}
if(isset($_POST["update_categories"]))
{
  echo'  <div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-6">
      <div class="msg"></div>
      <div class="card">
      <div class="card-header">Update Categories</div>
      <div class="card-body">
       <select id="select_cat" class="form-control mb-1">
      <option>Select Book Categories</option>
      ';
      $query="SELECT * FROM category";
    $res = $conn->query($query);
    if(mysqli_num_rows($res)>0)
    {
       while($row=mysqli_fetch_array($res)){
            $id=$row['cat_id'];
            $options=$row["cat_name"];
            echo' <option value="'.$id.'">'.$options.'</option>';
          }
    }
      echo'
      </select>
      <input type="text" id="cat_name" class="form-control" placeholder="Enter the New Name" required=""></div>
      <div class="card-footer">
        <button class="btn btn-primary" id="update_cat_btn">Update</button>
      </div>
      </div>
  <div class="col-sm-4"></div>
    
    </div>
  </div>';
}
if(isset($_POST["add_books"]))
{
	echo'  <div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-6">
      <div class="msg"></div>
      <div class="card">
      <div class="card-header">Add Books</div>
      <div class="card-body">
          <select id="select_cat" class="form-control mb-1">
      <option>Select Book Categories</option>
      ';
      $query="SELECT * FROM category";
    $res = $conn->query($query);
    if(mysqli_num_rows($res)>0)
    {
       while($row=mysqli_fetch_array($res)){
            $id=$row['cat_id'];
            $options=$row["cat_name"];
            echo' <option value="'.$id.'">'.$options.'</option>';
          }
    }
      echo'
      </select>
      <select id="select_sub_cat" class="form-control mb-1">
      <option>Select Sub-Categories</option>
      </select>
      <input type="text" id="book_name" class="form-control mb-1" placeholder="Book Name" required="">
      <input type="text" id="book_price" class="form-control mb-1" placeholder="Price" required="">
      <textarea id="book_desc" class="form-control mb-1" placeholder="Book Description" required=""></textarea>
      <input type="text" id="authors" class="form-control mb-1" placeholder="Authors" required="">
      <input type="text" id="edition" class="form-control mb-1" placeholder="Edition" required="">
      <input type="file" id="file" class="form-control mb-1" required=""></br>
      <span id="uploaded_image"></span>
      <p id="img_name" style="display:none;"></p>
      </div>
      <div class="card-footer">
        <button class="btn btn-primary" id="add_book_btn">Add</button>
      </div>
      </div>
  <div class="col-sm-4"></div>
    
    </div>
  </div>';
}
if(isset($_POST["get_subcat"]))
{
  $catid=$_POST['cat_id'];
  $sql="SELECT * FROM subcategory where parent_id='$catid'";
  $result=$conn->query($sql);
  if(mysqli_num_rows($result)>0)
    {
       while($row=mysqli_fetch_array($result)){
          $id=$row['sub_cat_id'];
            $options=$row["sub_cat_name"];
            echo' <option value="'.$id.'">'.$options.'</option>';
       }
     }
     else{
      echo' <option value="">No subcategory</option>';
     }
   }
   if(isset($_POST["add_book_btn"]))
   {
    $cat_id=$_POST['cat'];
    $sub_cat_id=$_POST['subcat'];
    $name=$_POST['name'];
    $price=$_POST['price'];
    $desc=$_POST['desc'];
    $authors=$_POST['authors'];
    $edition=$_POST['edition'];
    $image=$_POST['image'];
     $sql="SELECT * FROM book WHERE book_name='$name'";
     $result=mysqli_query($conn,$sql); 
     if(mysqli_num_rows($result)>0){
      echo '<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Book is already present in the store.</strong>
</div>';
     }
     else{
      $query="INSERT INTO book (book_id, cat_id, book_name, book_price, book_desc, authors, edition, book_image, sub_cat_id) VALUES(NULL,'$cat_id','$name','$price','$desc','$authors','$edition','$image','$sub_cat_id')";
       if($conn->query($query))
       {
         echo '<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Book is Successfully Added!.</strong>
</div>';
      }     
       else{
        echo '<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Try Again.</strong>
</div>';
       }
     }
   }
?>