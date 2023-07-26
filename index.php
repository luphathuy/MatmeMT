<!Doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Matme MT</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="shortcut icon" type="image/png" href="./img/logo_shortcut.png" />
</head>

<style>
  .truncate-text {
    white-space: nowrap;
    /* Ngăn văn bản xuống dòng */
    overflow: hidden;
    /* Ẩn các nội dung dư thừa */
    text-overflow: ellipsis;
    /* Hiển thị dấu ba chấm (...) khi bị cắt */
  }
</style>

<body>
  <?php
  @include './config/config.php';
  if (isset($_POST['add_to_cart'])) {
    $image = $_POST['image_product'];
    $name = $_POST['name_product'];
    $price = $_POST['price_product'];
    $quantity = 1;

    $select = mysqli_query($conn, "SELECT * FROM cart WHERE name = '$name'");

    if (mysqli_num_rows($select) > 0) {
      echo '<div class="alert alert-danger mb-0 text-center" role="alert">Sản phẩm đã có trong giỏ hàng!</div>';
    } else {
      $insert = mysqli_query($conn, "INSERT INTO cart (image, name, price, quantity) 
      VALUES ('$image','$name','$price','$quantity')");
      echo '<div class="alert alert-info mb-0 text-center" role="alert">Sản phẩm đã được thêm vào giỏ hàng!</div>';
    };
  };
  include './includes/nav.php'
  ?>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./img/004.jpg" class="d-block w-100 banner" alt="...">
    </div>
  </div>
  <?php
  $select = mysqli_query($conn, "SELECT * FROM product");
  ?>
  <div class="container mb-5">
    <div class="row">
      <div class="col-md-8">
        <h2 class="mt-5">Trà Sữa & Ăn Vặt</h2>
        <div class="row mt-3">
          <?php if (mysqli_num_rows($select) > 0) {
            while ($row = mysqli_fetch_assoc($select)) { ?>
              <div class="col-md-4">
                <form action="" method="post">
                  <a href=""><img src="/admin/uploaded_img/<?php echo $row['image']; ?>" class="img-fluid rounded w-100 mt-2" height="150" title=""></a>
                  <div class="p-1 text-lg-center mt-2">
                    <h6 class=""><?php echo $row['name']; ?></h6>
                    <h5 class="mb-2"><?php echo $row['price']; ?>đ</h5>
                    <p class="mb-2 truncate-text"><?php echo $row['depict']; ?></p>
                    <input type="hidden" name="image_product" value="<?php echo $row['image']; ?>">
                    <input type="hidden" name="name_product" value="<?php echo $row['name']; ?>">
                    <input type="hidden" name="price_product" value="<?php echo $row['price']; ?>">
                    <input type="submit" class="btn btn-success" value="Đặt Ngay" name="add_to_cart">
                  </div>
                </form>
              </div>
          <?php };
          }; ?>
        </div>
      </div>
      <aside class="col-md-4">
        <h2 class="mt-5">SALE</h2>
        <div class="row">
          <img src="./img/banner1.jpg" alt="" width="100" class="col-md-12 mt-3">
          <img src="./img/banner3.jpg" alt="" width="100" class="col-md-12 mt-3">
          <img src="./img/banner4.jpg" alt="" width="100" class="col-md-12 mt-3">
          <img src="./img/banner5.jpg" alt="" width="100" class="col-md-12 mt-3">
        </div>
      </aside>
    </div>
  </div>
  <?php
  include './includes/footer.php'
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>