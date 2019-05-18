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
    <link rel="stylesheet" href="../assets/css/books.css">
    <link rel="stylesheet" href="../assets/fonts/css/all.min.css">
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/sweetAlert.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/books.js"></script>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <?php require_once 'menu.php' ?>
        <div class="offset-md-3 col-md-9 col-sm mt-5">
            <div class="bookHeader text-center">Ավելացնել Գիրք</div>
            <div id="addBook">
                <div id="left">
                    <div class="subHeader">Ավելացնել ինֆորմացիա</div>
                    <div class="myRow">
                        <div>
                            <label for="bookName">Գրքի անուն*</label>
                            <input type="text" id="bookName" placeholder="Գրքի անուն">
                        </div>
                        <div>
                            <label for="authorName">Գրքի հեղինակ*</label>
                            <input type="text" id="authorName" placeholder="Գրքի հեղինակ">
                        </div>
                    </div>
                    <div class="myRow">
                        <div>
                            <label for="subjects">Ընտրել Առարկաներ*</label>
                            <select name="subjects[]" id="subjects" multiple size="4">
                                <?php foreach($subjects as $key => $value):?>
                                <option value="<?=$value['id']?>"><?=$value['name']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="myRow">
                        <div>
                            <label for="description">Կարճ նկարագրություն*</label>
                            <textarea name="description" id="description" placeholder="Կարճ նկարագրություն"></textarea>
                        </div>
                    </div>
                    <div class="myRow">
                        <div>
                            <label for="year">Ընտրել հրատարակման ամսաթիը*</label>
                            <select name="year" id="year">
                                <option value="0" selected disabled>Ընտրել հրատարակման ամսաթիվը</option>
                                <?php for($i = 1901; $i <= 2019; $i++) :?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                <?php endfor;?>
                            </select>
                        </div>
                        <div>
                            <label for="keyWord">Ավելացնել բանալի բառեր</label>
                            <input type="text" id="keyWord" placeholder="Ավելացնել բանալի բառեր">
                            <button><i class="fas fa-plus"></i></button>
                            <div id="keyWords"></div>
                        </div>
                    </div>
                </div>
                <div id="right">
                    <div class="subHeader">Ավելացնել ֆայլեր</div>
                    <div class="myRow myCenter">
                        <div>
                            <label for="addImage" id="addImageLabel" title="Ընտրել Նկար">
                                <div class="mb-2">Ընտրել Նկար</div>
                                <img src="../assets/images/choose Image.png" alt="Ընտրել Նկար" >
                            </label>
                            <input type="file" id="addImage">
                        </div>
                    </div>
                    <div class="myRow myCenter">
                        <div>
                            <label for="addBookFile" id="addFileLabel" title="Ընտրել գիրք">
                                <div>Ընտրել Գիրքը*</div>
                                <div class="mb-2">Միայն PDF տիպի ֆայլ</div>
                                <div class="icons">
                                    <i class="far fa-file-pdf"></i>
                                    <i class="fas fa-reply" id="myRotate"></i>
                                </div>
                            </label>
                            <input type="file" id="addBookFile">
                            <div id="fileName"></div>
                        </div>
                    </div>
                    <div class="myRow mt-5">
                        <div>
                            <button id="sendBook">Ավելացնել Գիրքը</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
