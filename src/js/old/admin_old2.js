const overlay = document.getElementById("overlay");
const adminButton = document.querySelector(".adminButton img");
const popup = document.querySelectorAll(".adminPopup");
const cards = document.getElementsByClassName('.cards');
const exit = document.querySelectorAll(".adminPopup .exit");

const defaultDisplay = document.getElementById("defaultDisplay");
const adminDisplay = document.getElementById("adminDisplay");
const noAdminDisplay = document.getElementById("noAdminDisplay");

const adminCard = document.querySelectorAll(".adminPopup .cards .admin");
const noAdminCard = document.querySelectorAll(".adminPopup .cards .noAdmin");

let adminPass = "Password123";
const pass = document.getElementById("passwordInput");
const passConfirm = document.getElementById("adminConfirm");

console.log('javascript working');

function hide(element) {
    element.classList.add('hidden');
    element.classList.remove('flex');
    return;
}

function show(element) {
    element.classList.remove('hidden');
    element.classList.add('flex');
    return;
}

function toggle(element) {
    element.classList.toggle('hidden');
    element.classList.toggle('flex');
}

adminButton.addEventListener("click", () => {
    toggle(overlay);
    toggle(defaultDisplay);
    toggle(cards);
});

exit.forEach(exit => {
    exit.addEventListener("click", () => {
        toggle(overlay);
        if (defaultDisplay.classList.contains('flex')) {
            toggle(defaultDisplay);
            toggle(cards);
        } else if (adminDisplay.classList.contains('flex')) {
            toggle(adminDisplay);
        } else if (noAdminDisplay.classList.contains('flex')) {
            toggle(noAdminDisplay);
        }
    });
});

adminCard.forEach(card => {
    card.addEventListener("click", () => {
        toggle(defaultDisplay);
        toggle(cards);
        toggle(adminDisplay);
    });
});

noAdminCard.forEach(card => {
    card.addEventListener("click", () => {
        toggle(defaultDisplay);
        toggle(cards);
        toggle(noAdminDisplay);
    });
})

passConfirm.addEventListener("click", () => {
    if (pass.value === adminPass) {
        console.log("password correct!");
    } else {
        console.log("password incorrect.");
    }
});