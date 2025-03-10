<?php
include_once "connect.php";
?>
<!DOCTYPE html>
<html>
	<head>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	</head>
	<body>

<h1 class="text-center py-3 fw-bold">Manage Profile</h1>

		<div class="container justify-content-end mt-3 mb-3" >
				<a class="add-record btn btn-primary" align="right" href="#" data-bs-toggle='modal' data-bs-target='#profile-modal'>+ Add record</a>
    <div id="list-profile"></div>

		</div>

<!-- The Modal-EDIT -->
<div class="modal fade" id="profile-modal">
  <div class="modal-dialog modal-fullscreen-lg-down">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="m-title"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <form id="profile-form" class="form-group" enctype="multipart/form-data">
      <div class="modal-body">
          
      <label for="lastname" class="form-label">Lastname: </label>
        <input type="text" placeholder="Enter lastname" name="lastname" id="lastname_e" required class="form-control" >

      <label for="firstname" class="form-label">Firstname: </label>
        <input type="text" placeholder="Enter firstname" name="firstname" required id="firstname_e" class="form-control" >

      <label for="middlename" class="form-label">Middlename: </label>
        <input type="text" placeholder="Enter middlename" name="middlename" required id="middlename_e" class="form-control" >

      <label for="address" class="form-label">Address: </label>
        <input type="text" placeholder="Enter address" name="address" required id="address_e" class="form-control" > 

      <label for="uname" class="form-label">Username: </label>
        <input type="text" placeholder="Enter username" name="uname" required id="uname_e" class="form-control" >

      <label for="pwsd" class="form-label">Password: </label>
        <input type="text" placeholder="Enter password" name="pwsd" required id="pwsd_e" class="form-control" >

      <label for="rpwsd" class="form-label">Re-type password: </label>
        <input type="text" placeholder="Re-type password" name="rpwsd" required id="rpwsd_e" class="form-control" >

        <input type="hidden" name="profileID" id="profileID" value="0">

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <input type="submit" name="btn-saving" class="btn btn-primary" id="b-save">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
      </form>

    </div>
  </div>
</div>






<!-- The Modal-DELETE -->
<div class="modal" id="profile-modal-delete">
  <div class="modal-dialog modal-fullscreen-lg-down">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Record</h4>
        <button type="button" class="btn-cancel btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div>
          <p>Are you sure you want to delete this record?</p>
          <p class="alert alert-warning" id="to-delete"></p>
          
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <button type="submit" class="btn-delete btn btn-danger" data-bs-dismiss="modal">Yes</button>
        <button type="button" class="btn-cancel btn btn-primary" data-bs-dismiss="modal">No</button>
      </div>

    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $.ajax({
        type:"POST", 
        url: "fetch-profile.php",   
        cache:false,
        success:function(data) {
          $("#list-profile").html(data);

        }
      });
    });

        // when the SAVE CHANGES button is clicked
        $('#profile-form').on("submit", function(event){
          event.preventDefault();

          var profile_form = $("#profile-form").serialize(); 
          // alert(profile_form);
        $.ajax({
          type:'POST',
          url:'saving-profile.php',
          data: profile_form,
          success: function(response){ 
            // $("#deletedAlert").text("Profile Successfully Added!").fadeIn(500).delay(1000).fadeOut(500);
            alert(response);
              $.ajax({
                  type:"POST", 
                  url: "fetch-profile.php",   
                  data:{},
                  cache:false,
                  success:function(data) {
                    $("#list-profile").html(data);

                    // hidding modal when click save
                    var myModal = new bootstrap.Modal(document.getElementById('profile-modal'));
                    myModal.hide();
                    location.reload();
                    // $("#profile-modal").modal("hide");
                  }
                });
                $("#profile-form")[0].reset();
                

          },
        });
      });
</script>


	</body>
</html>
