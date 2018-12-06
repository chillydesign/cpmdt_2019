<?php get_header(); ?>

<?php // get_template_part( 'breadcrumbs' ); ?>

<!--Title  -->
<div class="page-title" style="margin-bottom: 50px;">
    <div class="container">
        <h1><span>Centre: <?php the_title(); ?></span></h1>
    </div>
</div>

<div class="blog-container">
    <!--Post Content-->

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <!-- Locations information -->
        <div class="container ">

            <div class="locations-container">
                <div class="information">
                    <div class="row">
                        <div class="col-sm-6">

                            <?php $location_id = get_the_ID(); ?>
                            <?php $addresse = get_field('addresse'); ?>
                            <?php $description = get_field('description'); ?>
                            <?php $infos = get_field('infos'); ?>
                            <?php $responsible = get_field('responsible'); ?>
                            <?php $lat = get_field('lat'); ?>
                            <?php $long = get_field('long'); ?>

                            <?php if ($addresse): ?>
                                <p>
                                    <b>Adresse:</b>
                                    <span><?php echo $addresse;  ?></span>
                                </p>
                            <?php endif; ?>
                            <?php if ($infos): ?>
                                <p>
                                    <b>Infos TPG:</b>
                                    <span><?php echo $infos; ?></span>
                                </p>
                            <?php endif; ?>
                            <?php if ($description): ?>
                                <p>
                                    <b>Description:</b>
                                    <span><?php echo $description; ?></span>
                                </p>
                            <?php endif; ?>

                            <?php if ($responsible): ?>
                                <p>
                                    <b>Responsable:</b>
                                    <span><?php echo $responsible; ?></span>
                                </p>
                            <?php endif; ?>



                        </div>
                        <div class="col-sm-6">
                            <p>
                                <b>Google Map:</b>
                                <a target="_blank" href="https://www.google.com/maps/?q=<?php echo $lat; ?>,<?php echo $long; ?>" style="color: inherit;">
                                    <span>Afficher le plan</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div> <!--END OF LOCATIONS CONTAINER -->

            <?php $courses = courses_from_location_id( $location_id ); ?>
            <?php if ($courses): ?>
                <div class="locations-connections ">
                    <h4>Disciplines enseignées:</h4>
                    <?php foreach( $courses as $course ) : ?>
                        <div class="connection-row">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="<?php echo $course->guid; ?>"><?php echo $course->post_title; ?></a>
                                </div>
                                <div class="col-sm-6">
                                    <ul>
                                        <?php $times = get_field('times',  $course->ID ); ?>
                                        <?php foreach ($times as $time): ?>
                                            <?php if ($time['location']): ?>
                                                <?php  ///  ONLY SHOW TEACHERS OF COURSE WHO WORK AT THIS PARTICULAR LOCATION ?>
                                                <?php if ($time['location']->ID ==  $location_id  ): ?>
                                                    <?php foreach ($time['teachers'] as $teacher) : ?>
                                                        <li>
                                                            <?php echo $teacher->post_title; ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>


                </div> <!-- END OF LOCATIONS CONNECTIONS -->
            <?php endif; // end if courses ?>

        </div>


    <?php endwhile; else: ?>

        <h1>Aucun article trouvé</h1>

    <?php endif; ?>

</div>

<?php get_footer(); ?>