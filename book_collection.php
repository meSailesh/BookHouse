<?php include('includes/header.inc.php');?>
<div id="errorModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header">
      <h4 class="modal-title">Login Error</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        <p id="error_msg"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div class="container-fluid " id="allbooks">
  <div class="row my-3" id="books" >
  <!--Side bar-->
    <div class="col-sm-3 border border-right-0 " id="categories" >
   
 </div>
 <div class="col-sm-9 "  >
    <h4 class="p-2 heading"></h4>
    <!-- <div class="error_msg">
    </div> -->
    <div class="row" id="products"  >
    </div>
 </div>
 </div>
 <!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Book Overview</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body p-0">
        </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
 </div>
 <?php include('includes/footer.inc.php');?>