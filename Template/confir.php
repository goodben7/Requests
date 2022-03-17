<?php
session_start();  

$host = "http://localhost:8888/";

if (isset($_SESSION['userId']))
{
  $ownerId = $_SESSION['userId'];
  $userIdBeneficiary = $_SESSION['userIdBeneficiary'];
  $amountSent =  $_SESSION['amountSent'];
  $amountReceived = $_SESSION['amountReceived'];
  $numAccountBeneficiary = $_SESSION['numAccount'];
  $currencyOwner = $_SESSION['currencyOwner'];
  $currencyBeneficiary = $_SESSION['currencyBeneficiary']; 
  $taux = $_SESSION['taux'];
  $label = $_SESSION['label'];
?>
<!DOCTYPE html>
<html>

<head>
  <title>Confirmation</title> 
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/mainStyle.css">
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



</div>
<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card my-5">
        <?php if (isset($_GET['err'])){?>
        <span class="badge bg-danger"><?php echo $_GET['err']; ?></span>
        <?php } ?>
        <form method="" action="/controller/controllerConfir.php" class="card-body cardbody-color p-lg-5">
          <div class="text-center">
            <img src="images/2.png" class="img-fluid profile-image-pic img-thumbnail" width="100%" alt="logo">
          </div> <br> <br>
          <input type="hidden" name="ownerId" value="<?php echo $ownerId; ?>">
          <input type="hidden" name="userIdBeneficiary" value="<?php echo $userIdBeneficiary; ?>">
          <input type="hidden" name="amountSent" value="<?php echo $amountSent; ?>">
          <input type="hidden" name="amountReceived" value="<?php echo $amountReceived; ?>">
          <input type="hidden" name="currency" value="<?php echo $currencyOwner; ?>">
          <input type="hidden" name="taux" value="<?php echo $taux; ?>">
          <input type="hidden" name="label" value="<?php echo $label; ?>">
          <div class="mb-3">
            <div class="card">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                DEVISE : <?php echo $currencyOwner; ?>/<?php echo $currencyBeneficiary; ?></li>
                <li class="list-group-item">1
                <?php echo $currencyOwner;?> = <?php echo $taux." ".$currencyBeneficiary; ?></li>
                <li class="list-group-item">MONTANT ENVOYE : 
                <?php echo $amountSent." ". $currencyOwner; ?></li>
                <li class="list-group-item">MONTANT RECU : 
                <?php echo $amountReceived." ".$currencyBeneficiary; ?></li>
                <li class="list-group-item">NUMERO COMPTE : 
                <?php echo $numAccountBeneficiary; ?></li>
                <li class="list-group-item">LABEL : <?php echo $label; ?></li>
              </ul>

              <div class="card-footer">
                <button type="submit" class="btn btn-secondary">Confirmer</button>
              </div>
            </div>
          </div>
         </form>
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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