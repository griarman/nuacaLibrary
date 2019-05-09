$(document).ready(function(){
    $('.myBtn').click(function(){
       let th = $(this);
       let name = th.closest('#addInputs').find('.myInp').val().trim();
       let facultyId = +$('#faculty').val();
       if(!name || !name.length || !facultyId){
           Swal.fire(
               'Լրացրեք անունը և ընտրեք ֆակուլտետը!',
               'Այս պայմաններն պարտադիր են!',
               'error'
           );
           return;
       }
       if(!checkName(name)) return;
       myAjax('/nuacaLibrary/ChairsController/addChair',{ name, facultyId });
    });
    $('.chairEdit').click(editChair);
    $('.chairDel').click(delChair);
    $('.facultyHeader').click(function(){
        let th = $(this);
        th.find('.closed').toggleClass('opened');
        th.next().slideToggle('500')
    });
    function myAjax(url , data, dataType = 'html'){
        $.ajax({
            url,
            method:'post',
            dataType,
            data
        }).done((res) => {
            if(url === '/nuacaLibrary/ChairsController/addChair'){
                addChair(res, data);
            }
            else if(url === '/nuacaLibrary/ChairsController/delChair')
            {
                if(res === 'error'){
                    Swal.fire(
                        'Կներեք ջնջել չհաջողվեց!',
                        'Փորձեք նորից մի փոքր ուշ!',
                        'error'
                    );
                    return;
                }
                delChairDone(data.id);
            }
            else if(url === '/nuacaLibrary/ChairsController/updChair') {
                if(res === 'error'){
                    Swal.fire(
                        'Կներեք փոփոխությունն չհաջողվեց!',
                        'Փորձեք նորից մի փոքր ուշ!',
                        'error'
                    );
                    return;
                }
                else if(res === 'error2'){
                    Swal.fire(
                        'Ոչ թույլատրելի սիմվոլներ!',
                        'Թույլատրվում են միայն ա-ֆ, 0-9 ',
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
                console.log(res);
                Swal.fire(
                    'Ամբիոնի անունը փոխված է!',
                    '',
                    'success'
                );
                updFacultyDone(data.id);
            }
        })
    }
    function addChair(res, data){
        if(res === 'exists'){
            Swal.fire(
                'Նման անունով ամբիոն գոյություն ունի!',
                'Փորձեք մեկ այլ անուն!',
                'error'
            );
            return;
        }
        else if(res === 'error1'){
            Swal.fire(
                'Լրացրեք անունը և ընտրեք ֆակուլտետը!',
                'Այս պայմաններն պարտադիր են!',
                'error'
            );
            return;
        }
        else if(res === 'error2'){
            Swal.fire(
                'Ոչ թույլատրելի սիմվոլներ!',
                'Թույլատրվում են միայն ա-ֆ, 0-9 և նվազագույնը 4 սիմվոլ',
                'error'
            );
            return;
        }
        Swal.fire(
            'Ամբիոնն ավելացված է!',
            '',
            'success'
        );
        $(`#faculty-${data.facultyId}`).next().append(`
            <div id="chair-${res}" class="mainChairs">
                <section>
                    <div class="chairName">${data.name}</div>
                    <div class="changing"></div>
                </section>
            </div>
        `);
        let edit = $(`<div class="chairEdit" title="Փոխել"><i class="fas fa-pen-alt"></i></div>`);
        let del = $(`<div class="chairDel" title="Ջնջել"><i class="fas fa-trash-alt"></i></div>`);
        $(`#chair-${res}`).find('.changing').append(edit, del);
        edit.click(editChair);
        del.click(delChair);
        $('.myInp').val('')
    }
    function editChair(){
        let th = $(this);
        let chair = th.closest('.mainChairs');
        let nameTag = chair.find('.chairName');
        if(!th.hasClass('save')){
            th.addClass('save');
            nameTag.attr('contenteditable', 'true');
            th.find('i').removeClass('fa-pen-alt').addClass('fa-save');
            return;
        }
        th.removeClass('save');
        Swal.fire({
            title: 'Վստա՞հ եք որ ուզում եք փոխել անունը',
            text: "Դուք այն անվերադարձ կփոխարինեք!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Այո փոխել!',
            cancelButtonText: 'Ոչ'
        }).then((result) => {
            if (result.value) {
                let id = chair.attr('id').split('-')[1];
                let name = nameTag.text().trim();
                if(!name){
                    Swal.fire(
                        'Անունը դատարկ լինել չի կարող!',
                        '',
                        'error'
                    );
                    return;
                }
                checkName(name);
                myAjax('/nuacaLibrary/ChairsController/updChair', { id, name });
            }
        });
    }
    function updFacultyDone(id){
        let el = $(`#chair-${id}`);
        console.log(el);
        el.find('.chairEdit').removeClass('save');
        el.find('.chairName').removeAttr('contenteditable');
        el.find('.chairEdit').find('i').addClass('fa-pen-alt').removeClass('fa-save');
        Swal.fire(
            'Փոփոխված է!',
            'Անունը փոփոխվել է.',
            'success'
        )
    }
    function delChair(){
        let th = $(this);
        Swal.fire({
            title: 'Վստա՞հ եք',
            text: "Դուք այն անվերադարձ կջնջեք!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Այո ջնջել!',
            cancelButtonText: 'Ոչ'
        }).then((result) => {
            if (result.value) {
                let chair = th.closest('.mainChairs');
                let id = chair.attr('id').split('-')[1];
                myAjax('/nuacaLibrary/ChairsController/delChair', { id })
            }
        });
    }
    function  delChairDone(id){
        Swal.fire(
            'Ջնջված է!',
            '',
            'success'
        );
        $(`#chair-${id}`).remove();
    }
    function checkName(name){
        // console.log(!(/^[ա-ֆ\s0-9]{4,150}$/i.test(name)));
        if(!(/^[ա-ֆ\s]{4,150}$/i.test(name))){
            Swal.fire(
                'Ոչ թույլատրելի սիմվոլներ!',
                'Թույլատրվում են միայն ա-ֆ, 0-9 և նվազագույնը 4 սիմվոլ',
                'error'
            );
            return false;
        }
        return true
    }
});
