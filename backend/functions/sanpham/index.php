<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Lớp</title>
</head>

<body>
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <div class="container">
        <?php
        include_once(__DIR__ . '/../../../dbconnect.php');
        $sql = <<<OTE
                SELECT sp.*
                , lsp.lsp_ten
                , nsx.nsx_ten
                , km.km_ten, km.km_noidung, km.km_tungay, km.km_denngay
            FROM `sanpham` sp
            JOIN `loaisanpham` lsp ON sp.lsp_ma = lsp.lsp_ma
            JOIN `nhasanxuat` nsx ON sp.nsx_ma = nsx.nsx_ma
            LEFT JOIN `khuyenmai` km ON sp.km_ma = km.km_ma
            ORDER BY sp.sp_ma DESC        
OTE;
        $result = mysqli_query($conn, $sql);
        $formatedData = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $km_tomtat = '';
            if (!empty($row['km_ten'])) {
                $km_tomtat = sprintf(
                    "Khuyến mãi %s, nội dung: %s, thời gian: %s-%s",
                    $row['km_ten'],
                    $row['km_noidung'],
                    date('d/m/Y', strtotime($row['km_tungay'])),
                    date('d/m/Y', strtotime($row['km_denngay']))
                );
            }
            $formatedData[] = array(
                'sp_ma' => $row['sp_ma'],
                'sp_ten' => $row['sp_ten'],

                'sp_gia' => number_format($row['sp_gia'], 2, ".", ",") . ' vnđ',
                'sp_giacu' => number_format($row['sp_giacu'], 2, ".", ",") . ' vnđ',
                'sp_mota_ngan' => $row['sp_mota_ngan'],
                'sp_mota_chitiet' => $row['sp_mota_chitiet'],
                'sp_ngaycapnhat' => date('d/m/Y H:i:s', strtotime($row['sp_ngaycapnhat'])),
                'sp_soluong' => number_format($row['sp_soluong'], 0, ".", ","),
                'lsp_ma' => $row['lsp_ma'],
                'nsx_ma' => $row['nsx_ma'],
                'km_ma' => $row['km_ma'],
                // Các cột dữ liệu lấy từ liên kết khóa ngoại
                'lsp_ten' => $row['lsp_ten'],
                'nsx_ten' => $row['nsx_ten'],
                'km_tomtat' => $km_tomtat,
            );
        }

        ?>
        <a class="btn btn-primary" href="create.php">Thêm</a>
        <table class="table table-bordered table-hover mt-2">
            <thead class="thead-dark">
                <tr>
                    <th>Mã Sản phẩm</th>
                    <th>Tên Sản phẩm</th>
                    <th>Giá</th>
                    <th>Giá cũ</th>
                    <th>Mô tả</th>
                    <th>Ngày cập nhật</th>
                    <th>Số lượng</th>
                    <th>Loại sản phẩm</th>
                    <th>Nhà sản xuất</th>
                    <th>Khuyến mãi</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($formatedData as $sanpham) : ?>
                    <tr>
                        <td><?= $sanpham['sp_ma'] ?></td>
                        <td><?= $sanpham['sp_ten'] ?></td>
                        <td><?= $sanpham['sp_gia'] ?></td>
                        <td><?= $sanpham['sp_giacu'] ?></td>
                        <td>
                            <?= $sanpham['sp_mota_ngan'] ?>
                            <p>
                                <?= $sanpham['sp_mota_chitiet'] ?>
                            </p>
                        </td>
                        <td><?= $sanpham['sp_ngaycapnhat'] ?></td>
                        <td><?= $sanpham['sp_soluong'] ?></td>
                        <td><?= $sanpham['lsp_ten'] ?></td>
                        <td><?= $sanpham['nsx_ten'] ?></td>
                        <td><?= $sanpham['km_tomtat'] ?></td>
                        <td>
                            <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `sp_ma` -->
                            <a href="edit.php?sp_ma=<?= $sanpham['sp_ma'] ?>" class="btn btn-warning">
                                Sửa
                            </a>
                            <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `sp_ma` -->
                            <a href="delete.php?sp_ma=<?= $sanpham['sp_ma'] ?>" class="btn btn-danger">
                                Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
</body>

</html>