/*First select all the elements which are there in our html file*/
const first = document.querySelector('.first');
const iframe = document.querySelector('iframe');




first.addEventListener('keyup', function(){
  var html = first.textContent
  iframe.src = "data:text/html;charset=utf-8," + encodeURI(html)

})



