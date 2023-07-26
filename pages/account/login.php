<?php
@include '../../config/config.php';
$error = array(); // Initialize an empty array to store errors.
session_start();
if (isset($_POST['submit'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, md5($_POST['password']));
  $user_type = 'user';
  $select = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' && password = '$password' && user_type = '$user_type'") or die('Kết nối không thành công');
  if (mysqli_num_rows($select) > 0) {
    $row = mysqli_fetch_assoc($select);
    $_SESSION['user_id'] = $row['id'];
    header('Location: /product/index.php');
  } else {
    $error[] = 'Email và mật khẩu chưa đúng!';
  }
};
?>
<!Doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đăng Nhâp</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="shortcut icon" type="image/png" href="../img/logo_shortcut.png" />
</head>

<body style="background-image: url('https://i.pinimg.com/originals/b5/68/99/b568994707e0057db0435e912bf4fb7f.jpg'); background-size: cover;">
<form action="" method="post" class="mx-md-auto p-4 pt-4 pb-5 shadow-lg mt-md-4 w-25 shadow border bg-gradient bg-black">
  <h1 class="text-lg-center col-md-12 mb-4 text-white">Đăng nhập</h1>
  <?php
  if (isset($error)) {
    foreach ($error as $error) {
      echo '<p class="mb-md-2 bg-danger p-2 rounded-3 text-white col-md-12">' . $error . '</p>';
    }
  }
  ?>
  <div class="align-items-md-center col-md-12 d-flex justify-content-center">
    <input class="col-md-12 text-black p-2 rounded-1 border" type="email" name="email" placeholder="Email">
  </div>
  <div class="mt-2 align-items-md-center col-md-12 d-flex justify-content-center">
    <input class="col-md-12 text-black p-2 rounded-1 border" type="password" name="password" placeholder="Mật khẩu">
  </div>
  <div class="col-md-12">
    <input class="btn btn-success w-100 mt-2" name="submit" type="submit" value="Đăng Nhập">
    <a class="btn btn-success w-100 mt-2 mb-2" href="./register.php">Đăng ký tài khoản</a>
    <a class="text-decoration-none text-white w-100" href="./forgot.php">Quên mật khẩu</a>
  </div>
</form>
</body>

</html>