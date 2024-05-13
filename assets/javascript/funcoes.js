function openMenu() {
    const menu = document.querySelector(".navbar");
    menu.classList.toggle("show");
}

function fecharNotificacao(){
     document.getElementById('div-cookie').style.display="none";
}

window.onload = function() {
    //menu dropdow
    const btnMenu = document.getElementById('hamburguer');
    const notificacao = document.getElementById('notificacao');
    btnMenu.addEventListener('click', openMenu);
    notificacao.addEventListener('click', fecharNotificacao);
    
}
