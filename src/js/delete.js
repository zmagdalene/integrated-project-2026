let deleteElement = document.querySelector('#book_cards');
let deleteDialog = document.querySelector('#deleteDlg');
let confirmBtn = document.querySelector('#confirmBtn');
let cancelBtn = document.querySelector('#cancelBtn');
let bookTitle = document.querySelector('#dlgBookTitle');

if (deleteElement !== null && deleteDialog !== null) {
    let target = null;
    let card = null;

    deleteElement.addEventListener('click', function (e) {
        target = e.target;
        card = target.closest('.book');

        let deleteBtn = target.closest('.deleteBtn');
        highlight(card);

        if (deleteBtn !== null) {
            e.preventDefault();
            bookTitle.textContent = card.dataset.title;
            setTimeout(() => {
                deleteDialog.showModal();
            }, 300);
        }
    });

    confirmBtn.addEventListener('click', function (e) {
        deleteDialog.close();
        setTimeout(() => {
            window.location = target.href;
        }, 300);
    });
    cancelBtn.addEventListener('click', function (e) {
        deleteDialog.close();
        highlight(card);
    });
}

deleteDialog.showModal();