
<?php
#get cookie from login - if cookie is not present then redirect, else function
if (!isset($_COOKIE["username"]))
{
    header('Location: http://www.aimscapstone.site/login2.php');
    exit;
}
//connect to database
$db_host = 'capstone.cfiax0xaq0zu.us-west-1.rds.amazonaws.com'; // Server Name
$db_user = 'stefancook'; // Username
$db_pass = 'SCapril5'; // Password
$db_name = 'Capstone_DB_2.0'; // Database Name
//notification if not connected
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
//Select statment to acquire data for use in html website - should match up with what is being displayed
$sql = 'SELECT Player_ID, player_first_name, player_last_name, player_picture, Teams.team_name as team, agent_id
        FROM hockey_players
        JOIN Teams
        ON hockey_players.teams_team_id = Teams.team_id
    JOIN Player_Agents
    ON hockey_players.player_agents_agent_id = Player_Agents.agent_id
    WHERE Player_Agents.agent_id = '.$_COOKIE["name"].'';

$query = mysqli_query($conn, $sql);
// $agentquery = mysqli_query($conn, $agent);
if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}

?>
<html class="export" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width">
  <meta name="description" content="filter &amp; sort magical layouts">

  <title>HOCKEY DATA ENGINE</title>

    <!-- Isotope does not require any CSS files -->
    <link rel="stylesheet" href="css/isotope-docs.css?6" media="screen">

</head>
<body class="page--sorting">
  <div id="content" class="main">
    <div class="container">
        <div class="toptext">HOCKEY DATA ENGINE</div>


<p><?php

	if(isset($_COOKIE["username"])){

			echo "Welcome " . $_COOKIE["username"];
	} else{
			echo "Welcome Guest!";
	}

	?> </p>

<div class="big-demo go-wide" data-js="sorting-demo">

  <div class="button-group sort-by-button-group js-radio-button-group">
    <button class="button " data-sort-by="original-order">original order</button>
    <button class="button" data-sort-by="name">name</button>
    <button class="button" data-sort-by="symbol">symbol</button>
    <button class="button" data-sort-by="number">number</button>
    <button class="button" data-sort-by="weight">weight</button>
    <button class="button" data-sort-by="category">category</button>
  </div>

	<div class="grid">

					<?php
					$no     = 0;
					$total     = 0;
					while ($row = mysqli_fetch_array($query))
					{
							#similar to JSON object
							echo '
							<div class="element-item player">
							<h5 class="name">'.$row['player_first_name'].'</h5>
							<h5 class="symbol">'.$row['player_last_name'].'</h5>
							<a href="/menu.php?='.$row['Player_ID'].'"><img class="image" style="filter"src='.$row['player_picture'].'></a>
							<h5 class="weight" style="opacity: .0">'.$row['agent_id'].'</h5>
							<h5 class="number" style="color: white; left: 2px;   top: 180px; font-size: 16px; font-weight: lighter;">'.$row['team'].'</h5>

					</div>';
}?>
</div>









<!-- Isotope does NOT require jQuery. But it does make things easier -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>

  <script src="js/isotope-docs.min.js?6"></script>


</body>
</html>

<style>
/*search bar*/
h5 span {
    background-color: white;
    opacity: .7;
}
input[type="text"] {
  border: 4px solid #484542;
  border-radius: 8px;
  font-size: 20px;
  background: black;
  color: white;
  font-family: "segoe-ui", "open-sans", tahoma, arial;
  height: 40;
  width: 180px;
}
input[type=text]:focus {
    width: 100%;
}
iframe {
    border: none;
}
.quicksearch{
  color: #343d44;
  border-radius: 8px;
  float: center;
}
.clear{
  border-radius: 20px;
  float:left;
  top: 20px;
}
/*testing:()*/
.footer {
    position: fixed;
    bottom-margin: 10px;
    width: 100%;
    background: red;
    text-align: center;
    color: #white;
}
body {
  font-size: 15px;
  font-family: "segoe-ui", "open-sans", tahoma, arial;
  padding: 0;
  margin: 0;
  background: white	 !important;
}
html {
  font-family: sans-serif; /* 1 */
  line-height: 1.15; /* 2 */
  -ms-text-size-adjust: 100%; /* 3 */
  -webkit-text-size-adjust: 100%; /* 3 */
}
body {
  margin: 0;
}

h1, h2, h3, h4 {
  line-height: 1.25;
}

.toptext {
  font-weight: bold;
  font-size: 2.65em;
  margin-bottom: 0.2em;
  margin-top: 2.0em;
  color: black;
}

h1:first-child { margin-top: 0; }

h2 {
  font-weight: bold;
}

h3 {
  font-weight: normal;
  font-size: 1.4em;
  margin-top: 2.0em;
  margin-bottom: 0.8em;
}

