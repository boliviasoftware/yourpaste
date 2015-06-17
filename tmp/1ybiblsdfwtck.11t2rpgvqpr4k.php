<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>YourPaste List</title>
	<?php echo $this->render('templates/header.htm',$this->mime,get_defined_vars()); ?>
</head>
<body>
	<?php echo $this->render('templates/menu.htm',$this->mime,get_defined_vars()); ?>
	<div class="container">
		<h1>Paste list<?php if ($term): ?> => searching: "<?php echo $term; ?>"<?php endif; ?></h1>
		<?php if ($done_save || $done_delete): ?>
			
				<div class="row">
					<div class="col-8 push-2"><div class="alert alert-success block">Operation Successful!</div></div>
				</div>
			
		<?php endif; ?>
		<div class="container">
			<div class="row">
				<div class="col-4"><a href="<?php echo $initial_address; ?>new/" title="New Paste" class="button-blue">+ New Paste</a></div>
				<div class="col-8 text-right">
					<form action="<?php echo $initial_address; ?>search" method="post">
						<input type="search" name="search" value="<?php echo $term; ?>" placeholder="Search..." class="button">
						<button type="submit" value="Search" class="button-blue">Search</button>
						<button type="reset" value="Clear" class="button">Clear</button>
					</form>
				</div>
			</div>
		</div>
		<table>
			<thead>
				<tr>
					<th>Title</th>
					<th>Format</th>
					<th>Created</th>
					<!-- <th>Expires (min)</th> -->
					<!-- view (popup), edit, delete(confirmation only)  -->
					<th>Operations</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach (($results?:array()) as $item): ?>
					<tr>
						<td><a href="<?php echo $initial_address; ?><?php echo $item['alias']; ?>" title="<?php echo $item['title']; ?>"><?php echo $item['title']; ?></a></td>
						<td><?php echo $item['format']; ?></td>
						<td><?php echo $item['created']; ?></td>
						<!-- <td><?php echo $item['time']; ?></td> -->
						<td><a href="<?php echo $initial_address; ?>delete/<?php echo $item['alias']; ?>" title="Delete paste" class="button red" onclick="return confirm('Do you really want to submit the form?');">Delete paste</a></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php echo $this->render('templates/footer.htm',$this->mime,get_defined_vars()); ?>
</body>
</html>