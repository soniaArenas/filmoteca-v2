<?php 
include("simple_html_dom.php");
$a=$_POST["str"];

$url  = 'http://www.google.com/search?hl=en&tbo=d&site=&source=hp&q='.$a.'&oq='.$a.'';
$html=file_get_html($url);



$linkObjs = $html->find('a');
foreach ($linkObjs as $linkObj) {
    $title = trim($linkObj->plaintext);
    $link  = trim($linkObj->href);
    
    // if it is not a direct link but url reference found inside it, then extract
    if (!preg_match('/^https?/', $link) && preg_match('/q=(.+)&amp;sa=/U', $link, $matches) && preg_match('/^https?/', $matches[1])) {
        $link = $matches[1];
    } else if (!preg_match('/^https?/', $link)) { // skip if it is not a valid link
        continue;    
    }
    if(strpos($title,'title')){
    
    echo  $link; 
       break;
    }   
}




 ?>