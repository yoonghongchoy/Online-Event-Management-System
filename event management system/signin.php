<?php include('server.php') ?>
<!DOCTYPE html>
<html>
  <head> 
    <meta charset = "utf-8">
    <title>Web App Assignment</title>
  </head>
  
<body>
  <div>
    <form method="post" action="signin.php">
      <?php include('errors.php'); ?>
      <img src = "Pic\smallLogo.png" alt = "MMU logo" />
      <p>IC:
      <input type = "text" name = "ic"></p>

      <p>Email:
      <input type = "email" name = "email"></p>

      <input type = "submit" value = "Sign In" name = "sign_in">
      <input type = "reset" value = "Clear" >
    </form>
  </div>
</body>
</html>