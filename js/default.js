$(document).ready(function(){
  initGoToTop();
function initGoToTop() {
  var back_to_top = $('.go-top');
  $(window).scroll(function() {
    ($(this).scrollTop() > 200) ? back_to_top.addClass('go-top-is-visible') : back_to_top.removeClass('go-top-is-visible go-top-fade-out');
  });

back_to_top.on('click', function (event) {
    event.preventDefault();
    $('body,html').animate({
      scrollTop: 0
    }, 700
                               );
  });
}
//go to top ends here
 $('[data-toggle="tooltip"]').tooltip(); 
 if(!localStorage.getItem("done")){
  setTimeout(function(){$('#loginModal').modal('show');},1400);
 }
 localStorage.setItem("done",true);
 cart_product();
 load_profile();
 load_categories();
 load_product();
 $('body').on("click",".cat_product", function(event){
  event.preventDefault();
  var cid=$(this).attr('id');
  var name=$(this).attr('name');
    $.ajax({
      url: "action.php",
      method: "POST",
      data:{get_cat_product:1,
                  cat_id:cid
     },
      success:function(data){
        $("#products").html(data);
        $(".heading").html(name);
      }
    });
 });
   $('body').on("click",".sub_cat_product", function(event){
 event.preventDefault();
  var sid=$(this).attr('id');
  var cid=$(this).attr('pid');
   var name=$(this).attr('name');
     $.ajax({
      url: "action.php",
      method: "POST",
      data:{get_sub_cat_product:1,
                  sub_cat_id:sid,
                  cat_id:cid
     },
      success:function(data){
        $("#products").html(data);
         $(".heading").html(name);
      }
    });
 });
     $('body').on("click",".allbooks", function(event){
     event.preventDefault();
     load_product();
});
  function load_categories(){
    $.ajax({
      url:"action.php",
      method:"POST",
      data:{get_category:1},
      success:function(data){
        $("#categories").html(data);
      }
    });
  }
  function load_profile(){
    $.ajax({
      url:"action.php",
      method:"POST",
      data:{get_profile:1},
      success:function(data){
        $("#profile").html(data);
      }
    });
  }
  function load_product(){
    $.ajax({
      url: "action.php",
      method: "POST",
      data:{get_product:1},
      success:function(data){
        $("#products").html(data);
         $(".heading").html('All Books');

      }
    });
  }
     $('body').on("click",".top", function(event){
      var book_id=$(this).attr('id');
   $.ajax({
      url: "action.php",
      method: "POST",
      data:{get_modal:1,
        bid:book_id},
      success:function(data){
        $(".modal-body").html(data);
        $('#myModal').modal('show'); 
      }
    });
 });
      $('body').on("click",".remove",function(event){
        event.preventDefault();
        var book_id=$(this).attr('remove_id');
        $.ajax({
        url: "action.php",
        method: "POST",
        data:{remove_item:1,bid:book_id},
        success:function(data){
           cart_product();
        }
        });
      });
     
         $('body').on("click",".update",function(event){
        event.preventDefault();
        var book_id=$(this).attr('update_id');
        var qty=$('#qty-'+book_id).val();
         var price=$('#price-'+book_id).val();
         if( qty > 0){
         var total=qty*price;
  
        $.ajax({
        url: "action.php",
        method: "POST",
        data:{update_price:1,bid:book_id,total_price:total,quantity:qty},
        success:function(data){
           cart_product();
        }
        });
             }
                });
      function cart_product(){
    $.ajax({
      url: "action.php",
      method: "POST",
      data:{cart_item:1},
      success:function(data){
        $("#cart_item").html(data);
      }
    });
    cart_count();
  }
   function cart_count(){
    $.ajax({
      url: "action.php",
      method: "POST",
      data:{cart_count:1},
      success:function(data){
        $(".badge").html(data);
      }
    });
  }

     $('body').on('click','#order_button',function(event){
      var book_id=$(this).attr('pid');
      $.ajax({
        url: "action.php",
        method:"POST",
        data:{addToBox:1,
          bid:book_id},
          success:function(data){
            if(data!="error"){
               $('[pid='+book_id+']').html(data);
                cart_count();
            }
            
            else{

              var msg=' Sorry! You need to be logged in to add books to the box.Please '+
    '&nbsp <a href="login.php">Login</a>&nbsp here.</div>';
                 $("#error_msg").html(msg);
                 $('#errorModal').modal('show')
                  
            }
          }
      });
     });
       $('#book').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"fetch.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
   })
  }
 });
       function fixDiv() {
    var $cache = $('#getFixed');
    if ($(window).scrollTop() > 100)
      $cache.css({
        'position': 'fixed',
        'top': '10px'
      });
    else
      $cache.css({
        'position': 'relative',
        'top': 'auto'
      });
  }
  $(window).scroll(fixDiv);
  fixDiv();
 $('.submenu').hide();
 $('.arrow').html('<i class="fas fa-angle-down float-right pt-1"></i>');
    $("li:has(ul)").click(function() {
          $("ul", this).toggle('slow');
         $(".arrow i", this).toggleClass("fas fa-angle-down fas fa-angle-up");

    });

})
  function load_subcategory(id){
    $.ajax({
      url:"action.php",
      method:"POST",
      data:{get_subcategory:1,
            cat_id:id
          },
      success:function(data){
        if(data!="")
        {
          $("#link"+id+">#submenu").html(data);
        }
      }
    });
  }
  //date and time
