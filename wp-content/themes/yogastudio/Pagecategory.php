<?php
/**
 * Template Name: PageCategory 

 */
get_header(); 


?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
 
            the_content();
 
            // End of the loop.
        endwhile;
        ?>
        <?php
         $categories =  get_categories();
        $i = 0;
        foreach  ($categories as $category) {
            
            ?>
            <li><a href="<?php bloginfo('url');?>/category/<?php echo $category->slug; ?>"><?php echo $category->cat_name?></a></li>
            <?php
            
            $i++;
        }
    
        ?>
        
    </main><!-- .site-main -->
 
 
 
</div><!-- .content-area -->
<?php

get_footer();
?>