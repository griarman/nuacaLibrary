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
            cancelButtonText: 'X',
            showConfirmButton: true,
            showCancelButton: true,

        }).then((result)=>{
            if(result.value){
                let releaseDate = $('#releaseDate').val(),
                    subjectSel = $('#subjectSel').val(),
                    bookName = $('#bookName').val().trim(),
                    authorName = $('#authorName').val().trim();
                // console.log(releaseDate, subjectSel, bookName , !authorName);
                console.log(subjectSel)
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
                        dataType:'json',
                        data: {
                            bookName,
                            authorName,
                            releaseDate,
                            subjectSel
                        }

                    }).done(function(data){
                        if(data === 'error1'){
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Լրացրեք գոնե մեկ դաշտ'
                            });
                            return;
                        }
                        printBooks(data);
                    });
                }
            }
        })
    });
    $('#searchButton').click(function(){
        let text = $(this).prev().val().trim();
        if(!text) return;
        $.ajax({
            url: '/nuacaLibrary/search/simpleSearch',
            method: 'post',
            dataType:'json',
            data: {
                text
            }
        }).done(function(data){
            if(data === 'error') return;
            printBooks(data);
        });
    });
    function show(){
        let next = $(this).next();
        let dateOfRelease = next.find('.dateOfRelease').text().trim(),
            addedDate = next.find('.addedDate').text().trim(),
            description = next.find('.description').text().trim();
        Swal.fire({
            type: 'info',
            html:`
                <div>
                    <div class="d-flex justify-content-between">
                        <span class="abc"><b>Հրատարակում։ </b></span>
                        <span>${dateOfRelease}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span><b>Ավելացման օր։ </b></span>
                        <span>${addedDate}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span><b>Նկարագրություն։ </b></span>
                        <span>${description}</span>
                    </div>
                </div>  
           `,
            confirmButtonText: 'Լավ'
        })
    }
    function printBooks(data){
        let tbody = $('tbody');
        tbody.empty();
        for(let i = 0; i < data.length; i++) {
            let tr = $(`<tr></tr>`);
            let image = $(`<th><img src="./books/images/${data[i].image}" alt=""></th>`);
            let name = $(`<td>${data[i].name}</td>`);
            let author = $(`<td>${data[i].author}</td>`);
            let date = $(`<td title="Ցույց տալ"></td>`);
            let icon = $(`<i class="fas fa-eye" title="Ցույց տալ"></i>`);
            let bookShow = $(`
                <div class="bookShow" style="display: none">
                    <div class="dateOfRelease">${data[i].dateOfRelease}</div>
                    <div class="addedDate">${data[i].addedDate}</div>
                    <div class="description">${data[i].description}<?= $value['description']?></div>
                    <div></div>
                 </div>`
            );
            icon.click(show);
            date.append(icon, bookShow);
            let download = $(`<td><a href="./books/${data[i].src}" download><i class="fas fa-download"></i></a></td>`);
            tbody.append(tr.append(image, name, author, date, download));
        }
    }
});
