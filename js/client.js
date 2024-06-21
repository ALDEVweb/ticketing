let mdpClient = document.getElementById("mdpClient");
let btnMdpClient = document.getElementById("btnMdpClient");
btnMdpClient.addEventListener("click", (e) =>{
    if(mdpClient.type === "password"){
        mdpClient.type = "text";
    }else{
        mdpClient.type = "password";
    }
})

