let exporter = document.querySelector(".exporter");
let admin = document.querySelector(".admin");
let role = document.querySelector(".role");

exporter.onclick = () =>{
    admin.classList.remove('active');
    exporter.classList.add('active');
    role.value = 1;
}
admin.onclick = () =>{
    exporter.classList.remove('active');
    admin.classList.add('active');
    role.value = 2;
}
