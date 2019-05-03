<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
    <link rel="icon"  href="../favicon.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/adminMenu.css">
    <link rel="stylesheet" href="../assets/css/subject.css">
    <link rel="stylesheet" href="../assets/fonts/css/all.min.css">
    <script src="../assets/JS/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/sweetAlert.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/subject.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php require_once 'menu.php' ?>
        <div class="col-md-7 col-sm mt-5">
            <div id="addSubject">
                <div class="header text-center">Ավելացնել Առարկա</div>
                <div id="addInputs">
                    <div>
                        <select name="" id="selectChair" title="Ընտրել ամբիոն">
                            <option value="0" selected disabled>Ընտրել ամբիոն</option>
                            <?php foreach($chairs as $key => $value):
                                $name = $value['name'];
                                str_replace([',',' '],'', substr($name, 0, 40),$count);
                                $str = (strlen($name) > 40)? substr($name, 0, 38 + $count).'...' : $name; ?>
                                <option title="<?= $name?>" value="<?= $value['id']?>"><?= $str?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div>
                        <input type="text" class="myInp">
                    </div>
                    <div><button class="myBtn">Ավելացնել</button></div>
                </div>
            </div>
            <table id="showSubjects">
                <tr class="subjects">
                    <th>Առարկա</th>
                    <th>Ցույց տալ</th>
                    <th>Փոխել</th>
                    <th>Ջնջել</th>
                </tr>
                <?php foreach ($subjects as $key => $value):?>
                    <tr id="subject-<?=$key?>" class="subjects">
                        <td class="subjectName"><?= $value['name']?></td>
                        <td class="show"><i class="fas fa-eye" title="Ցույց տալ"></i></td>
                        <td class="editSubject"><i class="fas fa-pen-alt" title="Փոխել"></i></td>
                        <td class="delSubject"><i class="fas fa-trash-alt" title="Ջնջել"></i></td>
                    </tr>
                <?php endforeach;?>
            </table>
        </div>
        <div class="col-md mt-5 searchTag">
            <div class="searchHeader">Որոնել առարկա</div>
            <div><input type="text" id="search" placeholder="Որոնել"></div>
        </div>
    </div>
</div>
</body>
</html>
