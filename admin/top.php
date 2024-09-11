<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Drew Smith, Matt Mccarthy, Aiden Davidson">
        <meta name="description" content="Drew, Matt, and Aiden's CS148 Final Project">

        <title>CS 148 Database Design for the web</title>

        <link rel="stylesheet"
            href="../css/custom.css?version=<?php print time(); ?>"
            type="text/css">
        <link rel="stylesheet" media="(max-width:800px)"
            href="../css/tablet.css?version=<?php print time(); ?>"
            type="text/css">
        <link rel="styleshet" media="(max-width:600px)"
            href="../css/phone.css?version=<?php print time(); ?>"
            type="text/css">


<?php

include '../lib/constants.php';
print '<!-- make database connections -->';
require_once('../lib/Database.php');

$thisDatabaseReader = new Database('mmccar25_reader', 'r', DATABASE_NAME);
$thisDatabaseWriter = new Database('mmccar25_writer', 'w', DATABASE_NAME);
?>

</head>

<?php

print '<body>';
print '<!-- ***** START OF THE BODY **** -->';

print PHP_EOL;

include 'nav.php';
print PHP_EOL;

include 'header.php';
print PHP_EOL;



?>
