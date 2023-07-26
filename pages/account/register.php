<?php
@include '../../config/config.php';

$error = array(); // Initialize an empty array to store errors.

if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $sex = $_POST['sex'];
  $password = md5($_POST['password']);
  $cpassword = md5($_POST['cpassword']);
  $image = $_FILES['image']['name'];
  $image_size = $_FILES['image']['size'];
  $image_tmp_name = $_FILES['image']['tmp_name'];
  $image_folder = '../../../admin/uploaded_img/' . $image;
  $user_type = $_POST['user_type'];

  $select = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' && password = '$password'");

  if (!$select) {
    die('Lỗi câu truy vấn: ' . mysqli_error($conn));
  }

  if (mysqli_num_rows($select) > 0) {
    $error[] = 'Tài khoản đã tồn tại!';
  } else {
    if ($image_size > 2000000) {
      $error[] = 'Hình ảnh không được quá 2MB';
    } elseif ($password != $cpassword) {
      $error[] = 'Mật khẩu chưa chính xác!';
    } else {
      $insert = "INSERT INTO users (name, email, phone, sex, password, image, user_type) VALUES ('$name', '$email', '$phone', '$sex','$password', '$image', '$user_type')";
      if (mysqli_query($conn, $insert)) {
        move_uploaded_file($image_tmp_name, $image_folder);
        $error[] = 'Đăng ký thành công!';
      } else {
        $error[] = 'Đăng ký không thành công, vui lòng kiểm tra lại! Error: ' . mysqli_error($conn);
      }
    }
  }
}
?>


<!Doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đăng Ký</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="shortcut icon" type="image/png" href="../img/logo_shortcut.png" />
</head>

<body style="background-image: url('https://i.pinimg.com/originals/b5/68/99/b568994707e0057db0435e912bf4fb7f.jpg'); background-size: cover;">
  <form action="" method="post" enctype="multipart/form-data" class="mx-md-auto p-4 pt-4 pb-5 shadow-lg shadow border bg-gradient bg-black mt-md-4 w-25">
    <h1 class="text-lg-center col-md-12 mb-4 text-white">Đăng Ký</h1>
    <?php
    if (isset($error)) {
      foreach ($error as $error) {
        echo '<p class="mb-md-2 bg-warning text-black p-2 rounded-3 col-md-12">' . $error . '</p>';
      }
    }
    ?>
    <div class="align-items-md-center col-md-12 d-flex justify-content-center">
      <input class="col-md-12 text-black p-2 rounded-1 border" type="text" name="name" placeholder="Họ tên" required>
    </div>
    <div class="mt-2 align-items-md-center col-md-12 d-flex justify-content-center">
      <input class="col-md-12 text-black p-2 rounded-1 border" type="email" name="email" placeholder="Email" required>
    </div>
    <div class="mt-2 align-items-md-center col-md-12 d-flex justify-content-center">
      <input class="col-md-12 text-black p-2 rounded-1 border" type="number" name="phone" placeholder="Số điện thoại" required>
    </div>
    <select class="mt-2 col-md-12 p-2 rounded-1 border text-black" name="sex">
      <option class="text-black" value="nam">Nam</option>
      <option class="text-black" value="nữ">Nữ</option>
    </select>
    <div class="mt-2 align-items-md-center col-md-12 d-flex justify-content-center">
      <input class="col-md-12 text-black p-2 rounded-1 border" type="password" name="password" placeholder="Mật khẩu" required>
    </div>
    <div class="mt-2 align-items-md-center col-md-12 d-flex justify-content-center">
      <input class="col-md-12 text-black p-2 rounded-1 border" type="password" name="cpassword" placeholder="Nhập Lại Mật khẩu" required>
    </div>
    <div class="mt-2 align-items-md-center col-md-12">
      <p class="m-0 mb-md-1 text-white">Loại tài khoản</p>
      <input class="col-md-12 text-black p-2 rounded-1 border" type="text" name="user_type" value="user" readonly>
    </div>
    <div class="mt-2 align-items-md-center col-md-12">
      <p class="m-0 mb-md-1 text-white">Thêm ảnh đại diện (Không bắt buộc)</p>
      <input class="col-md-12 text-white p-2 rounded-1 border" type="file" name="image" accept="image/jpg, image/jpeg, image/png">
    </div>
    <div class="col-md-12">
      <input class="btn btn-success w-100 mt-3" name="submit" type="submit" value="Đăng Ký">
      <div class="d-flex mt-2">
        <p class="text-white">Bạn đã có tài khoản?</p><a class="text-danger text-decoration-none ms-md-1" href="/product/pages/account/login.php">Đăng Nhập</a>
      </div>
    </div>
  </form>
</body>

</html>