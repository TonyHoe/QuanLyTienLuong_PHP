<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");


$conn = mysqli_connect('localhost', 'root', '', 'quan_ly_tien_luong') or die('Could not connect to MySQL: ' . mysqli_connect_error());

$getMaNhanVien = 'select * from nhan_vien ';
$resultMaNhanVien = mysqli_query($conn, $getMaNhanVien);

$maPL = $_GET["maPL"];
$getPhieuLuong = "select * from phieu_luong where MaPhieuLuong='$maPL'";
$resultPhieuLuong = mysqli_query($conn, $getPhieuLuong);
$row = mysqli_fetch_array($resultPhieuLuong, MYSQLI_ASSOC);
$maNV = $row["MaNV"];
$thang = $row["Thang"];
$nam = $row["Nam"];
$soNgayCong = $row["SoNgayCong"];
$soNgayVang = $row["SoNgayVang"];
$luongTangCa = $row["LuongTangCa"];
$luongTamUng = $row["TienTamUng"];
$thue = $row["Thue"];
$truBaoHiem = $row["TruBaoHiem"];
$troCap = $row["TroCap"];
$thuong = $row["Thuong"];
$phat = $row["Phat"];
$tienLuongThang = $row["TienLuongThang"];
$tongThuNhap = $row["TongThuNhap"];
$thucLinh = $row["ThucLinh"];
$ghiChu = $row["GhiChu"];

if (isset($_POST["MaNV"])) {
    $maNV = $_POST['MaNV'];
}

if (!isset($_POST['thang']))
    $_POST['thang'] = $thang;
else $thang = "";

if (!isset($_POST['nam']))
    $_POST['nam'] = $nam;
else $nam = "";

if (isset($_POST['soNgayCong']))
    $soNgayCong = trim($_POST['soNgayCong']);
else $soNgayCong = "";

if (isset($_POST['soNgayVang']))
    $soNgayVang = $_POST['soNgayVang'];
else $soNgayVang = "";
if (isset($_POST['luongTangCa']))
    $luongTangCa = trim($_POST['luongTangCa']);
else $luongTangCa = "";

if (isset($_POST['luongTamUng']))
    $luongTamUng = trim($_POST['luongTamUng']);
else $luongTamUng = "";

if (isset($_POST['thue']))
    $thue = $_POST['thue'];
else $thue = "";
if (isset($_POST['truBaoHiem']))
    $truBaoHiem = trim($_POST['truBaoHiem']);
else $truBaoHiem = "";

if (isset($_POST['troCap']))
    $troCap = trim($_POST['troCap']);
else $troCap = "";

if (isset($_POST['thuong']))
    $thuong = $_POST['thuong'];
else $thuong = "";
if (isset($_POST['phat']))
    $phat = trim($_POST['phat']);
else $phat = "";

if (isset($_POST['tienLuongThang']))
    $tienLuongThang = trim($_POST['tienLuongThang']);
else $tienLuongThang = "";

if (isset($_POST['tongThuNhap']))
    $tongThuNhap = $_POST['tongThuNhap'];
else $tongThuNhap = "";
if (isset($_POST['thucLinh']))
    $thucLinh = trim($_POST['thucLinh']);
else $thucLinh = "";

if (isset($_POST['ghiChu']))
    $ghiChu = trim($_POST['ghiChu']);
else $ghiChu = "";

