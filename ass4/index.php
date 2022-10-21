<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
?>

<?php
if(file_exists('./xml/birds.xml')){
    $birds = simplexml_load_file(('./xml/birds.xml'));
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
    <link rel="stylesheet" href="./css/stylesheet.css" />
    <link rel="shortcut icon" type="image/jpg" href="./assets/images/icons/favicon-32x32.png"/>
  </head>
  <!-- page body -->
  <body class="theme-light">
    
    <!-- main content -->
    <main id="app" class="home">
        <section class="hero">
            <video loop muted autoplay preload="auto">
                <source src="./assets/video/video.mp4" type="video/mp4">
            </video>
            <div id="hero-text" class="content-wrap">
                <h1>New Zealand <br/> Native Bird <br/> <span>Catalogue</span></h1>
                <p>Explore and learn about the native birds of New Zealand.</p>
                <form action="./php/catalogue.php" method="POST">
                    <input id="btn-catalogue" value="Go to Catalogue" type="submit"/>
                </form>
                
            </div>
            <div id="scroll-down">                
                <span>S</span>
                <span>c</span>
                <span>r</span>
                <span>o</span>
                <span>l</span>
                <span>l</span>
            </div>
        </section> 
        <section id="categories">
            <div class="content-wrap">  
            <section class="category">                
                    <h3>Recently Viewed</h3>
                    <?php
                        if(!$data_avail){
                            echo "<p>No recent history available</p>";

                        }else{
                            foreach ($recent as $bird_id) {
                                $results = $birds->xpath("//bird[bird_id='$bird_id']");  
                                foreach($results as $result){
                                    $caption = $result->english_name;
                                    $bird_id = $result->bird_id;
                                    $bird_id = "./php/species.php?bird_id=".$bird_id;
                                    $src = $result->image_220;
                                    $alt = $result->alt;
                                    $src = "./assets/images/birds/$src";
                                    include("./php/components/bird.php");
                                }
                            }
                        }
                    ?>        
                </section>
                <section class="category">
                    <h3>Threatened & At Risk Species</h3>
                    <?php 
                        $results = $birds->xpath("
                        //bird[conservation_status='Relict'] | 
                        //bird[conservation_status='Recovering'] | 
                        //bird[conservation_status='Declining'] | 
                        //bird[conservation_status='Naturally Uncommon'] | 
                        //bird[conservation_status='Nationally Critical'] |
                        //bird[conservation_status='Nationally Endangered'] | 
                        //bird[conservation_status='Nationally Vulnerable']");        
                        $count = count($results);
                        $scroll = "";
                        if($count >=5){
                            $scroll = "scrollable";
                        }                    
                    ?>
                    <div class="category-items <?php echo $scroll?>">    
                        <?php                
                            foreach ($results as $result) {
                                $caption = $result->english_name;
                                $bird_id = $result->bird_id;
                                $src = $result->image_220;
                                $alt = $result->alt;
                                $src = "./assets/images/birds/$src";  
                                include("php/components/bird.php");
                            }
                        ?>                          
                    </div>
                </section>
                <section class="category">
                    <h3>Land Birds</h3>
                    <?php 
                        $results = $birds->xpath("//bird[classification='Land']");        
                        $count = count($results);
                        $scroll = "";
                        if($count >=5){
                            $scroll = "scrollable";
                        }                    
                    ?>
                    <div class="category-items <?php echo $scroll?>">    
                        <?php                             
                            foreach ($results as $result) {
                                $caption = $result->english_name;
                                $bird_id = $result->bird_id;
                                $src = $result->image_220;
                                $alt = $result->alt;
                                $src = "./assets/images/birds/$src";                           
                                include("php/components/bird.php");
                            }
                        ?>                          
                    </div>
                </section>
                <section class="category">
                    <h3>Flightless Land Birds</h3>
                    <?php 
                        $results = $birds->xpath("//bird[classification='Flightless']");        
                        $count = count($results);
                        $scroll = "";
                        if($count >=5){
                            $scroll = "scrollable";
                        }                    
                    ?>
                    <div class="category-items <?php echo $scroll?>">    
                        <?php                
                            foreach ($results as $result) {
                                $caption = $result->english_name;
                                $bird_id = $result->bird_id;
                                $src = $result->image_220;
                                $alt = $result->alt;
                                $src = "./assets/images/birds/$src";  
                                include("php/components/bird.php");
                            }
                        ?>                          
                    </div>
                </section>
                <section class="category">
                    <h3>Wetland Birds</h3>
                    <?php 
                        $results = $birds->xpath("//bird[classification='Wetland']");        
                        $count = count($results);
                        $scroll = "";
                        if($count >=5){
                            $scroll = "scrollable";
                        }                    
                    ?>
                    <div class="category-items <?php echo $scroll?>">    
                        <?php                
                            foreach ($results as $result) {
                                $caption = $result->english_name;
                                $bird_id = $result->bird_id;
                                $src = $result->image_220;
                                $alt = $result->alt;
                                $src = "./assets/images/birds/$src";  
                                include("php/components/bird.php");
                            }
                        ?>                          
                    </div>
                </section>
                <section class="category">
                    <h3>Seabirds</h3>
                    <?php 
                        $results = $birds->xpath("//bird[classification='Seabird']");        
                        $count = count($results);
                        $scroll = "";
                        if($count >=5){
                            $scroll = "scrollable";
                        }                    
                    ?>
                    <div class="category-items <?php echo $scroll?>">    
                        <?php                
                            foreach ($results as $result) {
                                $caption = $result->english_name;
                                $bird_id = $result->bird_id;
                                $src = $result->image_220;
                                $alt = $result->alt;
                                $src = "./assets/images/birds/$src";  
                                include("php/components/bird.php");
                            }
                        ?>                          
                    </div>
                </section>
            </div>            
        </section>  
        <?php 
        $src = "./assets/images/icons/logo.svg";
        $home = "index.php";
        $catalogue = "./php/catalogue.php";
        $contact = "./php/contact.php";
        include("./php/components/footer.php")?>       
    </main>
  </body>
</html>

<!-- link to external Javascript file-->
<script src="./js/main.js" ></script>