<?php

// first let's set some variables
	
	//Max size in bytes 100 kb
	$maxSize=100000;
	
	// make a note of the current working directory, relative to root.
	$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
	
	// make a note of the directory that will recieve the uploaded file
	$uploadsDirectory = '../UserImages/';
	
	// make a note of the location of the upload form in case we need it
	$uploadForm = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'ChangePic.php';
	
	// make a note of the location of the success page
	$uploadSuccess = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'SuccessPic.php';
	
	// fieldname used within the file <input> of the HTML form
	$fieldname = 'file';

if($_COOKIE["name"])
{
	// The following function is an error handler which is used
	// to output an HTML error page if the file upload fails
	function error($error, $location, $seconds = 5)
	{
		header("Refresh: $seconds; URL=\"$location\"");
		echo 
		'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'."\n".
		'<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">'."\n\n".
		'    <head>'."\n".
		'        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />'."\n\n".
		'        <link rel="stylesheet" type="text/css" href="stylesheet.css" />'."\n\n".
		'    <title>Uppladdning Error</title>'."\n\n".
		'    </head>'."\n\n".
		'    <body>'."\n\n".
		'    <div id="Upload">'."\n\n".
		'        <h1>Upload failure</h1>'."\n\n".
		'        <p>Någonting gick snett: '."\n\n".
		'        <span class="red">' . $error . '...</span>'."\n\n".
		'         Uppladdning sidan laddas om...</p>'."\n\n".
		'     </div>'."\n\n".
		'</body>'."\n\n".
		'</html>';
		exit;
	} // end error handler
	
	// filename: upload.processor.php
	
	// Now let's deal with the upload
	
	// possible PHP upload errors
	$errors = array(1 => 'Filen är för stor',
					2 => 'Filen är för stor',
					3 => 'Error "file upload was only partial" (vet inte vad det betyder men fel blev det)',
					4 => 'Ingen fil');
	
	// check the upload form was actually submitted else print the form
	isset($_POST['submit'])
		or error('the upload form is neaded', $uploadForm);
	
	// check for PHP's built-in uploading errors
	($_FILES[$fieldname]['error'] == 0)
		or error($errors[$_FILES[$fieldname]['error']], $uploadForm);
		
	// check that the file we are working on really was the subject of an HTTP upload
	@is_uploaded_file($_FILES[$fieldname]['tmp_name'])
		or error('Inte HTTP Uppladdning', $uploadForm);
		
	// validation... since this is an image upload script we should run a check  
	// to make sure the uploaded file is in fact an image. Here is a simple check:
	// getimagesize() returns false if the file tested is not an image.
	@getimagesize($_FILES[$fieldname]['tmp_name'])
		or error('Bara bilder får laddas upp', $uploadForm);
		
	//Size of image
	
	if(filesize($_FILES[$fieldname]['tmp_name'])>$maxSize){
	error('Filen är för stor!', $uploadForm);
	}
		
	// make a unique filename for the uploaded file and check it is not already
	// taken... if it is already taken keep trying until we find a vacant one
	// sample filename: 1140732936-filename.jpg
	/*$now = time();
	while(file_exists($uploadFilename = $uploadsDirectory.$now.'-'.$_FILES[$fieldname]['name']))
	{
		$now++;
	}*/
	
	$uploadFilename = $uploadsDirectory.$_COOKIE["name"].".bmp";
	
	// now let's move the file to its final location and allocate the new filename to it
	@move_uploaded_file($_FILES[$fieldname]['tmp_name'], $uploadFilename)
		or error('receiving directory insuffiecient permission', $uploadForm);
		
	// If you got this far, everything has worked and the file has been successfully saved.
	// We are now going to redirect the client to a success page.
	header('Location: ' . $uploadSuccess);
	

}
else
{
	header('Location: ' . $uploadForm);
}
?> 