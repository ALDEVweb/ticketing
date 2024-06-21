let mdpOld = document.getElementById("mdpOld");
let btnMdpOld = document.getElementById("btnMdpOld");
btnMdpOld.addEventListener("click", (e) =>{
    if(mdpOld.type === "password"){
        mdpOld.type = "text";
    }else{
        mdpOld.type = "password";
    }
})

let mdpNew = document.getElementById("mdpNew");
let btnMdpNew = document.getElementById("btnMdpNew");
btnMdpNew.addEventListener("click", (e) =>{
    if(mdpNew.type === "password"){
        mdpNew.type = "text";
    }else{
        mdpNew.type = "password";
    }
})

let mdpVerif = document.getElementById("mdpVerif");
let btnMdpVerif = document.getElementById("btnMdpVerif");
btnMdpVerif.addEventListener("click", (e) =>{
    if(mdpVerif.type === "password"){
        mdpVerif.type = "text";
    }else{
        mdpVerif.type = "password";
    }
})