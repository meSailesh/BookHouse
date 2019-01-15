<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "brihaspati_db");
$request = mysqli_real_escape_string($connect, $_POST["query"]);
$query = "
 SELECT * FROM book WHERE book_name LIKE '%".$request."%'
";

$result = mysqli_query($connect, $query);

$data = array();

if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
  $data[] = $row["book_name"];
 }
 echo json_encode($data);
}

?>
