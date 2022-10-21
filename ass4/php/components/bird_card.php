<div class="bird-card">
    <picture>
        <a href="./species.php?bird_id=<?php echo $bird_id?>">
            <img src="../assets/images/birds/<?php echo $src?>" alt="<?php echo $alt?>" />
        </a>        
    </picture>
    <div>
        <a href="./species.php?bird_id=<?php echo $bird_id?>">
            <h4><?php echo $english_name; echo $maori_name != "" ? " | $maori_name" : "" ;?></h4>
        </a>
        <div class="icon-layout">
            <div class="icon-box">
                <img src="../assets/images/icons/weight.svg" class="icon"/> 
                <span> <?php echo $weight?></span> 
            </div>
            <div class="icon-box">
                <img src="../assets/images/icons/length.svg" class="icon"/> 
                <span> <?php echo $length?></span> 
            </div>
            <div class="icon-box">
                <img src=<?php 
                if($classification == 'Seabird'){
                    echo "../assets/images/icons/seabird.svg";
                }else if($classification == 'Land'){
                    echo "../assets/images/icons/land.svg";
                }else if($classification == 'Flightless'){
                    echo "../assets/images/icons/flightless.svg";
                }else if($classification == 'Wetland'){
                    echo "../assets/images/icons/wetland.svg";
                }
                ?> class="icon"/> 
                <span> <?php echo $classification?></span> 
            </div>
        </div>
        <hr/>          
        <ul>
            <li><span>Scientific Name:</span> <?php echo $scientific_name?></li>
            <li><span>Conservation Status:</span> <?php echo $conservation_status?></li>
            <li class="information"><span>Information:</span> <?php echo $information?></li>        
        </ul>
    </div>   
</div>