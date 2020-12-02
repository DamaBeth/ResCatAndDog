<?php

require("libs/config.php");
$pageDetails = getPageDetailsByName($currentPage);

include("header.php");
?>
<div class="row main-row">
    <div class="9u">
        <section class="left-content">
            <h2><?php echo stripslashes($pageDetails["page_title"]); ?></h2>
            <?php echo stripslashes($pageDetails["page_desc"]); ?>
            
            <div class="row">
                <div class="12u">
                    <a class="twitter-follow-button"
		                href="https://beanimalheroes.org/?gclid=CjwKCAiA8Jf-BRB-EiwAWDtEGpiFN_iPjf5NStKLOOYn1kt1A8DD2ALN_EmS8l7gHXTvt5fTAYSJCRoCoDUQAvD_BwE"
		                data-show-count="true" data-size="large"  
		                data-lang="en">
		                Animal heroes 
                    </a><br>
                    <a class="twitter-follow-button"
		                href="https://igualdadanimal.org/"
		                data-show-count="true" data-size="large"  
		                data-lang="en">
		                Igualdad animal 
                    </a><br>
                    <a class="twitter-follow-button"
		                href="http://iba.puebla.gob.mx/"
		                data-show-count="true" data-size="large"  
		                data-lang="en">
		                Instituto de bienestar animal - Puebla 
                    </a>
                    
                </div>
            </div>
        </section>
    
    </div>
    <!--sidebar starts-->
	<?php include("sidebar.php"); ?>    
    <!--sidebar ends-->
</div>
<?php
include("footer.php");
?>