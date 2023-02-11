// Function checkAns()
// Kollar igenom varje input och
//	jämför med words
function checkAns()
{
	var numWords = 0;
	var correctWords = 0;
	
	for (key in words)
	{
		numWords += 1;
		var field = document.getElementById(key);
		if (field.value.toLowerCase() == words[key].toLowerCase())
		{
			field.style.borderColor ='green';
			correctWords += 1;
		}
		else
			field.style.borderColor ='red';
	}
	
	document.getElementById('right').innerHTML = '<span style="color:green">' + correctWords + ' av ' + numWords + ' rätt (' + Math.round((correctWords/numWords)*100) + '%)</span>';
}

// Function showAns()
// Kollar igenom varje input och
//	skriver ut rätt
function showAns()
{
	for (key in words)
	{
		var field = document.getElementById(key);
		field.value = words[key];
		field.style.borderColor = 'green';
		document.getElementById('right').innerHTML = '';
	}
}

// Function checkAnsId(elementId)
// Kollar igenom inputen och
//	jämför med words
// @param elementId - Idn på inputen.
function checkAnsId(elementId)
{
	var field = document.getElementById(elementId);
	
	if (field.value.toLowerCase() == words[elementId].toLowerCase())
		field.style.borderColor ='green';
	else
		field.style.borderColor ='red';
}

// Function showAnsId(elementId)
//	skriver ut rätt svar i inputen
// @elementId - Idn på inputen
function showAnsId(elementId)
{
	var field = document.getElementById(elementId);
	field.value = words[elementId];
	field.style.borderColor = 'green';
}
// Function resetAns()
// Kollar igenom varje input och
//	skriver ut rätt
function resetAns()
{
	for (key in words)
	{
		var field = document.getElementById(key);
		field.value = '';
		field.style.borderColor = 'black';
		document.getElementById('right').innerHTML = '';
	}
}

//Function clearField()
function clearField (f)
{
	if(f.style.borderColor.substr(0,3) == 'red')
	{
		f.value = '';
		f.style.borderColor = 'yellow';
	}
	
}

// Function checkEnter
// Kollar om man klickar 'Enter'
function checkEnter(e)
{
	var keycode;
	
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return true;
	
	if (keycode == 13)
		checkAns();
}

// Function show(element)
// Visar ett objekt genom att ändra
// style display till block; och sparar 
// idn för att dölja det när nästa visas.
// @param: elementId -  idn på element att visa
var showId = '';
function show(elementId)
{
	if(showId != '')
		document.getElementById(showId).style.display = 'none';
	
	showId = elementId;
	document.getElementById(elementId).style.display = 'block';
}