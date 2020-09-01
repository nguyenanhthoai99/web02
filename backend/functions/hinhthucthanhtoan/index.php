<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Lớp</title>
</head>
<body>
    <?php include_once(__DIR__.'/../../layouts/partials/header.php');?>
    <div class="container">
        <div class="row">
            <div class="col-4"><?php include_once(__DIR__.'/../../layouts/partials/sidebar.php');?></div>
            <div class="col-8">
               <?php 
                include_once(__DIR__.'/../../../dbconnect.php');
                $sql=<<<OTE
                SELECT httt_ma,httt_ten
                FROM hinhthucthanhtoan
OTE;
                $result = mysqli_query($conn,$sql);
                $data=[];
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    $data[] = array(
                        'httt_ma'=>$row['httt_ma'],
                        'httt_ten'=>$row['httt_ten'],
                    );
                }
               ?>
                <a class="btn btn-primary" href="create.php">Thêm</a>
               <table border="1">
                    <thead>
                        <tr>
                            <th>ID Lớp</th>
                            <th>Tên Lớp</th>
                            <th>Chức Năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $id):?>
                            <tr>
                                <td><?= $id['httt_ma']?></td>
                                <td><?= $id['httt_ten']?></td>
                                <td>
                                    <a class="btn btn-primary"  href="edit.php?xuli_sua=<?=$id['httt_ma']?>">Sửa</a>
                                    <a class="btn btn-primary"  href="delete.php?xuli_xoa=<?=$id['httt_ma']?>">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach;?>    
                    </tbody>
               </table>
            </div>
        </div>
    </div>
    <?php include_once(__DIR__.'/../../layouts/partials/footer.php');?>
</body>
</html>