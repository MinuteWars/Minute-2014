<?php get_header() ?>
    <section>
        <?php while(have_posts()): the_post() ?>
            <h1><?php the_title() ?></h1>
            <p class="meta">
                <span class="date"><?php the_date() ?></span> - <span class="author"><?php the_author() ?></span>
            </p>
            <?php the_content() ?>
        <?php endwhile ?>
    </section>
<?php get_footer() ?>