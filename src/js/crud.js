const button = document.querySelectorAll('.selectButton');

function visibility(element) {
    element.classList.toggle('hidden');
}

button.forEach(btn => {
    const textInput = document.querySelector('.textInput');
    btn.addEventListener('click', (e) => {
        visibility(textInput);
        btn.textContent = button.textContent === "New Author" ? "Select Author" : "New Author";
    })
})