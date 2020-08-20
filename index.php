<?php 
require $_SERVER['DOCUMENT_ROOT'] . "/inc/config.php";

// DB Fetch
$query = $conn->query('SELECT * FROM server');
$results = $query->fetchAll();
?>
<html>
<head>
<title>Server Listing</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link href="./css/style.css" rel="stylesheet">
<style>
<?php foreach($results as $row) { 
if ($row['dead']) { $alive++; }
if (!$row['dead']) { $dead++; }
$totalcost = $totalcost + $row['cost'];
}
$all = $alive + $dead; ?>
@media screen and (min-width: 600px) {
	ul {
		column-count:  <?php echo $all-1; ?>;
	}
}
@media screen and (min-width: 900px) {
	ul {
		column-count: <?php echo $all-2; ?>
	}
}

</style>
</head>
<body>
<article id="servers">
	<h1>Servers</h1>
	<p>
	Total: <?php echo "${all} ({$alive} running, {$dead} dead)<br>
	Cost: {$totalcost}€/mo<br>"?>
	Updated: August 2020<br>
	</p>
	<h3>Currently Active</h3>
	<ul>
	<?php
	//$query = $conn->query('SELECT * FROM server');
  	//$results = $query->fetchAll();
	foreach($results as $row) {
	if (!$row['dead']){
        switch ($row['type']) {
          case "vps":
                $type = " ☁";
		$coststr = "({$row['cost']}€/mo)";
                break;
          case "home":
                $type = " 🏠";
		$coststr = "(⚡/mo)";
                break;
          default:
		$type = "";
		$coststr = "({$row['cost']}€/mo)";
                break;
        }
	echo "<li><a href='{$row['href']}'>{$row['name']}{$type}<br><i>{$row['description']}<br>{$coststr}</i></a></li>";
	}} ?>
	</ul>
	<h3>Inactive or Dead</h3>
	<ul>
	<?php
	foreach($results as $row) {
	if ($row['dead']){
        $type = " 💀";
        echo "<li>{$row['name']}{$type}<br><i>{$row['description']}</i></li>";
        }} ?>
	</ul>
</article>
</body>
</html>
