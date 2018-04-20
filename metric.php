<?php
$urlstring = $_SERVER['REQUEST_URI'];
$p_id = substr($urlstring, 13);
?>
<meta charset="utf-8">
<html>
<link rel="stylesheet" href="menu.css" media="screen">
<div class="dropdown">
	<button onclick="myFunction()" class="button_slide slide_left" button class="btn rel">Menu</button>
	<div id="myDropdown" class="dropdown-content">
		<a href="/analytics.php?=<?php echo $p_id?>">Analytics</a>
    <a href="/salary.php?=<?php echo $p_id?>">Contract Analytics</a>
    <a href="/contact2.php?=<?php echo $p_id?>">Player Contact</a>
    <a href="/acquisition.php?=<?php echo $p_id?>" >Acquisitions</a>
    <a href="/menu.php?=<?php echo $p_id ?>"class="button_slide slide_left">Back</a>
	</div>
</div>
<div style="margin-top: -130px;">
<h1 style="font-family: sans-serif;">Metrics</h1>
</div>
<div style="width:1000px; margin:0 auto;">

<script type='text/javascript' src='https://us-west-2b.online.tableau.com/javascripts/api/viz_v1.js'></script>
<div class='tableauPlaceholder' style='width: 1000px; height: 827px;'>
  <object class='tableauViz' width='1000' height='827' style='display:none;'>
    <param name='host_url' value='https%3A%2F%2Fus-west-2b.online.tableau.com%2F' />
    <param name='embed_code_version' value='3' />
    <param name='site_root' value='&#47;t&#47;clientmanagementengine' />
    <param name='name' value='metric_tracker&#47;Metric_Dash' />
    <param name='tabs' value='no' />
    <param name='toolbar' value='yes' />
    <param name='showAppBanner' value='false' />
    <param name='filter' value='iframeSizedToWindow=true' />
  <param name='filter' value='Player%20ID=<?php echo $p_id ?>' />

	</object>
</div>
</div>

<p style="text-align: center;">©2018 Stefan Cook and Marcus Nordstrom.</p>

  <style>
.footer {
    position: fixed;
    bottom-margin: 10px;
    width: 100%;
    background: red;
    text-align: center;
    color: #white;
}

</style>
