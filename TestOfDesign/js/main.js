// get window size
var wwidth;
var wheight;
function getWindowSize(){
   if (typeof window.innerWidth != 'undefined') {
      wwidth  = window.innerWidth,
      wheight = window.innerHeight
   } else if (typeof document.documentElement != 'undefined' && typeof document.documentElement.clientWidth != 'undefined' 
   && document.documentElement.clientWidth != 0) {
      wwidth = document.documentElement.clientWidth,
      wheight = document.documentElement.clientHeight
   } else  {
      wwidth = document.getElementsByTagName('body')[0].clientWidth,
      wheight = document.getElementsByTagName('body')[0].clientHeight
   }
};
getWindowSize();
$(window).resize(function(){
   getWindowSize();
});
// Function to check if elements are outside
function checkOutside(){
   var outTop      = true;
   var outBottom   = true;
   
   $(".contentText").each(function(){
      if( parseInt($(this).css('top')) + 20 + parseInt($(this).height()) < wheight ) {
         outBottom = false;
      }
      if( parseInt($(this).css('top')) - 20 > 0 ) {
         outTop = false;
      }
   });
   return {top: outTop, bottom: outBottom};
}

// Moves to the provided ID
function moveToText( id ){
   obj = $("#"+id);
   // Move ddblclicked object
   isDragging = false;
   
   var toMove = 40 - parseInt($(obj).css('top'));
   var moveSpeed = toMove > 0 ? toMove/200 * 500 : toMove*-1/200 * 500;
   $(".navLink").each(function(){
      var newPos = parseInt( $(this).css('top') ) + toMove;
      $(this).animate({top: newPos + 'px'}, moveSpeed);
   });
   $(".contentText").each(function(){
      var newPos = parseInt( $(this).css('top') ) + toMove*3;
      $(this).animate({top: newPos + 'px'}, moveSpeed);
   });
   
   document.location.hash = "#"+$(obj).text();
}

var isDragging 	= false;
var dragStart 	= {x: 0, y: 0};
var startPos	= {};
var moved		= {x: 0, y:0};
var lastMoved	= {x: 0, y:0};
var speed		= {x: 1, y:1};

$(document).ready(function(){
   
   $("body").mousemove(function(e){
      if( isDragging ){
         // Calculate distance moved
         moved = {
            //x: dragStart.x - e.pageX,
            y: dragStart.y - e.pageY
         };
         // Check if all elements are (almost) outside
         var isOut = checkOutside();
         if( moved.y > 0 && isOut.top ) return;
         if( moved.y < 0 && isOut.bottom) return;
         // Move the objects
         $(".navLink").each(function(){
            $(this).stop();
            $(this).css({
               top: startPos[$(this).attr('id')].top - moved.y + "px"
            })
         })
         $(".contentText").each(function(){
            $(this).stop();
            $(this).css({
               top: startPos[$(this).attr('id')].top - moved.y*3 + "px"
            })
         })
         
      }
      
      // Prevent textselection
      e.returnValue = false;
      e.preventDefault();
      return false;
   })
   
   $("body").mouseup(function(){
      if( isDragging ){
         isDragging = false;
      }
   })
   
   $("#leftNav").mousedown(function(e){
      isDragging 	= true;
      dragStart 	= {x: e.pageX, y: e.pageY};
      
      $(".navLink").each(function(){
         // Set the starting pos of each object
         startPos[$(this).attr('id')] = {
            left: 	parseInt($(this).css('left')),
            top: parseInt($(this).css('top'))
         };
      })
      $(".contentText").each(function(){
         // Set the starting pos of each object
         startPos[$(this).attr('id')] = {
            left: 	parseInt($(this).css('left')),
            top: parseInt($(this).css('top'))
         };
      })
      
      // Prevent textselection
      e.returnValue = false;
      e.preventDefault();
      return false;
   });
    
   // Add dubbleclick -> move
   $(".navLink").bind("dblclick", function(){ moveToText( $(this).attr('id') ) });
   
   // Place the links + text.
   $(".navLink").each(function( i ){
      if( i == 0 ){
         var pos = 20;
      } else {
         var prevNav = $(".navLink")[i-1];
         var prevTxt = $(".contentText")[i-1];
         var prevHeight = Math.max( $(prevNav).height(), $(prevTxt).height() / 3 );
         var prevPos = parseInt($(prevNav).css('top'));
         var pos = prevPos + prevHeight + 20;
      }
      
      $(this).css({
         top: pos
      });
      $($(".contentText")[i]).css({
         top: pos * 3
      })
   });
   
   // Remove links used when js iis deactivated
   $("#smallNav").html('');
   
   // Add all navItems to the small navigation
   $(".navLink").each(function(){
      var link = document.createElement('a');
      link.href = 'javascript:moveToText("' + $(this).attr('id') + '");';
      $(link).text($(this).text());
      $(link).addClass('smallNavLink');
      $(link).css({color: $(this).css('color')});
      $("#smallNav").append(link);
   });
   
   // If a hash is supplied, move to that text
   if( (hash = document.location.hash.substr(1)) != '' ){
      $(".navLink").each(function(){
         if( $(this).text() == hash ){
            moveToText( $(this).attr('id') );
            return;
         }
      });
   }
   
   
});