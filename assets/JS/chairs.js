$(document).ready(function(){
    $('.myBtn').click(function(){
       let  th = $(this);
       let name = th.closest('#addInputs').find('.myInp').val().trim();
       let faculty = $('#faculty')[0].value;
       if(!name || !name.length || !faculty){
           Swal.fire(
               'Լրացրեք անունը և ընտրեք ֆակուլտետը!',
               'Այս պայմաններն պարտադիր են!',
               'error'
           );
           return;
       }
       myAjax('/nuacaLibrary/AdminController/addChairs',{ name, faculty });
    });
    $('.facultyHeader').click(function(){
        $(this).find('.closed').toggleClass('opened');
    });
    function myAjax(url , data, dataType = 'html'){
        $.ajax({
            url,
            method:'post',
            dataType,
            data
        }).done((res) => {
            if(url === '/nuacaLibrary/AdminController/addChairs'){

            }
            else if(url === '/nuacaLibrary/AdminController/delFaculty')
            {
                if(res === 'error'){
                    Swal.fire(
                        'Կներեք ջնջել չհաջողվեց!',
                        'Փորձեք նորից մի փոքր ուշ!',
                        'error'
                    );
                    return;
                }
                delFacultyDone(data.id);
            }
            else if(url === '/nuacaLibrary/AdminController/updFaculty')
            {
                if(res === 'error'){
                    Swal.fire(
                        'Կներեք փոփոխությունն չհաջողվեց!',
                        'Փորձեք նորից մի փոքր ուշ!',
                        'error'
                    );
                    return;
                }
                else if(res === 'error1'){
                    Swal.fire(
                        'Նման անունով ֆակուլտետ արդեն գոյություն ունի!',
                        'Փորձեք մեկ այլ անուն!',
                        'error'
                    );
                    return;
                }
                updFacultyDone(data.id);
            }
        })
    }

});
