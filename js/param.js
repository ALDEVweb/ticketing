let param = document.getElementById("param");
let menu = document.getElementById("menu");
let closeMenu = document.getElementById("closeMenu");

param.addEventListener("click", (e) =>{
    menu.classList.remove("d-none");
})

closeMenu.addEventListener("click", (e) => {
    menu.classList.add("d-none");
})