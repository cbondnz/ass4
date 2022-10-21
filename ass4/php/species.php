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
    $bird_id = $_GET["bird_id"];
    $results = $birds->xpath("//bird[bird_id='$bird_id']");
    foreach($results as $result){
        $english_name = $result->english_name;
        $maori_name = $result->maori_name;
        $caption = $result->alt;
        $alt = $result->alt;
        $src = $result->image;
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
  </head>
  <!-- page body -->
  <body class="theme-light">
  <?php 
    $active = "species";
    include("../php/components/header.php")?>
    <!-- main content -->
    <main id="app" class="home">
      <!-- bird image and statistics section -->
      <section id="img-stat">
        <figure id="image">
          <img src= <?php echo "../assets/images/birds/$src" ?> alt="<?php echo $alt?>" />
          <figcaption><?php echo $caption?></figcaption>
        </figure>
        <aside id="statistics"></aside>
      </section>
      <!-- bird information section -->
      <section>
        <h2></h2>
        <p></p>
      </section>
      <!-- bird identification section -->
      <section>
        <h2></h2>
        <p></p>
      </section>
      <!-- references section -->
      <section>
        <p></p>
      </section>     
    </main>
  </body>
</html>

<!-- link to external Javascript file-->
<script src="./js/main.js" ></script>