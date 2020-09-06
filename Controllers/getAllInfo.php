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
  

    } 

 $language_from = 'en';

$text_to_translate =$descr;


    $language_to = 'es';


$encoded_text = urlencode(strip_tags($text_to_translate));

$url = 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=' . $language_from . '&tl=' . $language_to . '&dt=t&q=' . $encoded_text;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
curl_setopt($ch, CURLOPT_USERAGENT, 'AndroidTranslate/5.3.0.RC02.130475354-53000263 5.1 phone TRANSLATE_OPM5_TEST_1');
$output = curl_exec($ch);
curl_close($ch);


$response_a = json_decode($output);


foreach ($response_a[0] as $text_block) {
    echo  $text_block[0];
}


} else if (isset($_POST["getDirect"])) { 
    $linkObjs2 = $htmlImdb->find('.credit_summary_item a[href$=_dr]');
    foreach ($linkObjs2 as $linkObj2) {
	  $credits  = trim($linkObj2->plaintext);
    
       echo $credits; 
    } 


}



     
 ?>