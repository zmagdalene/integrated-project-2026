function visibility(element) {
    element.classList.toggle('hidden');
}

const formRow = document.querySelectorAll('.formRow').forEach(row => {
    const btn = row.querySelector('.selectButton');
    const textInputS = row.querySelectorAll('.textInput');
    const inputSelect = row.querySelector('.inputSelect');

    btn.addEventListener('click', () => {
        visibility(inputSelect);

        textInputS.forEach(Input => {
            visibility(Input);
        })

        if (btn.textContent.includes("New")) {
            btn.textContent = btn.textContent.replace("New", "Select");
        } else {
            btn.textContent = btn.textContent.replace("Select", "New");
        }
    })
})

// buttons.forEach(btn => {
//     const textInput = document.querySelector('.textInput');
//     btn.addEventListener('click', (e) => {
//         visibility(textInput);
//         if (btn.textContent === "New Author") {
//             btn.textContent = "Select Author"
//         } else {
//             btn.textContent = "New Author";
//         }
//     })
// })