<div class="container mt-4">



    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Lastname</th>
                    <th>Firstname</th>
                    <th>Middlename</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once "connect.php";
                $sql_profile = "SELECT * FROM tbl_profile";
                $result_profile = mysqli_query($con, $sql_profile);

                if (mysqli_num_rows($result_profile) > 0) {
                    while ($row = mysqli_fetch_array($result_profile)) {
                        echo "<tr>";
                        echo "<td>" . $row['profileID'] . "</td>";
                        echo "<td>" . $row['lastname'] . "</td>";
                        echo "<td>" . $row['firstname'] . "</td>";
                        echo "<td>" . $row['middlename'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>
                            <a href='#' id='" . $row['profileID'] . "' 
                            class='edit-profile btn btn-sm btn-outline-warning mx-1' 
                            data-bs-toggle='modal' data-bs-target='#profile-modal'>Edit</a>

                            <a href='#' id='" . $row['profileID'] . "' 
                            class='delete-profile btn btn-sm btn-outline-danger mx-1' 
                            data-bs-toggle='modal' data-bs-target='#profile-modal-delete'>Delete</a>
                        </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>




<script type="text/javascript">
	//when Edit link is clicked
      $(".edit-profile").click(function(){
        $("#m-title").text("Edit profile");
        $("#b-save").val("Save Changes");
      
        var profileID =  $(this).attr("id");
        //alert (profileID);
        $.ajax({
            type:"POST", 
            url: "fetch-edit-profile.php",   
            data:{profileID:profileID},
            dataType:"JSON",
            success:function(data) {
              $('#profileID').val(data.profileID);
              $('#lastname_e').val(data.lastname);
              $('#firstname_e').val(data.firstname);
              $('#middlename_e').val(data.middlename);
              $('#address_e').val(data.address);
            }

            
          });
      });



	//when Add record is clicked
      $(".add-record").click(function(){
        $("#m-title").text("Register profile");
        $("#b-save").val("Save");
        $("#profile-form")[0].reset();


        $("#b-save").click(function(){
        if ($("#profile-form input").filter(function(){ return this.value.trim() === ""; }).length) {
            alert("Please fill out all fields!");
        } else {
            $("#deletedAlert").text("Profile Successfully Added!").fadeIn(500).delay(1000).fadeOut(500);
        }
    });
});
      




        //when delete icon is clicked
      $(document).ready(function(){
      $(".delete-profile").click(function(){
        var profileID =  $(this).attr("id");
        //alert(profile_ID);
        $("#to-delete").text("Profile ID: "+profileID);

        $(".btn-delete").click(function(){
          $.ajax({
            url:'delete-profile.php',   // backend file: where your codes for saving were written.
            method:'POST',
            data: { profileID:profileID },
            success: function(response){ 
              $.ajax({
                  type:"POST", 
                  url: "fetch-profile.php",   
                  data:{},
                  cache:false,
                  success:function(data) {
                    $("#list-profile").html(data);
                    // $('#profile-modal-delete').modal('hide');
                    
                    $("#deletedAlert").fadeIn(500).delay(5000).fadeOut(500);

                  }
                });
            }
          });
        });
      });
    });

</script>