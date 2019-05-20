$(document).ready(function(){
    $('.chairs').click(function(){
        let next = $(this).next();
        next.hasClass('subjects')? next.toggleClass('subjectClosed'):"";
    });
    $('.subject').click(function(){
        let id = $(this).find('div').attr('id').split('-')[1];
        $.ajax({
            url: '/nuacaLibrary/Search/searchBySubject',
            method: 'post',
            dataType: 'json',
            data: {
                id
            }
        }).done(function(data){
            printBooks(data);
        })
    });
    function printBooks(data){
        let tbody = $('tbody');
        tbody.empty();
        for(let i = 0; i < data.length; i++) {
            let tr = $(`<tr></tr>`);
            let image = $(`<th><img src="./books/images/${data[i].image}" alt=""></th>`);
            let name = $(`<td>${data[i].name}</td>`);
            let author = $(`<td>${data[i].author}</td>`);
            let date = $(`
                    <td title="Ցույց տալ">
                        <i class="fas fa-eye" title="Ցույց տալ"></i>
                        <div class="bookShow" style="display: none">
                            <div class="dateOfRelease">${data[i].dateOfRelease}</div>
                            <div class="addedDate">${data[i].addedDate}</div>
                            <div class="description">${data[i].description}<?= $value['description']?></div>
                            <div></div>
                        </div>
                    </td>
            `);
            let download = $(`<td><a href="./books/${data[i].src}" download><i class="fas fa-download"></i></a></td>`);
            tbody.append(tr.append(image, name, author, date, download));
        }
    }
});