h4 {
  text-transform: uppercase;
  letter-spacing: 0.1em;
  font-size: 1.1em;
}

/* element-item
------------------------- */


.element-item {
  position: relative;
  width: 200px;
  height: 200px;
  margin: 4px;
  padding: 3px;
  background: linear-gradient(to bottom, rgba(255,0,0,0), rgba(255,0,0,1)); */
   background: -webkit-linear-gradient(left, rgba(255,50,54,1) 1%,rgba(255,50,54,1) 23%,rgba(255,50,54,0.9) 28%,rgba(219,88,103,0) 48%,rgba(125,185,232,0) 100%);
}
.image {
  height: 200px;
  width: 200px;
  background: black;
  transition: .3s;
  margin: -1px;
	opacity: .5px;
}
.image:hover {
  opacity: 1;
	filter: grayscale(50%);


}
.element-item:be {
	height: 200px;
	width: 200px;
}

.element-item > * {
	height: 200px;
	width: 200px;
  margin: 0;
  padding: 1px;
}

.element-item .name {
  position: absolute;
  left: 2px;
  top: 123px;
  text-transform: none;
  letter-spacing: 0;
  font-size: 22px;
  font-weight: normal;
  color: black;
  z-index: 3;
}

.element-item .symbol {
  position: absolute;
  left: 2px;
  top: 150px;
  font-size: 24px;
  font-weight: bold;
  color: black;
  z-index: 3;

}

.element-item .number {
color: black; left: 2px;   top: 179px; font-size: 18px; color: black;
back
}

.element-item .weight {
  position: absolute;
  left: 2px;
  top: 180px;
  font-size: 16px;
  font-weight: lighter;
  color: black;
  z-index: 4;
}
/* Texta Heavy */
@font-face {
  font-family: 'Texta';
  font-weight: bold;
  font-style: normal;
  src: url('../fonts/2D333F_0_0.woff2') format('woff2'),
    url('../fonts/2D333F_0_0.woff') format('woff');
}

/* Texta Italic */
@font-face {
  font-family: 'Texta';
  font-weight: normal;
  font-style: italic;
  src: url('../fonts/2D333F_1_0.woff2') format('woff2'),
    url('../fonts/2D333F_1_0.woff') format('woff');
}

/* Texta Regular */
@font-face {
  font-family: 'Texta';
  src: url('../fonts/2D333F_2_0.woff2') format('woff2'),
    url('../fonts/2D333F_2_0.woff') format('woff');
}

@font-face {
    font-family: 'icomoon';
    src:url('../fonts/icomoon.eot');
    src:url('../fonts/icomoon.eot?#iefix') format('embedded-opentype'),
        url('../fonts/icomoon.woff') format('woff'),
        url('../fonts/icomoon.ttf') format('truetype'),
        url('../fonts/icomoon.svg#icomoon') format('svg');
    font-weight: normal;
    font-style: normal;
}

.main h1 {
  font-size: 3.8rem;
}

.main h2 {
  font-size: 1.6rem;
  font-weight: normal;
  border-top: 6px solid #484542;
  padding-top: 1.1em;
  margin-top: 1.4em;
}

.main h2:target {
  padding-left: 0.5em;
  background: #D26;
  color: black;
}

.main h3 {
  font-size: 1.3rem;
  border-top: 1px solid #484542;
  padding-top: 0.8em;
  margin: 1.4em 0 0.5em;
}



.grid {
  border-radius: 8px;
  position: fixed;
  padding: 8px;
  margin-top: 8px;
  margin-top: 20px;
  margin-left: 5px;
  position: center;
	display: block;
	clear: both;
}

/* clearfix */
.grid:after {
  display: block;
  clear: both;
}


.ui-group {
  display: inline-block;
}

.ui-group__title {
  display: inline-block;
  vertical-align: top;
  font-size: 1.2rem;
  line-height: 40px;
  margin: 0 10px 0 0;
  font-weight: bold;
}

.ui-group .button-group {
  display: inline-block;
  margin-right: 20px;
}

@charset "UTF-8";

/* button
------------------------- */
.footer {
    position: relative;
    left: 0;
    right: 0;
    margin-bottom: -100px;
    width: auto;
    height: 20px;
    background-color: white;
    color: white;
    text-align: center;
    color: #343d44;
    border-radius: 8px;
    float: center;
}
.button {
  display: inline-block;
  padding: 10px 15px;
  margin-bottom: 10px;
  /* background-color: #F8F8F8;
  background-image: linear-gradient( hsla(0, 0%, 0%, 0), hsla(0, 0%, 0%, 0.1) );
  border: 1px solid #CCC;
  border-radius: 10px; */
  font-family: "segoe-ui", "open-sans", tahoma, arial;
  font-size: 15px;
  color: #343d44;
  border-radius: 8px;
  float: center;

  p {
       font-family: 'Roboto';
      text-align: center;
      text-transform: uppercase;
    color: #FFF;
    user-select: none;
  }

  &:hover {
    cursor: pointer;
  }

  &:after {
    content: "";
    display: block;
    position: absolute;
    width: 100%;
    height: 10%;
    border-radius: 50%;
    background-color: darken(#f1c40f, 20%);
    opacity: 0.4;
    bottom: -30px;
  }
}
}

