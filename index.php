<h2 style="text-align: right;color: green;">
  <?php
    $conn = mysqli_connect('localhost','root','','info');
    if(isset($_POST['btn'])){
      $cusname = $_POST['cusname'];
      $cusphn = $_POST['cusphn'];
      $mediname = $_POST['mediname'];
      $price = $_POST['price'];
     
      if(!empty($cusname) && !empty($cusphn) && !empty($mediname) && ($price)){
        $query = "INSERT INTO customer(cusname,cusphn,mediname,price) VALUE('$cusname',$cusphn,'$mediname',$price)";
        $createquery = mysqli_query($conn, $query);
        if($createquery){
          echo "Your information is submitted";
        }
      }
      else{
        echo "Please enter information";
      }
      
    }

  ?>
</h2>
<h2 style="text-align: left; color: red;">
  <?php
    if (isset($_GET['delete'])){
      $cusid = $_GET['delete'];
      $query = "DELETE FROM customer WHERE id={$cusid}";
      $deletequery= mysqli_query($conn, $query);
      if ($deletequery){
        echo "Information deleted";
      }
    }

?>
</h1>
<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>CRUD</title>
  </head>
  <body style="background-color: gray;">
    <div style="text-align: center; color: blue;font-size: 80px;">AH Veterinary and Medicine<br><h1>Customer Database</h1></div>

    <div class="container shadow m-5 p-3">
      <form action="" method="post" class="d-flex justify-content-around">
        <input class="form-control" type="text" name="cusname" placeholder="Enter Customer Name">

        <input class="form-control" type="number" name="cusphn" placeholder="Enter Customer mobile Number">

        <input class="form-control" type="text" name="mediname" placeholder="Enter Medicine Name">

        <input class="form-control" type="number" name="price" placeholder="Enter Total Price">

        <input type="submit" value="Submit"  name="btn" class="btn btn-success">
      </form>
    </div>

    <div class="container shadow m-5 p-3">
      <form action="" method="post" class="d-flex justify-content-around">
        <?php 
          if(isset($_GET['update'])){
            $cusid = $_GET['update'];
            $query = "SELECT * FROM customer WHERE id={$cusid}";
            $getdata = mysqli_query($conn, $query);
            while($rx=mysqli_fetch_assoc($getdata)){
              $cusid = $rx['id'];
                $cusname = $rx['cusname'];
                $cusphn = $rx['cusphn'];
                $mediname = $rx['mediname'];
                $price = $rx['price'];
     
        ?>

          <input class="form-control" type="text" name="cusname" value="<?php echo $cusname ?>">

        <input class="form-control" type="number" name="cusphn" value="<?php echo $cusphn ?>">

        <input class="form-control" type="text" name="mediname" value="<?php echo $mediname ?>">

        <input class="form-control" type="number" name="price" value="<?php echo $price ?>">

        <input type="submit" value="Update"  name="update_btn" class="btn btn-primary">

      <?php }} ?>

<h4 style="padding-left: 5px;color: blue;">
      <?php

        if (isset($_POST['update_btn'])) {
          $cusname = $_POST['cusname'];
          $cusphn = $_POST['cusphn'];
          $mediname = $_POST['mediname'];
          $price = $_POST['price'];


          if(!empty($cusname) && !empty($cusphn) && !empty($mediname) && ($price)){
             $query = "UPDATE customer SET cusname='$cusname', cusphn=$cusphn, mediname='$mediname', price=$price WHERE id=$cusid";
          $updatequery = mysqli_query($conn,$query);
          if ($updatequery) {
            echo "Information updated";
          }
          
          }
            else{
              echo "Please enter information";
            }
          
        }

      ?>
</h4>
    
     
      </form>
    </div>

    <div class="container">
        <table class="table table-bordered">
          <tr style="text-align: center; color: blue;">
            <th>S/N</th>
            <th>Customer Name</th>
            <th>Customer Mobile Number</th>
            <th>Medicine Name</th>
            <th>Total Price</th>
            <th></th>
            <th></th>
          </tr>

            <?php
            $query = "SELECT * FROM customer";
            $readquery = mysqli_query($conn, $query);
            if($readquery->num_rows >0){
              while($rd=mysqli_fetch_assoc($readquery)) {
                $cusid = $rd['id'];
                $cusname = $rd['cusname'];
                $cusphn = $rd['cusphn'];
                $mediname = $rd['mediname'];
                $price = $rd['price'];

             
          ?>  
            <tr style="text-align: center;">
            <td><?php echo $cusid ?></td>
            <td><?php echo $cusname ?></td>
            <td><?php echo $cusphn ?></td>
            <td><?php echo $mediname ?></td>
            <td><?php echo $price ?></td>
            <td><a href="index.php?update=<?php echo $cusid ?> " class="btn btn-info">Update</a></td>
            <td><a href="index.php?delete=<?php echo $cusid ?> " class="btn btn-danger">Delete</a></td>
            
            </tr>  
              <?php }}
                else{
                  echo "<h2>Database is empty</h2>";
                }
               ?>

        </table>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

  </body>
</html>



