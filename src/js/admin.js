const overlay = document.getElementById("overlay");
const adminButton = document.querySelectorAll(".adminButton img");
const popup = document.querySelectorAll(".adminPopup");
const exit = document.querySelectorAll(".adminPopup .exit");

const adminDisplay = document.getElementById(".adminDisplay .exit");
const noAdminDisplay = document.getElementById(".noAdminDisplay");

const adminCard = document.querySelectorAll(".adminPopup .cards .admin");
const noAdminCard = document.querySelectorAll(".adminPopup .cards .noAdmin");

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
hide(adminDisplay);
hide(noAdminDisplay);

adminButton.addEventListener("click", () => {
    show(overlay);
})

exit.addEventListener("click", () => {
    hide(overlay);
})

adminCard.addEventListener("click", () => {
    show(adminDisplay);
})

