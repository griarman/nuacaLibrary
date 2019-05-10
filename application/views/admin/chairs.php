<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
    <link rel="icon"  href="../favicon.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/adminMenu.css">
    <link rel="stylesheet" href="../assets/css/chairs.css">
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/sweetAlert.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/chairs.js"></script>
    <link rel="stylesheet" href="../assets/fonts/css/all.min.css">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <?php require_once 'menu.php' ?>
        <div class="offset-md-3 col-md-9 col-sm mt-5">
            <div id="addChairs" class="mt-5">
                <div class="header text-center"><label for="l">Ավելացնել ամբիոն</label></div>
                <div id="addInputs">
                    <div>
                        <select id="faculty" title="Ընտրել ֆակուլտետ">
                            <option selected disabled value="0">Ընտրել ֆակուլտետ</option>
                            <?php foreach($faculties as $key => $value):?>
                                <option value="<?= $value['id']?>"><?= $value['name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div><input type="text" class="myInp" id="l"></div>
                    <div><button class="myBtn">Ավելացնել</button></div>
                </div>
            </div>
            <div id="showChairs" class="mt-3">
                <?php foreach($faculties as $key => $value):?>
                    <div id="faculty-<?= $value['id']?>" class="facultyHeader">
                        <nav>
                            <div>
                                <b><?= $value['name']?></b>
                            </div>
                            <div class="closed">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </nav>
                    </div>
                    <div class="chairs chairsClosed">
                        <?php foreach($value['chairs'] as $k => $v) :?>
                            <div id="chair-<?= $v['id']?>" class="mainChairs">
                                <section>
                                    <div class="chairName"><?= $v['name']?></div>
                                    <div class="changing">
                                        <div class="chairEdit" title="Փոխել"><i class="fas fa-pen-alt"></i></div>
                                        <div class="chairDel" title="Ջնջել"><i class="fas fa-trash-alt"></i></div>
                                    </div>
                                </section>
                            </div>
                        <?php endforeach;?>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
</body>
</html>