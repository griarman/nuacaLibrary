$(document).ready(function(){
    $('#keyWord').keyup(function(e){
        let text = $(this).val().trim();
        let keyWords = $('#keyWords');
        if(e.which === 13 && checkName(text) && keyWords.children().length < 15){
            let div = $(`<div class="keyTag">${text}</div>`);
            let del = $('<i class="fas fa-trash-alt del"></i>');
            keyWords.append(div.append(del));
            $(this).val('');
            del.click(function(){
                $(this).parent().remove();
            })
       }
       if(keyWords.children().length >= 15){
           Swal.fire(
               "Առավելագույնը 15 բանալի բառ",
               'Դուք լրացրել եք առավելագույն քանակությամբ բանալի բառեր ',
               'error'
           );
       }
    });
    $('#addImage').change(function(){
        let image = $(this)[0].files[0];
        if(!image){
            $('#addImageLabel img').attr('src', '../assets/images/choose Image.png');
            return;
        }
        if (!image.type.match('image.*')) {
            Swal.fire(
                'Սխալ ֆորմատ',
                "Միայն նկար...",
                'error'
            );
            return;
        }
        let file = new FileReader();
        file.onload = function() {
            return function(e) {
                $('#addImageLabel img').attr('src', e.target.result);
            };
        }(image);
        file.readAsDataURL(image);

    });
    $('#addBookFile').change(function () {
        let file = this.files[0];
        let fileName = $('#fileName');
        if(!file){
            this.value = '';
            fileName.text('');
            return;
        }
        if(file.type !== "application/pdf") {
            Swal.fire(
                'Սխալ ֆորմատ',
                "Միայն PDF ֆորմատի ֆայլ...",
                'error'
            );
            this.value = '';
            return;
        }
        fileName.text(file.name);
    });
    $('#sendBook').click(function(){
        let arr = [];
        let name = $('#bookName').val().trim();
        let author = $('#authorName').val().trim();
        let description = $('#description').val().trim();
        let subjects = $('#subjects').val();
        let yearTag = $('#year');
        let year = yearTag.val() ? yearTag.val().trim(): null;
        let keyWords = $('#keyWords').children();
        let image = $('#addImage')[0].files;
        let file = $('#addBookFile')[0].files;
        keyWords.each(function(i, el){
            checkName($(el).text().trim()) ? arr.push($(el).text().trim()): '';
        });
        switch(true){
            case !checkFields(name):
            case !checkFields(author):
            case !checkFields(description):
            case !subjects.length:
            case !year:
            case !file.length:
                Swal.fire(
                    'Ճիշտ լրացրեք բոլոր դաշտերը և ընտրեք ֆայլը',
                    "Թույլատրվում են միայն ա-ֆ,a-z,а-я 0-9",
                    'error'
                );
                return;
        }
        let form = new FormData();

        form.append('name', name);
        form.append('author', author);
        form.append('description', description);
        form.append('subjects', subjects);
        form.append('year', year);
        form.append('file', file[0]);
        form.append('keyWords', JSON.stringify(arr));
        if(image.length) form.append('image', image[0]);
        $.ajax({
            url:'/nuacaLibrary/BookController/addBook',
            method:'post',
            data:form,
            cache:false,
            processData:false,
            contentType:false
        }).done( data => {
            if (data === 'error1'){

            }else if(data === 'error2'){

            }
        })
    });
    function checkFields(field) {
        return /^[ա-ֆa-zа-я\s0-9]{4,150}$/i.test(field);
    }
    function checkName(name){
        if(!(/^[ա-ֆa-zа-я\s0-9\.]{4,150}$/i.test(name))){
            Swal.fire(
                'Ոչ թույլատրելի սիմվոլներ!',
                'Թույլատրվում են միայն ա-ֆ,a-z,а-я 0-9',
                'error'
            );
            return false;
        }
        return true
    }
});
