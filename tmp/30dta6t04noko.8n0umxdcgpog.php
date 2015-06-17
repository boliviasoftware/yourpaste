<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Your Paste List</title>
	<?php echo $this->render('templates/header.htm',$this->mime,get_defined_vars()); ?>
</head>
<body>
	<?php echo $this->render('templates/menu.htm',$this->mime,get_defined_vars()); ?>
	<div class="container">
		<h1>System Configuration</h1>
		<?php if ($done_save || $done_delete): ?>
			
				<div class="row">
					<div class="col-8 push-2"><div class="alert alert-success block">Operation Successful!</div></div>
				</div>
			
		<?php endif; ?>
		<form action="<?php echo $initial_address; ?>save_configuration" method="post">
			<fieldset>
				<legend>Style for this session</legend>
				<div class="field-group clear row">
					<label class="col-2" for="style">Style</label>
					<div class="col-10">
						<select name="style" class="field button" id="style">
							<option value="">Select one option...</option>
							<?php foreach (($styles?:array()) as $item): ?>
								<option value="<?php echo $item['style']; ?>" <?php if ($item['style'] === $default_highlight): ?> selected <?php endif; ?> ><?php echo $item['style']; ?> </option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="text-right field-group"><button type="submit" class="button button-blue">Save</button></div>
			</fieldset>
		</form>
	</div>
	<?php echo $this->render('templates/footer.htm',$this->mime,get_defined_vars()); ?>
</body>
</html>