.button:enabled {
  cursor: pointer;
}

.button:enabled:hover {
  background-color: #8CF;
}

.button.is-checked,
.button.is-selected {
  background-color: #19F;
  color: white;
}

.button:active {
  color: white;
  background-color: #59F;
  box-shadow: inset 0 2px 10px hsla(0, 0%, 0%, 0.8);
}

/* hide radio inputs */
.button input[type="radio"] { display: none; }
/* ---- button-group ---- */

.button-group:after {
  content: '';
  display: block;
  clear: both;
}

.button-group .button {
  float: left;
  border-radius: 0;
  margin-left: -1px;
}

.button-group .button:first-child { border-radius: 5px 0 0 5px; }
.button-group .button:last-child { border-radius: 0 5px 5px 0; }









/* animate-item-size-item
------------------------- */

.animate-item-size-item {
  float: left;
}

/* animate-item-size-item is invisible, but used for layout */
.animate-item-size-item,
.animate-item-size-item__content {
  width: 60px;
  height: 60px;
}

/* animate-item-size-item__content is visible, and transitions size */
.animate-item-size-item__content {
  background: #8DF;
  border: 2px solid #333;
  border-color: hsla(0, 0%, 0%, 0.7);
  -webkit-transition: width 0.4s, height 0.4s;
     -moz-transition: width 0.4s, height 0.4s;
       -o-transition: width 0.4s, height 0.4s;
          transition: width 0.4s, height 0.4s;
}

.animate-item-size-item:hover .animate-item-size-item__content {
  border-color: white;
  background: #4BF;
  cursor: pointer;
}

/* both animate-item-size-item and animate-item-size-item content change size */
.animate-item-size-item.is-expanded,
.animate-item-size-item.is-expanded .animate-item-size-item__content {
  width: 180px;
  height: 120px;
}

.animate-item-size-item.is-expanded {
  z-index: 2;
}

.animate-item-size-item.is-expanded .animate-item-size-item__content {
  background: #F90;
}

/* ---- responsive ---- */

.grid--animate-item-size-responsive .animate-item-size-item,
.grid--animate-item-size-responsive .grid-sizer {
  width: 20%;
}

.grid--animate-item-size-responsive .animate-item-size-item__content,
.grid--animate-item-size-responsive .animate-item-size-item.is-expanded .animate-item-size-item__content {
  width: 100%;
  height: 100%;
}

/* item has expanded size */
.grid--animate-item-size-responsive .animate-item-size-item.is-expanded {
  width: 60%;
}

/* bootstrap 3
------------------------- */

.bootstrap-3__container-fluid {
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}

.bootstrap-3__col-xs-4,
.bootstrap-3__col-xs-6,
.bootstrap-3__col-xs-8,
.bootstrap-3__col-xs-12 {
  padding-right: 15px;
  padding-left: 15px;
}

.bootstrap-3__col-xs-4 { width: 33.333%; }
.bootstrap-3__col-xs-6 { width: 50%; }
.bootstrap-3__col-xs-8 { width: 66.666%; }

.bootstrap-3__grid-item-content {
  height: 200px;
}

.bootstrap-3__grid-item-content--height2 { height: 200px; }

/* sm */
@media (min-width: 768px) {
  .bootstrap-3__col-sm-4 { width: 33.333%; }
  .bootstrap-3__col-sm-8 { width: 66.666%; }
}

/* md */
@media (min-width: 992px) {
  .bootstrap-3__col-md-3 { width: 25%; }
  .bootstrap-3__col-md-6 { width: 50%; }
}


/* tablet-ish */
@media screen and ( min-width: 768px ) {

  .container {
    margin-left: 220px;
  }

  .main .container > * {
    max-width: 900px;
  }

}

/* desktop */
@media screen and ( min-width: 960px ) {

  .container {
    margin-right: 6%;
  }

}


/* button overwrites
------------------------- */

.button {
  border-color: #222;
}


/**
 * Add the correct display in IE 9-.
 */

audio,
canvas,
progress,
video {
  display: inline-block;
}

/**
 * Add the correct display in iOS 4-7.
 */

audio:not([controls]) {
  display: none;
  height: 0;
}

/**
 * Add the correct vertical alignment in Chrome, Firefox, and Opera.
 */

