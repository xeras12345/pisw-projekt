function submitForm(id, action) {
    document.getElementById("formaction").value = action
    document.getElementById("formid").value = id

    document.getElementById("form").submit() 
}

function submitForm2(kategoria) {
    document.getElementById("formkategoria").value = kategoria
    document.getElementById("form2").submit()
}