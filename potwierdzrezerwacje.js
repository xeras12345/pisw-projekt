Date.prototype.yyyymmdd = function() {
    var mm = this.getMonth() + 1; // getMonth() is zero-based
    var dd = this.getDate();
  
    return [this.getFullYear(),
            (mm>9 ? '' : '0') + mm,
            (dd>9 ? '' : '0') + dd 
           ].join('-');
  };

function formSubmit(tableid, day, month, hours, minutes) {

    var d = new Date();
    d.setFullYear(2019)
    d.setDate(day)
    d.setMonth(parseInt(month)-1)
    d.setHours(parseInt(hours)+2)
    d.setMinutes(minutes)
    d.setSeconds(00)

    document.getElementById("formtableid").value = tableid
    document.getElementById("formday").value = d.yyyymmdd()
    document.getElementById("formtime").value = d.toISOString().slice(11,19)

    var name = document.getElementById("name").value
    var tel = document.getElementById("tel").value
    var email = document.getElementById("email").value

    
    if (name == "")                                  
    { 
        window.alert("Wpisz imię i nazwisko."); 
    } else if (tel == "")                               
    { 
        window.alert("Podaj numer telefonu w formacie: 123456789"); 
    } else if (tel.match(/\d/g).length !== 9)
    {
        window.alert("Podaj numer telefonu w formacie: 123456789");
    } else if (email != "") {
        if (email.indexOf("@", 0) < 0)                 
        { 
            window.alert("Podaj prawidłowy adres email."); 
        } else if (email.indexOf(".", 0) < 0)                 
        { 
            window.alert("Podaj prawidłowy adres email."); 
        } else {
            document.getElementById("form").submit()
        }
    } else {
        document.getElementById("form").submit()
    }
    
}

function goBack() {
    window.location.href="rezerwacje.php";
}

function waitThenHome() {
    setTimeout(function(){
        window.location.href="home.php";
    }, 3000);
}