<?php 
$pdo=new PDO('mysql:host=localhost;dbname=binarysec', 'root', '');
$message="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    @$username=$_POST["Username"];
    @$email=$_POST["email"];
    @$password=$_POST["password"];
    @$conf_password=$_POST["Conf_password"];
    if ($password !==$conf_password){
        $message="mot de passe non identique ";
    }
    else{
      $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $stmt=$pdo->prepare("INSERT INTO Users(Username,email,password) VALUE(?,?,?)");
    $stmt->execute([$username, $email, $password_hash,]);
    $message="enregistrement efferctué";
    header("location: login.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="style.css">
</head>
<s>
  <div class="wrapper">
    <form  method="post">
      <h2>Register</h2>
      <div class="input-field">
        <input type="text" name="Username" required>
        <label>Username</label>
      </div>
        <div class="input-field">
        <input type="text"   name="email"required>
        <label>Enter your email*</label>
      </div>
      <div class="input-field">
        <input type="password"    name="password" required>
        <label>Enter your password*</label>
      </div>
      <div class="input-field">
        <input type="password"   name="Conf_password" required>
        <label>confirme your password*</label>
      </div>
      <button type="submit">Register</button>
      <div class="register">
        <p>Don't have an account? <a href="Login.php">Login</a></p>
      </div>
      <?php if (!empty($message)): ?>
    <div class="alert"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>
    </form>
  </div>
</body>
</html>