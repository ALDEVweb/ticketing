let mdp = document.getElementById("mdp");
let btnMdp = document.getElementById("btnMdp");
btnMdp.addEventListener("click", (e) =>{
    if(mdp.type === "password"){
        mdp.type = "text";
    }else{
        mdp.type = "password";
    }
})