<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Giỏ hàng</title>
  <link rel="stylesheet" href="/product/css/cart.css">
  <link rel="stylesheet" href="/product/css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="shortcut icon" type="image/png" href="../../img/logo_shortcut.png" />
</head>

<body>
  <?php
  include '../../includes/nav.php'
  ?>
  <div class="mt-3">
    <div class="sp-cart">
      <h2 class="text-center pt-md-3 pb-md-3">GIỎ HÀNG</h2>
      <table class="w-100">
        <thead>
          <tr class="border">
            <th class="text-danger text-center pt-md-3 pb-md-3">Hình Ảnh</th>
            <th class="text-center text-danger pt-md-3 pb-md-3">Tên</th>
            <th class="text-center text-danger pt-md-3 pb-md-3">Giá</th>
            <th class="text-center text-danger pt-md-3 pb-md-3">Số lượng</th>
            <th class="text-center text-danger pt-md-3 pb-md-3">Tổng cộng</th>
            <th class="text-center text-danger pt-md-3 pb-md-3">Hành động</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($_POST['update_quantity'])) {
            $quantity_value = $_POST['quantity_value'];
            $quantity_id = $_POST['quantity_id'];
            $result = mysqli_query($conn, "UPDATE cart SET quantity = '$quantity_value' WHERE id = '$quantity_id'");
          };
          
          if(isset($_GET['delete'])){
            $delete_id = $_GET['delete'];
            mysqli_query($conn, "DELETE FROM cart WHERE id = '$delete_id'");
          };

          if(isset($_GET['delete_all'])){
            mysqli_query($conn, "DELETE FROM cart");
          };
          ?>
          <?php
          $select = mysqli_query($conn, "SELECT * FROM cart");
          $grand_total = 0;
          if (mysqli_num_rows($select) > 0) {
            while ($row = mysqli_fetch_assoc($select)) {
          ?>
              <tr class="border">
                <td class="pt-md-3 pb-md-3 text-center"><img src="/admin/uploaded_img/<?php echo $row['image'] ?>" height="200" alt=""></td>
                <td class="h5 text-center"><?php echo $row['name'] ?></td>
                <td class="h5 text-center"><?php echo $row['price'] ?>đ</td>
                <td class="text-md-center">
                  <form action="" method="post">
                    <input type="hidden" name="quantity_id" class="w-25 btn border border-dark" value="<?php echo $row['id'] ?>">
                    <input type="number" min="1" name="quantity_value" class="w-25 btn border border-dark" value="<?php echo $row['quantity'] ?>">
                    <input type="submit" name="update_quantity" value="Cập Nhật" class="btn btn-success">
                  </form>
                </td>
                <td class="h5 text-center"><?php echo $sub_total = $row['price'] * $row['quantity'];  ?>đ</td>
                <td class="text-center">
                  <a class="btn btn-danger" href="./cart.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Xóa Sản Phẩm Từ Giỏ Hàng');"><i class="fa fa-trash"> Xóa</i></a>
                </td>
              </tr>
          <?php
              $grand_total += $sub_total;
            };
          };
          ?>
          <tr class="border">
            <td class="pt-md-3 pb-md-3 text-center"><a href="../../index.php" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> TIẾP TỤC MUA HÀNG</i></a></td>
            <td colspan="3"></td>
            <td colspan="1" class="text-center h5"><?php echo number_format($grand_total); ?>đ</td>
            <td colspan="1" class="text-center"><a href="./cart.php?delete_all" class="btn btn-danger" onclick="return confirm('Xóa tất cả sản phẩm trong giỏ hàng');"><i class="fa fa-trash"> Xóa Tất Cả</i></a></td>
          </tr>
        </tbody>
      </table>
    </div>
      <div class="d-flex justify-content-center">
        <a href="./pay.php" class="btn btn-success mt-md-3 w-25 <?= ($grand_total > 1)?'':'disabled'; ?>">TIẾP THEO <i class="fa fa-arrow-circle-right"></i></a>
      </div>
  </div>
  <?php
  include '../../includes/footer.php'
  ?>