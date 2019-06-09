function goBack() {
    window.location.href="twojekonto.php";
}

function showMessage(message) {
    html = '<p class="textMenu">'+message+'</p>'
    document.getElementById("message").innerHTML = html
}

function formSubmit() {

    var name = document.getElementById("name").value
    var tel = document.getElementById("tel").value

    
    if (name == "")                                  
    { 
        showMessage("Ups, zapomniałeś podać imię i nazwisko."); 
    } else if (tel == "")                               
    { 
        showMessage("Podaj numer telefonu w formacie: 123456789"); 
    } else if (tel.match(/\d/g).length !== 9)
    {
        showMessage("Podaj numer telefonu w formacie: 123456789");
    } else {
        document.getElementById("form").submit()
    }
    
}

function formSubmit() {

    document.getElementById("form").submit()
    
}