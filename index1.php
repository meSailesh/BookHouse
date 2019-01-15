<!DOCTYPE html>
<html>
<head>
	<title></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		cat();
		function cat(){
			$.ajax({
				url: "categories.php",
				method: "POST",
				data: {categories:1},
				success: function(data){
					$("#get_category").html(data);
				}
			})
		}

	})
	function get_submenu(id)
		{
			$.ajax({
				url:"subcategories.php",
				method: "POST",
				data: {get_submenu:1,
						menu_id: id},
						success:function(data){
				if(data!="")
 						{
  						$("#link"+id+">#submenu_div").html(data);
 							}
						}
			})
		}
</script>
</head>
<body>
<div id="get_category">
</div>
</body>
</html>