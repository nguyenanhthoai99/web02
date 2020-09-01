<h1>Xóa Hoàn Tất</h1><br/>
<?php include_once(__DIR__.'/../../layouts/styles.php');?>
<a href="index.php" class="btn btn-outline-primary">Qua Về</a>
<?php
    include_once(__DIR__.'/../../../dbconnect.php');
    $id_lop = $_GET['xuli_xoa'];
    $sql =<<<OTE
           DELETE FROM lop
           WHERE id_lop = $id_lop;
OTE;
    mysqli_query($conn,$sql);
?>