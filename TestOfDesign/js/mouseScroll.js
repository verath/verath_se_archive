function scrollAnimate(){
   // Check if all elements are (almost) outside
   var isOut = checkOutside();
   if( scrollSpeed < 0 && isOut.top ){ scrollSpeed = 0; return;}
   if( scrollSpeed > 0 && isOut.bottom){ scrollSpeed = 0;return;}
   if( scrollSpeed == 0 ) return;
   $(".navLink").each(function(){
      var newPos = parseInt( $(this).css('top') ) + scrollSpeed;
      $(this).stop().css({top: newPos + 'px'});
   });
   $(".contentText").each(function(){
      var newPos = parseInt( $(this).css('top') ) + scrollSpeed*3;
      $(this).stop().css({top: newPos + 'px'});
   });
}

function resetScrollSpeed(){ 
   if( scrollSpeed > 0 ){
      scrollSpeed -= 1;
   } else if(scrollSpeed < 0){
      scrollSpeed += 1;
   }
   console.log(scrollSpeed);

}
setInterval(resetScrollSpeed, 2000);
setInterval("scrollAnimate()", 25);
var scrollSpeed = 0;
function handleMousewheel(event){
   /* This code is from the jQuery_mousewheel_plugin.
      http://www.ogonek.net/mousewheel/jQuery_mousewheel_plugin.js */
   if (!event) event = window.event;
   
   if (event.preventDefault){
      event.preventDefault();
   } else { 
      event.returnValue = false;
   }
   
   var dir = 0;
   if (event.wheelDelta) {
      dir = event.wheelDelta/120;
      if (window.opera) dir = -dir;
   } else if (event.detail) {
      dir = -event.detail/3;
   }
   
   if( dir > 0)
      scrollSpeed += 1;
   else
      scrollSpeed -= 1;
}
$(document).ready(function(){
   if (window.addEventListener) {
      window.addEventListener('DOMMouseScroll', handleMousewheel, false);
   } else {
      window.onmousewheel = document.onmousewheel = handleMousewheel;
   }
});