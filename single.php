<?php get_header(); ?>
    <div id="conter" class="fl">
    	<div class="book-left">
            <div class="clmu fl bgcolor1" id="bookconter-ls_elite">
                <h5 class="title">Elite Chronilces</h5>
                <ul class="index-list">
                    <li><a href="#">What is this?</a></li> 
                    <li><a href="#">Current Event</a></li>
                    <li><a href="#">Playbook</a></li>
                    <li><a href="#">Elite Universe</a></li>
                </ul>
                <h5 class="title mt20">Genres</h5>
                <ul class="index-list">
                    <li><a href="#">What is this?</a></li> 
                    <li><a href="#">Current Event</a></li>
                    <li><a href="#">Playbook</a></li>
                    <li><a href="#">Elite Universe</a></li> 
                    <li><a href="#">Elite Universe</a></li>
                </ul>
            </div>
             <div class="clmu fl tag">
                <h5 class="title">Tags</h5>
                <ul class="index-list">
                    <li><a href="#">What is this?</a></li> 
                    <li><a href="#">Current Event</a></li>
                    <li><a href="#">Playbook</a></li>
                    <li><a href="#">Elite Universe</a></li>
                    <li><a href="#">Playbook</a></li>
                    <li><a href="#">Elite Universe</a></li> 
                </ul>
            </div>
        </div>  
        <div class="clmu fl ml15" id="book_mc_featured">
        <?php while (have_posts()):the_post();?>
        	<h6 class="subnav">
        	<a title="Go to homepage" href="<?php echo get_settings('home'); ?>/">Home</a> > <?php the_title(); ?>
            </h6> 
            
            <?php the_content()?>
            <?php endwhile; ?>
            <div id="commentform" class="mt20">
            	<div class="clmu Author">
                    <h5 class="title">Author's Note</h5>
                     
                </div>
            	<div id="postauthor">
                	<img src="images/photo04.jpg" />
                    <span>About</span>
                    <span>Mail&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">More Posts(8)</a></span>
                </div>
                
                
                <div class="comments mt20">
                	<span class="comm-title">
                    	<?php comments_number()?>comments
                    </span>
                    <div>
                    <?php if ($comments):?>
	                    <?php foreach ($comments as $comment) :?>
	                    	<p>
	                        	<span><?php comment_author()?>:</span>
	                            <?php comment_text()?>
	                        </p>
	                    <?php endforeach;?>
	                <?php endif;?>
                    </div>
                </div>
              
                <div class="comments mt20">
                	<form>
                	<span class="comm-title">
                    	comments
                    </span>
                    <div>
                    	 <textarea name="comment" id="comment" class="comment-text"></textarea>
                    </div>
                    	<input name="submit" type="submit" id="submit" value="Post Comment" class="input2" />
                    	<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
                    	<?php do_action('comment_form', $post->ID); ?>
                    </form>
                </div>
            </div> 
        </div>   
    </div> 
<?php get_footer(); ?>
</div>
</body>
</html>
