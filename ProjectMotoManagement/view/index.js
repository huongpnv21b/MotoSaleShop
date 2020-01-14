
document.getElementById("login-form").style.display = "none";

function onLoginClicked() {
    document.getElementById("login-form").style.display = "block";
}

function onRegisterClicked() {
    document.getElementById("register-form").style.display = "block";
}

function onEditClicked() {
    alert("Edit");
    document.getElementById("edit-form").style.display = "block";
}

function DisplayCart() {
    document.getElementById("display").style.display = "none";
    alert("Cart");
    document.getElementById("DisplayCart").style.display = "block";
}
// function OK(){
// 	document.getElementById("display").style.display = "none";
//     document.getElementById("sumcart").style.display = "block";
// }
function Guilienhe() {
    alert("GUI THANH CONG");
}

function thanhtoan() {
    alert("sng");
    document.getElementById("hoadon").style.display = "none";
    document.getElementById("cart").style.display = "none";
    document.getElementById("DisplayCart").style.display = "none";
    document.getElementById("thanhtoan").style.display = "block";
}
function hoadon() {
    document.getElementById("hoadon").style.display = "block";
}
