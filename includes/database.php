<?php
  try {
    $conn = mysqli_connect("localhost", "root", "Huyblack1212@@", "matmemt");
  } catch (mysqli_sql_exception $e) {
    echo "Không thể kết nối đến máy chủ <br>";
  }
?>