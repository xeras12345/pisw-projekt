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