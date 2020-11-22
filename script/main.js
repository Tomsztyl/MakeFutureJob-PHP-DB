const hamburger =document.querySelector(".hamburger");
const menu=document.querySelector(".menu");

hamburger.addEventListener('click',()=>{
    menu.classList.toggle("active");
})

const canvas=document.querySelector(".canvas");
var delayInMilliseconds = 1000; //5 second

document.addEventListener('DOMContentLoaded', (event) => {
    setTimeout(delayInMilliseconds);
  })

  

setTimeout(function() {
    canvas.classList.add("canvasmove");
}, delayInMilliseconds);