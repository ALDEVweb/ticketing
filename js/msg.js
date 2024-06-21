let cloture = document.getElementById("cloture");
let confirme = document.getElementById("confirm");
let annule = document.getElementById("annule");

cloture.addEventListener("click", (e) => {
    confirme.classList.remove("d-none");
})

annule.addEventListener("click", (e) => {
    confirme.classList.add("d-none");
})

// appel le controleur ajax de surveillance des message
let listMsg = document.getElementById("listMsg");


function surveilleMsg(){
    fetch("surveiller_msg.php")
    .then(resp => {
        return resp.text();
    })
    .then(retour => {
        listMsg.innerHTML = retour;
    })
}
surveilleMsg();
setInterval(surveilleMsg, 3000);