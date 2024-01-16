<?php get_header(); ?>

    <article>
  
        <h1 class="text-center my-5"><?php the_title();?></h1>

        <?php if ( have_posts() ): ?>
                
            <?php while( have_posts() ): the_post();?>
                    
                <div class="container">
                    <?php the_content(); ?>
                </div>

            <?php endwhile; ?>
            
        <?php endif; ?>

    </article>

<?php get_footer(); ?>