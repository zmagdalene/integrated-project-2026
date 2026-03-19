const overlay = document.getElementById("overlay");
const adminButton = document.querySelector(".adminButton img");
const popup = document.querySelectorAll(".adminPopup");
const exit = document.querySelectorAll(".adminPopup .exit");

const defaultDisplay = document.getElementById("defaultDisplay");
const adminDisplay = document.getElementById("adminDisplay");
const noAdminDisplay = document.getElementById("noAdminDisplay");

const adminCard = document.querySelector(".adminPopup .cards .admin");
const noAdminCard = document.querySelector(".adminPopup .cards .noAdmin");

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

hide(overlay);
hide(defaultDisplay);
hide(adminDisplay);
hide(noAdminDisplay);

adminButton.addEventListener("click", () => {
    show(overlay);
    show(defaultDisplay);
});

exit.forEach(exit => {
    exit.addEventListener("click", () => {
        hide(overlay);
        if (defaultDisplay.classList.contains('flex')) {
            hide(defaultDisplay);
        } else if (adminDisplay.classList.contains('flex')) {
            hide(adminDisplay);
        } else if (noAdminDisplay.classList.contains('flex')) {
            hide(noAdminDisplay);
        }
    });
});

adminCard.addEventListener("click", () => {
    hide(defaultDisplay);
    show(adminDisplay);
});

noAdminCard.addEventListener("click", () => {
    hide(defaultDisplay);
    show(noAdminDisplay);
});

passConfirm.addEventListener("click", () => {
    if (pass.value === adminPass) {
        console.log("password correct!");
    } else {
        console.log("password incorrect.");
    }
});