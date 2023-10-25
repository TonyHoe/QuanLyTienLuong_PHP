<?php $this->layout('layout_manager') ?>
<?php $this->section('content'); ?>
<style>
    [class*=" bi-"]::before, [class^=bi-]::before{
        height: 16.5px;
    }
    .date-board{
        overflow: scroll;
    }
    .table-split1{
        width: 35%;
    }
    .table-split2{
        width: 65%;
    }
    .table-split2 .date-board table thead,
    .table-split2 .date-board table thead tr th,
    .table-split2 .date-board table tbody tr td{
        border-left: 1px solid #00000012;
    }

    th, td{
        text-align: center;
    }
    td i{
        font-size: larger;
    }

    
</style>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

function GetDayOfWeek($date)
{
    $day = '';
    switch (date('w', strtotime($date))) {
        case '0':
            $day = 'CN';
            break;
        case '1':
            $day = 'T2';
            break;
        case '2':
            $day = 'T3';
            break;
        case '3':
            $day = 'T4';
            break;
        case '4':
            $day = 'T5';
            break;
        case '5':
            $day = 'T6';
            break;
        case '6':
            $day = 'T7';
            break;
    }
    return $day;
}
?>
<div class="card shadow border-0 mb-3">
    <div id="thang" class="carousel slide" data-bs-interval="false">
        <div class="carousel-inner">
            <?php
            $counter = 1;
            $yearnow = date('Y');

            $sqlgetThang = "SELECT month(Ngay) as thangtrongnam, year(Ngay) as nam from cham_cong 
            where year(Ngay) = $yearnow
            GROUP BY month(Ngay)
            ORDER BY month(Ngay) ";

            $resultgetThang = mysqli_query($conn, $sqlgetThang);

            while ($rowsThang = mysqli_fetch_array($resultgetThang)) {
                $actives = '';
                if ($counter == mysqli_num_rows($resultgetThang)) {
                    $actives = 'active';
                }
            ?>
                <div class="carousel-item <?= $actives; ?>">
                    <div style='display:flex'>
                        <div class='table-split1'>
                            <div class="card-header">
                                <h3 class="mb-0">Bảng chấm công</h3>
                            </div>
                                <table class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="padding-top: 32.5px;padding-bottom: 32.5px;">Mã <br> nhân viên</th>
                                            <th >Họ và tên</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            $sqlgetTen = "SELECT MaNV, TenNV, HoNV from nhan_vien";
                                            $resultgetTen = mysqli_query($conn, $sqlgetTen);
                                            $icon = '';
                                            while ($rowTen = mysqli_fetch_array($resultgetTen)) {
                                                $sqlgetCC = "SELECT TinhTrang from cham_cong where MaNV = '$rowTen[MaNV]' and month(Ngay) = $rowsThang[thangtrongnam]";
                                                $resultgetCC = mysqli_query($conn, $sqlgetCC);
                                            ?>
                                                <td><?= $rowTen['MaNV'] ?></td>
                                                <td><p><?= $rowTen['HoNV'] . ' ' . $rowTen['TenNV'] ?></p></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                        </div>
                        <div class='table-split2'>
                            <div class="card-header">
                                <h3 class="mb-0">Tháng <?= $rowsThang['thangtrongnam'] ?> năm <?= $rowsThang['nam'] ?></h3>
                            </div>
                            <div class='date-board'>
                            <table class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <?php
                                            do {
                                                $sqlgetNgay = "SELECT day(Ngay) as ngaytrongthang, Ngay from cham_cong 
                                                where year(Ngay) = $yearnow
                                                and month(Ngay) = $rowsThang[thangtrongnam]
                                                GROUP BY day(Ngay);";
                                                $resultgetNgay = mysqli_query($conn, $sqlgetNgay);
                                            } while (mysqli_num_rows($resultgetNgay) == 0);
                                            while ($rowNgay = mysqli_fetch_array($resultgetNgay)) {
                                                $day = GetDayOfWeek($rowNgay['Ngay']); 
                                                echo "<th>$day</th>";
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php 
                                                do {
                                                    $sqlgetNgay = "SELECT day(Ngay) as ngaytrongthang, Ngay from cham_cong 
                                                    where year(Ngay) = $yearnow
                                                    and month(Ngay) = $rowsThang[thangtrongnam]
                                                    GROUP BY day(Ngay);";
                                                    $resultgetNgay = mysqli_query($conn, $sqlgetNgay);
                                                } while (mysqli_num_rows($resultgetNgay) == 0);
                                                while ($rowNgay = mysqli_fetch_array($resultgetNgay)) {
                                                    $day = GetDayOfWeek($rowNgay['Ngay']); 
                                                    echo "<th>$rowNgay[ngaytrongthang]</th>";
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            $sqlgetTen = "SELECT MaNV, TenNV, HoNV from nhan_vien";
                                            $resultgetTen = mysqli_query($conn, $sqlgetTen);
                                            $icon = '';
                                            while ($rowTen = mysqli_fetch_array($resultgetTen)) {
                                                $sqlgetCC = "SELECT TinhTrang from cham_cong where MaNV = '$rowTen[MaNV]' and month(Ngay) = $rowsThang[thangtrongnam]";
                                                $resultgetCC = mysqli_query($conn, $sqlgetCC);
                                            ?>
                                                <?php
                                                while ($rowCC = mysqli_fetch_array($resultgetCC)) {
                                                    if ($rowCC['TinhTrang'] == 1) {
                                                        $icon = '<i class="bi bi-check-lg" style="color: green"></i>';
                                                    } else $icon = '<i class="bi bi-x-lg" style="color: red"></i>';
                                                ?>
                                                    <td><?= $icon ?></td>
                                                <?php } ?>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                $counter++;
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#thang" data-bs-slide="prev" style="left: -20px;">
        <i style="color: black; font-size: 50px; position:fixed; top: 50%; left: 20%" class="bi bi-caret-left-fill"></i>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#thang" data-bs-slide="next" style="right: -20px;">
            <i style="color: black; font-size: 50px; position:fixed; top: 50%;right: 0" class="bi bi-caret-right-fill"></i>
        </button>
    </div>
</div>
<?php $this->end(); ?>