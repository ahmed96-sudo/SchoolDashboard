let btn1 = document.getElementById("admin");
let btn2 = document.getElementById("teacher");
let btn3 = document.getElementById("student1");
let forg = document.getElementById("forg");
let stud = document.getElementById("stud");
function showforg1() {
    forg.style.display = "block";
    stud.style.display = "none";
}
function showforg2() {
    forg.style.display = "block";
    stud.style.display = "block";
}
function showforg3() {
    forg.style.display = "none";
    stud.style.display = "none";
}