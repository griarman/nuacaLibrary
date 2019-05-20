$(document).ready(function(){
    $('#more').click(function(){
        let date = '', subject = '', subjects = [];
        for(let i = 1901; i <= new Date().getFullYear(); i++){
            date += `<option value="${i}">${i}</option>`;
        }
        $('.subject').each(function(i, el){
            let element = $(el).find('div');
            let id = +element.attr('id').split('-')[1];
            let name = element.text();
            subjects.push([id, name]);
        });
        // console.log(subjects)
        for(let i = 0; i < subjects.length; i++){
            subject += `<option value="${subjects[i][0]}">${subjects[i][1]}</option>`
        }
        Swal.fire({
            title: 'Մանրամասն որոնում',
            type: 'question',
            html: `
                <div id="searchFields">
                    <div id="nameAuthor">
                        <div>
                            <label for="bookName">Գրքի անուն*</label>
                            <input class="form-control mr-sm-2" type="text" id="bookName" placeholder="Գրքի անուն">
                        </div>
                        <div>
                            <label for="authorName">Գրքի հեղինակ*</label>
                            <input class="form-control mr-sm-2" type="text" id="authorName" placeholder="Գրքի հեղինակ">
                        </div>
                    </div>   
                    <div id="dateSelect">
                        <label for="releaseDate">Ընտրեք հրատարակման տարին</label>
                        <select name="" id="releaseDate" class="form-control">
                            <option value="0" selected disabled>Ընտրեք հրատարակման տարին</option>
                            ${date}
                        </select>
                    </div>  
                    <div id="subjectSelect">
                        <label for="subjectSel">Ընտրեք առարկան</label>
                        <select id="subjectSel" class="form-control">
                            <option value="0" selected disabled>Ընտրեք առարկան</option>
                            ${subject}
                        </select>
                    </div>             
                </div>  `,
            confirmButtonText: 'Որոնել',
            showConfirmButton: true,

        })
            .then((result)=>{
                if(result.value){
                    let releaseDate = $('#releaseDate').val(),
                        subjectSel = $('#subjectSel').val(),
                        bookName = $('#bookName').val().trim(),
                        authorName = $('#authorName').val().trim();
                    if(!releaseDate && !subjectSel && !bookName && !authorName){
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Լրացրեք գոնե մեկ դաշտ'
                        });
                    }else{
                        $.ajax({
                            url: '/nuacaLibrary/search/advancedSearch',
                            method: 'post',
                            data: {
                                bookName,
                                authorName,
                                releaseDate,
                                subjectSel
                            }

                        }).done(function(){

                        });
                    }
                }
            })
    })
});
