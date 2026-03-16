const admin_overlay = document.querySelector(".admin_overlay")
const overlay_display = document.querySelector(".admin_content .hiddenText")
const adminButton = document.querySelector(".adminButton img")
const exit = document.querySelector(".admin_content .hiddenText .exit")

admin_overlay.style.display = "none"
overlay_display.style.display = "none"

adminButton.addEventListener("click", () => {
    admin_overlay.style.display = "flex"
    overlay_display.style.display = "flex"
})

exit.addEventListener("click", () => {
    admin_overlay.style.display = "none"
    overlay_display.style.display = "none"
})



