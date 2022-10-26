<!-- This php component represents a bird object in a basic sense of an image and a name -->
<figure class="bird">
    <!-- Image for the bird -->
    <a href="<?php echo $bird_id?>">
        <picture>            
                <img src="<?php echo $src?>" alt="<?php echo $alt?>">            
        </picture> 
    </a>  
    <!-- Name of the bird -->
    <figcaption><?php echo $caption?></figcaption>
</figure>