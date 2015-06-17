<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>New Paste</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $initial_address; ?>templates/css/highlight/default.css">
	<?php echo $this->render('templates/header.htm',$this->mime,get_defined_vars()); ?>
</head>
<body>
	<?php echo $this->render('templates/menu.htm',$this->mime,get_defined_vars()); ?>
	<div class="container">
		<!-- <h3>New Record</h3> -->
		<br>
		<form action="<?php echo $initial_address; ?>save" method="post" >
			<fieldset>
				<legend>Add new Paste:</legend>
				<div class="field-group clear row">
					<label class="col-3" for="title">Title/Name <span class="required">*</span></label>
					<div class="col-9">
						<input type="text" class="field button" id="title" placeholder="Title for the paste" name="title" required>
					</div>
				</div>
				<div class="field-group clear row">
					<label class="col-3" for="format">Select <span class="required">*</span></label>
					<div class="col-9">
						<select name="format_id" class="field button" id="format" required>
							<option value="">Select one option...</option>
							<?php foreach (($formats?:array()) as $format): ?>
								<option value="<?php echo $format['id']; ?>"><?php echo $format['format']; ?> </option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="field-group">
					<label class="block strong" for="paste">Paste <span class="required">*</span></label>
					<textarea name="paste" class="field button" id="paste" cols="30" rows="5" required></textarea>
				</div>
				<div class="field-group clear row">
					<label class="col-3" for="expiration">Time of life for the paste (minutes)</label>
					<div class="col-9">
						<select name="expiration" class="field button" id="expiration">
							<option value="">Select one option...</option>
							<?php foreach ((array(1,2,3,5,10,15,20,25,30,45,60,120,180,270)?:array()) as $expire): ?>
								<option value="<?php echo $expire; ?>"><?php echo $expire; ?> </option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="field-group clear row">
					<label class="col-3" for="tags">Tags (separated with comas)</label>
					<div class="col-9">
						<input type="text" class="field button" id="tags" name="tags" placeholder="Tags separated with comas">
					</div>
				</div>
				<div class="text-right field-group"><button type="submit" class="button-blue">Save</button></div>
			</fieldset>
		</form>
	</div>
	<?php echo $this->render('templates/footer.htm',$this->mime,get_defined_vars()); ?>
</body>
</html>