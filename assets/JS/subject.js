$(document).ready(function(){
    $('.myBtn').click(function(){
        let subject = $(this).closest('#addInputs').find('.myInp').val().trim();
        let chairId = $('#selectChair')[0].value;
        console.log(chairId);
        if(!subject || !chairId){
            Swal.fire(
                'Լրացրեք անունը և ընտրեք ամբիոնը!',
                'Այս պայմաններն պարտադիր են!',
                'error'
            );
            return;
        }
        if(!checkName(subject)) return;
        myAjax('/nuacaLibrary/SubjectController/addSubject', { subject, chairId });
    });
    function checkName(name){
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
    function myAjax(url , data, dataType = 'html'){
        $.ajax({
            url,
            method:'post',
            dataType,
            data
        }).done((res) => {
            switch(res){
                case '/nuacaLibrary/SubjectController/addSubject':
                    addSubject(res, data);
                    break;
                case '/nuacaLibrary/SubjectController/delSubject':
                    delSubject(res, data.id);
                    break;
                case '/nuacaLibrary/SubjectController/updSubject':
                    editSubject(res, data.id);
                    break;
            }
        })
    }
    function addSubject(res, data){
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
        return;
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
    function delSubject(res, id){
        if(res === 'error'){
            Swal.fire(
                'Կներեք ջնջել չհաջողվեց!',
                'Փորձեք նորից մի փոքր ուշ!',
                'error'
            );
            return;
        }
        delSubjectDone(id);
    }
    function editSubject(res, id){
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
        Swal.fire(
            'Առարկայի անունը փոխված է!',
            '',
            'success'
        );
        updSubjectDone(id);
    }
    function delSubjectDone(id) {

    }
    function updSubjectDone(){
        let el = $(`#${id}`);
        el.find('.edit').removeClass('save');
        el.find('.facultyName').removeAttr('contenteditable');
        el.find('.edit').find('i').addClass('fa-pen-alt').removeClass('fa-save');
        Swal.fire(
            'Փոփոխված է!',
            'Անունը փոփոխվել է.',
            'success'
        )
    }
});