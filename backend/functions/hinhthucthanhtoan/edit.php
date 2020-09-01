<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Cập Nhât</title>
</head>
<body>
    <?php include_once(__DIR__.'/../../layouts/partials/header.php');?>
    <?php
    include_once(__DIR__.'/../../../dbconnect.php');
        $id_lop = $_GET['xuli_sua'];
        $sqlSelect =<<<OTE
        SELECT id_lop, ten_lop
        FROM lop
        WHERE id_lop = $id_lop;
OTE;
    $resultSelect = mysqli_query($conn,$sqlSelect);
    $id_lopRow = [];
    while($row = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC)){
        $id_lopRow = array(
            'id_lop' => $row['id_lop'],
            'ten_lop' => $row['ten_lop'],
        );
    }
    ?>

    <div class="container">
    <form name="frm_them" id="frm_them" method="POST" action="">
            <input name="ten_lop" id="ten_lop" type="text"value="<?= $id_lopRow['ten_lop']?>">
            <input name="btn_Luu" id="btn_Luu" type="submit" value="Lưu">
            <a class="btn btn-outline-primary" href="index.php">Qua Về</a>
        </form>
    </div>
    <?php
        if(isset($_POST['btn_Luu'])){
            $ten_lop = $_POST['ten_lop'];
            $sql =<<<OTE
            UPDATE lop
            SET ten_lop ='$ten_lop'
            WHERE id_lop = $id_lop
OTE;
        mysqli_query($conn,$sql);
        }
    ?>
    <?php include_once(__DIR__.'/../../layouts/partials/footer.php');?>
</body>
</html>