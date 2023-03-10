function update_clock()
{
   var currentTime = new Date ();

   var currentHours = currentTime.getHours ( );
   var currentMinutes = currentTime.getMinutes ( );

   // Pad the minutes
   currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;

   // Choose either "AM" or "PM" as appropriate
   var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

   // Convert the hours component to 12-hour format if needed
   currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

   // Convert an hours component of "0" to "12"
   currentHours = ( currentHours == 0 ) ? 12 : currentHours;

   // Compose the string for display
   var currentTimeString = currentHours + ":" + currentMinutes + " " + timeOfDay;

   // Update the time display
   document.getElementById("clock").innerHTML = currentTimeString;
}