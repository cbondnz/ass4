<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
?>

<?php
if(file_exists('../xml/birds.xml')){
    $birds = simplexml_load_file(('../xml/birds.xml'));
}else{
    exit('Failed to open birds.xml');
}
?>

<?php
include('../php/classes/bird.php')


?>

<?php
    $bird_id = $_GET["bird_id"];
    $results = $birds->xpath("//bird[bird_id='$bird_id']");
    //var_dump($results);
    foreach($results as $result){
      $identification = $result->identification;

      $array = array();
      foreach($identification->paragraph as $obj){
        array_push($array, (string)$obj);
      }
  
      $bird = new Bird(
        $result->english_name,
        $result->maori_name,
        $result->scientific_name,
        $result->conservation_status,
        $result->classification,
        $result->other_names,
        $result->length,
        $result->weight,
        $result->lower_length,
        $result->length_unit,
        $result->lower_weight,
        $result->weight_unit,
        $result->upper_length,
        $result->upper_weight,
        $result->bird_id,
        $result->information,
        $array,
        $result->image,
        $result->alt,
        $result->source,
        $result->breeding,
        $result->egg_laying
      );  
    }
?>

<?php
  if(isset($_COOKIE['recent'])){
    // Cookie available
    // Get the array from the cookie
    $recent = json_decode($_COOKIE['recent'], true); 

    // Push new bird onto the array it not already in the array
    if(!in_array($bird_id, $recent)){
      array_unshift($recent, $bird_id);
    }    

    // Pop off the end if greater than 5
    if(count($recent) > 5){
      array_pop($recent);
    }    

    // Set cookie again
    setcookie('recent', json_encode($recent), time() + 2592000,"/" );
  }else{
    // No cookie, create and set a cookie
    $recent = array($bird_id);
    setcookie('recent', json_encode($recent), time() + 2592000,"/" );
  }    
?>


<!DOCTYPE html>
<html lang="en">
  <!-- page header -->
  <head>
    <!-- page meta data -->
    <meta charset="utf-8" />
    <meta name="description" content="<?php echo $english_name; echo $maori_name != "" ? " | $maori_name" : "" ;?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $english_name; echo $maori_name != "" ? " | $maori_name" : "" ;?></title>
    <!-- link to external CSS file-->
    <link rel="stylesheet" href="../css/stylesheet.css" />
    <link rel="shortcut icon" type="image/jpg" href="../assets/images/icons/favicon-32x32.png"/>
  </head>
  <!-- page body -->
  <body class="theme-light">
  <?php 
    $active = "species";
    $logo_href = "../index.php";
    $logo_src = "../assets/images/icons/logo.svg";
    $home = "../index.php";
    $contact = "contact.php";
    $catalogue = "catalogue.php";
    include("../php/components/header.php")?>
    <!-- main content -->
    <main id="species" class="home">
      <div class="content-wrap">
        <h2><?php echo $bird->get_english_name();?></h2>
        <!-- bird image and statistics section -->
        <section id="img-stat">
          <figure id="image">
            <img src="<?php echo "../assets/images/birds/470_".$bird->get_image();?>" alt="<?php echo $bird->get_alt();?>" />
            <figcaption><?php echo $bird->get_alt();?></figcaption>
          </figure>
          <aside id="statistics">              
            <ul>
                <?php echo $bird->get_scientific_name_box();?> 
                <?php echo $bird->get_maori_name_box();?> 
                <?php echo $bird->get_conservation_status_box();?>
                <?php echo $bird->get_weight_box();?> 
                <?php echo $bird->get_length_box();?> 
                <?php echo $bird->get_classification_box();?> 
                <?php echo $bird->get_other_names_box();?>       
            </ul>
            <hr/>   
            <?php echo $bird->get_icon_box();?>               
          </aside>
        </section>
        <!-- bird information section -->
        <section>
          <h3>Information</h3>          
          <p><?php echo $bird->get_information();?></p>
        </section>
        <!-- bird identification section -->
        <section id="identification">
          <h3>Identification</h3>
          <?php echo $bird->get_identification();?>
        </section>
        <!-- breeding season table -->
        <section id="breeding">
          <h3>Breeding season</h3>
          <div id="legend">
            <input type="color" value="#a01d6b" disabled/>
            <label>= active</label>
          </div>
          <table>
            <tr>
            <?php 
            echo $bird->get_breeding();
            ?>                          
            </tr>
          </table>
        </section>
        <!-- Egg laying season table -->
        <section id="egg_laying">
          <h3>Egg Laying season</h3>
          <div id="legend">
            <input type="color" value="#a01d6b" disabled/>
            <label>= active</label>
          </div>
          <table>
            <tr>
            <?php 
            echo $bird->get_egg_laying();
            ?>                          
            </tr>
          </table>
        </section>
      </div>    
    </main>
    <?php 
        $src = "../assets/images/icons/logo.svg";
        $home = "../index.php";
        $catalogue = "catalogue.php";
        $contact = "contact.php";
        include("./components/footer.php")?> 
  </body>
</html>
<!-- link to external Javascript file-->
<script src="./js/main.js" ></script>