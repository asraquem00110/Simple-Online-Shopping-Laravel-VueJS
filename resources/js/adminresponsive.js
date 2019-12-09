
let opentoggle = document.getElementById('open-toggle');
let aside = document.querySelector('aside');
let mainsection = document.getElementsByClassName('MainSection');

opentoggle.onclick = function(){
if(aside.style.width=="0px"){
aside.style.width = "220px";


for(let y = 0 ; y<mainsection.length; y++){
	mainsection[0].style.marginLeft = "220px";
}
}else{
aside.style.width = "0px";

for(let y = 0 ; y<mainsection.length; y++){
	mainsection[0].style.marginLeft = "0px";
}
}
}

function adminmatch(x){
let aside = document.querySelector('aside');
let mainsection = document.getElementsByClassName('MainSection');

if(x.matches){
aside.style.width = "0px";
for(let y = 0 ; y<mainsection.length; y++){
	mainsection[0].style.marginLeft = "0px";
}
}else{
aside.style.width = "220px";
for(let y = 0 ; y<mainsection.length; y++){
	mainsection[0].style.marginLeft = "220px";
}
}
}

var admin = window.matchMedia("(max-width: 800px) and (min-width: 100px)");
adminmatch(admin);
admin.addListener(adminmatch);



var dropbtn = document.getElementsByClassName("dropbtn");

for(let x = 0 ; x < dropbtn.length ; x++){
dropbtn[x].onclick = function(){
let childdiv = this.nextElementSibling;
childdiv.style.display=="block" ? childdiv.style.display = "none" : childdiv.style.display = "block";	
}
}
