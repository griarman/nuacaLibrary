<!DOCTYPE html>
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
    <link rel="stylesheet" href="../assets/css/faculty.css">
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/sweetAlert.js"></script>
<!--    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>-->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/faculty.js"></script>
    <link rel="stylesheet" href="../assets/fonts/css/all.min.css">
</head>
<body>

<div class="container-fluid">
    <div class="row">
       <?php require_once 'menu.php' ?>
        <div class="offset-md-2 col-md-7">
            <div class="mt-5 label text-center">
                <label for="faculty">Ավելացնել ֆակուլտետ</label>
            </div>
            <div class=" myForm">
                <input type="text" id="faculty" class="myInp" placeholder="Ֆակուլտետ">
                <button type="button" class="myBtn" id="addFaculty">Ավելացնել</button>
            </div>
            <div class="faculties mt-5">
                <div class="header d-flex">
                    <div><b>Id</b></div>
                    <div><b>Անուն</b></div>
                    <div><b>Փոխել</b></div>
                    <div><b>Ջնջել</b></div>
                </div>
                <?php foreach ($faculties as $key => $value): ?>
                <div class="faculty d-flex" id="<?= $value['id']?>">
                    <div class="id"><?= $value['id']?></div>
                    <div class="facultyName"><?= $value['name']?></div>
                    <div class="edit"><i class="fas fa-pen-alt"></i></div>
                    <div class="del"><i class="fas fa-trash-alt"></i></div>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>
</body>
</html>
