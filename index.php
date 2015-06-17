<?php
$initial_address = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']) , "", $_SERVER['SCRIPT_NAME']);

$f3 = require ('lib/base.php');

$db = new DB\SQL('sqlite:database/main.db');
$f3->set('initial_address', $initial_address);
// list all pastes
$f3->route('GET /', function ($f3) use ($db)
{
	$test = $f3->set('done_save', $f3->get('SESSION.done_save'));
	$test = $f3->set('done_delete', $f3->get('SESSION.done_delete'));
	$f3->set('results', $db->exec('SELECT *, strftime("%m-%d-%Y", created) created FROM paste LEFT JOIN format ON format.id = paste.format_id  WHERE state= 1'));
	echo Template::instance()->render('templates/list.htm');
	$f3->set('SESSION.done_save', FALSE);
	$f3->set('SESSION.done_delete', FALSE);
});
// show paste
$f3->route('GET /@alias', function ($f3) use ($db)
{
	$style = ($f3->get('SESSION.view_style')) ? $f3->get('SESSION.view_style') : 'default';
	$f3->set('default_highlight', $style);
	$f3->set('result', $db->exec('SELECT *, strftime("%m-%d-%Y", created) created FROM paste LEFT JOIN format ON format.id = paste.format_id  WHERE state= 1 AND alias = ?', $f3->get('PARAMS.alias')));
	echo Template::instance()->render('templates/view.htm');
});
// search in db
$f3->route('POST /search', function ($f3) use ($db)
{
	$term = $_POST['search'];
	$f3->set('term', $term);
	$test = $f3->set('results', $db->exec("SELECT *, strftime('%m-%d-%Y', created) created FROM paste LEFT JOIN format ON format.id = paste.format_id  WHERE state = 1 AND (title LIKE :title OR paste LIKE :paste OR tags LIKE :tags )", array(
		':title' => "%$term%",
		':paste' => "%$term%",
		':tags' => "%$term%"
		)));
	echo Template::instance()->render('templates/list.htm');
});
// search with tags
$f3->route('GET /search/@term', function ($f3) use ($db)
{
	$f3->set('term', $f3->get('PARAMS.term'));
	$term = $f3->get('PARAMS.term');
	$test = $f3->set('results', $db->exec("SELECT *, strftime('%m-%d-%Y', created) created FROM paste LEFT JOIN format ON format.id = paste.format_id  WHERE state = 1 AND (title LIKE :title OR paste LIKE :paste OR tags LIKE :tags )", array(
		':title' => "%$term%",
		':paste' => "%$term%",
		':tags' => "%$term%"
		)));
	echo Template::instance()->render('templates/list.htm');
});
// new paste
$f3->route('GET /new', function ($f3) use ($db)
{
	$f3->set('formats', $db->exec('SELECT * FROM format'));
	echo Template::instance()->render('templates/new_paste.htm');
});
// save data
$f3->route('POST /save', function ($f3) use ($db)
{
	$values = $_POST;
	$id = $db->exec("SELECT MAX(id) max FROM paste");
	$alias = ($id[0]['max']++) . "-" . str_replace(' ', '-', $values['title']);
	$paste = new DB\SQL\Mapper($db, 'paste');
	$paste->paste = $values['paste'];
	$paste->format_id = $values['format_id'];
	$paste->title = $values['title'];
	$paste->tags = $values['tags'];
	$paste->time = $values['time'];
	$paste->alias = $alias;
	$paste->save();
	$f3->set('SESSION.done_save', TRUE);
	$f3->reroute('/');
});
// delete one record
$f3->route('GET /delete/@alias', function ($f3) use ($db)
{
	$db->exec('DELETE FROM paste WHERE alias = ?', $f3->get('PARAMS.alias'));
	$f3->reroute('/');
});

$f3->route('GET /random', function ($f3) use ($db)
{
	$results = $db->exec("SELECT id,alias FROM paste WHERE state = 1");
	foreach ($results as $key => $item) $new_array[] = $item['id'];
	// $temp = rand(min, max)
	$f3->reroute('/' . $results[array_rand($new_array) ]['alias']);
});

$f3->route('GET /about', function ()
{
	echo Template::instance()->render('templates/about.htm');
});

$f3->route('GET /configuration', function ($f3) use ($db)
{
	$style = ($f3->get('SESSION.view_style')) ? $f3->get('SESSION.view_style') : 'default';
	$f3->set('default_highlight', $style);
	$test = $f3->set('done_save', $f3->get('SESSION.done_save'));
	$f3->set('styles', $db->exec('SELECT * FROM styles'));
	echo Template::instance()->render('templates/configuration.htm');
	$f3->set('SESSION.done_save', FALSE);
});

$f3->route('POST /save_configuration', function ($f3) use ($db)
{
	if (count($_POST['style'])) $f3->set('SESSION.view_style', $_POST['style']);
	$f3->set('SESSION.done_save', TRUE);
	$f3->reroute('/configuration');
});

$f3->run();
?>
