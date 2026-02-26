<?php
require_once('c:\xampp\htdocs\QuizMaster\includes\fpdf\makefont\makefont.php');

$url = 'https://raw.githubusercontent.com/google/fonts/main/ofl/greatvibes/GreatVibes-Regular.ttf';
$fontData = file_get_contents($url);
if ($fontData) {
    file_put_contents('GreatVibes-Regular.ttf', $fontData);
    MakeFont('GreatVibes-Regular.ttf', 'cp1252');
    echo "Success";
} else {
    echo "Failed to download";
}
?>
