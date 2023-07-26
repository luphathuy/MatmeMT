<?php
@include '../../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Matme MT</title>
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="shortcut icon" type="image/png" href="./img/logo_shortcut.png" />
</head>

<body>
  <?php
  include '../../includes/nav.php';
  $user_id = 0;
  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
  }
  $select_name = mysqli_query($conn, "SELECT * FROM users WHERE id ='$user_id'");
  if (mysqli_num_rows($select_name) > 0) {
    $fetch_user = mysqli_fetch_assoc($select_name);
  }
  if (isset($fetch_user['image'])) {
    $user_id = $fetch_user['image'];
  } else {
    $user_id = "default_img.jpg";
  } 
  ?>
  <div style='z-index: 1100; padding: 2rem;' class='top-0 end-0 align-items-md-center d-flex justify-content-center w-100'>
    <div style='padding: 2rem;' class='shadow bg-dark rounded-3 text-center w-50'>
      <h2 class='text-white text-uppercase pb-md-3'>Hồ Sơ</h2>
      <div class="row mt-3">
        <div class="form-floating col-md-12 mb-md-2">
          <img src="../../../admin/uploaded_img/<?php echo $user_id; ?>" height="150" class="rounded-circle">
        </div>
        <div class="form-floating col-md-12 mt-md-1 mb-md-3">
          <p class="m-0 h5 font-weight-bold text-white"><?php echo $fetch_user['name'] ?></p>
        </div>
        <div class="form-floating col-md-12">
          <span class="text-md-start ms-md-2 text-white d-block mb-md-1 font-weight-bold">Email:</span>
          <p class="w-100 rounded-3 p-3 bg-light"><?php echo $fetch_user['email'] ?></p>
        </div>
        <div class="form-floating col-md-12">
          <span class="text-md-start ms-md-2 text-white d-block mb-md-1 font-weight-bold">Số điện thoại:</span>
          <p class="w-100 rounded-3 p-3 bg-light">0<?php echo $fetch_user['phone'] ?></p>
        </div>
        <div class="form-floating col-md-12">
          <span class="text-md-start ms-md-2 text-white d-block mb-md-1 font-weight-bold">Giới tính:</span>
          <p class="w-100 rounded-3 p-3 bg-light"><?php echo $fetch_user['sex'] ?></p>
        </div>
      </div>
      <div class="mt-md-5">
        <a href='/product/pages/profile/edit.php' class='bg-success text-uppercase btn d-block h6 p-3 rounded-3 text-white'>Cập nhật hồ sơ</a>
        <a href='/product/index.php' class='bg-danger text-uppercase btn d-block h6 p-3 rounded-3 text-white'>Trở về</a>
      </div>
    </div>
  </div>
  <?php
  include '../../includes/footer.php';
  ?>