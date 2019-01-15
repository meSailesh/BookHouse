<?php include('includes/mysql.inc.php');
$emailErr=$paswdErr="";
$email=$paswd=$decryptedPaswd=$user="";
$error=false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{

if(empty($_POST["inputEmail"])){
    $error=true;
    $emailErr="Email is required";
}
else{
	$email=test_input($_POST["inputEmail"]);
}
//email validation
if(empty($_POST["inputPassword"])){
    $error=true;
    $paswdErr="Password is required";
}
else{
    $paswd=test_input($_POST["inputPassword"]);
    }
//password validation
if(!$error)
{
	$sql = "SELECT email, password FROM user_info WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows ==0) {
    $emailErr="You are not registered yet. Please register to continue.";
	}
	else{
		$user=$result->fetch_assoc();
		$decryptedPaswd=dec_enc('decrypt',$user['password']);
			if($paswd==$decryptedPaswd){
            session_start();
            $sessionemail=$user["email"];
			 $_SESSION["user"]=$sessionemail;
        $date=date("Y-m-d h:i:s");
       $sql="UPDATE user_info SET last_login='$date' WHERE email='$sessionemail'";
       $conn->query($sql);
				if(!empty($_POST["remember"])) {
				setcookie ("user",$email,time()+ (10 * 365 * 24 * 60 * 60));
				setcookie ("password",$paswd,time()+ (10 * 365 * 24 * 60 * 60));
				}
				 else {
					if(isset($_COOKIE["user"])) {
						setcookie ("user","");
					}
					if(isset($_COOKIE["password"])) {
						setcookie ("password","");
						
					}
	       		}
                if($_SESSION["user"]=='mesailesh07@gmail.com')
                {
                    header("location:admin/index.php");
                }
                else
                {
              header("location:index.php");
            }
			}//if password match
			else
				{
					$paswdErr="Password didnot match.";
				}
	}//else not registered
}//error
}//server close
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
<!DOCTYPE html>
<html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Brihaspati Publication</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
     <link rel="stylesheet" type="text/css" href="css/style.css">
     <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans|Fjalla+One|Quicksand|Hind+Madurai|Noticia+Text|PT+Sans|Roboto|Ubuntu|Roboto+Condensed|Open+Sans|Prosto+One|Changa|Ropa+Sans" rel="stylesheet">
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
  <a class="navbar-brand  mx-0" id="logo" href="index.php" style="font-family:'Changa', sans-serif;"><img src="images/bp_logo.png " width="60" > <h2 style="display: inline;" id="titlebar">Brihaspati Publication</h2></a>

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
   <ul class="nav float-right">
   <li class="btn btn-success">
    <a class="text-white" href="login.php" > <i class="fas fa-sign-in-alt"></i> Login</a>
  </li>
  <li class=" btn btn-success">
    <a class="text-white" href="register.php" > <i class="fas fa-user-plus"></i> Sign Up</a>
  </li>
  </ul>
   </div>
  </div>
    </div>
</header>

<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-md-12">
                <div class="row">
                <div class="col-md-6 mx-auto">

                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="mb-0">Sign in</h3>
                        </div>
                        <div class="card-body">
                        <form class="form" role="form" autocomplete="off" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input type="email" class="form-control" id="inputEmail3" value="<?php if(isset($_COOKIE["user"])) { echo $_COOKIE["user"]; } ?>" placeholder="email@gmail.com" name="inputEmail">
                                </div>
                                 <?php 
                            if(!empty($emailErr)){
                                 echo'<div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                       '.$emailErr.'
                                      </div>';
                                  }
                                  ?>
                            <div class="form-group">
                                    <label for="inputPassword">Password</label>
                                    <input type="password" class="form-control" id="inputPassword3" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>"  placeholder="password" name="inputPassword" title="At least 6 characters with letters and numbers" >
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
								<div><input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["user"])) { ?> checked <?php } ?> />
									<label for="remember-me">Remember me</label>
											</div>
											</div>
                             <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg float-right">Login</button>
                                </div>
                            </form>
                        </div>
                        <!--/card-block-->
                    </div>
                    <!-- /form card login -->
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