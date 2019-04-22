<?php
    $arr = ['home', 'chairs', 'subject', 'books', 'students'];
    $path =  explode('/' ,$_SERVER['PATH_INFO'])[2];
?>
<div class="col-md-2 menu">
    <div><b><i class="fas fa-cog"></i> Մենյու</b></div>
    <section><a href="home"><i class="fas fa-plus"></i> Ավելացնել ֆակուլտետ </a></section>
    <section><a href="#"><i class="fas fa-plus"></i> Ավելացնել ամբիոն </a></section>
    <section><a href="#"><i class="fas fa-plus"></i> Ավելացնել առարկա </a></section>
    <section><a href="#"><i class="fas fa-plus"></i> Ավելացնել գիրք </a></section>
    <section><a href="#"><i class="fas fa-plus"></i> Ավելացնել ուսանող </a></section>
</div>
<script>
    document.getElementsByTagName('section')[<?= array_search($path, $arr)?>].classList.add('active');
</script>