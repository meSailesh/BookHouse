<?php
session_start();
require('includes/mysql.inc.php');
$icon='<i class="fas fa-box-open"></i>';
//loading of profile
if(isset($_POST['get_profile']))
{
   $email=$_SESSION['user'];
     $sql="SELECT name, phone, address, last_login FROM user_info WHERE email='$email'";
     $result=mysqli_query($conn,$sql); 
     if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
            $name=$row["name"];
             $phone=$row["phone"];
              $address=$row["address"];
              $last_login=$row["last_login"];
              echo'<div class="picture m-3" align="center">
    <i class="fas fa-user-circle" style="font-size: 9rem;"></i>
  </div>
  <div class="user_info pt-3">
  <h5><b>Profile</b></h5>
  <p><i class="fas fa-user"></i> '.$name.'</p>
  <p><i class="fas fa-user"></i> '.$phone.'</p>
  <p><i class="fas fa-user"></i> '.$address.'</p>
  <p ><i class="far fa-clock"></i>Last Login:<small> '. $last_login.' </small></p>
  <button class="btn btn-primary">Edit Profile</button>
  </div>';
            }
          }
  }
//end of profile
// Loading the main category starts here
if(isset($_POST['get_category']))
{
    $sql="SELECT * FROM category";
    $result=mysqli_query($conn,$sql); 
    echo'<h4 class="p-2">Categories</h4>
    <ul class="list-group" style="list-style:none">
        <li><a href="#" class="list-group-item text-dark allbooks">All Books</a></li>';
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
            $cid=$row["cat_id"];
            $cat_name=$row["cat_name"];
            ?>
    <li id="link<?php echo $cid; ?>"><a href="#" class="list-group-item text-dark cat_product" name="<?php echo $cat_name; ?>" id="<?php echo $cid; ?>" onmouseover="load_subcategory(this.id);"><?php echo $cat_name;?></a>
  <ul style="list-style: none" id='submenu'></ul>
  </li>
  <?php
 }
 echo "</ul>";
}
}
// Loading the main category ends here
// Loading the sub category starts here
if(isset($_POST['get_subcategory']))
{
 $cat_id=$_POST['cat_id'];
 $sql ="SELECT * FROM subcategory where parent_id='$cat_id'";
 $result=mysqli_query($conn,$sql); 
if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
            $sid=$row["sub_cat_id"];
            $sub_cat_name=$row["sub_cat_name"];
  echo '<li id="subLink'.$sid.'"><a href="#" class="list-group-item text-dark sub_cat_product" id="'.$sid.'" pid="'.$cat_id.'" name="'.$sub_cat_name.'"><i class="fas fa-angle-right"></i>&nbsp'.$sub_cat_name.'</a>
  </li>';
 }	
}
 exit();
}
// Loading the sub category ends here
//loading of products starts here
if(isset($_POST['get_product']))
{
    $sql="SELECT * FROM book";
    $result=mysqli_query($conn,$sql); 
     if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
            $book_id=$row["book_id"];
             $book_name=$row["book_name"];
              $book_price=$row["book_price"];
               $book_desc=$row["book_desc"];
                $authors=$row["authors"];
                $edition=$row["edition"];
                 $book_image=$row["book_image"];
if(isset($_SESSION['user']))
{
  $email=$_SESSION['user'];
  $sql="SELECT user_id FROM user_info WHERE email='$email'";
  $res = $conn->query($sql);
  $user=$res->fetch_assoc();
  $user_id=$user['user_id'];
  $query="SELECT * FROM cart WHERE book_id='$book_id' AND user_id='$user_id'";
  $res = $conn->query($query);
   if(mysqli_num_rows($res)==0){
  $icon='<i class="fas fa-box-open"></i>';
  }
  else{
  $icon='<i class="fas fa-thumbs-up"></i>';

  }
}
                  echo '<div class="product_container m-2" id="'.$book_id.'">
<div class="top" id="'.$book_id.'">
  <img class="rounded mx-auto d-block" src="uploaded_images/'.$book_image.'" width="160" height="200">
</div>
<div class="middle"><p>'.$book_name.'</p></div>
 <div class="bottom">
  <div class="left"><h5>Rs &nbsp'.$book_price.'</h5></div>
     <div class="right" data-toggle="tooltip" title="Add to order box" id="order_button" pid="'.$book_id.'">'.$icon.'</div>
     </div>
</div>';
       }
 }
}

