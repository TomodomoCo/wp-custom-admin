<?php get_header(); ?>
<div class="bigbox first">


                        <?php $presenters = wp_get_post_terms( $post->ID, 'showpresenter' ); ?>
                        <?php //print_r($presenters); ?>
                        <?php query_posts('post_type=sm_presenter&nopaging=false&showpresenter='.$presenters['0']->slug.''); ?>
                        <?php while(have_posts()): the_post();
                        $tit = get_the_title();
                        ?>
                        
                         <h5>
								<?php the_title(); ?>
							</h5>
                            <?php if(has_post_thumbnail()){ ?>
                       
                       <?php 
                       $thumb_id = get_post_thumbnail_id($post->ID);
                       $thumb_link = wp_get_attachment_url($thumb_id);                      
                       ?>
                       
                       <img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo $thumb_link; ?>&h=150&w=150&q=100" style="float: left; margin: 10px;" />
							<?php } ?><?php the_content(); ?>
                            
                        <?php endwhile; ?>
                        <?php wp_reset_query(); ?>
                        
                     
                        
                        
                        <?php query_posts('post_type=show&nopaging=false&showpresenter='.$presenters['0']->slug.''); ?>
                        <h5>
								Shows by <?php echo $presenters['0']->name; ?>
							</h5>
                        <ul class="presentershows">
                        <?php while(have_posts()): the_post();?>
                        <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><figure><?php the_post_thumbnail('thumb'); ?><figcaption><?php the_title(); ?></figcaption></figure></a></li>
                        <?php endwhile; ?>
                        <?php wp_reset_query(); ?>
                        </ul>
                        <div style="clear: both;"></div>
                                              
                        <h5>
								Other Presenters
							</h5>
                        <div class="other_shows">
                        <?php 
                        $p = 0;
                         ?>
                        <?php query_posts('post_type=sm_presenter&orderby=rand'); ?>
                        <?php while(have_posts()): the_post(); 
                        if($tit != get_the_title()){
                        $p++;
                        if($p == 5){ ?>
                            <div style="clear: both;"></div>
                       <?php  unset($p);
                       $p = 0; }
                       
                        ?>
                        <?php  ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><figure><?php the_post_thumbnail('thumb'); ?><figcaption><?php the_title(); ?></figcaption></figure></a>
                        <?php 
                        }
                        endwhile; ?>
                        <?php wp_reset_query(); ?>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="ads">
                        <h5>Sponsored</h5>                        
							<?php if ( is_active_sidebar( 'homepage_news_section' ) ) : ?> <?php dynamic_sidebar( 'homepage_news_section' ); ?>
                            <?php else : ?><p>You need to drag a widget into your sidebar in the WordPress Admin</p>
                	        <?php endif; ?>
							</div>
							<?php comments_template(); ?>
						</div>
                        
                        <?php get_sidebar(); ?>
                        <?php get_footer(); ?>
                        