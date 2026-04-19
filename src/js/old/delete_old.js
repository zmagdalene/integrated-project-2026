// let deleteElement = document.querySelectorAll('.container');
// // let deleteElement = document.querySelector('#book_cards');
let deleteDialog = document.querySelector('#deleteDlg');
let confirmBtn = document.querySelector('#confirmBtn');
let cancelBtn = document.querySelector('#cancelBtn');
let storyHeadline = document.querySelector('#dlgStoryHeadline');

if (deleteDialog !== null) {
    let target = null;

    document.addEventListener('click', (e) => {
        target = e.target;
        let deleteBtn = target.closest('a.delete');

        if (deleteBtn !== null) {
            if (!deleteBtn.offSetParent) return;
            e.preventDefault();
            target = deleteBtn;
            console.log(deleteBtn.dataset.headline);
            storyHeadline.textContent = deleteBtn.dataset.headline;
            setTimeout(() => {
                deleteDialog.showModal();
            }, 300);
        }
    });

    confirmBtn.addEventListener('click', () => {
        deleteDialog.close();
        setTimeout(() => {
            window.location = target.href;
        }, 300);
    });
    cancelBtn.addEventListener('click', () => {
        deleteDialog.close();
    });
}