<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <script src="../assets/JS/jquery-3.3.1.min.js"></script>
    <link rel="icon"  href="../favicon.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/adminMenu.css">
    <link rel="stylesheet" href="../assets/css/faculty.css">
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

</head>
<body>

<div class="container-fluid">
    <div class="row">
       <?php require_once 'menu.php' ?>
        <div class="offset-md-2 col-md-4">
            <div class="mt-5 myForm">
                <label for="faculty">Ավելացնել ֆակուլտետ</label>
                <input type="text" id="faculty" class="myInp" placeholder="Ֆակուլտետ">
                <button type="button" class="myBtn">Ավելացնել</button>
            </div>
            <div class="faculties mt-5">
                <div class="header d-flex">
                    <div><b>Id</b></div>
                    <div><b>Անուն</b></div>
                    <div><b>Փոխել</b></div>
                    <div><b>Ջնջել</b></div>
                </div>

            </div>
        </div>
    </div>
</div>