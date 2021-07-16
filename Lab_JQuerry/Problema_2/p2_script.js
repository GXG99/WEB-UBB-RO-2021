function computeDate(birthDate) {
    let diff = Date.now() - birthDate;
    let age = new Date(diff);
    return Math.abs(age.getUTCFullYear() - 1970);
}

$(document).ready(function () {
    $(".formular").submit(function () {
        var fName = $("#firstName").val();
        var lName = $('#lastName').val();
        var date = $('#birthDate').val();
        var age = $('#age').val();
        var email = $('#email').val();
        var validation = true
        let birthDate = new Date(date);

        if (fName.length < 1) {
            $('#firstName').css("border-color", "red");
            validation = false;
        }
        if (lName.length < 1) {
            $('#lastName').css("border-color", "red");
            validation = false;
        }
        if (computeDate(birthDate) !== parseInt(age)) {
            console.log(birthDate);
            console.log(age);
            $('#age').css("border-color", "red");
            $('#birthDate').css("border-color", "red");
            validation = false;
        }
        var regEx = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
        var validEmail = regEx.test(email);
        if (!validEmail) {
            $('#email').css("border-color", "red");
            validation = false;
        }

        return validation;
    });
});