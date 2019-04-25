<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
    <script src="../assets/JS/jquery-3.3.1.min.js"></script>
    <link rel="icon"  href="../favicon.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/adminMenu.css">
    <link rel="stylesheet" href="../assets/css/chairs.css">
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/chairs.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

</head>
<body>

<div class="container-fluid">
    <div class="row">
        <?php require_once 'menu.php' ?>
        <div class="col-md-7  col-sm-7">
            <div id="addChairs" class="mt-5">
                <div class="header text-center">Ավելացնել ամբիոն</div>
                <div id="addInputs">
                    <div>
                        <select id="faculty" title="Ընտրել ֆակուլտետ">
                            <option selected disabled value="0">Ընտրել ֆակուլտետ</option>
                            <?php foreach($faculties as $key => $value):?>
                                <option value="<?= $value['id']?>"><?= $value['name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div><input type="text" class="myInp"></div>
                    <div><button class="myBtn">Ավելացնել</button></div>
                </div>
            </div>
            <div id="showChairs" class="mt-3">
                <?php foreach($faculties as $key => $value):?>
                    <div id="faculty-<?= $value['id']?>" class="facultyHeader">
                        <nav>
                            <div>
                                <?= $value['name']?>
                            </div>
                            <div class="closed">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </nav>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>