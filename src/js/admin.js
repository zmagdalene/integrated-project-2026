let state = 'default';
let mode = 'user';

let adminBtn = document.querySelector('#adminButton');
let adminDlg = document.querySelector('#adminPopup');

let cards = document.querySelector('#popupCards');
let popupText = document.querySelector('#popupText');
let icon = document.querySelector('#popupIcon');
let input = document.querySelector('#popupInput');

let adminMode = document.querySelectorAll('.adminMode');

let adminPass = 'Password123';
let target = null;
let card = null;
let type = null;

function loadPopups() {
    const popup = popupData.popups;

    if (state === 'default') {
        const data = popup.default;
        popupText.textContent = data.text;
        show(cards);
        icon.className = data.icon;
        input.innerHTML = '';
    }

    if (state === 'login') {
        const data = popup.login;
        popupText.textContent = data.text;
        hide(cards);
        icon.className = data.icon;
        input.innerHTML = `
                <input type="text"id="passInput" placeholder="Enter password">
                <button id="passConfirm" class="button">${data.adminConfirm}</button>
                <p class="error passError hidden">Password Incorrect.</p>
            `;
    }

    if (state === 'noAdmin') {
        const data = popup.noAdmin;
        popupText.textContent = data.text;
        hide(cards);
        icon.className = data.icon;
        input.innerHTML = '';
    }

    if (state === 'admin') {
        const data = popupData.admin;
        mode = 'admin';
        popupText.textContent = data.text;
        show(cards);
        icon.className = data.icon;
        input.innerHTML = '';
        cards.innerHTML = '';

        for (const type in data.cards) {
            const item = data.cards[type];

            cards.innerHTML += `
        <a href="${item.href}" class="card-link">
            <div class="card" data-type="${type}">
                <i class="${item.icon}"></i>
                <h4>${item.text}</h4>
            </div>
        </a>`;
        }
    }
}

function loadState() {
    if (mode === 'admin') {
        state = 'admin';
    } else {
        state = 'default';
    }
}

adminBtn.addEventListener('click', () => {
    adminDlg.showModal();
    loadState();
    loadPopups();
})

adminDlg.addEventListener('click', (e) => {
    let target = e.target;

    if (target.closest('.exit')) {
        adminDlg.close();
        loadState();
        return;
    }

    if (target.closest('#passConfirm')) {
        let passInput = input.querySelector('#passInput');
        let passError = input.querySelector('.passError');

        console.log('clicked confirm button');

        if (!passInput) return;

        if (passInput.value === adminPass) {
            mode = 'admin';
            loadState();
            loadPopups();

            adminMode.forEach(adminControl => {
                visibility(adminControl);
            })
        } else {
            show(passError);
            return;
        }
        return;
    }
    card = target.closest('.card');
    if (!card || state !== 'default') return;
    type = card.dataset.type;

    if (type === 'login') {
        state = 'login';
    }

    if (type === 'noAdmin') {
        state = 'noAdmin';
    }

    loadPopups();
})

adminDlg.addEventListener('close', () => {
    loadState();
})