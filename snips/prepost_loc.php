<?php

$content = $_GET["c"];
$access = false;

if (!$content)
	$content = "index";

$l = $_GET["l"];

if (!$l) {
	$l = "en";
}

$langs = array("de", "fr", "es", "nl", "pl", "ru", "zh", "ja");

if (!in_array($l, $langs)) {
	$l = "en";
	
	$_l = "";
	$__l = "?";
	$___l = "";
} else {
	$_l = "&l=$l";
	$__l = "?l=$l";
	$___l = "&amp;l=$l";
}
	
if (file_exists("content/$content"."_acc.php"))
{
	include "content/$content"."_acc.php";
}

if ($access)
{
	include "content/$content"."_pre.php";
}

if ($l == "en") {
	if (isset($_PRE["REQUEST_URI"]) && $_SERVER["REQUEST_URI"] != "slc24_v2/".$_PRE["REQUEST_URI"])
	{
		header("Location: ttp://localhost/slc24_v2/".$_PRE["REQUEST_URI"]);
	}
} else {
	if ($_PRE["REQUEST_URI"] != "/") {
		if (isset($_PRE["REQUEST_URI"]) && $_SERVER["REQUEST_URI"] != "/slc24_v2".$_PRE["REQUEST_URI"]."&l=$l")
			header("Location: http://localhost/slc24_v2".$_PRE["REQUEST_URI"]."&l=$l");
	} else {
		if (isset($_PRE["REQUEST_URI"]) && $_SERVER["REQUEST_URI"] != "/slc24_v2/?l=$l")
			header("Location: http://localhost/slc24_v2/?l=$l");
	}
}

get_connection();

if ($_SESSION["li"] == 1) {
	mysql_query("UPDATE user SET last_action = NOW() WHERE id = '$_SESSION[user_id]'");
}

?>