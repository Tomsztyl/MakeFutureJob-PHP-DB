const canvas=document.querySelector(".canvas");
var delayInMilliseconds = 1000; //5 second

document.addEventListener('DOMContentLoaded', (event) => {
    setTimeout(delayInMilliseconds);
  })

  

setTimeout(function() {
    canvas.classList.add("canvasmove");
}, delayInMilliseconds);