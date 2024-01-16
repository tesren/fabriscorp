<?php get_header();?>

<?php if( have_posts() ): ?>

    <?php while( have_posts() ): the_post();?>

        <div class="position-relative">
            <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' )?>" alt="<?php echo get_the_title();?>" class="w-100" style="height:50vh; object-fit:cover;">
            <div class="fondo-oscuro"></div>

            <?php $categories = get_the_category(); ?>

            <div class="row position-absolute h-100 top-0 start-0 text-white z-2">
                <div class="col-12 text-center align-self-center">
                    <h1 class="fs-1 text-uppercase mb-3"><?php echo get_the_title();?></h1>
                    <div class="my-4 d-flex justify-content-center fs-5">
                        <?php foreach($categories as $cat): ?>
                            <div class="badge bg-blue fs-6 fw-light rounded-pill me-3"><?php echo $cat->name; ?></div>
                        <?php endforeach; ?>
                        
                        <div class="me-3 align-self-center"><?php echo get_the_date(); ?></div>
                        <div class="align-self-center"><?php echo get_the_author(); ?></div>
                    </div>
                </div>
            </div>

        </div>
                       
        <div class="col-12 px-2 col-lg-10 mx-auto mt-5">

            <div class="mb-5 fs-5">
                <?php echo the_content(); ?>
            </div>

        </div>

    <?php endwhile; ?>

<?php endif; ?>

<?php get_footer();?>