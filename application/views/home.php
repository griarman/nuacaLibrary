<div class="row mrg_top">
    <div class="col-md-4">
        <div class="accordion" id="accordionExample">
            <?php foreach ($faculties as $key => $value):?>
            <div class="card">
                <div class="card-header" id="heading<?= $key?>">
                    <h5 class="mb-0">
                        <button class="btn btn-link btn-left <?= ($key !== 0)? 'collapsed': '' ?>" type="button" data-toggle="collapse" data-target="#collapse<?= $key?>" aria-expanded="<?= ($key === 0)? 'true': 'false' ?>" aria-controls="collapse<?= $key?>">
                            <?= $value['name']?>
                        </button>
                    </h5>
                </div>

                <div id="collapse<?=$key?>" class="collapse <?= ($key === 0)? 'show': '' ?>" aria-labelledby="heading<?= $key?>" data-parent="#accordionExample">
                    <div class="card-body">
                        <ul>
                            <?php foreach ($value['chairs'] as $k => $v):?>
                                <li id="chair-<?= $v['id']?>" class="chairs"><?= $v['name']?></li>
                                <div class="subjects subjectClosed" >
                                    <?php foreach ($v['subjects'] as $kSub => $vSub): ?>
                                    <div class="subject">
                                        <i class="fas fa-angle-right"></i>
                                        <div id="subject-<?=$vSub['id']?>"><?=$vSub['name']?></div>
                                    </div>
                                    <?php endforeach;?>
                                </div>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
    <div class="col-md-8">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Նկար</th>
                    <th scope="col">Անուն</th>
                    <th scope="col">Հեղինակ</th>
                    <th scope="col">Տարեթիվ</th>
                    <th scope="col">Ներբեռնել</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><img src="assets/images/book-example.jpg" alt="" width="100"></th>
                    <td>Անուն</td>
                    <td>Հեղինակ</td>
                    <td>Ամբիոն</td>
                    <td><i class="fas fa-download"></i></td>
                </tr>
                <tr>
                    <th scope="row"><img src="assets/images/book-example.jpg" alt="" width="100"></th>
                    <td>Անուն</td>
                    <td>Հեղինակ</td>
                    <td>Ամբիոն</td>
                    <td><i class="fas fa-download"></i></td>
                </tr>
                <tr>
                    <th scope="row"><img src="assets/images/book-example.jpg" alt="" width="100"></th>
                    <td>Անուն</td>
                    <td>Հեղինակ</td>
                    <td>Ամբիոն</td>
                    <td><i class="fas fa-download"></i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script src="./assets/js/user/home.js"></script>