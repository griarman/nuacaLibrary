<?php
    $arr = ['home', 'chairs', 'subject', 'books', 'students'];
    $path =  explode('/' ,$_SERVER['PATH_INFO'])[2];
    $pages = [
      ["home" , 'Ավելացնել ֆակուլտետ' ],
      ["chairs" , 'Ավելացնել ամբիոն'],
      ["subject" , 'Ավելացնել առարկա '],
      ["books" , 'Ավելացնել գիրք '],
//      ["student" , ' Ավելացնել ուսանող ']
    ];
?>
<div class="col-md-3 menu col-sm">
    <div>
        <div class="header">
            <div>
                <b><i class="fas fa-cog"></i> Մենյու</b>
            </div>
            <div><a href="exit"><i class="fas fa-sign-out-alt" title="Դուրս գալ"></i></a> </div>
            </div>
        </div>
    <?php foreach($pages as $key => $value):
        $active = ($key === array_search($path, $arr))? 'active': '';
        ?>
    <section class="<?=$active?>">
        <a href="<?= $value[0]?>"><i class="fas fa-plus"></i><?= $value[1] ?></a>
    </section>
    <?php endforeach;?>
</div>
