
//Created by Alvin S. Raquem
//2019

var toggle = document.getElementById('toggle-button');

var nav = document.getElementById("mainnav");
let dropdowncontent = document.getElementsByClassName("dropdown-content");

if(toggle){
	toggle.onclick = function(){
		if(nav.style.width == "100%"){
		nav.style.width = "0";
		for(let y=0;y<dropdowncontent.length;y++){
		if(x!=y){
		dropdowncontent[y].style.display = "none";
		}	
		}
		}else{
		nav.style.width = "100%";
		}

		}
}



function match(x){
if(x.matches && nav){
nav.style.width = "100%";
}else{
	if(nav){
		nav.style.width = "0";
		for(let y=0;y<dropdowncontent.length;y++){
		if(x!=y){
		dropdowncontent[y].style.display = "none";
		}	
		}
	}
		
}
}

var x = window.matchMedia("(min-width: 801px)");
match(x);
x.addListener(match);

let dropbtn = document.getElementsByClassName("dropbtn");
for(let x = 0 ; x < dropbtn.length ; x++){
dropbtn[x].onclick = function(){
for(let y=0;y<dropdowncontent.length;y++){
if(x!=y){
dropdowncontent[y].style.display = "none";
}	
}
let childdiv = this.nextElementSibling;
childdiv.style.display=="block" ? childdiv.style.display = "none" : childdiv.style.display = "block";	
}
}



function OpenDisplay(evt,targetdiv){
var i, tabcontent, tablinks;
tabcontent = document.getElementsByClassName("tab-content");
for (i = 0; i < tabcontent.length; i++) {
tabcontent[i].style.display = "none";
}
tablinks = document.getElementsByClassName("tablinks");
for (i = 0; i < tablinks.length; i++) {
tablinks[i].className = tablinks[i].className.replace(" active", "");
}
document.getElementById(targetdiv).style.display = "block";
evt.currentTarget.className += " active";
}

if(document.getElementById("defaultOpen")){
	document.getElementById("defaultOpen").click();
}