//loading of category products
if(isset($_POST['get_cat_product']))
{
    $cat_id=$_POST['cat_id'];
    $sql="SELECT * FROM book WHERE cat_id='$cat_id'";
    $result=mysqli_query($conn,$sql); 
     if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
            $book_id=$row["book_id"];
             $book_name=$row["book_name"];
              $book_price=$row["book_price"];
               $book_desc=$row["book_desc"];
                $authors=$row["authors"];
                $edition=$row["edition"];
                 $book_image=$row["book_image"];
                 if(isset($_SESSION['user']))
{
  $email=$_SESSION['user'];
  $sql="SELECT user_id FROM user_info WHERE email='$email'";
  $res = $conn->query($sql);
  $user=$res->fetch_assoc();
  $user_id=$user['user_id'];
  $query="SELECT * FROM cart WHERE book_id='$book_id' AND user_id='$user_id'";
  $res = $conn->query($query);
   if(mysqli_num_rows($res)==0){
  $icon='<i class="fas fa-box-open"></i>';
  }
  else{
  $icon='<i class="fas fa-thumbs-up"></i>';

  }
}
  
                  echo '<div class="product_container m-2">
<div class="top" id="'.$book_id.'">
  <img class="rounded mx-auto d-block" src="uploaded_images/'.$book_image.'" width="160" height="200">
</div>
<div class="middle"><p>'.$book_name.'</p></div>
 <div class="bottom">
  <div class="left"><h5>Rs &nbsp'.$book_price.'</h5></div>
     <div class="right" id="order_button" data-toggle="tooltip" title="Add to order box" pid="'.$book_id.'">'.$icon.'</div>
     </div>
</div>';
       }
 }
}
//loading of category products end here

//loading of sub category products
if(isset($_POST['get_sub_cat_product']))
{
    $sub_cat_id=$_POST['sub_cat_id'];
    $cat_id=$_POST['cat_id'];
    $sql="SELECT * FROM book WHERE sub_cat_id='$sub_cat_id' AND cat_id='$cat_id' ";
    $result=mysqli_query($conn,$sql); 
     if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
            $book_id=$row["book_id"];
             $book_name=$row["book_name"];
              $book_price=$row["book_price"];
               $book_desc=$row["book_desc"];
                $authors=$row["authors"];
                $edition=$row["edition"];
                 $book_image=$row["book_image"];
                 if(isset($_SESSION['user']))
{
  $email=$_SESSION['user'];
  $sql="SELECT user_id FROM user_info WHERE email='$email'";
  $res = $conn->query($sql);
  $user=$res->fetch_assoc();
  $user_id=$user['user_id'];
  $query="SELECT * FROM cart WHERE book_id='$book_id' AND user_id='$user_id'";
  $res = $conn->query($query);
   if(mysqli_num_rows($res)==0){
  $icon='<i class="fas fa-box-open"></i>';
  }
  else{
  $icon='<i class="fas fa-thumbs-up"></i>';

  }
}
  
                  echo '<div class="product_container m-2">
<div class="top" id="'.$book_id.'">
  <img class="rounded mx-auto d-block" src="uploaded_images/'.$book_image.'" width="160" height="200">
</div>
<div class="middle"><p>'.$book_name.'</p></div>
 <div class="bottom">
  <div class="left"><h5>Rs &nbsp'.$book_price.'</h5></div>
     <div class="right" id="order_button" data-toggle="tooltip" title="Add to order box" pid="'.$book_id.'">'.$icon.'</div>
     </div>
</div>';
       }
 }
}
//loading of sub category products end here

