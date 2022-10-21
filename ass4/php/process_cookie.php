<?php
if(file_exists('../xml/birds.xml')){
    $birds = simplexml_load_file(('../xml/birds.xml'));
}else{
    exit('Failed to open birds.xml');
}
?>

<?php
  $data_avail = false;
  if(isset($_COOKIE['recent'])){
    // Cookie available
    $data_avail = true;

    // Get the array from the cookie
    $recent = json_decode($_COOKIE['recent'], true);
    var_dump($recent);
  }   
?>

<?php
 foreach ($recent as $bird_id) {
    $results = $birds->xpath("//bird[bird_id='$bird_id']");  
    foreach($results as $result){
        $caption = $result->english_name;
        $bird_id = $result->bird_id;
        $src = $result->image_220;
        $alt = $result->alt;
        $src = "../assets/images/$src";
        include("bird.php");
    }
}
?>