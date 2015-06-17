<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>YourPaste List</title>
		<?php echo $this->render('templates/header.htm',$this->mime,get_defined_vars()); ?>
	</head>
	<body>
		<?php echo $this->render('templates/menu.htm',$this->mime,get_defined_vars()); ?>
		<div class="container about">
			<h1>About</h1>
			<p>Your Paste is a software based in the idea of the "pastebin", "Ideone", "codepad" and others.</p>
			<p>The main idea is to give to the user a simple interface to save and share their pastes between their LAN or only for a personal use</p>
			<hr>
			<h4>How to use</h4>
			<ul>
				<li>Create a new Paste</li>
				<li>View your paste</li>
				<li>And you are ready to go!</li>
			</ul>
			<hr>
			<h4>How to install</h4>
			<p>Simply copy to an environment PHP 5.2+ the compressed folder and it's ready to use</p>
			<hr>
			<h4>Changelog</h4>
			<h5>Version 0.1</h5>
			<ul>
				<li>Initial Release</li>
			</ul>
			<hr>
			<h4>What is next (TODO)?</h4>
			<ul>
				<li>Adding of expiry time to every record</li>
				<li>Adding AJAX functionality</li>
				<li>Pagination of the results</li>
				<li>Others</li>
			</ul>
			<hr>
			<h4>What is under the hood of YourPaste?</h4>
			<ul>
				<li><a href="http://sqlite.org/" target="_blank">SQLite</a></li>
				<li>	<a href="http://fatfreeframework.com/home" target="_blank">Fat Free Framework</a></li>
				<li><a href="http://getbase.org/" target="_blank">Base CSS</a></li>
				<li>	<a href="https://highlightjs.org/" target="_blank">highlight.js</a></li>
			</ul>
			<h4>License</h4>
			<p>Your Paste is an <a href="http://www.tldrlegal.com/l/mit" target="_blank">MIT</a> License - Made in the "labs" of <a href="http://www.boliviasoftware.com" title="Bolivia Software" target="_blank">Bolivia Software</a></p>
		</div>
		<?php echo $this->render('templates/footer.htm',$this->mime,get_defined_vars()); ?>
	</body>
</html>