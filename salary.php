<?php
$urlstring = $_SERVER['REQUEST_URI'];
$p_id = substr($urlstring, 13);
?>
<html>
<link rel="stylesheet" href="menu.css" media="screen">
<meta charset="UTF-8">

<div class="dropdown">
	<button onclick="myFunction()" class="button_slide slide_left" button class="btn rel">Menu</button>
	<div id="myDropdown" class="dropdown-content">
		<a href="/analytics.php?=<?php echo $p_id?>">Analytics</a>
		<a href="/metric.php?=<?php echo $p_id?>">Client Metric Monitor</a>
    <a href="/contact2.php?=<?php echo $p_id?>">Player Contact</a>
    <a href="/acquisition.php?=<?php echo $p_id?>" >Acquisitions</a>
    <a href="/menu.php?=<?php echo $p_id ?>"class="button_slide slide_left">Back</a>
	</div>
</div>

<div style="margin-top: -130px;">
<h1>CAA</h1>
</div>
<div style="width:1000px; margin:0 auto;">
<script type='text/javascript' src='https://us-west-2b.online.tableau.com/javascripts/api/viz_v1.js'></script><div class='tableauPlaceholder' style='width: 1000px; height: 827px;'><object class='tableauViz' width='1000' height='827' style='display:none;'><param name='host_url' value='https%3A%2F%2Fus-west-2b.online.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='&#47;t&#47;clientmanagementengine' /><param name='name' value='NHL_Salary_Overview&#47;Dashboard1' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='filter' value='iframeSizedToWindow=true' /><param name='showAppBanner' value='false' /><param name='display_count' value='no' /></object></div>
<div class="footer" style="text-align: left;">©2018 Stefan Cook and Marcus Nordstrom.</p>
</div>

<style>
.dropdown:hover .dropbtn {
    background-color: #ce1127;
    color: white;
}
.button_slide {
  /* color: #FFF; */
  color: rgb(206, 17, 39);
  border: 2px solid rgb(206, 17, 39);
  border-radius: 4px;
  padding: 18px 36px;
  display: inline-block;
  font-family: "Lucida Console", Monaco, monospace;
  font-size: 14px;
  letter-spacing: 1px;
  cursor: pointer;
  box-shadow: inset 0 0 0 0 rgb(206, 17, 39);
  -webkit-transition: ease-out 0.4s;
  -moz-transition: ease-out 0.4s;
  transition: ease-out 0.4s;
  height: auto;
}
.slide_right:hover {
  box-shadow: inset 400px 0 0 0 rgb(206, 17, 39);
  color: white;
}
* {
    box-sizing: border-box;
}
.slide_left:hover {
  box-shadow: inset 0 0 0 50px rgb(206, 17, 39);
  color: white;
}
.slide_diagonal:hover {
  box-shadow: inset 400px 50px 0 0 rgb(206, 17, 39);
  color: white;

}
.slide_down:hover {
  box-shadow: inset 0 100px 0 0 #ce1127);
  color: white;
}
h1{
  /* font-family: "Lucida Console", Monaco, monospace; */
  font-family: sans-serif, Monaco, monospace;

}
.footer {
  position:fixed;
top: 50%;
left: 50%;
width:30em;
height:18em;
margin-top: -9em; /*set to a negative number 1/2 of your height*/
margin-left: -15em; /*set to a negative number 1/2 of your width*/
border: 1px solid #ccc;
background-color: #f3f3f3;
}
</style>
