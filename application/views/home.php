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
                    <th scope="col">Կարճ նկարագրություն</th>
                    <th scope="col">Ներբեռնել</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $key => $value):?>
                <tr>
                    <th scope="row"><img src="./books/images/<?= $value['image']?>" alt="" width="100"></th>
                    <td title="<?= $value['name']?>"><?= $value['name']?></td>
                    <td title="<?= $value['author']?>"><?= $value['author']?></td>
                    <td title="Ցույց տալ">
                        <i class="fas fa-eye" title="Ցույց տալ"></i>
                        <div class="bookShow" style="display: none">
                            <div class="dateOfRelease"><?= $value['dateOfRelease']?></div>
                            <div class="addedDate"><?= $value['addedDate']?></div>
                            <div class="description"><?= $value['description']?></div>
                            <div></div>
                        </div>
                    </td>
                    <td><a href="./books/<?=$value['src']?>" download=""><i class="fas fa-download"></i></a></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<script src="./assets/js/user/home.js"></script>
<pre>
