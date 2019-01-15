<?php include('includes/header.inc.php');
require('includes/mysql.inc.php');
$nameErr=$emailErr=$paswdErr=$phoneErr=$addressErr=$matchErr=$alreadyUsed=$shopName="";
$name=$email=$paswd=$phone=$address=$success="";
$error=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
if(empty($_POST["inputName"])){
    $error=true;
    $nameErr="Name is required";
}
else{
    $name=test_input($_POST["inputName"]);
    if(!preg_match("/^[a-zA-Z ]*$/", $name))
    {
        $error=true;
        $nameErr="Only letters and whitespace are allowed";
    }
}
if(empty($_POST["inputEmail"])){
    $error=true;
    $emailErr="Email is required";
}
else{
    $email=test_input($_POST["inputEmail"]);
    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $error=true;
        $emailErr="Invalid email format";
    }
}
if(empty($_POST["inputPassword"])){
    $error=true;
    $paswdErr="Password is required";
}
else{
    $paswd=test_input($_POST["inputPassword"]);
    if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $paswd))
    {
        $error=true;
        $paswdErr="Password must be 8 characters long with uppercase characters ,lowercase characters,symbols and digits";
    }
}
 if($_POST['inputPassword'] != $_POST['inputVerify']){ 
    $error=true;
$matchErr = "Passwords didnot match"; 
}
if(empty($_POST["inputPhone"])){
    $error=true;
    $phoneErr="Phone number is required";
}
else{
    $phone=test_input($_POST["inputPhone"]);
    if(!preg_match("/^[0-9\-\(\)\/\+\s]*$/", $phone))
    {
        $error=true;
        $phoneErr="Invalid phone number";
    }
}
if(empty($_POST["inputAddress"])){
    $error=true;
    $addressErr="Address is required";
}
else{
    $address=test_input($_POST["inputAddress"]);
    if(!preg_match("/^[a-zA-Z0-9]*$/", $address))
    {
        $error=true;
        $addressErr="Invalid address format";
    }
}
 $shopName=test_input($_POST["inputShopName"]);
    if(!preg_match("/^[a-zA-Z ]*$/", $shopName))
    {
        $error=true;
        $nameErr="Only letters and whitespace are allowed";
    }
if(!$error)
{
    $sql = "SELECT email FROM user_info WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    $alreadyUsed="Email is already used.";
   
}
else{
   $date=date("Y-m-d h:i:s");
    $encryptedPaswd=dec_enc('encrypt',$paswd);
    $stmt = $conn->prepare("INSERT INTO user_info (name,email,password,phone,address,shopName,reg_date,last_login) VALUES (?, ?, ?, ?, ?, ?,?,?)");
    $stmt->bind_param("sssissss", $name, $email, $encryptedPaswd, $phone, $address,$shopName,$date,$date);
    $stmt->execute();
    $stmt->close();
    $conn->close();
   $success='Thanks for joining with us &nbsp'.$name.'. Please <a href="login.php">login</a> to continue.';
}
}
}
function dec_enc($action, $string) {
    $output = false;
 
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';
 
    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
 
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
 
    return $output;
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-md-12">
               <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card border-secondary">
                        <div class="card-header">
                            <h3 class="mb-0 my-2">Sign Up</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                           <?php
                             if(!empty($success))
                             {
                                  echo'<div class="alert alert-success alert-dismissible py-5">
                                  <button type="button" class="close" data-dismiss="alert">&times;</button>'.$success.'</div>';
                              }
                                  ?>
      
                                <div class="form-group">
                                    <label for="inputName">Name</label>
                                    <input type="text" class="form-control" id="inputName" value="<?php echo $name;?>" placeholder="full name" name="inputName" >
                                </div>
                                <?php 
                            if(!empty($nameErr)){
                                 echo'<div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                       '.$nameErr.'
                                      </div>';
                            }
                            ?>
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input type="email" class="form-control" id="inputEmail3" value="<?php echo $email;?>" placeholder="email@gmail.com" name="inputEmail">
                                </div>
                                 <?php 
                            if(!empty($emailErr)){
                                 echo'<div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                       '.$emailErr.'
                                      </div>';
                                  }
                                       if(!empty($alreadyUsed)){
                                 echo'<div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                       '.$alreadyUsed.'
                                      </div>';
                            }
                            ?>
                                <div class="form-group">
                                    <label for="inputPassword">Password</label>
                                    <input type="password" class="form-control" id="inputPassword3"  placeholder="password" name="inputPassword" title="At least 6 characters with letters and numbers" >
                                </div>
                                 <?php 
                            if(!empty($paswdErr)){
                                 echo'<div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                       '.$paswdErr.'
                                      </div>';
                            }
                            ?>
                                <div class="form-group">
                                    <label for="inputVerify3">Verify</label>
                                    <input type="password" class="form-control" id="inputVerify3" name="inputVerify" placeholder="password (again)" >
                                </div>
                                 <?php 
                            if(!empty($matchErr)){
                                 echo'<div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                       '.$matchErr.'
                                      </div>';
                            }
                            ?>
                                <div class="form-group">
                                    <label for="inputPhone">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="inputPhone" value="<?php echo $phone;?>" placeholder="Phone Number">
                                </div>
                                 <?php 
                            if(!empty($phoneErr)){
                                 echo'<div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                       '.$phoneErr.'
                                      </div>';
                            }
                            ?>
                                <div class="form-group">
                                    <label for="inputAddress">Address</label>
                                    <input type="text" class="form-control" id="address" name="inputAddress" value="<?php echo $address;?>" placeholder="Address">
                                </div>
                                   <?php 
                            if(!empty($addressErr)){
                                 echo'<div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                       '.$addressErr.'
                                      </div>';
                            }
                            ?>
                            <div class="form-group">
                                    <label for="inputName">Shop Name</label>
                                    <input type="text" class="form-control" id="inputName" value="<?php echo $name;?>" placeholder="Optional" name="inputShopName" >
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg float-right">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/row-->

        </div>
        <!--/col-->
    </div>
    <!--/row-->
</div>
<!--/container-->
<?php include ('includes/footer.inc.php');?>