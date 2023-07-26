<nav class="navbar navbar-expand-lg bg-success">
  <div class="container-fluid px-md-4">
    <a class="navbar-brand text-dark" href="/product/index.php" style="color: #fffc00 !important;">Matme MT</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Bạn đang tìm gì?</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-start flex-grow-1 pe-3 align-items-md-center">
          <li class="nav-item" style="font-size: 17px">
            <a class="nav-link active text-white" aria-current="page" href="/product/index.php">Trang Chủ</a>
          </li>
          <li class="nav-item" style="font-size: 17px">
            <a class="nav-link text-white" href="#">Liên Hệ</a>
          </li>
          <li class="nav-item" style="font-size: 17px">
            <a class="nav-link text-white" href="#">Giới Thiệu</a>
          </li>
        </ul>
        <form class="d-flex align-items-center" role="search">
          <input class="form-control me-3" type="search" placeholder="Tìm Kiếm..." aria-label="Search">
          <?php
          @include '../../config/config.php';
          session_start();
            $user_id = 0;
          if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $user_login_profile = '';
            $logout = '';
            $logout_image = '';
          }
          $select_name = mysqli_query($conn, "SELECT * FROM users WHERE id ='$user_id'");
          if (mysqli_num_rows($select_name) > 0) {
            $fetch_user = mysqli_fetch_assoc($select_name);
          }
          if (isset($fetch_user['image'])) {
            $user_id = $fetch_user['image'];
            $user_login_profile = "/product/pages/profile/profile.php";
            $logout = '/product/pages/account/logout.php';
            $logout_icon = 'fa fa-sign-out text-black fa-2x';
          } else {
            $user_id = "default_img.jpg";
            $user_login_profile = "/product/pages/account/login.php";
            $logout = '';
            $logout_icon = '';
          }
          $row = mysqli_query($conn, "SELECT * FROM cart") or die('query failed');
          $row_count = mysqli_num_rows($row);
          ?>

          <a href="/product/pages/cart/cart.php" class="position-relative"><i class="fa fa-shopping-cart pe-4 ms-lg-1 pe-md-3 text-white align-middle" style="font-size: 25px; color: #fff;"></i>
            <p class="position-absolute end-0 bottom-0 text-white bg-black w-50 text-center rounded-circle"><?php echo $row_count; ?></p>
          </a>
          <div class="d-flex justify-content-center align-items-md-center mt-md-2 mb-md-2">
            <a href="<?php echo $user_login_profile ?>" class="col-md-4align-items-md-center"><img class="rounded-circle ms-md-2 me-md-2" src="../../../admin/uploaded_img/<?php echo $user_id; ?>" height="40" alt=""></a>
            <a href="<?php echo $logout ?>" class="col-md-4align-items-md-center ms-md-2" title="Đăng xuất"><i class="<?php echo $logout_icon; ?>"></i></a>
          </div>
        </form>
      </div>
    </div>
  </div>
</nav>