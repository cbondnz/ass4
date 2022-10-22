<!-- This php component represents a bird card on the catalogue.php page -->
<div class="bird-card">
    <!-- Image for the bird -->
    <picture>
        <a href="./species.php?bird_id=<?php echo $bird_id?>">
            <img src="../assets/images/birds/220_<?php echo $src?>" alt="<?php echo $alt?>" />
        </a>        
    </picture>
    <!-- Section for the bird summary information -->
    <div>
        <a href="./species.php?bird_id=<?php echo $bird_id?>">
            <h4><?php echo $english_name; echo $maori_name != "" ? " | $maori_name" : "" ;?></h4>
        </a>
        <?php echo $icon_box?>
        <hr/>          
        <ul>
            <li><span>Scientific Name:</span> <?php echo $scientific_name?></li>
            <li><span>Conservation Status:</span> <?php echo $conservation_status?></li>
            <li class="information"><span>Information:</span> <?php echo $information?></li>        
        </ul>
    </div>   
</div>