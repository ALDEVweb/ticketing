// je récupère tout les tr du document
let histos = document.querySelectorAll(".histo");

document.addEventListener("click", (e) => {
    histos.forEach(histo => {
        let tdPop = histo.querySelector(".tdPop");
        let tdClose = histo.querySelector(".tdClose");
        if(tdPop.classList.contains("d-none") && histo.contains(e.target)){
            tdPop.classList.remove("d-none")
        }else if(!tdPop.classList.contains("d-none") && tdClose.contains(e.target)){
            tdPop.classList.add("d-none");
        }
    })
})