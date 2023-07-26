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

  if (isset($_POST['update_profile'])) {
    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
    $update_phone = mysqli_real_escape_string($conn, $_POST['update_phone']);
    $update_sex = $_POST['update_sex'];

    mysqli_query($conn, "UPDATE users SET name = '$update_name', email = '$update_email', 
  phone = '$update_phone', sex = '$update_sex' WHERE id = '$user_id'") or die('Không thể kết nối!');

    $update_image = $_FILES['update_image']['name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder = '../../../admin/uploaded_img/' . $update_image;

    if (!empty($update_image)) {
      if ($update_image_size > 2000000) {
        $error[] = 'Kích thước ảnh không được quá 2MB';
      } else {
        $image_update_query = mysqli_query($conn, "UPDATE users SET image = '$update_image' WHERE id = '$user_id'") or die('Không thể kết nối!');
        if ($image_update_query) {
          move_uploaded_file($update_image_tmp_name, $update_image_folder);
        }
        $error[] = 'Cập nhật thành công!';
      }
    } else {
      $error[] = 'Vui lòng điền đầy đủ thông tin!';
    }
  }
  ?>
  <?php
  $select_name = mysqli_query($conn, "SELECT * FROM users WHERE id ='$user_id'");
  if (mysqli_num_rows($select_name) > 0) {
    $fetch_user = mysqli_fetch_assoc($select_name);
  }
  ?>
  <div style='z-index: 1100; padding: 2rem;' class='top-0 end-0 align-items-md-center d-flex justify-content-center w-100'>
    <div style='padding: 2rem;' class='shadow bg-dark rounded-3 text-center w-50'>
      <h2 class='text-white text-uppercase pb-md-3'>Hồ Sơ</h2>
      <form action="" method="post" enctype="multipart/form-data">
        <?php
        if (isset($fetch_user['image'])) {
          $user_id = $fetch_user['image'];
        } else {
          $user_id = "default_img.jpg";
        }
        ?>
        <?php
        if (isset($error)) {
          foreach ($error as $error) {
            echo '<p class="mb-md-2 bg-warning text-black p-2 rounded-3 col-md-12">' . $error . '</p>';
          }
        }
        ?>
        <div class="row mt-3">
          <div class="form-floating col-md-12 mb-md-2">
            <img src="../../../admin/uploaded_img/<?php echo $user_id; ?>" height="150" class="rounded-circle">
          </div>
          <div class="form-floating col-md-12 mt-md-1 mb-md-3">
            <p class="m-0 h5 font-weight-bold"><?php echo $fetch_user['name'] ?></p>
          </div>
          <div class="form-floating col-md-12">
            <span class="text-lg-left d-block mb-md-1 font-weight-bold">Ảnh đại diện:</span>
            <input class="col-md-12 text-white p-2 rounded-1 border mb-md-3" type="file" name="update_image" accept="image/jpg, image/jpeg, image/png">
          </div>
          <div class="form-floating col-md-12">
            <span class="text-lg-left d-block mb-md-1 font-weight-bold">Họ tên:</span>
            <input class="col-md-12 text-black p-2 rounded-1 border mb-md-3" type="text" name="update_name" placeholder="Họ tên">
          </div>
          <div class="form-floating col-md-12">
            <span class="text-lg-left d-block mb-md-1 font-weight-bold">Số điện thoại:</span>
            <input class="col-md-12 text-black p-2 rounded-1 border mb-md-3" type="number" name="update_phone" placeholder="Số điện thoại">
          </div>
          <div class="form-floating col-md-12">
            <span class="text-lg-left d-block mb-md-1 font-weight-bold">Email:</span>
            <input class="col-md-12 text-black p-2 rounded-1 border mb-md-3" type="email" name="update_email" placeholder="Email">
          </div>
          <div class="form-floating col-md-12">
            <span class="text-lg-left d-block mb-md-1 font-weight-bold">Giới tính:</span>
            <select class="w-100 ps-md-2 mb-3 p-2 rounded-1" name="update_sex">
              <option class="text-black" value="nam">Nam</option>
              <option class="text-black" value="nữ">Nữ</option>
            </select>
          </div>
        </div>
        <div class="mt-md-5">
          <input type="submit" name="update_profile" class='bg-success text-uppercase btn d-block w-100 h6 p-3 rounded-3 text-white' value="Cập nhật">
          <a href='/product/pages/profile/profile.php' class='bg-danger text-uppercase btn d-block h6 p-3 rounded-3 text-white'>Trở về</a>
        </div>
      </form>
    </div>
  </div>
  <?php
  include '../../includes/footer.php';
  ?>