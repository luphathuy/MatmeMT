<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thanh Toán</title>
  <link rel="stylesheet" href="/product/css/cart.css">
  <link rel="stylesheet" href="/product/css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="shortcut icon" type="image/png" href="../../img/logo_shortcut.png" />
</head>

<body>
  <?php
  include '../../includes/nav.php';
  @include '../../config/config.php';

  if (isset($_POST['order_btn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $code = $_POST['code'];
    $note = $_POST['note'];
    $address = $_POST['address'];
    $method = $_POST['method'];

    $cart_quety = mysqli_query($conn, "SELECT * FROM cart");
    $price_total = 0;
    if (mysqli_num_rows($cart_quety) > 0) {
      while ($product_item = mysqli_fetch_assoc($cart_quety)) {
        $product_name[] = $product_item['name'] . '(' . $product_item['quantity'] . ')';
        $product_price = $product_item['price'] * $product_item['quantity'];
        $price_total += $product_price;
      };
    };
    $total_product = implode(' - ', $product_name);
    $detail_query = mysqli_query($conn, "INSERT INTO `order` 
    (name, email, phone, code, note, address, method, total_product, total_price) 
    VALUES('$name', '$email', '$phone', '$code', '$note', '$address', '$method', '$total_product', '$price_total')")
      or die('query failed');
    if ($cart_quety && $detail_query) {
      echo "
      <div style='z-index: 1100; padding: 2rem;' class='position-fixed top-0 end-0 h-100 align-items-md-center d-flex justify-content-center w-100'>
        <div style='padding: 2rem;' class='shadow bg-light rounded-3 text-center'>
      <h3 class='text-black text-uppercase'>Cảm ơn bạn đã mua hàng!</h3>
      <div class='rounded-3 bg-dark shadow' style='padding: 1rem; margin: 1rem 0;'>
        <span style='display: inline-block; padding: 1rem 1.5rem; margin: 1rem;' class='rounded-3 text-black bg-light text-uppercase'>$total_product</span>
        <span class='d-block bg-danger text-white rounded-3' style='padding: 1rem 1.5rem; margin: 1rem;'> TỔNG TIỀN : $price_total đ </span>
      </div>
      <div style='margin: 1rem 0;'>
        <p class='text-uppercase'> Họ tên : <span class='text-primary p-2 h6'>$name</span> </p>
        <p class='text-uppercase'> Email : <span class='text-primary p-2 h6'>$email</span> </p>
        <p class='text-uppercase'> Số điện thoại : <span class='text-primary p-2 h6'>$phone</span> </p>
        <p class='text-uppercase'> Mã free ship : <span class='text-primary p-2 h6'>$code</span> </p>
        <p class='text-uppercase'> Ghi chú : <span class='text-primary p-2 h6'>$note</span> </p>
        <p class='text-uppercase'> Địa chỉ : <span class='text-primary p-2 h6'>$address</span> </p>
        <p class='text-uppercase'> Chế độ thanh toán : <span class='text-primary p-2 h6'>$method</span> </p>
      </div>
      <a href='../index.php' class='bg-dark text-uppercase btn d-block h6 p-3 rounded-3 text-white'>Trở về trang chủ</a>
        </div>
      </div>
      ";
    }
  }
  ?>
  <h3 class="text-center pt-md-4 pb-md-2">THANH TOÁN</h3>
  <div class="settle row m-0">
    <form action="" method="post">
      <div class="text-center mb-md-3">
        <div class="w-50 text-md-center d-inline-block border p-3 ms-md-4 me-md-4">
          <?php
          $select = mysqli_query($conn, "SELECT * FROM cart");
          $total = 0;
          $grand_total = 0;
          if (mysqli_num_rows($select) > 0) {
            while ($row = mysqli_fetch_assoc($select)) {
              $total_price = $row['price'] * $row['quantity'];
              $grand_total = $total += $total_price;
          ?>
              <span class="btn btn-success d-inline-block mt-md-2"><?= $row['name']; ?>(<?= $row['quantity']; ?>)</span>
          <?php
            };
          } else {
            echo "<div class=''<span>Giỏ hàng của bạn trống!</span></div>";
          }
          ?>
          <span class="btn btn-warning mt-md-2 w-100">Tổng cộng : <?= number_format($grand_total); ?>đ</span>
        </div>
      </div>
      <div class="row pt-md-3 ps-md-4 pe-md-4 pb-md-4">
        <div class="col-md-7">
          <h4>Thông tin</h4>
          <div class="row mt-3">
            <div class="form-floating col-md-6">
              <input type="text" class="form-control mb-3" name="name" placeholder="Họ và tên" required>
              <label class="ps-md-4">*Họ và tên</label>
            </div>
            <div class="form-floating col-md-6">
              <input type="email" class="form-control mb-3" name="email" placeholder="Email" required>
              <label class="ps-md-4">*Email</label>
            </div>
            <div class="form-floating col-md-6">
              <input type="number" class="form-control mb-3" name="phone" placeholder="Số điện thoại" required>
              <label class="ps-md-4">*Sô điện thoại</label>
            </div>
            <div class="form-floating col-md-6">
              <input type="text" class="form-control mb-3" name="code" placeholder="Mã Free Ship">
              <label class="ps-md-4">Mã Free Ship</label>
            </div>
            <div class="form-floating col-md-6">
              <span class="ps-md-2">Ghi chú</span>
              <textarea name="note" class="w-100 mt-2 p-2" cols="50" rows="7"></textarea>
            </div>
            <div class="form-floating col-md-6">
              <span class="ps-md-2">*Địa chỉ (Lưu ý: chỉ giao trong khu vực Cái Răng)</span>
              <textarea name="address" class="w-100 mt-2 p-2" cols="50" rows="7" required></textarea>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <h4>Phương thức thanh toán (Vui lòng chọn 1 trong 2)</h4>
          <div class="row mt-3">
            <div class="input-group mb-3">
              <label class="input-group-text" for="inputGroupSelect01">Chọn phương thức</label>
              <select name="method" class="form-select">
                <option value="Thanh toán khi nhận hàng" selected>Thanh toán khi nhận hàng</option>
                <option value="Chuyển khoản">Chuyển khoản</option>
              </select>
            </div>
            <div class="row ms-md-1">
              <div class="col-md-6">
                <img src="../../img/qrbank.jpg" alt="bank" class="w-100">
              </div>
              <div class="col-md-6 align-self-center">
                <h5 class="p-2"><i class="fas fa-stamp"></i> Lữ Phát Huy</h5>
                <h5 class="p-2"><i class="far fa-credit-card"></i> 30442243</h5>
                <h5 class="p-2"><i class="fas fa-landmark"></i> Kiên Long</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <a href="./cart.php" class="btn btn-success mt-md-3 w-25 me-md-2"><i class="fa fa-arrow-circle-left"></i> TRỞ LẠI GIỎ HÀNG</a>
          <input type="submit" name="order_btn" class="btn ms-md-2 btn-success mt-md-3 w-25" value="Hoàn Tất">
        </div>
      </div>
    </form>
  </div>
  <?php
  include '../../includes/footer.php'
  ?>