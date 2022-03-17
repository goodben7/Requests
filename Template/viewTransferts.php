<?php
session_start();  

$host = "http://localhost:8888/";

if (isset($_SESSION['role']))
{
  include __DIR__ . '/../public/index.php';

  $transfert = getTransferts();

  if ($transfert == false) 
  {
    $message = "Application Error";
    header('Location:' .$host. 'template/login.php?err=' .$message);
    exit();
  }

  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
  	<meta charset="UTF-8">
  	<title>Transfert</title>
  	<link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="
    sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
  	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
  </head>

  <body>
    <div class="wrapper">
      <div class="sidebar">
        <h2>Goodben</h2>
      </div>

      <div class="fixed-bottom"> 
        <a style="margin: 20px;" href="/controller/deconnexion.php" 
        class="btn btn-secondary" role="button">DECONNEXION</a>
      </div>

      <div class="main_content">
      <div class="header">
        OPERATEUR
      </div>  

      <div class="info">
          <h2> Historique des transactions </h2>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Device</th>
                <th scope="col">Taux</th>
                <th scope="col">Montant Envoyé</th>
                <th scope="col">Montant Reçu</th>
                <th scope="col">NUMERO COMPTE</th>
                <th scope="col">Référence</th>
                <th scope="col">Label</th>
              </tr>
            </thead>  
            <tbody>
              <?php if ($transfert != 1) { $i=0;?>
              <?php  foreach($transfert as $query) : ?>
              <tr>
                <th scope="row"><?php echo $transfert[$i]->dateTransfert?></th>
                <td><?php echo $transfert[$i]->currency; ?></td>
                <td><?php echo $transfert[$i]->taux; ?></td>
                <td><?php echo $transfert[$i]->amountSent; ?></td>
                <td><?php echo $transfert[$i]->amountReceived; ?></td>
                <td><?php echo $transfert[$i]->numAccount; ?></td>
                <td><?php echo $transfert[$i]->reference; ?></td>
                <td><?php echo $transfert[$i]->label; ?></td>
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