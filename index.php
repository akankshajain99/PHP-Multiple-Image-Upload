<?php 
/* Created by E-siksha @ www.e-siksha.in */
// Run the connection here   

$dbc = mysqli_connect("localhost","root","", "demo") or die ("could not connect to mysql");  
// Now you can use the variable $dbc to connect in your queries 

if (isset($_POST['upload'])) {
	$image = $_FILES['image']['name'];
    $img_type=$_FILES['image']['type'];
	$tmp_name = $_FILES['image']['tmp_name'];
	foreach ($image as $key => $value) {
		if (!empty($image)) {
			$types = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif');
			if(in_array($img_type[$key], $types)){
				         
				$sql = "INSERT into multiple_images (image) values ('$value')";
		        mysqli_query($dbc, $sql);
		        echo '<script>alert("Your Image Added Successfully!!")</script>';
		        move_uploaded_file($tmp_name[$key], "images/$value");
		        echo("<script>location.href = 'index.php';</script>");
				           
		    		        
			}else{
				echo '<script>alert("Please upload a image in valid formate!!")</script>';
		        echo("<script>location.href = 'index.php';</script>");
			}  
		}else{
			echo '<script>alert("Please upload an image.")</script>';
			echo("<script>location.href = 'index.php';</script>");
		}
	}
	
	
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Multiple Image Upload Using PHP</title>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<style type="text/css">
	
</style>
</head>
<body>
<!-- As a heading -->
<nav class="navbar navbar-light bg-primary">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1" style="color:white;">Multiple Image Upload Using PHP</span>
  </div>
</nav>
<section style="padding-top: 20px;">
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				
			</div>
			<div class="col-md-10">
				<form method="post" action="index.php" enctype="multipart/form-data">
					<div class="mb-3">
				  
				  	  <input type="file" name="image[]" class="form-control" multiple>
					</div>
					<div class="mb-3">
					  <button type="submit" name="upload" class="btn btn-success">Upload Images</button>
					</div>
				</form>
				
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container">
		<div class="row">
			<?php 

				$select = "SELECT * from multiple_images";
				$run = mysqli_query($dbc, $select);
				while($row=mysqli_fetch_array($run)){
					
						
					
					$row_image = $row['image'];

			 ?>
			<div class="col-md-4">
				<img src="images/<?=$row_image?>" class="img-thumbnail" alt="Multiple Images Upload Using PHP">
			</div>
			<?php 

				} ?>
		</div>
	</div>

</section>


 <!-- FOOTER -->
  <footer class="container" style="padding-top:20px;">
    <a href="http://e-siksha.in/"><p style="text-align:center; font-weight:bolder;">E-Siksha</p></a>
  </footer>
</body>
</html>