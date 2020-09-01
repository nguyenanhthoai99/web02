<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
</head>
<body>
    <?php include_once(__DIR__.'/../layouts/partials/header.php');?>
    <div class="container">
        <div class="row">
            <div class="col-4"><?php include_once(__DIR__.'/../layouts/partials/sidebar.php');?></div>
            <div class="col-8">
                Nội Dung
            </div>
        </div>
    </div>
    <?php include_once(__DIR__.'/../layouts/partials/footer.php');?>
</body>
</html>