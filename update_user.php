<!-- PHP Code Start -->
<?php
/*-- Header Start --*/
    include("includes/header.php");
/*-- Header Start --*/

/*-- User Update Process --*/
    if(isset($_GET['update']) && $_GET['update'] != NULL){
    /*-- Getting user id to update --*/
        $updateId = $_GET['update'];

    /*-- Getting file data as array --*/
        $data = file($filename); 

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])){
        /*-- Set new data to specific array index --*/
            $data[$updateId] = "{$_POST['role']},{$_POST['firstName']},{$_POST['lastName']},{$_POST['userName']},{$_POST['mailAddress']},{$_POST['userPassword']}";
            
        /*-- Inserting updated new array to the file --*/
            $result = file_put_contents($filename, $data);
            if($result !== false){
                echo "<script>alert('User Role Updated Successfuly!')</script>";
                echo "<script>window.location='admin_home.php'</script>";
            } else{
                echo "<script>alert('Something wend wrong!')</script>";
            }
        }
    } else{
        if($_SESSION['userRole'] == "User"){
            echo"<script>window.location='user_home.php'</script>";
        } else{
            echo"<script>window.location='admin_home.php'</script>";
        }
    }

    /*-- User Access Control Process --*/
      if($_SESSION['userRole'] == "User"){
        echo"<script>window.location='user_home.php'</script>";
      }
?>
<!-- PHP Code End -->

<!-- Home Content Start -->
    <div class="container-fluid content-body">
      <div class="row d-flex justify-content-center min-vh-100 m-1">
        <div class="col-12 p-2">
        <!-- Card Start -->
          <div class="card rounded overflow-hidden">
              <div class="card-header text-white fw-bold d-flex">
              <!-- Card Title Start -->
                  <h5 class="card-title p-2 me-auto mb-0 text-uppercase">Update User</h5>
              <!-- Card Title End -->
              </div>

              <div class="card-body p-3">
                  <!-- Form Start -->
                  <form action="" method="POST">
                    <div class="row justify-content-center fs-5">
                    <?php
                    if(isset($_GET['update']) && $_GET['update'] != NULL){
                      for($i = 0; $i < count($data); $i++){
                        if($i == $updateId){
                            $singleUserData = explode(",", $data[$i]);
                    ?>
                        <div class="col-12 mb-2">
                            <label for="firstName">First Name</label>
                            <input type="text" readonly name="firstName" value="<?php echo $singleUserData[1]; ?>" class="form-control fs-5">
                        </div>
                        
                        <div class="col-12 mb-2">
                            <label for="lastName">Last Name</label>
                            <input type="text" readonly name="lastName" value="<?php echo $singleUserData[2]; ?>" class="form-control fs-5">
                        </div>

                        <div class="col-12 mb-2">
                            <label for="userName">Username</label>
                            <input type="text" readonly name="userName" value="<?php echo $singleUserData[3]; ?>" class="form-control fs-5">
                        </div>

                        <div class="col-12 mb-2">
                            <label for="mailAddress">Email</label>
                            <input type="text" readonly name="mailAddress" value="<?php echo $singleUserData[4]; ?>" class="form-control fs-5">
                        </div>

                        <div class="col-12 mb-2">
                          <label for="role">Role</label>
                          <select name="role" class="form-select fs-5">
                            <option value="Admin" <?php if($singleUserData[0] == "Admin"){ echo "selected"; } ?> >Admin</option>
                            <option value="User" <?php if($singleUserData[0] == "User"){ echo "selected"; } ?> >User</option>
                          </select>
                        </div>

                        <input type="hidden" name="userPassword" value="<?php echo $singleUserData[5]; ?>">
                        
                        <div class="col-12 mt-5">
                            <input class="btn btn-primary shadow-none text-white w-100 fs-5" type="submit" name="update" value="Update">
                        </div>
                    <?php } } } ?>
                    </div>
                </form>
            <!-- Form End -->
              </div>
          </div>
        <!-- Card End -->
        </div>
      </div>
    </div>
<!-- Home Content End -->

  
<!-- Footer Start -->
<?php
  include("includes/footer.php");
?>
<!-- Footer End -->