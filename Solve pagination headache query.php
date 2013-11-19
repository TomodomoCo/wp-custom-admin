<?php 
/**
 * Template Name: Blog Section
 * 
 * */
 ?>
<?php get_header(); ?>

                    </div>
					<div class="insidewrapper">    
						<section id="blog">

							<header class="inside">

								<h1>

									BLOG

								</h1>

							</header>

							<div class="container">

								<article id="ajaxFeeder">
<?php 
if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }
query_posts('category_name=blog&posts_per_page=1&paged=' . $paged); ?>

                        <?php while (have_posts()) : the_post(); ?>
									<h2>

										<?php the_title(); ?>

									</h2>

									<?php the_content(); ?>
                                    <?php endwhile; ?>   
                                    <div class="pagnavi"><?php wp_pagenavi(); ?></div>
                                      

                        <?php wp_reset_query(); ?>
								</article>

							</div>

						</section>


					</div>
<?php get_footer(); ?>