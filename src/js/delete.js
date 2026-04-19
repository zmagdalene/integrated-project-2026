// let deleteElement = document.querySelectorAll('.container');
// // let deleteElement = document.querySelector('#book_cards');
let deleteDialog = document.querySelector('#deleteDlg');
let deleteBtn = document.querySelectorAll('a.delete');
let confirmBtn = document.querySelector('#confirmBtn');
let cancelBtn = document.querySelector('#cancelBtn');
let storyHeadline = document.querySelector('#dlgStoryHeadline');

let targetUrl = null;

if (deleteDialog !== null) {

    deleteBtn.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            target = btn;
            targetUrl = btn.href;
            storyHeadline.textContent = btn.dataset.headline;
            setTimeout(() => {
                deleteDialog.showModal();
            }, 300);
        })
    })
}

confirmBtn.addEventListener('click', () => {
    deleteDialog.close();
    setTimeout(() => {
        window.location = targetUrl;
    }, 300);
});
cancelBtn.addEventListener('click', () => {
    deleteDialog.close();
});
