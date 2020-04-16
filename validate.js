const firstName = document.getElementById("firstName");
const lastName = document.getElementById("lastName");
const password = document.getElementsByName("password")[0];
const pass = document.getElementsByName("pass")[0];
const submit = document.getElementById("submit");
const pic = document.getElementById("exampleFormControlFile1");
const failure = document.getElementById("failure");
let myaddress = document.getElementById('myaddress');
let validfname = false;
let validlname = false;
let validpassword = false;
let validpass = false;
let validmyaddress = false;
let validpic = false;

pic.addEventListener('input', function () {
        let str = pic.value;
        if (str.endsWith(".jpg") || str.endsWith(".png")) {
            pic.classList.remove('is-invalid');
            pic.classList.add('is-valid');
            document.getElementById("picture").innerHTML = "";
            validpic = true;
        }
        else {
            pic.classList.add('is-invalid');
            pic.classList.remove('is-valid');
            document.getElementById("picture").innerHTML = "Only pnj and jpg file allowed";
            validpic = false;
        }

    });
    myaddress.addEventListener('input', function () {
        let reg = /^[a-zA-Z0-9 ,\n]{10,300}$/;
        let str = myaddress.value;
        if (reg.test(str)) {
            myaddress.classList.remove('is-invalid');
            myaddress.classList.add('is-valid');
            document.getElementById("add").innerHTML = "";
            validmyaddress = true;
        }
        else {
            myaddress.classList.add('is-invalid');
            myaddress.classList.remove('is-valid');
            document.getElementById("add").innerHTML = "Address must be 10 to 300 characters long (only letters and numbers are allowed)";
            validmyaddress = false;
        }

    });
firstName.addEventListener('input', function () {
    let reg = /^[a-zA-Z ]{3,12}$/;
    let str = firstName.value;
    if (reg.test(str)) {
        firstName.classList.remove('is-invalid');
        firstName.classList.add('is-valid');
        document.getElementById("fname").innerHTML = "";
        validfname = true;
    }
    else {
        firstName.classList.add('is-invalid');
        firstName.classList.remove('is-valid');
        document.getElementById("fname").innerHTML = "First name must be at lest 3 to 12 character long";
        validfname = false;
    }

});
lastName.addEventListener('input', function () {
    let reg = /^[a-zA-Z ]{3,12}$/;
    let str = lastName.value;
    if (reg.test(str)) {
        lastName.classList.remove('is-invalid');
        lastName.classList.add('is-valid');
        document.getElementById("lname").innerHTML = "";
        validlname = true;
    }
    else {
        lastName.classList.add('is-invalid');
        lastName.classList.remove('is-valid');
        document.getElementById("lname").innerHTML = "Last name must be at lest 3 to 12 character long";
        validlname = false;
    }

});
password.addEventListener('input', function () {
    let reg1 = /([A-Z])/;
    let reg2 = /([a-z])/;
    let reg3 = /([0-9])/;
    let reg4 = /[~!@#$%^&]/;
    let str = password.value;
    if (reg1.test(str) && str.length <= 20 && str.length >= 8 && reg2.test(str) && reg3.test(str) && reg4.test(str)) {
        password.classList.remove('is-invalid');
        password.classList.add('is-valid');
        document.getElementById("passcode").innerHTML = "";
        validpassword = true;
    }
    else {
        password.classList.add('is-invalid');
        password.classList.remove('is-valid');
        document.getElementById("passcode").innerHTML = "Password must be at least 8 to 20 characters long where 1 upper case, 1 lower case, 1 number and 1 special character";
        validpassword = false;
    }

});
pass.addEventListener('input', function () {
    let str1 = password.value;
    let str2 = pass.value;
    if (str1 == str2) {
        pass.classList.remove('is-invalid');
        pass.classList.add('is-valid');
        document.getElementById("passcode1").innerHTML = "";
        validpass = true;
    }
    else {
        pass.classList.add('is-invalid');
        pass.classList.remove('is-valid');
        document.getElementById("passcode1").innerHTML = "Password doesn't matched";
        validpass = false;
    }

});
function validate() {
    if (validpic && validmyaddress && validfname && validlname && validpassword && validpass) {
        return true;
    }
    else {
        let failure = document.getElementById("failure");
        failure.classList.add('show');
        setTimeout(function () {
            failure.classList.remove('show');
        }, 5000)
        return false;
    }
}