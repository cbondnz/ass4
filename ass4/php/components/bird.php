<!-- This php component represents a bird object in a basic sense of an image and a name -->
<figure class="bird">
    <!-- Image for the bird -->
    <picture>
        <a href="<?php echo $bird_id?>">
            <img src="<?php echo $src?>" alt="<?php echo $alt?>" />
        </a>
    </picture>   
    <!-- Name of the bird -->
    <figcaption><?php echo $caption?></figcaption>
</figure>