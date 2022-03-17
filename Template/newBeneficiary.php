<?php
session_start();  

$host = "http://localhost:8888/";

if (isset($_SESSION['userId'])) 
{
  $ownerId =$_SESSION['userId'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Beneficiary</title>
  <link rel="stylesheet" type="text/css" href="css\style.css">
  <link rel="stylesheet" type="text/css" href="css\mainStyle.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
  rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
  crossorigin="anonymous">
</head>

<body>
  <div class="wrapper">
    <div class="sidebar">
      <h2>Goodben</h2>
      <ul>
        <li><a href="viewTransfert.php">Transferts</a></li>
        <li><a href="viewBeneficiary.php">Bénéficiaires</a></li>
      </ul> 
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <div class="card my-5">
            <?php if (isset($_GET['err'])){?>
            <span class="badge bg-danger"><?php echo $_GET['err']; ?></span>
            <?php } ?>
            <form  method="post" action="/controller/controlleraddBeneficiary.php" 
            class="card-body cardbody-color p-lg-5">
              <div class="text-center">
                <img src="images/2.png" class="img-fluid profile-image-pic img-thumbnail" width="100%" alt="logo">
              </div> <br> <br>
              <div class="mb-3">
                <input name="numAccount" pattern="^[0-9]{10}$" type="text" 
                class="form-control" id="numAccount" 
                placeholder="Numero Compte" required>
              </div>

              <div class="mb-3">
                <input name="label" pattern="^[a-z-A-Z ]{1,40}$" type="text" class="form-control" 
                id="label" 
                placeholder="Label" required>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-secondary">Enregistrer</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<?php
}   
else  
{ 
  $message = "USER NOT FOUND";
  header('Location:' .$host. 'template/login.php?err=' .$message);
  exit();
}
?> 