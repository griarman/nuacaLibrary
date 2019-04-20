$(document).ready(function(){
    $('#enter').click(function(e){
        let tags = $('[myRequired]');
        if(!tags.eq(0).val().trim().length || !tags.eq(1).val().trim().length){
            Swal.fire(
                'Լրացրեք բոլոր դաշտերը!',
                'Շարունակելու համար սեխմեք ok կոճակը!',
                'error'
            );
            e.preventDefault();
        }
    })
});