//loading of product modal Starts here
if(isset($_POST['get_modal']))
{
    $book_id=$_POST['bid'];
    $sql="SELECT * FROM book WHERE book_id='$book_id'";
    $result=mysqli_query($conn,$sql); 
     if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
            $book_id=$row["book_id"];
             $book_name=$row["book_name"];
              $book_price=$row["book_price"];
               $book_desc=$row["book_desc"];
                $authors=$row["authors"];
                $edition=$row["edition"];
                 $book_image=$row["book_image"];
                if(isset($_SESSION['user']))
                    {
                      $email=$_SESSION['user'];
                      $sql="SELECT user_id FROM user_info WHERE email='$email'";
                      $res = $conn->query($sql);
                      $user=$res->fetch_assoc();
                      $user_id=$user['user_id'];
                      $query="SELECT * FROM cart WHERE book_id='$book_id' AND user_id='$user_id'";
                      $res = $conn->query($query);
                       if(mysqli_num_rows($res)==0){
                      $icon='Add to Order Box<i class="fas fa-box-open"></i>';
                      }
                      else{
                      $icon=' Already Added <i class="fas fa-thumbs-up"></i>';

                      }
                    }   
                  echo '<div class="d-flex flex-row ">
  <div class="p-2 shadow m-2" style="height:100%;"><img src="uploaded_images/'.$book_image.'" class="rounded img-fluid" width="300"></div>
  <div class="p-2">
  <h2 class="title">'.$book_name.'</h2>
          <p class="price">Rs '.$book_price.'</p>
          <p class="description">'.$book_desc.'</p><hr>
          <div class="content-set">
            <h5>Author</h5>
            <span>'.$authors.'</span>
          </div>
          <div class="content-set">
            <h5>Edition</h5>
            <span>'.$edition.'</span>
          </div>
          
          <hr>
  <a href="#" class="btn btn-lg btn-outline-success text-uppercase m-1" id="order_button" pid="'.$book_id.'">'.$icon.' </a>
          </div>
        </div>';
       }
 }
}
//loading of product modal  end here
if(isset($_POST["addToBox"]))
{
  if(isset($_SESSION['user']))
{
  $email=$_SESSION['user'];
  $sql="SELECT user_id FROM user_info WHERE email='$email'";
  $result = $conn->query($sql);
  $user=$result->fetch_assoc();
  $user_id=$user['user_id'];
  $bookId=$_POST['bid'];
  $query="SELECT * FROM cart WHERE book_id='$bookId' AND user_id='$user_id'";
  $res = $conn->query($query);
   if(mysqli_num_rows($res)==0){
    $query="SELECT * FROM book WHERE book_id='$bookId' ";
  $res = $conn->query($query);
  while($row=mysqli_fetch_array($res)){
   
                $book_name=$row["book_name"];
              $book_price=$row["book_price"];
              $book_image=$row["book_image"];
   $sql="INSERT INTO cart (id, book_id, user_id, book_name, book_image, quantity, price, ttl_price) VALUES (NULL, '$bookId', '$user_id', '$book_name', '$book_image', '1', '$book_price', '$book_price')";
       if($conn->query($sql))
       {
        echo '<i class="fas fa-thumbs-up"></i>';
       }       
 }
  }
  else{
    echo '<i class="fas fa-thumbs-up"></i>';
  }
}
else{
  echo"error";
}
}
// Item in the cart
if(isset($_POST["cart_item"]))
{
  if(isset($_SESSION['user'])){
  $email=$_SESSION['user'];
  $sql="SELECT user_id FROM user_info WHERE email='$email'";
  $result = $conn->query($sql);
  $user=$result->fetch_assoc();
  $user_id=$user['user_id'];
  $total=0;
  $query="SELECT * FROM cart WHERE user_id='$user_id'";
  $result = $conn->query($query);
  if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
           $id=$row["id"];
           $book_id=$row["book_id"];
            $user_id=$row["user_id"];
             $book_name=$row["book_name"];
              $price=$row["price"];
               $image=$row["book_image"];
                $quantity=$row["quantity"];
                  $total_price=$row["ttl_price"];
                  $price_array=array($total_price);
                  $total_sum=array_sum($price_array);
                  $total=$total+$total_sum;
                  $_SESSION['total']=$total;
          echo'<div class="row px-3 py-2" id="cartbody">

    <div class="col-sm-1 cart_image" ><img src="uploaded_images/'.$image.'" width="50" height="76"></div>
    <div class="col-sm-3 cart_name">'.$book_name.'</div>
    <div class="col-sm-2"> <span class="hidden-text"><b>Price:</b></span>&nbsp<input type="text" name="price" pid="'.$book_id.'" id="price-'.$book_id.'" value="'.$price.'" class="form-control prices" disabled=""></div>
    <div class="col-sm-2"><span class="hidden-text"><b>Quantity:</b></span>&nbsp<input type="number" name="quantity" min="0" pid="'.$book_id.'" id="qty-'.$book_id.'" value="'.$quantity.'" class="form-control qty" ></div>
    <div class="col-sm-2"><span class="hidden-text"><b>Total:</b></span>&nbsp<input type="text" name="total" pid="'.$book_id.'" id="total-'.$book_id.'" class="form-control total" value="'.$total_price.'" disabled=""></div>
    <div class="col-sm-2">
      <div class="btn-group">
        <a class="btn btn-danger remove" data-toggle="tooltip" title="Remove From Box" remove_id="'.$book_id.'" href="#"><i class="fas fa-trash-alt"></i></a>
        <a class="btn btn-primary update" data-toggle="tooltip" title="Update Quantity" update_id="'.$book_id.'" href="#"><i class="fas fa-edit"></i></a>
      </div>
    </div>
  </div>';
        }
       echo'<hr>
  <div class="total_amount pt-4" align="center"><h5><b>Total:</b>&nbsp '.$total.'</h5>
  </div>';
      }
      else{
        echo'<h3 class="my-3" align="center">Your Order Box is Empty.</h3>';
      }
  }
}

