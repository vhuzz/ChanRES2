<!DOCTYPE html>
<html lang="en">
<style>
body {
  background-image: url('./nenthemnhanvien.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  
        
     
}
</style>
<style>
         div#bigBox {width:auto; 
                     height:500px; 
                    
                     padding: 106px 192px 23px 123px;
                     }
   .app-main {
    width: 100%;
}

.sidebar {
    position: fixed;
    height: 100vh;
    width: 180px;
    padding: 10px 0px !important;
    font-weight: 700;
    border-radius: 0px 5px 5px 0px;
    z-index: 20;
}
nav ul {
    padding: 0 !important;
    list-style: none;
}

nav ul li {
    padding: 15px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
    transition: ease-in-out .2s all;
}

nav ul li a:hover {
    color: #d1d1d1;
}
        </style>   
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách</title>

    <!-- Liên kết CSS Bootstrap bằng CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
</head>

<body>

<nav class="sidebar bg-primary">
                <ul>
                    <li>
                        <a href="LOGIN.php"><i class="fa-solid fa-house ico-side"></i>ADMIN</a>
                    </li>
                    <li>
                        <a href="admin2.php"><i class="fa-solid fa-cart-shopping ico-side"></i>DANH MỤC SP</a>
                    </li>
                    <li>
                        <a href="dsdb2.php"><i class="fa-solid fa-folder-open ico-side"></i>DANH SÁCH ĐẶT BÀN</a>
                    </li>
                   
                    
                </ul>
            </nav>
    <!-- Main content -->
    <div class="container">
        <h1>CÁC MÓN ĂN</h1>

        <?php
        // Truy vấn database để lấy danh sách
        // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
        //include_once(__DIR__ . '/../dbconnect.php');
       
        $conn = mysqli_connect('localhost', 'root', '', 'danhmucsp') ;
        // 2. Chuẩn bị câu truy vấn $sql
        $sql = "select * from `tbl_khoa` order by tensanpham";

        // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
        $result = mysqli_query($conn, $sql);

        // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tách để sử dụng
        // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
        // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
       
        ?>

        <!-- Button Thêm mới -->
        <a href="createSP.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm mới
        </a>
        <form action="" method="GET">
<input type="text" name="texttimkiem" />
<input type="submit" name="timkiem" value="Gửi" />
</form>
        <?php
include('connect_db.php');
if (isset($_GET['timkiem'])) {
$tukhoa = $_GET['texttimkiem'];
// từ mình nhập vào ô input;
$sql_timkiem = "SELECT * FROM `tbl_khoa` WHERE `tensanpham` LIKE '%" .$tukhoa. "%' ";
$query_timkiem = mysqli_query($conn, $sql_timkiem);
} else {
$tukhoa = '';
$sql_timkiem = "SELECT * FROM `tbl_khoa` limit 20";
$query_timkiem = mysqli_query($conn, $sql_timkiem);
}
?>
<?php
$data = [];
        $rowNum = 1;
        while ($rowtimkiem = mysqli_fetch_array($query_timkiem)) {
            $data[] = array(
                'rowNum' => $rowNum, // sử dụng biến tự tăng để làm dữ liệu cột STT
                'ID' => $rowtimkiem['ID'],
                'tensanpham' => $rowtimkiem['tensanpham'],
                'gia' => $rowtimkiem['gia'],
                'anhmota' => $rowtimkiem['anhmota']
                
            );
            $rowNum++;
        }
       
     ?>
     <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>TÊN SP</th>
                    <th>GIÁ</th>
                    <th>Ảnh mô tả</th>
                    <th>SỬA</th>
                    <th>Xóa</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $rowtimkiem) : ?>
                    <tr>
                        <td><?php echo $rowtimkiem['rowNum']; ?></td>
                        <td><?php echo $rowtimkiem['ID']; ?></td>
                        <td><?php echo $rowtimkiem['tensanpham']; ?></td>
                        <td><?php echo $rowtimkiem['gia']; ?></td>
                        <td><img style="width: 80px; height: 80px;"src="images/<?php echo $rowtimkiem['anhmota'];?>"></td>

                       
                        <td>
                            <!-- Button Sửa -->
                            <a href="editSP.php?ID=<?php echo $rowtimkiem['ID']; ?>" id="btnUpdate" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                            </a>
                            </td>
                            <td>
                                 <!-- Button Xóa -->
                            <a href="deleteSP.php?ID=<?php echo $rowtimkiem['ID']; ?>" id="btnDelete" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                            </a>
                            </td>
                           
                        
                    </tr>
                    
                <?php endforeach; ?>
            </tbody>
        </table>
        <td ><a href="index.php"><h4 align="center">Thoát</h4></a></td>
    </div>

    <!-- Liên kết JS Jquery bằng CDN -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

    <!-- Liên kết JS Popper bằng CDN -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <!-- Liên kết JS Bootstrap bằng CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- Liên kết JS FontAwesome bằng CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
</body>

</html>