progress {
  vertical-align: baseline;
}

/**
 * Add the correct display in IE 10-.
 * 1. Add the correct display in IE.
 */

template, /* 1 */
[hidden] {
  display: none;
}

/* Links
   ========================================================================== */

/**
 * 1. Remove the gray background on active links in IE 10.
 * 2. Remove gaps in links underline in iOS 8+ and Safari 8+.
 */

a {
  background-color: transparent; /* 1 */
  -webkit-text-decoration-skip: objects; /* 2 */
}

/**
 * Remove the outline on focused links when they are also active or hovered
 * in all browsers (opinionated).
 */

a:active,
a:hover {
  outline-width: 0;
}

/* Text-level semantics
   ========================================================================== */

/**
 * 1. Remove the bottom border in Firefox 39-.
 * 2. Add the correct text decoration in Chrome, Edge, IE, Opera, and Safari.
 */

abbr[title] {
  border-bottom: none; /* 1 */
  text-decoration: underline; /* 2 */
  text-decoration: underline dotted; /* 2 */
}

/**
 * Prevent the duplicate application of `bolder` by the next rule in Safari 6.
 */

b,
strong {
  font-weight: inherit;
}

/**
 * Add the correct font weight in Chrome, Edge, and Safari.
 */

b,
strong {
  font-weight: bolder;
}

/**
 * Add the correct font style in Android 4.3-.
 */

dfn {
  font-style: italic;
}

/**
 * Correct the font size and margin on `h1` elements within `section` and
 * `article` contexts in Chrome, Firefox, and Safari.
 */

 h1 {
   font-size: 2em;
   margin: 0.67em 0;
   color: white;
 }

 /**
  * Add the correct background and color in IE 9-.
  */

 mark {
   background-color: #ff0;
   color: #000;
 }

 /**
  * Add the correct font size in all browsers.
  */

 small {
   font-size: 80%;
 }

 /**
  * Prevent `sub` and `sup` elements from affecting the line height in
  * all browsers.
  */

 sub,
 sup {
   font-size: 75%;
   line-height: 0;
   position: relative;
   vertical-align: baseline;
 }

 sub {
   bottom: -0.25em;
 }

 sup {
   top: -0.5em;
 }

 /**
  * Remove the border on images inside links in IE 10-.
  */

 img {
   border-style: none;
 }

 /**
  * Hide the overflow in IE.
  */

 svg:not(:root) {
   overflow: hidden;
 }
 ====================================================== */

/**
* 1. Correct the inheritance and scaling of font size in all browsers.
* 2. Correct the odd `em` font sizing in all browsers.
*/

code,
kbd,
pre,
samp {
font-family: monospace, monospace; /* 1 */
font-size: 1em; /* 2 */
}

/**
* Add the correct margin in IE 8.
*/

figure {
margin: 1em 40px;
}

/**
* 1. Add the correct box sizing in Firefox.
* 2. Show the overflow in Edge and IE.
*/

hr {
box-sizing: content-box; /* 1 */
height: 0; /* 1 */
overflow: visible; /* 2 */
}

/* Forms
 ========================================================================== */

/**
* 1. Change font properties to `inherit` in all browsers (opinionated).
* 2. Remove the margin in Firefox and Safari.
*/
/**
 * Remove the default vertical scrollbar in IE.
 */

textarea {
  overflow: auto;
}

/**
 * 1. Add the correct box sizing in IE 10-.
 * 2. Remove the padding in IE 10-.
 */

[type="checkbox"],
[type="radio"] {
  box-sizing: border-box; /* 1 */
  padding: 0; /* 2 */
}

/**
 * Correct the cursor style of increment and decrement buttons in Chrome.
 */

[type="number"]::-webkit-inner-spin-button,
[type="number"]::-webkit-outer-spin-button {
  height: auto;
}

/**
 * 1. Correct the odd appearance in Chrome and Safari.
 * 2. Correct the outline style in Safari.
 */

[type="search"] {
  -webkit-appearance: textfield; /* 1 */
  outline-offset: -2px; /* 2 */
  float: center;


}

/**
 * Remove the inner padding and cancel buttons in Chrome and Safari on OS X.
 */

[type="search"]::-webkit-search-cancel-button,
[type="search"]::-webkit-search-decoration {
  -webkit-appearance: none;
}

/**
 * Correct the text style of placeholders in Chrome, Edge, and Safari.
 */

::-webkit-input-placeholder {
  color: inherit;
  opacity: 0.54;
}

/**
 * 1. Correct the inability to style clickable types in iOS and Safari.
 * 2. Change font properties to `inherit` in Safari.
 */

::-webkit-file-upload-button {
  -webkit-appearance: button; /* 1 */
  font: inherit; /* 2 */
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
</style>
