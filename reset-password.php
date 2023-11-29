<?php
include "config.php";
date_default_timezone_set("Asia/Calcutta");
$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$sql = "SELECT * FROM users
        WHERE reset_token_hash = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
    header("refresh:3;url=login.php");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
    header("refresh:3;url=login.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

  $sql2 = "UPDATE users
          SET password = ?,
              reset_token_hash = NULL,
              reset_token_expires_at = NULL
          WHERE vc_id = ?";

  $stmt = $conn->prepare($sql2);

  $stmt->bind_param("ss", $password_hash, $user["vc_id"]);

  $stmt->execute();

  header("location:login.php");

}

$conn->close();

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    
    <section class="vh-100" style="background-color: #253238;">
        <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                  <img src="login.avif"
                  alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
                  
                  <form method="post" name="resetform">
                      
                      <div class="d-flex align-items-center mb-3 pb-1">
                          <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">Forgot Password</span>
                  </div>
                  <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                  
                  <div class="form-outline mb-4">
                      <label class="form-label" for="password">New Password</label>
                      <input type="password" name="password" class="form-control form-control-lg" minlength="8" required/>
                  </div>

                  <div class="form-outline mb-4">
                      <label class="form-label" for="cpassword">Confirm New Password</label>
                      <input type="password" name="cpassword" class="form-control form-control-lg" minlength="8" required/>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" id="submitbtn">Submit</button>
                </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</section>
<script>
  const submitButton = document.getElementById("submitbtn");
  submitButton.addEventListener("click", function (e) {
    e.preventDefault();
    const password = document.getElementsByName("password")[0].value;
    const cpassword = document.getElementsByName("cpassword")[0].value;
    const form = document.getElementsByName("resetform")[0];
    if (password.length > 6) {
      if (password=== cpassword) {  
        form.submit();
      } else {
        alert("Password does not match");
      }
    } else {
      alert("Password should be at least 6 characters long");
    }
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>