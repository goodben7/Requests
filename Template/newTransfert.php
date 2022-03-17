<?php
session_start();  

$host = "http://localhost:8888/";

if (isset($_SESSION['userId']))
{

  include __DIR__ . '/../public/index.php';

  $ownerId =$_SESSION['userId'];


  $beneficiary = getBeneficiariesByowner($ownerId);
  if ($beneficiary == false) 
  {
    $message = "user NOT FOUND";
    header('Location:' .$host. 'template/login.php?err=' .$message);
    exit();
  }

  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <title>New Transfert</title>
    <link rel="stylesheet" type="text/css" href="css\style.css">
    <link rel="stylesheet" type="text/css" href="css/mainStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
          <form method="post" action="/controller/controllernewTransfert.php"
          class="card-body cardbody-color p-lg-5">
            <div class="text-center">
              <img src="images/2.png" class="img-fluid profile-image-pic img-thumbnail" 
              width="100%" alt="logo">
            </div> <br> <br>
            <div class="mb-3">
              <select name="label" class="form-select" required>
                <option value="">Sélectionnez un bénéficiaire</option>
                <?php if ($beneficiary != 1) { $i=0;?>
                <?php  foreach($beneficiary as $query) : ?>
                <option value="<?php echo $beneficiary[$i]->userIdBeneficiary; ?>">
                <?php echo $beneficiary[$i]->label; ?></option>
                <?php $i++;?>
                <?php endforeach ?>
                <?php }?>
              </select>
            </div>
            <div class="mb-3">
              <input name="amountSent" pattern="^[0-9]{1,9}$" type="text" class="form-control" 
              id="AmountSent" placeholder="Montant" required>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-secondary">Envoyer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
  crossorigin="anonymous"></script>
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