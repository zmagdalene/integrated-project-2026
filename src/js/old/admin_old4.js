const overlay = document.getElementById("overlay");
const adminButton = document.querySelector(".adminButton img");
const popup = document.querySelectorAll(".adminPopup");
const cards = document.querySelectorAll('.cards');
const exit = document.querySelectorAll(".adminPopup .exit");

// const defaultDisplay = document.getElementById("defaultDisplay");
const adminDisplay = document.getElementById("adminDisplay");
const noAdminDisplay = document.getElementById("noAdminDisplay");

const adminCard = document.querySelectorAll(".adminPopup .cards .admin");
const noAdminCard = document.querySelectorAll(".adminPopup .cards .noAdmin");

let adminPass = "Password123";
let currentState = "defaultDisplay";
const pass = document.getElementById("passwordInput");
const passConfirm = document.getElementById("adminConfirm");

console.log('javascript working');


function toggle(element) {
    element.classList.toggle('hidden');
    element.classList.toggle('flex');
}

function showPopup(state) {
    const target = document.getElementById(state);
    visibility(target);

    cards.forEach(card => {
        visibility(card);
    });

    if (state === "defaultDisplay") {
        visibility(overlay);
    }
    currentState = state;
}

exit.forEach(exit => {
    exit.addEventListener("click", () => {
        visibility(overlay);
        if (defaultDisplay.classList.contains('flex')) {
            visibility(defaultDisplay);
            visibility(cards);
        } else if (adminDisplay.classList.contains('flex')) {
            visibility(adminDisplay);
        } else if (noAdminDisplay.classList.contains('flex')) {
            visibility(noAdminDisplay);
        }
    });
});

adminCard.forEach(card => {
    card.addEventListener("click", () => {
        visibility(defaultDisplay);
        visibility(cards);
        visibility(adminDisplay);
    });
});

noAdminCard.forEach(card => {
    card.addEventListener("click", () => {
        visibility(defaultDisplay);
        visibility(cards);
        visibility(noAdminDisplay);
    });
})

passConfirm.addEventListener("click", () => {
    if (pass.value === adminPass) {
        console.log("password correct!");
    } else {
        console.log("password incorrect.");
    }
});