<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
?>

<!-- Import the bird class -->
<?php include('../php/classes/bird.php')?>

<!-- Check if the $_GET variables are set. These will be set if a user is searching for a bird or
selecting a sort option from the sorting feature -->
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

<!-- Open the birds.xml file and search for birds based on the search phrases that the user has typed in the search box -->
<?php
if(file_exists('../xml/birds.xml')){
    $birds = simplexml_load_file(('../xml/birds.xml'));
    $results  = $birds->xpath(
        "//bird[contains(translate(english_name, 'ABCDEFGHJIKLMNOPQRSTUVWXYZ', 'abcdefghjiklmnopqrstuvwxyz'), '$search')] | 
        //bird[contains(translate(maori_name, 'ABCDEFGHJIKLMNOPQRSTUVWXYZĀĒĪŌŪ', 'abcdefghjiklmnopqrstuvwxyzāēīōū'), '$search')] |
        //bird[contains(translate(scientific_name, 'ABCDEFGHJIKLMNOPQRSTUVWXYZ', 'abcdefghjiklmnopqrstuvwxyz'), '$search')] 
        " 
    );
    
    // Set the count variable for the number of results from the search operation 
    $count = count($results);

    // Create an array to hold invidiual bird objects which are created from the bird.php class
    $bird_array = array();

    // Loop through each bird in the birds.xml file
    foreach ($results as $result)
    {        
        // Create an array to hold the paragraph objects that are embedded in the birds.xml 
        // file. These paragraphs appear in the identification description for each bird
        $identification = $result->identification;
        $array = array();
        foreach($identification->paragraph as $obj){
            array_push($array, (string)$obj);
        }

        // Create a bird 
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
        
        // Push the bird object into the bird array
        array_push($bird_array, $bird);
    }

    // Sort the bird array based on what has been selected in the sort dropdown box
    switch ($sort) {
        case 'english':
            usort($bird_array, function($a, $b){
                return strcmp($a->get_english_name(), $b->get_english_name());
            });
            break;
        case 'maori':
            usort($bird_array, function($a, $b){
                return strcmp($a->get_maori_name(), $b->get_maori_name());
            });
            break;
        case 'consv':
            usort($bird_array, function($a, $b){
                return strcmp($a->get_conservation_status(), $b->get_conservation_status());
            });
            break;
        case 'weight':
            usort($bird_array, function($a, $b){
                return $a->get_lower_weight() - $b->get_lower_weight();
            });
            break;
        case 'length':
            usort($bird_array, function($a, $b){
                return $a->get_lower_length() - $b->get_lower_length();
            });
            break;
        default:
            break;
    }
}else{
    exit('Failed to open birds.xml');
}
?>

<!-- Get the cookie that holds an array of recently viewed birds -->
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
    <!-- favicon -->
    <link rel="shortcut icon" type="image/jpg" href="../assets/images/icons/favicon-32x32.png"/>
  </head>
  <!-- page body -->
  <body class="theme-light">
    <!-- header with navigation links and site logo -->
    <?php 
    $active = "catalogue";
    $logo_href = "../index.php";
    $logo_src = "../assets/images/icons/logo.svg";
    $home = "../index.php";
    $contact = "contact.php";
    $catalogue = "catalogue.php";
    include("../php/components/header.php")?>

    <!-- main content -->
    <main id="catalogue" class="home">
        <div class="content-wrap">
            <!-- search inbox box and sorting drop down list -->
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
                        <option value="weight" <?php echo isset($_GET['bird-sort']) && $_GET['bird-sort'] == "weight" ? "selected" : ''; ?>>Weight (low to high)</option>
                        <option value="length" <?php echo isset($_GET['bird-sort']) && $_GET['bird-sort'] == "length" ? "selected" : ''; ?>>Length (low to high)</option>
                    </select>
                </div>
            </form>
            <!-- Results bar to indicate how many birds were found in the search -->
            <section id="results-bar">
                <h4><?php if($search){echo "Found $count birds";}?></h4>     
            </section>
            <!-- Search results -->
            <section id="results-recent">
                <div id="results">
                    <?php           
                        if($search){
                            foreach ($bird_array as $result) {
                                $src = $result->get_image();
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
                                $icon_box = $result->get_icon_box();
                                include("./components/bird_card.php");
                            }
                       }                        
                    ?>
                </div> 
                <!-- Recently viewed birds (max 5) -->
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
                                    $src = $result->image;
                                    $alt = $result->alt;
                                    $src = "../assets/images/birds/220_$src";
                                    include("./components/bird.php");
                                }
                            }
                        }
                    ?>        
                </aside>               
            </section>        
        </div>
    </main>
    <!-- Footer -->
    <?php 
        $src = "../assets/images/icons/logo.svg";
        $home = "../index.php";
        $catalogue = "catalogue.php";
        $contact = "contact.php";
        include("./components/footer.php")?>    
  </body>
</html>
<!-- link to external Javascript file-->
<script src="../js/main.js" type="application/javascript"></script>