if (isset($_POST['edit'])) {

    $err = array();
    
    
    if (empty($_POST['thang'])) {
        $err[] = "Tháng không được để trống";
    }
    if (empty($_POST['nam'])) {
        $err[] = "Năm không được để trống";
    }
    if (empty($soNgayCong)) {
        $err[] = "Số ngày công không được để trống";
    } elseif (!is_numeric($_POST["soNgayCong"])) {
        $err[] = "Số ngày công phải là số";
    }
    if (!is_numeric($_POST["soNgayVang"])) {
        $err[] = "Số ngày vắng phải là số";
    }
    if (!is_numeric($_POST["luongTangCa"])) {
        $err[] = "Lương tăng ca phải là số";
    }
    if (!is_numeric($_POST["luongTamUng"])) {
        $err[] = "Lương tạm ứng phải là số";
    }
    if (empty($thue)) {
        $err[] = "Thuế không được để trống";
    } elseif (!is_numeric($_POST["thue"])) {
        $err[] = "Thuế phải là số";
    }
    if (!is_numeric($_POST["truBaoHiem"])) {
        $err[] = "Trừ bảo hiểm phải là số";
    }
    if (!is_numeric($_POST["troCap"])) {
        $err[] = "Trợ cấp phải là số";
    }
    if (!is_numeric($_POST["thuong"])) {
        $err[] = "Thưởng phải là số";
    }
    if (!is_numeric($_POST["phat"])) {
        $err[] = "Phạt phải là số";
    }
    if (empty($tienLuongThang)) {
        $err[] = "Tiền lương tháng không được để trống";
    } elseif (!is_numeric($_POST["tienLuongThang"])) {
        $err[] = "Tiền lương tháng phải là số";
    }
    if (empty($tongThuNhap)) {
        $err[] = "Tổng thu nhập không được để trống";
    } elseif (!is_numeric($_POST["tongThuNhap"])) {
        $err[] = "Tổng thu nhập phải là số";
    }
    if (empty($thucLinh)) {
        $err[] = "Thực lĩnh không được để trống";
    }elseif (!is_numeric($_POST["thucLinh"])) {
        $err[] = "Thực lĩnh phải là số";
    }

    if (empty($err)) {
        $sqlupdate = "UPDATE `phieu_luong` SET `MaPhieuLuong`='$maPL',`MaNV`='$maNV',`Thang`='$_POST[thang]',`Nam`='$_POST[nam]',`SoNgayCong`='$soNgayCong',`SoNgayVang`='$soNgayVang',`LuongTangCa`='$luongTangCa',`TienTamUng`='$luongTamUng',`Thue`='$thue',`TruBaoHiem`='$truBaoHiem',`TroCap`='$troCap',`Thuong`='$thuong',`Phat`='$phat',`TienLuongThang`='$tienLuongThang',`TongThuNhap`='$tongThuNhap',`ThucLinh`='$thucLinh',`GhiChu`='$ghiChu' WHERE MaPhieuLuong= '$maPL'";
        $resultupdate = mysqli_query($conn, $sqlupdate);
        $maNV = $_POST['MaNV'];
        $thang = $_POST["thang"];
        $nam = $_POST["nam"];
        $soNgayCong = $_POST["soNgayCong"];
        $soNgayVang = $_POST["soNgayVang"];
        $luongTangCa = $_POST["luongTangCa"];
        $luongTamUng = $_POST["luongTamUng"];
        $thue = $_POST["thue"];
        $truBaoHiem = $_POST["truBaoHiem"];
        $troCap = $_POST["troCap"];
        $thuong = $_POST["thuong"];
        $phat = $_POST["phat"];
        $tienLuongThang = $_POST["tienLuongThang"];
        $tongThuNhap = $_POST["tongThuNhap"];
        $thucLinh = $_POST["thucLinh"];
        $ghiChu = $_POST["ghiChu"];
        echo "<div class='alert alert-success'>Sửa phiếu lương thành công</div>";
    } else {
        foreach ($err as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
}
?>

<div class="g-6 mb-6 w-100 search-container mt-5" style="height: 665px;">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h3 class="mb-0">SỬA PHIẾU LƯƠNG</h3>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr class="tr">
                            <td>Mã phiếu lương</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maPL" value="<?php echo $row['MaPhieuLuong']; ?>" disabled /></td>
                            <td>Mã nhân viên</td>
                            <td>
                                <select name="MaNV" class="form-select search-option">
                                    <?php
                                    if (mysqli_num_rows($resultMaNhanVien) <> 0) {
                                        while ($rows = mysqli_fetch_array($resultMaNhanVien)) {
                                            echo "<option value='$rows[MaNV]'";
                                            if (isset($_POST['MaNV']) && $_POST['MaNV'] == $rows['MaNV'] || $rows['MaNV'] == $row['MaNV']) echo "selected";
                                            echo ">$rows[MaNV]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            </td>
                        </tr>
                        <tr class="tr">
                            <td>Tháng</td>
                            <td><input class="form-control py-2" type="text" size="20" name="thang" value="<?php echo $_POST['thang']; ?>" /></td>
                            <td>Năm</td>
                            <td><input class="form-control py-2" type="text" name="nam" value="<?php echo $_POST['nam']; ?>" /></td>
                        </tr>
                        <tr class="tr">
                            <td>Số ngày công</td>
                            <td><input class="form-control py-2" type="text" size="20" name="soNgayCong" value="<?php echo $row['SoNgayCong']; ?> " /></td>
                            <td>Số ngày vắng</td>
                            <td><input class="form-control py-2" type="text" name="soNgayVang" value="<?php echo $row['SoNgayVang']; ?> " /></td>
                        </tr>
                        <tr class="tr">
                            <td>Lương tăng ca</td>
                            <td><input class="form-control py-2" type="text" size="20" name="luongTangCa" value="<?php echo $row['LuongTangCa']; ?> " /></td>
                            <td>Lương tạm ứng</td>
                            <td><input class="form-control py-2" type="text" name="luongTamUng" value="<?php echo $row['TienTamUng']; ?> " /></td>
                        </tr>
                        <tr class="tr">
                            <td>Thuế</td>
                            <td><input class="form-control py-2" type="text" size="20" name="thue" value="<?php echo $row['Thue']; ?> " /></td>
                            <td>Trừ bảo hiểm</td>
                            <td><input class="form-control py-2" type="text" name="truBaoHiem" value="<?php echo $row['TruBaoHiem']; ?> " /></td>
                        </tr>
                        <tr class="tr">
                            <td>Trợ cấp</td>
                            <td><input class="form-control py-2" type="text" size="20" name="troCap" value="<?php echo $row['TroCap']; ?> " /></td>
                            <td>Thưởng</td>
                            <td><input class="form-control py-2" type="text" name="thuong" value="<?php echo $row['Thuong']; ?> " /></td>
                        </tr>
                        <tr class="tr">
                            <td>Phạt</td>
                            <td><input class="form-control py-2" type="text" size="20" name="phat" value="<?php echo $row['Phat']; ?> " /></td>
                            <td>Tiền lương tháng</td>
                            <td><input class="form-control py-2" type="text" name="tienLuongThang" value="<?php echo $row['TienLuongThang']; ?> " /></td>
                        </tr>
                        <tr class="tr">
                            <td>Tổng thu nhập</td>
                            <td><input class="form-control py-2" type="text" size="20" name="tongThuNhap" value="<?php echo $row['TongThuNhap']; ?> " /></td>
                            <td>Thực Lĩnh</td>
                            <td><input class="form-control py-2" type="text" name="thucLinh" value="<?php echo $row['ThucLinh']; ?> " /></td>
                        </tr>
                        <tr class="tr">
                            <td>Ghi chú</td>
                            <td id="no_colo" r>
                                <div class="input-group input-group-lg">
                                    <textarea class="form-control" name="ghiChu" rows="3" maxlength="300"> <?php echo $row['GhiChu']; ?></textarea>
                                </div>
                            </td>
                            <td align="center" id="no_color" colspan="2">
                                <input type="submit" value="Sửa" name="edit" class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" />
                                <a class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" href="index.php?page=admin-paycheck">Quay Lại</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->end(); ?>