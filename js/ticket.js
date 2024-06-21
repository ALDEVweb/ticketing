// appel le controleur ajax de surveillance des tickets

let tickets = document.getElementById("tickets");

function surveilleTicket(){
    fetch("surveiller_ticket.php")
    .then(response => {
        return response.text();
    })
    .then(retour => {
        tickets.innerHTML = retour;
    })
}
surveilleTicket();
setInterval(surveilleTicket, 1000);AC