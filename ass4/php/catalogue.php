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
        $search = $_GET['search'];    
    }
?> 

<?php
if(file_exists('../xml/birds.xml')){
    $birds = simplexml_load_file(('../xml/birds.xml'));
    $results = $birds->xpath("//bird[contains(english_name, '$search')] | //bird[contains(maori_name, '$search')] | //bird[contains(scientific_name, '$search')]");        
    $count = count($results);

    $bird_array = array();
    foreach ($results as $result)
    {
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
            $result->identification,
            $result->image,
            $result->image_220,
            $result->alt,
            $result->source
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
  </head>
  <!-- page body -->
  <body class="theme-light">
    <?php 
    $active = "catalogue";
    $logo_href = "./index.php";
    $logo_src = "../assets/images/icons/logo.svg";
    $home = "./index.php";
    $contact = "contact.php";
    $catalogu = "catalogue.php";
    include("../php/components/header.php")?>
    <!-- main content -->
    <main id="catalogue" class="home">
        <div class="content-wrap">
            <form method="GET" action="catalogue.php" id="search-form">
                <div>
                    <input type="text" placeholder="Search for a bird by name..." name="search" value=<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search'], ENT_QUOTES) : ''; ?>>
                    <input type="submit" value="Search" class="btn-search"/>
                </div>
                <div>
                    <label>Sort:</label>
                    <select name="bird-sort" id="bird-sort" onchange="this.form.submit()">
                        <option value="english" <?php echo isset($_GET['bird-sort']) && $_GET['bird-sort'] == "english" ? "selected" : ''; ?>>English Name</option>
                        <option value="maori" <?php echo isset($_GET['bird-sort']) && $_GET['bird-sort'] == "maori" ? "selected" : ''; ?>>Māori Name</option>
                        <option value="consv" <?php echo isset($_GET['bird-sort']) && $_GET['bird-sort'] == "consv" ? "selected" : ''; ?>>Conservation Status</option>
                        <option value="weight" <?php echo isset($_GET['bird-sort']) && $_GET['bird-sort'] == "weight" ? "selected" : ''; ?>>Weight</option>
                        <option value="length" <?php echo isset($_GET['bird-sort']) && $_GET['bird-sort'] == "length" ? "selected" : ''; ?>>Length</option>
                    </select>
                </div>
            </form>
            <section id="results-bar">
                <h4><?php 
                    if($search){
                        
                        
                        echo "Found $count birds";
                    }                    
                ?></h4>

                

            </section>
            <section id="results-recent">
                <div id="results">
                    <?php            
                       
                       if($search){
                            foreach ($bird_array as $result) {
                                $src = $result->get_image_220();
                                $alt = $result->get_alt();
                                $bird_id = $result->get_bird_id();
                                $english_name = $result->get_english_name();
                                $maori_name = $result->get_maori_name();
                                $scientific_name = $result->get_scientific_name();
                                $conservation_status = $result->get_conservation_status();
                                $information = $result->get_information();
                                $weight = $result->get_weight();
                                $length = $result->get_length();
                                $classification = $result->get_classification();
                                include("./components/bird_card.php");
                            }
                       }                        
                    ?>
                </div> 
                <aside id="recent">
                    <h4>Recently Viewed</h4>
                    <?php
                        if(!$data_avail){
                            echo "<p>No recent history available</p>";

                        }else{
                            foreach ($recent as $bird_id) {
                                $results = $birds->xpath("//bird[bird_id='$bird_id']");  
                                foreach($results as $result){
                                    $caption = $result->english_name;
                                    $bird_id = $result->bird_id;
                                    $bird_id = "./species.php?bird_id=".$bird_id;
                                    $src = $result->image_220;
                                    $alt = $result->alt;
                                    $src = "../assets/images/birds/$src";
                                    include("./components/bird.php");
                                }
                            }
                        }
                    ?>        
                </aside>               
            </section>        
        </div>
    </main>
  </body>
</html>

    <!-- link to external Javascript file-->
    <script src="../js/main.js" type="application/javascript"></script>