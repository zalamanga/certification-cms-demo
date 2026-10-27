<?php
require_once __DIR__ . '/config.php';
$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['pass'] ?? '';
    $confirm = $_POST['confirm-pass'] ?? '';
    if ($username === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Username dan email yang valid diperlukan.';
    } elseif ($pass !== $confirm || strlen($pass) < 10 || strlen($pass) > 72) {
        $error = 'Kata sandi 10-72 byte dan konfirmasi yang sama diperlukan.';
    } else {
        $stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = 'Email sudah digunakan.';
        } else {
            $stmt = $conn->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
            $stmt->execute([$username, $email, password_hash($pass, PASSWORD_DEFAULT)]);
            header('Location: login.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/register.css">
</head>

<body>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-pic js-tilt" data-tilt>
          <img src="assets/img/logo.png" alt="IMG">
        </div>

        <form class="login100-form validate-form" method="POST" action="">
          <span class="login100-form-title">
            Create Account
          </span>

          <!-- Pesan error atau sukses -->
          <?php if ($error): ?>
            <p style="color:red; text-align:center;"><?= $error ?></p>
          <?php endif; ?>

          <?php if ($success): ?>
            <p style="color:green; text-align:center;"><?= $success ?></p>
          <?php endif; ?>

          <div class="wrap-input100 validate-input" data-validate="Username is required">
            <input class="input100" type="text" name="username" placeholder="Username" required>
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
            <input class="input100" type="text" name="email" placeholder="Email" required>
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Password is required">
            <input class="input100" type="password" name="pass" placeholder="Password" required>
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Please confirm your password">
            <input class="input100" type="password" name="confirm-pass" placeholder="Confirm Password" required>
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>

          <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit">
              Create Account
            </button>
          </div>

          <div class="text-center p-t-136">
            <a class="txt2" href="login.php">
              Already have an account? Login
              <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
