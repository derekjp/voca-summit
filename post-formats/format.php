
              <?php
                /*
                 * This is the default post format.
                 *
                 * So basically this is a regular post. if you don't want to use post formats,
                 * you can just copy ths stuff in here and replace the post format thing in
                 * single.php.
                 *
                 * The other formats are SUPER basic so you can style them as you like.
                 *
                 * Again, If you want to remove post formats, just delete the post-formats
                 * folder and replace the function below with the contents of the "format.php" file.
                */
              ?>

              <div class="article-body" id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

                <header class="article-header entry-header">
                  <?php if( get_field('editor_letter_tf') ): ?>
                    <h1 class="entry-title single-title" itemprop="headline" rel="bookmark">Editor's Letter</h1>
                  <?php else :  ?>
                   <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
                  <?php endif; ?>

                  <?php if( get_field('sub_title') ): ?>
                    <h2 class="sub_title"><?php the_field('sub_title'); ?></h2>
                  <?php endif; ?>
                  <?php if( !get_field('editor_letter_tf') ): ?>
                          <p class="author-name"><?php the_field('author_name'); ?></p>
                  <?php endif; ?>
                  
                </header> <?php // end article header ?>

                <section class="entry-content cf" itemprop="articleBody">

                  <?php if( get_field('intro_paragraph') ): ?>
                    <div class="intro-section">
                      <span class="line"></span>
                      <p class="intro-paragraph"><?php the_field('intro_paragraph'); ?></p>
                      <span class="line"></span>
                    </div>
                  <?php endif; ?>


                  
                  <?php
                    // the content (pretty self explanatory huh)
                    the_content();

                    /*
                     * Link Pages is used in case you have posts that are set to break into
                     * multiple pages. You can remove this if you don't plan on doing that.
                     *
                     * Also, breaking content up into multiple pages is a horrible experience,
                     * so don't do it. While there are SOME edge cases where this is useful, it's
                     * mostly used for people to get more ad views. It's up to you but if you want
                     * to do it, you're wrong and I hate you. (Ok, I still love you but just not as much)
                     *
                     * http://gizmodo.com/5841121/google-wants-to-help-you-avoid-stupid-annoying-multiple-page-articles
                     *
                    */
                    wp_link_pages( array(
                      'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
                      'after'       => '</div>',
                      'link_before' => '<span>',
                      'link_after'  => '</span>',
                    ) );
                  ?>
                </section> <?php // end article section ?>





              </div> <?php // end article ?>
