<?php 
include("simple_html_dom.php");
$link=$_POST["linkImdb"];

$htmlImdb=file_get_html($link);

if (isset($_POST["getImg"])) {

      $linkObjs2 = $htmlImdb->find('.poster a img');

      foreach ($linkObjs2 as $linkObj2) {
	       $linkImg  = trim($linkObj2->src);
  
           echo  $linkImg; 

      
      } 

} else if (isset($_POST["getDesc"])) { 
    $linkObjs2 = $htmlImdb->find('.summary_text');
    foreach ($linkObjs2 as $linkObj2) {
	     $descr  = trim($linkObj2->plaintext);
  
    echo $descr;

    } 
/*
$textt = $descr;

$json = file_get_contents('https://api.mymemory.translated.net/get?q='.urlencode($textt).'&langpair=en|es');

    if (!empty($json)) { 
    $obj = json_decode($json);   
    echo $obj->responseData->translatedText;
    }*/
} else if (isset($_POST["getDirect"])) { 
    $linkObjs2 = $htmlImdb->find('.credit_summary_item a[href$=_dr]');
    foreach ($linkObjs2 as $linkObj2) {
	  $credits  = trim($linkObj2->plaintext);
    
       echo $credits; 
    } 


}



     
 ?>