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
        <div class="offset-md-3 col-md-9 col-sm mt-5 all">
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
                        <input type="text" class="myInp" placeholder="Ավելացնել առարկա">
                    </div>
                    <div><button class="myBtn">Ավելացնել</button></div>
                </div>
            </div>
            <div class="col-md mt-5 searchTag">
                <div class="searchHeader">Որոնել առարկա</div>
                <div class="searchInput"><input type="text" id="search" placeholder="Որոնել"></div>
            </div>
            <table id="showSubjects" class="table table-dark table-hover table-striped">
                <thead>
                    <tr class="subjects">
                        <th scope="col">#Առարկա</th>
                        <th scope="col">Ցույց տալ</th>
                        <th scope="col">Փոխել</th>
                        <th scope="col">Ջնջել</th>
                    </tr>
                </thead>
                <?php foreach ($subjects as $key => $value):?>
                    <tr id="subject-<?=$value['id']?>" class="subjects">
                        <td class="subjectName"><?= $value['name']?></td>
                        <td class="show"><i class="fas fa-eye" title="Ցույց տալ"></i>
                            <div class="parents">
                                <div class="faculty"><?=$value['parents']['fName']?></div>
                                <div class="chair"><?=$value['parents']['cName']?></div>
                            </div>
                        </td>
                        <td class="editSubject"><i class="fas fa-pen-alt" title="Փոխել"></i></td>
                        <td class="delSubject"><i class="fas fa-trash-alt" title="Ջնջել"></i></td>
                    </tr>
                <?php endforeach;?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
