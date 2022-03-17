<?php
  include __DIR__ . '/../public/index.php';

  $countries = getCountries(); 
  if ($countries == false) 
  {
    $message = "Application Error";
    header('Location:' .$host. 'template/login.php?err=' .$message);
    exit();
  }

  $allemagne = $countries[0]->countryName;
  
  $maroc = $countries[1]->countryName;
    
  $japon = $countries[2]->countryName;
  
  $mexique = $countries[3]->countryName;

  $rdc = $countries[4]->countryName;
?>
<!DOCTYPE html>
<html>

<head>
  <title>Inscription</title>
  <link rel="stylesheet" type="text/css" href="css/mainStyle.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
  rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
  crossorigin="anonymous">
</head>

<body>



<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card my-5">
        <?php if (isset($_GET['err'])){?>
        <span class="badge bg-danger"><?php echo $_GET['err']; ?></span>
        <?php } ?>
        <form method="post" action="/controller/controllerSingin.php" 
          class="card-body cardbody-color p-lg-5">
          <div class="text-center">
            <img src="images/2.png" class="img-fluid profile-image-pic img-thumbnail" width="100%" alt="logo">
          </div> <br> <br>
          <div class="mb-3">
            <input name="name" pattern="^[a-z-A-Z ]{1,40}$"  type="text" 
            class="form-control" id="Name" 
            aria-describedby="emailHelp" placeholder="Nom" required="required">
          </div>

          <div class="mb-3">
          <input name="middleName" pattern="^[a-z-A-Z ]{1,40}$" 
          pattern="^[A-Z][a-z- ]{1,40}$" type="text" class="form-control" id="middleName" 
          placeholder="Post-Nom" required="required">
          </div>

          <div class="mb-3">
            <input name="firstName" pattern="^[a-z-A-Z ]{1,40}$"
            type="text" class="form-control" id="firstName" 
            placeholder="Prenom" required="required">
          </div>

          <div class="mb-3">
            <input name="phoneNumber" pattern="^[0-9]{10}$"  maxlength="10" type="text" 
            class="form-control" id="phoneNumber" 
            placeholder="Numero telephone" required="required">
          </div>

          <div class="mb-3">
            <input name="password" type="password" class="form-control" id="password" 
            placeholder="Mot de passe" required="required">
          </div>

          <div class="mb-3">
            <select name="role" class="form-select" required>
              <option value="">Selectionner le role</option>
              <option value="Client">Client</option>
            </select>
          </div>

          <div class="mb-3">
            <select name="pays" class="form-select" required>
              <option value="">Selectionner le pays</option>
              <option value="<?php echo $allemagne; ?>"><?php echo $allemagne; ?></option>
              <option value="<?php echo  $maroc ?>"><?php echo  $maroc ?></option>
              <option value="<?php echo  $japon ?>"><?php echo $japon; ?></option>
              <option value="<?php echo  $mexique ?>"><?php echo $mexique; ?></option>
              <option value="<?php echo  $rdc ?>"><?php echo $rdc; ?></option>
            </select>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-secondary">Inscription</button>
          </div>
          <div  class="form-text text-center mb-5 text-dark">you have an account? 
            <a href="login.php" class="text-dark fw-bold">Login</a>
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