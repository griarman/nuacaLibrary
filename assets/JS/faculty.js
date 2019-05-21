$(document).ready(function(){
    $('#faculty').change(function(){
        let text = $(this).val().trim();
        $(this).val(text[0].toUpperCase()+text.substr(1));
    });
    $('#addFaculty').click(function(){
        let newFaculty = $(this).prev().val().trim();
        if(!newFaculty || !newFaculty.length ){
            Swal.fire(
                'Լրացրեք անունը!',
                'Այս պայմանը պարտադիր է!',
                'error'
            );
            return;
        }
        if(!checkName(newFaculty)) return;
        if(!newFaculty) {
            Swal.fire(
                'Լրացրեք ֆակուլտետի անունը!',
                'Դատարկ տեքստ ավելացնել չի թույլատրվում',
                'error'
            );
            return;
        }
        myAjax('/nuacaLibrary/FacultyController/addFaculty', { newFaculty });
    });
    $('.del').click(delFaculty);
    $('.edit').click(updFaculty);
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
            if(url === '/nuacaLibrary/FacultyController/addFaculty'){
                addFaculty(res.trim(), data.newFaculty);
            }
            else if(url === '/nuacaLibrary/FacultyController/delFaculty')
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
            else if(url === '/nuacaLibrary/FacultyController/updFaculty')
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

    function addFaculty(res, name){
        if(res === 'exists'){
            Swal.fire(
                'Նման անունով ֆակուլտետ գոյություն ունի!',
                'Փորձեք մեկ այլ անուն',
                'error'
            );
            return;
        }
        let tag = $('.id');
        let i = +tag.eq(tag.length - 1).text().trim();
        let faculties = $('.faculties');
        let faculty = $(`<div class="faculty d-flex" id="${res}"></div>`);
        let id = $(`<div class="id">${i + 1}</div>`);
        let facultyName = $(`<div class="facultyName">${name}</div>`);
        let edit = $(`<div class="edit"><i class="fas fa-pen-alt"></i></div>`);
        let del = $(`<div class="del"><i class="fas fa-trash-alt"></i></div>`);
        del.click(delFaculty);
        edit.click(updFaculty);
        faculties.append(faculty.append(id, facultyName, edit, del));
        $('#addFaculty').prev().val('');
    }
    function updFaculty(){
        let th = $(this);
        let parentDiv = th.closest('.faculty');
        let facultyName = parentDiv.find('.facultyName');

        if(!th.hasClass('save')){
            th.addClass('save');
            facultyName.attr('contenteditable', 'true');
            th.find('i').removeClass('fa-pen-alt').addClass('fa-save');
            return;
        }
        th.removeClass('save');
        Swal.fire({
            title: 'Վստա՞հ եք',
            text: "Դուք այն անվերադարձ կփոխարինեք!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Այո փոխել!',
            cancelButtonText: 'Ոչ'
        }).then((result) => {
            if (result.value) {
                let name = facultyName.text().trim();
                if(!name){
                    Swal.fire(
                        'Անունը դատարկ լինել չի կարող!',
                        '',
                        'error'
                    );

                    return;
                }
                let id = parentDiv.attr('id');
                myAjax('/nuacaLibrary/FacultyController/updFaculty', { id, name });
            }
        });
    }
    function updFacultyDone(id){
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
    function delFaculty(){
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
                let parentDiv = $(this).closest('.faculty');
                let id = parentDiv.attr('id');
                myAjax('/nuacaLibrary/FacultyController/delFaculty', { id })
            }
        });

    }

    function delFacultyDone(id){
        Swal.fire(
            'Ջնջված է!',
            '',
            'success'
        );
        $(`#${id}`).remove();
    }
});
