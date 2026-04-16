let adminBtn = document.querySelector('#adminButton');
let adminDlg = document.querySelector('#adminPopup');
let cards = document.querySelector('#popupCards');
let popupText = document.querySelector('#popupText');
let icon = document.querySelector('#popupIcon');
let input = document.querySelector('#popupInput');
let adminMode = document.querySelectorAll('#adminMode');

let adminPass = 'Password123';
let target = null;
let card = null;
let type = null;

function resetAdminPopup() {
    type = 'default';
    popupText.textContent = '';
    cards.style.display = '';
    icon.className = '';
    input.innerHTML = '';
}

function passCheck() {
    let passInput = input.querySelector('#passInput');
    let passError = input.querySelector('.passError');

    console.log('clicked confirm button');

    if (!passInput) {
        return;
    }

    if (!passError) {
        return;
    }

    if (passInput.value === adminPass) {
        adminDlg.close();
        adminMode.forEach(adminControl => {
            visibility(adminControl);
        })

    } else {
        show(passError);
    }
}

adminBtn.addEventListener('click', () => {
    adminDlg.showModal();
    console.log('clicked!');
})

adminDlg.addEventListener('click', (e) => {
    target = e.target;

    if (target.closest('.exit')) {
        adminDlg.close();
        type = 'default';
        return;
    }

    if (target.closest('#passConfirm')) {
        passCheck();
        return;
    }

    card = target.closest('.card');
    if (!card) return;

    type = card.dataset.type;

    if (!adminDlg.open) {
        type = 'default';
    }

    let popupDisplay = type === 'admin' ? popupData.adminDisplay : popupData.noAdminDisplay;

    popupText.textContent = popupDisplay.text;
    cards.style.display = 'none';
    icon.className = popupDisplay.icon || '';

    if (popupDisplay.adminConfirm) {
        input.innerHTML = `
                <input type="text"id="passInput" placeholder="Enter password">
                <button id="passConfirm" class="button">${popupDisplay.adminConfirm}</button>
                <p class="error passError hidden">Password Incorrect.</p>
            `;
    } else {
        input.innerHTML = '';
    }
})

adminDlg.addEventListener('close', resetAdminPopup);
console.log('jVA');



// if (deleteElement !== null && deleteDialog !== null) {
//     let target = null;
//     let card = null;

//     deleteElement.addEventListener('click', function (e) {
//         target = e.target;
//         card = target.closest('.book');

//         let deleteBtn = target.closest('.deleteBtn');
//         highlight(card);

//         if (deleteBtn !== null) {
//             e.preventDefault();
//             bookTitle.textContent = card.dataset.title;
//             setTimeout(() => {
//                 deleteDialog.showModal();
//             }, 300);
//         }
//     });

//     confirmBtn.addEventListener('click', function (e) {
//         deleteDialog.close();
//         setTimeout(() => {
//             window.location = target.href;
//         }, 300);
//     });
//     cancelBtn.addEventListener('click', function (e) {
//         deleteDialog.close();
//         highlight(card);
//     });
// }