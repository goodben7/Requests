<?php
session_start();  

$host = "http://localhost:8888/";

if (isset($_SESSION['userId']))
{
  include __DIR__ . '/../public/index.php';

  $ownerId =$_SESSION['userId'];

  $beneficiary= getBeneficiariesByowner($ownerId);
  if ($beneficiary == false) 
  {
    $message = "user NOT FOUND";
    header('Location:' .$host. 'template/login.php?err=' .$message);
    exit();
  }

  $balance = getBalanceByowner($ownerId);
  if ($balance == false) 
  {
    $message = "user NOT FOUND";
    header('Location:' .$host. 'template/login.php?err=' .$message); 
    exit();
  }
  $currency = getCurrencyByowner($ownerId);
  if ($currency == false) 
  {
    $message = "user NOT FOUND";
    header('Location:' .$host. 'template/login.php?err=' .$message);
    exit();
  }
  $account = getAccountByowner($ownerId);
  if ($account == false) 
  {
    $message = "user NOT FOUND";
    header('Location:' .$host. 'template/login.php?err=' .$message);
    exit();
  }

  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
  	<meta charset="UTF-8">
  	<title>Beneficiare</title>
  	<link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="
    stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
  	<script src="https://kit.fontawesome.com/8b7ce8e7a1.js" crossorigin="anonymous"></script>
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
      
      <div class="fixed-bottom"> 
        <a style="margin: 20px;" href="/controller/deconnexion.php" 
        class="btn btn-secondary" role="button">DECONNEXION</a>
      </div>

      <div class="main_content">
        <div class="header">
          <span class="badge bg-secondary">
          <?php echo "NUMERO COMPTE : ".$account->numAccount; ?></span>
          <span style="float: right;" class="badge bg-secondary">
          <?php echo "SOLDE : ". $balance->balance. " " .$currency->currency; ?></span>
        </div>  

        <div class="info">
          LISTE DES BÉNÉFICIAIRES <br>
          <a style="float: left;" href="newBeneficiary.php" class="btn btn-secondary" 
          role="button">Add Beneficiary</a>  
          <a style="float: right;" href="deleteBeneficiary.php" class="btn btn-danger" 
          role="button">Delete Beneficiary</a> <br><br> 
          <table class="table table-bordered">
            <thead>
              <tr class="something">
                <th style="width: 5%;" scope="col">NUMÉRO</th>
                <th scope="col">LABEL</th>
              </tr>
            </thead>  

            <tbody>
              <?php if ($beneficiary != 1) { $i=0;?>
              <?php  foreach($beneficiary as $query) : ?>
              <tr>
                <th scope="row"><?php echo $i+1; ?></th>
                <td><?php echo $beneficiary[$i]->label; ?></td>
              </tr>
              <?php $i++;?>
              <?php endforeach ?>
              <?php }?>
            </tbody>
          </table>
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