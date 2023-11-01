<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>

<?php
//Ket noi CSDL
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");



$sqlTangCa = 'select * from tang_ca ';
$resultTangCa = mysqli_query($conn, $sqlTangCa);

$sqlNhanVien = 'select * from nhan_vien ';
$resultNhanVien = mysqli_query($conn, $sqlNhanVien);

if (isset($_POST['maTC']))
    $maTC = trim($_POST['maTC']);
else $maTC = "";
if (isset($_POST['MaNV'])){
    $maNV = $_POST['MaNV'];
}
    

if (!isset($_POST['ngayTC'])){
    $_POST['ngayTC'] = date('Y-m-d');
}
    

if (isset($_POST['loaiTC']))
    $loaiTC = $_POST['loaiTC'];
else $loaiTC = "";


if (isset($_POST['add'])) {

    $err = array();

    if (empty($maTC)) {
        $err[] = "Vui lòng nhập mã tăng ca";
    }
    if (empty($_POST['ngayTC'])) {
        $err[] = "Vui lòng nhập ngày tháng";
    }
    if ( empty($loaiTC)) {
        $err[] = "Vui lòng nhập loại tăng ca";
    } else if ( $loaiTC > 2) {
        $err[] = "Loại tăng ca không quá 2";
    }

    if (empty($err)) {
        $sqlInsert = "INSERT INTO `tang_ca`(`MaTC`, `MaNV`, `NgayTC`, `LoaiTC`) 
                            VALUES ('$maTC','$maNV','$_POST[ngayTC]', '$loaiTC')";
        $resultInsert = mysqli_query($conn, $sqlInsert);

        if ($resultInsert) {
            echo "<div class='alert alert-success'>Thêm tăng ca thành công</div>";
            // làm mới giá trị
            // $maCV = "";
            // $tenCV = "";
            // $HSL = "";
        } else {
            // echo "Lỗi: " . mysqli_error($conn);
            echo "<div class='alert alert-danger'>Thêm tăng ca không thành công</div>";
        }
    } else {
        foreach ($err as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }

    }
}
?>
<style>
    .form-control.form-select {
        padding-top: 0.3rem !important;
        padding-bottom: 0.3rem !important;

    }

    .form-control {
        width: 100%;
        height: 40px;
        padding-left: 20px;
    }

    .form-select {
        width: 75%;
        padding-left: 20px;
    }

    .form-date-control {
        text-align: center;
        width: 23%;
    }

    .form-control-img {
        width: 50%;

    }

    .tr td {
        font-size: 20px !important;
        height: 20% !important;
        font-weight: bold;
    }
</style>
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">THÊM TĂNG CA</h5>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr class="tr">
                            <td>Mã tăng ca</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maTC" value="<?php echo $maTC; ?>" /></td>
                            <td>Mã nhân viên</td>
                            <td>
                                <select name="MaNV" class="form-select search-option">
                                    <?php
                                    if (mysqli_num_rows($resultNhanVien) <> 0) {
                                        while ($rows = mysqli_fetch_array($resultNhanVien)) {
                                            echo "<option value='$rows[MaNV]'";
                                            if (isset($_POST['MaNV']) && $_POST['MaNV'] == $rows['MaNV']) echo "selected";
                                            echo ">$rows[MaNV]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr class="tr">
                            <td>Ngày tăng ca </td>
                            <td>
                                <input class="form-control py-2" type="date" size="20" name="ngayTC" value="<?php echo $_POST['ngayTC']; ?>" />
                            </td>
                            <td>Loại tăng ca</td>
                            <td>
                                <input class="form-control py-2" type="text" size="20" name="loaiTC" value="<?php echo $loaiTC; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td id="no_color" align="center" colspan="4">
                                <input type="submit" value="Thêm" name="add" class="btn btn-outline-purple me-3 themnhanvien-btn mb-5 w-25" />
                                <a class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" href="index.php?page=admin-overtime"> Quay Lại</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->end(); ?>