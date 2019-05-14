$(document).ready(function(){
    $('.chairs').click(function(){
        let next = $(this).next();
        next.hasClass('subjects')? next.toggleClass('subjectClosed'):"";
    });
    $('.subject').click(function(){
        let id = $(this).find('div').attr('id').split('-')[1];
        console.log(id);
        $.ajax({
            url: '/nuacaLibrary/'
        })
    })
});
