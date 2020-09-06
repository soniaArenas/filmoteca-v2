<?php 
include("simple_html_dom.php");
include("traduct.php");
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

    /* echo $descr;*/

  } 
  echo translate($descr);
  
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


}else if (isset($_POST["getDuration"])) { 
  $linkObjs2 = $htmlImdb->find('.subtext time');
  foreach ($linkObjs2 as $linkObj2) {
    $time = trim($linkObj2->plaintext);
    
    echo $time; 
  }  

} else if (isset($_POST["getGenre"])) { 

  $linkObjs2 = $htmlImdb->find('.subtext a[href^=/search/title?genres]');
  foreach ($linkObjs2 as $linkObj2) {
    $genero = trim($linkObj2->plaintext);
    echo translate($genero)."  ";
    
  }  
  

} else if (isset($_POST["getStars"])) { 

  $linkObjs2 = $htmlImdb->find('a[href*=tt_ov_st_sm]');
  $i=0;
  foreach ($linkObjs2 as $linkObj2) {
    if($i<=2){
      $stars = trim($linkObj2->plaintext);
      
      echo $stars."</br> ";
      $i++; 
    }  
  } 


  

}




?>