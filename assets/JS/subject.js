$(document).ready(function(){
    $('.myBtn').click(function(){
        let subject = $(this).closest('#addInputs').find('.myInp').val().trim();
        let chairId = +$('#selectChair')[0].value;
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
    $('#search').keyup(function(e){
        console.log(e);
       let text = $(this).val().trim();
       if(!(/^[ա-ֆ0-9\s]{0,150}$/i.test(text))) {
           Swal.fire(
               'Ոչ թույլատրելի սիմվոլներ!',
               'Թույլատրվում են միայն ա-ֆ, 0-9',
               'error'
           );
           $(this).val(text.slice(0, text.length - 1));
           return;
       }
       switch(e.which){
           case 9:
           case 16:
           case 17:
           case 18:
           case 13:
           case 37:
           case 38:
           case 39:
           case 40:
               return;
       }
        myAjax('/nuacaLibrary/SubjectController/searchSubjects', { text });
    });
    $('.show').click(showInfo);
    $('.editSubject').click(updateSubject);
    $('.delSubject').click(remSubject);

    function showInfo() {
        let faculty = $(this).find('.faculty').text().trim();
        let chair = $(this).find('.chair').text().trim();
        console.log(faculty, chair);
        Swal.fire({
            title: faculty,
            type: 'info',
            text: chair,
            confirmButtonText:'Լավ'
        })
    }
    function remSubject(){
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
                let subject = th.parent();
                let id = subject.attr('id').split('-')[1];
                myAjax('/nuacaLibrary/SubjectController/delSubject', { id })
            }
        });
    }
    function updateSubject() {
        let th = $(this);
        let subject = th.parent();
        let nameTag = subject.find('.subjectName');
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
                let id = subject.attr('id').split('-')[1];
                let name = nameTag.text().trim();
                // console.log(id, name);
                if(!name){
                    Swal.fire(
                        'Անունը դատարկ լինել չի կարող!',
                        '',
                        'error'
                    );
                    return;
                }
                checkName(name);
                myAjax('/nuacaLibrary/SubjectController/updSubject', { id, name });
            }
        });
    }
    function checkName(name){
        if(!(/^[ա-ֆ\s0-9]{4,150}$/i.test(name))){
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
            switch(url){
                case '/nuacaLibrary/SubjectController/addSubject':
                    addSubject(res, data);
                    break;
                case '/nuacaLibrary/SubjectController/delSubject':
                    delSubject(res, data.id);
                    break;
                case '/nuacaLibrary/SubjectController/updSubject':
                    editSubject(res, data.id);
                    break;
                case '/nuacaLibrary/SubjectController/searchSubjects':
                    filterSubject(res);
                    break;
            }
        })
    }
    function addSubject(res, data){
        if(res === 'exists'){
            Swal.fire(
                'Նման անունով առարկա գոյություն ունի!',
                'Փորձեք մեկ այլ անուն!',
                'error'
            );
            return;
        }
        else if(res === 'error1'){
            Swal.fire(
                'Լրացրեք անունը և ընտրեք ամբիոնը!',
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
            'Առարկան ավելացված է!',
            '',
            'success'
        );
        res = JSON.parse(res);
        $('tbody').append(`
            <tr id="subject-${res['id']}" class="subjects">
                <td class="subjectName">${data.subject}</td>
            </tr>
        `);
        let show = $(`
            <td class="show"><i class="fas fa-eye" title="Ցույց տալ"></i>
                <div class="parents">
                    <div class="faculty">${res['fName']}</div>
                    <div class="chair">${res['cName']}</div>
                </div>
            </td>`);
        let edit = $(`<td class="editSubject"><i class="fas fa-pen-alt" title="Փոխել"></i></td>`);
        let del = $(`<td class="delSubject"><i class="fas fa-trash-alt" title="Ջնջել"></i></td>`);
        $(`#subject-${res['id']}`).append(show,edit, del);
        show.click(showInfo);
        edit.click(updateSubject);
        del.click(remSubject);
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
        let el = $(`#subject-${id}`);
        el.remove();
    }
    function updSubjectDone(id){
        let el = $(`#subject-${id}`);
        el.find('.editSubject').removeClass('save');
        el.find('.subjectName').removeAttr('contenteditable');
        el.find('.editSubject').find('i').addClass('fa-pen-alt').removeClass('fa-save');
        Swal.fire(
            'Փոփոխված է!',
            'Անունը փոփոխվել է.',
            'success'
        )
    }
    function filterSubject(res){
        if(res === 'error'){
            Swal.fire(
                'Ոչ թույլատրելի սիմվոլներ!',
                'Թույլատրվում են միայն ա-ֆ, 0-9',
                'error'
            );
            return;
        }
        res = JSON.parse(res);
        let tbody = $('tbody');
        tbody.empty();
        for(let i = 0; i < res.length; i++){
            tbody.append(`
                <tr id="subject-${res[i].id}" class="subjects">
                    <td class="subjectName">${res[i].name}</td>
                </tr>
            `);
            let show = $(`
                <td class="show"><i class="fas fa-eye" title="Ցույց տալ"></i>
                    <div class="parents">
                        <div class="faculty">${res[i].parents.fName}</div>
                        <div class="chair">${res[i].parents.cName}</div>
                    </div>
                </td>`);
            let edit = $(`<td class="editSubject"><i class="fas fa-pen-alt" title="Փոխել"></i></td>`);
            let del = $(`<td class="delSubject"><i class="fas fa-trash-alt" title="Ջնջել"></i></td>`);
            $(`#subject-${res[i].id}`).append(show,edit, del);
            show.click(showInfo);
            edit.click(updateSubject);
            del.click(remSubject);
        }
    }
});