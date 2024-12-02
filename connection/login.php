<?php 
$message="";
$pdo=new PDO('mysql:host=localhost;dbname=binarysec', 'root', '');
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    @$email=$_POST["email"];
    @$password= $_POST["password"];
    

    $stmt=$pdo->prepare("SELECT *FROM Users WHERE email=?");
    $stmt->execute([$email]);
    $user=$stmt->fetch();


    if ($user && password_verify($password,$user["password"])){
      $_SESSION["user_id"]=$user["id"];
      $_SESSION["Username"]=$user["Username"];
      header("location: acceuil.php");
      exit();
    }else{
      $message="Indentifiant incrorrects";
    }


}

?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Glassmorphism Login Form | CodingNepal</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="wrapper">
    <form  method="post">
      <h2>Login</h2>
      <?php if (!empty($message)): ?>
        <div class="alert"><?php echo htmlspecialchars($message); ?></div>
      <?php endif; ?>
        <div class="input-field">
        <input type="text"  name="email" required>
        <label>Enter your email or Username</label>
      </div>
      <div class="input-field">
        <input type="password" name="password" required>
        <label>Enter your password</label>
      </div>
      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember">
          <p>Remember me</p>
        </label>
        <a href="#">Forgot password?</a>
      </div>
      <button type="submit">Log In</button>
      <div class="register">
        <p>Don't have an account? <a href="Register.php">Register</a></p>
      </div>
    </form>
  </div>
</body>
</html>