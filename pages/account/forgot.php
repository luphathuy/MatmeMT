<!Doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đăng Ký</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="shortcut icon" type="image/png" href="./img/logo_shortcut.png" />
</head>

<body style="background-image: url('https://anhdepfree.com/wp-content/uploads/2020/04/hinh-nen-khu-rung-toi-tam.jpg'); background-size: cover; margin-top: 100px;">
  <form action="login" class="mx-md-auto p-3 pt-4 pb-5 shadow-lg w-25 shadow border bg-gradient bg-black row">
    <h1 class="text-lg-center col-md-12 mb-4 text-white fs-2 mt-3">Thay đổi mật khẩu</h1>
    <div class="align-items-md-center col-md-12 d-flex justify-content-center">
      <input class="col-md-12 text-black p-2 rounded-1 border" type="text" name="username" placeholder="Tên đăng nhập" required>
    </div>
    <div class="col-md-12">
      <button class="btn btn-success w-100 mt-3" id="submitButton" type="submitButton" formaction="./newpassword.php" name="submit">Tiếp Theo</button>
      <a class="btn btn-success w-100 mt-2 mb-2" href="../index.php"><i class="fas fa-angle-left"></i> Trở Lại</a>
    </div>
  </form>
</body>

</html>