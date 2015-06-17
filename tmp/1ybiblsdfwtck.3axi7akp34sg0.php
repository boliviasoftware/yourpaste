<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $result['0']['title']; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo $initial_address; ?>templates/css/highlight/<?php echo $default_highlight; ?>.css">
	<script src="<?php echo $initial_address; ?>templates/js/highlight.pack.js" type="text/javascript"></script>
	<?php echo $this->render('templates/header.htm',$this->mime,get_defined_vars()); ?>
</head>
<body>
	<?php echo $this->render('templates/menu.htm',$this->mime,get_defined_vars()); ?>
	<div class="container">
		<h1><?php echo $result['0']['title']; ?></h1>
		<p><strong>Format: </strong><?php echo $result['0']['format']; ?></p>
		<p><strong>Created at:</strong> <?php echo $result['0']['created']; ?></p>
		<?php if ($result['0']['time'] > 0): ?>
			
				<p><strong>Expires in:</strong> <?php echo $result['0']['time']; ?> minutes</p>
			
		<?php endif; ?>
		<pre><code class="<?php echo $result['0']['format']; ?>"><?php echo $result['0']['paste']; ?></code></pre>
		<?php if ($result['0']['tags']): ?>
			
				<p class="tags"><strong>Tags:</strong>
					<?php foreach ((explode(',',$result['0']['tags'] )?:array()) as $tag): ?>
						<span><a href="<?php echo $initial_address; ?>search/<?php echo trim($tag); ?>" title="<?php echo trim($tag); ?>" class="button tag-button"><?php echo trim($tag); ?></a></span>
					<?php endforeach; ?>
				</p>
			
		<?php endif; ?>
	</div>
	<?php echo $this->render('templates/footer.htm',$this->mime,get_defined_vars()); ?>
	<script>hljs.initHighlightingOnLoad();</script>
</body>
</html>