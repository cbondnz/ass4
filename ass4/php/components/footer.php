<!-- This php component represents the footer object that appears on all pages throughout the website -->
<footer id="footer">
        <!-- main content -->
        <section id="footer-main">
            <div class="content-wrap">
                <!-- Mission statement box -->
                <div id="mission">
                    <h1>Our mission</h1>
                    <p>The aim of this website is to showcase the native birds of New Zealand, providing key information about the birds. We aim to motivate people to take a greater interest in some of the native bird species in New Zealand.</p>
                </div>
                <!-- Menus box -->
                <div>
                    <h1>Menus</h1>
                    <ul>
                        <a href="<?php echo $home?>">
                            <li>Home</li>
                        </a>
                        <a href="<?php echo $catalogue?>">
                            <li>Catalogue</li>
                        </a>
                    </ul>
                </div>
                <!-- Website logo and  tagline for the webiste -->
                <div>
                    <img src="<?php echo $src?>" alt="NZ Native Birds Catalogue Logo"/>
                    <p>Explore and learn about the <br/> native birds of New Zealand.</p>
                </div>
            </div>
        </section>

        <!-- additional content -->
        <section id="footer-sub">
            <div class="content-wrap">
                <cite>Video by Kelly: <a href="https://www.pexels.com/video/plants-clinging-by-the-tree-branches-in-a-forest-2882118/" target="_blank">https://www.pexels.com/video/plants-clinging-by-the-tree-branches-in-a-forest-2882118/</a></cite>
                <cite>All content for this website has been sourced from <a href="https://nzbirdsonline.org.nz/" target="_blank">https://nzbirdsonline.org.nz/</a></cite>
            </div>            
        </section>  
</footer>