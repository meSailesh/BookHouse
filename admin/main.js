$(document).ready(function(){
	load_dashboard();
	
	  function load_users(){
    $.ajax({
      url:"action.php",
      method:"POST",
      data:{get_users:1},                   
      success:function(data){
      $(".reg_usr").html(data);
      }
    });
  };
   function load_book_count(){
    $.ajax({
      url:"action.php",
      method:"POST",
      data:{get_books_count:1},                   
      success:function(data){
      $(".books_count").html(data);
      }
    });
  };
  function load_sales(){
    $.ajax({
      url:"action.php",
      method:"POST",
      data:{get_sales:1},                   
      success:function(data){
      $(".sales_count").html(data);
      }
    });
  };
   function load_dashboard(){
    $.ajax({
      url:"action.php",
      method:"POST",
      data:{dashboard:1},                   
      success:function(data){
      	load_users();
		load_book_count();
		load_sales();
      $(".content").html(data);
      }
    });
  };
      $('body').on("click","#allBooks", function(event){
     event.preventDefault();
     load_dashboard();
});
     $('body').on("click","#add_categories", function(event){
     event.preventDefault();
     $.ajax({
      url:"action.php",
      method:"POST",
      data:{add_categories:1},                   
      success:function(data){
      $(".content").html(data);
      }
    });
     
});
     $('body').on("click","#update_cat", function(event){
     event.preventDefault();
     $.ajax({
      url:"action.php",
      method:"POST",
      data:{update_categories:1},                   
      success:function(data){
      $(".content").html(data);
      }
    });
     
});
        $('body').on("click","#add_books", function(event){
     event.preventDefault();
     $.ajax({
      url:"action.php",
      method:"POST",
      data:{add_books:1},                   
      success:function(data){
      $(".content").html(data);
      }
    });
     
});
        $('body').on("click","#add_cat_btn", function(event){
     event.preventDefault();
     var name=$("#cat_name").val();
      $.ajax({
      url:"action.php",
      method:"POST",
      data:{add_cat:1,cat_name:name},                   
      success:function(data){
     $(".msg").html(data);
      }
    });
     
 });
        $('body').on("click","#update_cat_btn", function(event){
     event.preventDefault();
     var name=$("#cat_name").val();
     var ids=$('#select_cat').val();
      $.ajax({
      url:"action.php",
      method:"POST",
      data:{update_cat:1,cat_name:name,old_cat:ids},                   
      success:function(data){
     $(".msg").html(data);
      }
    });
     
 });
      $('body').on('change','#file',function(){
        var property=document.getElementById('file').files[0];
        var img_name=property.name;
        var img_extn=img_name.split('.').pop().toLowerCase();
        if(jQuery.inArray(img_extn,['jpg','png','jpeg','gif'])==-1)
        {
          alert("Invalid Image File");
        }
        var img_size=property.size;
        if(img_size>2000000)
        {
          alert("To big image size");
        }
        else{
          var form_data=new FormData();
          form_data.append("file",property);
          response=new Array();
          $.ajax({
            url:"upload.php",
            method:"POST",
            data:form_data,
            contentType:false,
            cache:false,
            processData:false,
            beforeSend:function(){
             $('#uploaded_image').html("<label class='text-success'>Image Uploading....</label>");
            },
            success:function(data)
            {
              response = JSON.parse(data);
             $('#uploaded_image').html("<img src="+response[1]+" width='100' height='128' class='img-thumbnail'>");
             $('#img_name').html(response[0]);
            }
          })
        }
      });
      $('body').on("change","#select_cat", function(event){
     event.preventDefault();
     var ids=$(this).val();
     $.ajax({
      url:"action.php",
      method:"POST",
      data:{get_subcat:1,cat_id:ids},                   
      success:function(data){
     $("#select_sub_cat").html(data);
      }
    });
     
 });
        $('body').on("click","#add_book", function(event){
     event.preventDefault();
     var name=$("#cat_name").val();
      $.ajax({
      url:"action.php",
      method:"POST",
      data:{add_book:1,book_name:name},                   
      success:function(data){
     $(".msg").html(data);
      }
    });
     
 });
              $('body').on("click","#add_book_btn", function(event){
     event.preventDefault();
     var name=$("#book_name").val();
      var price=$("#book_price").val();
       var desc=$("#book_desc").val();
        var authors=$("#authors").val();
         var edition=$("#edition").val();
          var image=$("#img_name").html();
           var cat=$("#select_cat").val();
            var subcat=$("#select_sub_cat").val();
      $.ajax({
      url:"action.php",
      method:"POST",
      data:{add_book_btn:1,name,price,desc,authors,edition,image,cat,subcat},                   
      success:function(data){
     $(".msg").html(data);
      }
    });
     
 });
});