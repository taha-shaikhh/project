<?php
session_start();
include 'conn.php';
if($_SESSION["user"] == "admin"){
    if(isset($_POST['name'])){
      $pid = $_POST['pid'];
      $name= $_POST['name'];
      $price= $_POST['price'];
      $desc= $_POST['desc'];
      $image= $_POST['image'];
      $query = $mysqli->prepare("UPDATE `product` SET `name`=?,`price`=?,`image`=?,`description`=? WHERE `pid` = ?");
      $query->bind_param("sssss", $name, $price, $image, $desc, $pid);
      $result0 = $query->execute();
      if($result0){
        header("location:admin.php");
      }else{
        echo "There was some problem";
      }
      $query->close();
    }
    $pid = $_GET['pid'];
    $query = "SELECT * FROM `product` WHERE pid = '$pid'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);  
    $count = mysqli_num_rows($result);
    if ($count == 1) {
      echo "
      <!doctype html>
      <html lang='en'>
        <head>
          <meta charset='utf-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1'>
          <title>Edit Product</title>
          <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD' crossorigin='anonymous'>
        </head>
        <body>
      <div class='container col-sm-6'>
      <h1 class='text-center mb-2 fw-semibold'>Edit Details</h1>
      <form action='' method='post'>
      <div class='container text-center'>
              <div class='row mt-2'>
                    <div class='col-sm-4'>
                      <label for='FormControlInput1' class='form-label '>Product ID</label>
                    </div>
                  <div class='col-sm-8'>
                    <input type='text' class='form-control text-center' readonly value='".$row['pid']."' id='FormControlInput1' name='pid'>
                  </div>
                </div>
        </div>
        
        <div class='container text-center'>
          <div class='row mt-2'>
            <div class='col-sm-4'>
              <label for='FormControlInput2' class='form-label'>Product Name</label>
             </div>
                  <div class='col-sm-8'>
                    <input type='text' class='form-control text-center' value='".$row['name']."' id='FormControlInput2' name='name' >
                  </div>
          </div>
        </div>
        
        <div class='container text-center'>
                <div class='row mt-2'>
                  <div class='col-sm-4'>
                    <label for='FormControlInput3' class='form-label'>Price</label>
                  </div>
                  <div class='col-sm-8'>
                    <input type='text' class='form-control text-center' value='".$row['price']."' id='FormControlInput3' name='price' >
                  </div>
                  </div>
                  </div>
                  <div class='container text-center'>
                    <div class='row mt-2'>
                      <div class='col-sm-4'>
                        <label for='FormControlInput6' class='form-label'>Image</label>
                      </div>
                      <div class='col-sm-8'>
                        <input type='text' class='form-control text-center' value='".$row['image']."' id='FormControlInput6' name='image' >
                      </div>
                    </div>
                  </div>
        
              <div class='container text-center'>
                <div class='row mt-2'>
                  <div class='col-sm-4'>
                    <label for='FormControlInput7' class='form-label '>Description</label>
                  </div>
                  <div class='col-sm-8'>
                    <textarea class='form-control text-center' name='desc' rows='5' >".$row['description']."</textarea>
                  </div>
                </div>
              </div>
            <div class='text-center mt-3'>
                <button type='submit' class='btn btn-success'>Update</button>
                <a class='btn btn-light' href='admin.php'>Cancel</a>
          </div>
        </form>
        </div>
"
    ;
    }else{
      echo "There is no matching item for that Product ID";
    }
    echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js' integrity='sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN' crossorigin='anonymous'></script>
    </body>
  </html>";
    mysqli_close($conn);
}

if(!$_SESSION["user"] == "admin"){
  header('location:db.php');
}
  
  ?>