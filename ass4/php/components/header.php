<!-- This php component is for the header that appears on all the pages in the website  -->
<header id="header" class="active">
  <div class="content-wrap">
    <!-- Website logo -->
    <a href="<?php echo $logo_href?>">
      <img src="<?php echo $logo_src?>" alt="NZ Native Birds Catalogue Logo"/>
    </a>  
    <!-- Main navigation -->
    <nav>
      <ol>
        <li class=<?php echo $active == "home"? "active-menu": "inactive-menu"?>>
          <a href="<?php echo $home?>"> Home </a>
        </li>
        <li class=<?php echo $active == "catalogue" ? "active-menu": "inactive-menu"?>>
          <a href="<?php echo $catalogue?>" > Catalogue </a>
        </li>
      </ol>
    </nav>
  </div>
</header>