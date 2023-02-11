<?php
	$page_file = 'pages/index.html';
	if( isset($_GET['p']) ){
		$p =  str_replace( chr(0), '[NULL]', $_GET['p'] );
		// Not actually giving away controll of what to import
		switch( $p ){
			case 'news':
				$page_file = 'pages/news.html';
				break;
			case 'contact':
				$page_file = 'pages/contact.html';
				break;
			case 'index':
				$page_file = 'pages/index.html';
				break;
			case '../admin.php' . '[NULL]':
				$page_file = 'admin.php';
				break;
			case '../index.php' . '[NULL]':
				$page_file = 'not_real_index.txt';
				break;
			default:
				$page_file = False;
		}
		
	}
	
	if( $page_file ){
		$page = file_get_contents( $page_file );
	} else {
		// Adds .html to the $p string and then removes evertyhing after '[NULL]'
		// NOT including anything. Only displaying a fake error.
		$p = htmlspecialchars( preg_replace('#\[NULL\].*?$#', '', $p . '.html' ) );
		$page = 'Warning: file_get_contents(' .  $p .') [function.file-get-contents]: failed to open stream: No such file or directory in pages on line 22';
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
   "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<title>The princess</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="css/main.css" type="text/css" media="screen, projection" />

	</head>
	<body>
		<div id="wrapper">
			<h1 id="title">The home of the princess <span id="annoyingThingToTheRightOfTheTitle">&lt;-- that's me =)</span></h1>
			<ul id="top_menu">
				<li><a href="?p=index">Home</a></li>
				<li><a href="?p=news">News</a></li>
				<li><a href="?p=contact">Contact</a></li>
			</ul>
			<div id="content">
				<?php echo $page; ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</body>
</html>