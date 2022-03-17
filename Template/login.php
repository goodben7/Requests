<!DOCTYPE html>
<html> 

<head>
  <title>Connexion</title>
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
        <?php if (isset($_GET['conf'])){?>
        <span class="badge rounded-pill bg-primary"><?php echo $_GET['conf']; ?></span>
        <?php } ?>
        <form method="post" action="/controller/controllerLogin.php" class="card-body cardbody-color p-lg-5">
          <div class="text-center">
            <img src="images/2.png" class="img-fluid profile-image-pic img-thumbnail" width="100%" alt="logo">
          </div> <br> <br>
          <div class="mb-3">
            <input name="phoneNumber" pattern="^[0-9]{10}$"  maxlength="10"  type="text" class="form-control" id="phoneNumber" 
           	placeholder="Numero Telephone" required>
          </div>
          <div class="mb-3">
            <input name="password" type="password" class="form-control" id="password" placeholder="Mot de passe" required>
          </div>
          <div class="text-center">
          	<button type="submit" class="btn btn-secondary">Connexion</button>
          </div>
         </form>
         <div class="card-body cardbody-color p-lg-5">
          <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not
              Registered? <a href="singin.php" class="text-dark fw-bold"> Create an
              Account</a>
          </div>
          </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>
</body>
</html>