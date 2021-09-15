<?php 
require $_SERVER['DOCUMENT_ROOT'] . "/inc/config.php";
$alive = 0;
$dead = 0;
$dates = array();

// DB Fetch
$query = $conn->query('SELECT * FROM server');
$results = $query->fetchAll(); 
?>
<html>
<head>
<title>Server Listing</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link href="./css/style.css" rel="stylesheet">
<style>
<?php foreach($results as $row) {
if (!$row['dead']) { $alive++; }
if ($row['dead']) { $dead++; }
$totalcost = $totalcost + $row['cost'];
$dates[] = $row['datetime']; 
}
$latestdate = date("d M Y", max(array_map('strtotime', $dates)));
$all = $alive + $dead; ?>
@media screen and (min-width: 600px) {
	.alive, ul {
		column-count:  <?php echo "1"; ?>;
	}
	.dead, ul {
		column-count:  <?php echo "1"; ?>;
	}
}
@media screen and (min-width: 900px) {
	.alive {
		column-count: <?php if ($alive >= 3) {echo "3";} else {echo "2";} ?>;
	}
	.dead {
		column-count: <?php if ($dead >= 3) {echo "3";} else {echo "2";} ?>;
	}
}

</style>
</head>
<body onload="startScript()">
	<h1>Servers</h1>
	<p>
	Total: <?php echo "${all} ({$alive} running, {$dead} dead)<br>
	Cost: {$totalcost}€/mo<br>"?>
	Updated: <?php echo $latestdate; ?> <br>
	</p>
	<h3>Currently Active</h3>
	<ul class="alive">
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
	echo "<li id='{$row['href']}'><a href='//{$row['href']}'>{$row['name']}{$type}<br><i>{$row['description']}<br>{$coststr}</i></a></li>";
	}} ?>
	</ul>
	<h3>Inactive or Dead</h3>
	<ul class="dead">
	<?php
	foreach($results as $row) {
	if ($row['dead']){
        $type = " 💀";
        echo "<li>{$row['name']}{$type}<br><i>{$row['description']}</i></li>";
        }} ?>
	</ul>
</body>
<script>
function startScript() {
	$('li a[href*="' + window.location.hostname + '"]').closest('a').addClass('current');
}
</script>
</html>
