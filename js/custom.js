/* Add here all your JS customizations */

/* checkPass */
function checkPass() {
    var password = $("#pass").val();
    var confirmPassword = $("#vpass").val();
    
    if (password != confirmPassword)
        $("#lblcheckpass").html("Passwords do not match!");
    else
        $("#lblcheckpass").html("Passwords match.");
}

$(document).ready(function () {
    $("#vpass").keyup(checkPass);
});


/* Tablecloth */
$(document).ready(function() {
    $("table").tablecloth({
        sortable: true,
    });
});