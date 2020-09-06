<?php 
include("simple_html_dom.php");
$link=$_POST["linkImdb"];

$htmlImdb=file_get_html($link);


$linkObjs2 = $htmlImdb->find('span[itemprop=ratingValue]');
foreach ($linkObjs2 as $linkObj2) {
    $note = trim($linkObj2->plaintext);
    
    echo  $note; 
    } 


     
 ?>