//end of cart item
//removing item from cart
if(isset($_POST["remove_item"]))
{
  if(isset($_SESSION['user'])){
  $email=$_SESSION['user'];
  $sql="SELECT user_id FROM user_info WHERE email='$email'";
  $result = $conn->query($sql);
  $user=$result->fetch_assoc();
  $user_id=$user['user_id'];
  $book_id=$_POST['bid'];
  $sql="DELETE FROM cart WHERE book_id='$book_id' AND user_id='$user_id'";
  $result = $conn->query($sql);
}
}
// end of removing item from cart
//updating item price of cart
if(isset($_POST["update_price"]))
{
  if(isset($_SESSION['user'])){
  $email=$_SESSION['user'];
  $sql="SELECT user_id FROM user_info WHERE email='$email'";
  $result = $conn->query($sql);
  $user=$result->fetch_assoc();
  $user_id=$user['user_id'];
  $book_id=$_POST['bid'];
  $total=$_POST['total_price'];
  $qty=$_POST['quantity'];
  $sql="UPDATE cart SET ttl_price='$total', quantity='$qty' WHERE book_id='$book_id' AND user_id='$user_id'";
  $result = $conn->query($sql);
}
}
//cart count
if(isset($_POST["cart_count"]))
{
  if(isset($_SESSION['user'])){
  $email=$_SESSION['user'];
  $sql="SELECT user_id FROM user_info WHERE email='$email'";
  $result = $conn->query($sql);
  $user=$result->fetch_assoc();
  $user_id=$user['user_id'];
  $query="SELECT * FROM cart WHERE user_id='$user_id'";
  $result = $conn->query($query);
  echo mysqli_num_rows($result);
  }
}
?>
