// If user clicks anywhere outside of the modal, Modal will close

var modal = document.getElementById('modal-wrapper');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


var modal2 = document.getElementById('modal-wrapper2');
window.onclick = function(event) {
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
}

var modal5 = document.getElementById('modal-wrapper5');
window.onclick = function(event) {
    if (event.target == modal5) {
        modal5.style.display = "none";
        
    }
}

var modal7 = document.getElementById('modal-wrapper7');
window.onclick = function(event) {
    if (event.target == modal7) {
        modal7.style.display = "none";
        location.href = "home.php";
    }
}

function changemenu() {
    var menu = document.getElementById("menulist");
    menu.removeChild(menu.lastChild);
    menu.removeChild(menu.lastChild);
    var newelement = document.createElement('li');
    newelement.innerHTML = '<a href="twojekonto.php">TWOJE KONTO</a>';
    menu.appendChild(newelement);
    var newelement = document.createElement('li')
    newelement.innerHTML = '<a href="logout.php">WYLOGUJ</a>';
    menu.appendChild(newelement);

}


var okno = document.getElementById('okno_potwierdzajace');
window.onclick = function(event) {
    if (event.target == okno) {
        okno.style.display = "none";
        location.href = "koszyk.php";
    }
}





function usun()
{
 document.getElementById('click').click();
}



