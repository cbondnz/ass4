<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
?>

<?php
include('../php/classes/bird.php')


?>

<?php
    $sort = null;
    $search = null;
    if(isset($_GET['bird-sort'])){
        $sort = $_GET['bird-sort'];
    }
    if(isset($_GET['search'])){
        $search = strtolower($_GET['search']);    
    }
?> 

<?php
if(file_exists('../xml/birds.xml')){
    $birds = simplexml_load_file(('../xml/birds.xml'));
    $results  = $birds->xpath(
        "//bird[contains(translate(english_name, 'ABCDEFGHJIKLMNOPQRSTUVWXYZ', 'abcdefghjiklmnopqrstuvwxyz'), '$search')] | 
        //bird[contains(translate(maori_name, 'ABCDEFGHJIKLMNOPQRSTUVWXYZĀĒĪŌŪ', 'abcdefghjiklmnopqrstuvwxyzāēīōū'), '$search')] |
        //bird[contains(translate(scientific_name, 'ABCDEFGHJIKLMNOPQRSTUVWXYZ', 'abcdefghjiklmnopqrstuvwxyz'), '$search')] 
        " 
    );
    //$results = $birds->xpath("//bird[contains(translate(.,'$search'), '$search')]");        
    $count = count($results);

    $bird_array = array();
    foreach ($results as $result)
    {
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
        array_push($bird_array, $bird);
    }

    if($sort == 'english'){
        usort($bird_array, function($a, $b){
            return strcmp($a->get_english_name(), $b->get_english_name());
        });
    }

    if($sort == 'maori'){
        usort($bird_array, function($a, $b){
            return strcmp($a->get_maori_name(), $b->get_maori_name());
        });
    }

    if($sort == 'consv'){
        usort($bird_array, function($a, $b){
            return strcmp($a->get_conservation_status(), $b->get_conservation_status());
        });
    }

    if($sort == 'weight'){
        usort($bird_array, function($a, $b){
            return $a->get_lower_weight() - $b->get_lower_weight();
        });
    }

    if($sort == 'length'){
        usort($bird_array, function($a, $b){
            return $a->get_lower_length() - $b->get_lower_length();
        });
    }

    


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
  }   
?>



<!DOCTYPE html>
<html lang="en">
  <!-- page header -->
  <head>
    <!-- page meta data -->
    <meta charset="utf-8" />
    <meta name="description" content="New Zealand Native Bird Catalogue - Explore and learn about New Zealand native birds." />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>New Zealand Native Bird Catalogue - Explore and learn about New Zealand native birds.</title>
    <!-- link to external CSS file-->
    <link rel="stylesheet" href="../css/stylesheet.css" />
    <link rel="shortcut icon" type="image/jpg" href="../assets/images/icons/favicon-32x32.png"/>
  </head>
  <!-- page body -->
  <body class="theme-light">
    <?php 
    $active = "contact";
    $logo_href = "../index.php";
    $logo_src = "../assets/images/icons/logo.svg";
    $home = "../index.php";
    $contact = "contact.php";
    $catalogue = "catalogue.php";
    include("../php/components/header.php")?>
    <!-- main content -->
    <main id="contact" class="home">
        <div class="contact-wrap">
            <h1>Contact Us</h1>
            <form method="POST" action="contact.php" id="contact-form" class="bird-card">
                <input type="text" name="name" placeholder="Please provide your name" pattern="[a-zA-Z]" required/>
                <input type="text" name="email" placeholder="Please provide your email address" pattern="^\w+@[a-z]+(\.[a-z]+)+$" required/>
                <textarea id="message" name="message" rows="5" cols="33" placeholder="Start typing your message here..." required></textarea>
                <input type="submit" />
            </form>
        </div>
    </main>
    <?php 
        $src = "../assets/images/icons/logo.svg";
        $home = "../index.php";
        $catalogue = "catalogue.php";
        $contact = "contact.php";
        include("./components/footer.php")?>       
  </body>
  </body>
</html>