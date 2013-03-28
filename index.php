<?php get_header(); ?>
<!--  contaienr  -->
<div id="conter" class="fl">
    	<div class="clmu fl bgcolor1" id="ls_elite">
        	<h5 class="title">Elite Chronilces</h5>
            <ul class="index-list">
				<li><a href="<?php echo get_page_link(150); ?>">What is this?</a></li>
				<li><a href="<?php echo get_page_link(152); ?>">Top 10</a></li>
				<li><a href="<?php echo get_page_link(153); ?>">Selected Stories</a></li>
				<li><a href="<?php echo get_page_link(154); ?>">Playbook</a></li>
				<li><a href="<?php echo get_page_link(155); ?>">Elite Universe</a></li>
			</ul>
        </div>
         <?php
				$post_id = 121;
				$queried_post = get_post($post_id);
				$post_link = get_permalink($post_id);
			?>
        <div class="clmu fl ml15" id="mc_featured">
        	<h5 class="title">Launch</h5>
           <a href="#"> <img src="<?php echo get_template_directory_uri(); ?>/images/photo.jpg" width="225" height="225" /></a>
           <p class="mt20"><font color="#6b2704"><?php echo $queried_post->post_title; ?></font><br />
                <?php echo $queried_post->post_excerpt; ?>.. <a href="<?php echo get_permalink(); ?>">Read more</a>
            </p>
        </div>
        <div class="clmu fl" id="left_sidebar">
        	<h5 class="title">Featured</h5>
            <div class="featured_item">
				<div class="fi_left"><img src="http://elitechronicles.tk/wp-content/uploads/2013/02/The-Virtuous-Misfortune_DS2-66x100.png" alt=""></div>
				<div class="fi_right">
					<h3>Life Plan<span>Michael Hyatt</span></h3>
					<div class="ratingsbox">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/rating_on.gif" />
                        <img src="<?php echo get_template_directory_uri(); ?>/images/rating_on.gif" />
                        <img src="<?php echo get_template_directory_uri(); ?>/images/rating_on.gif" />
                        <img src="<?php echo get_template_directory_uri(); ?>/images/rating_off.gif" />
                        <img src="<?php echo get_template_directory_uri(); ?>/images/rating_off.gif" /> 
                    </div> 
					<div class="excerpt">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget lorem odio, id elementum massa. Cras arcu lacus, interdum et laoreet vitae, aliquet in odio. Etiam nec venenatis justo.</p>
					</div>
				</div> 
			</div>
            <div class="featured_item">
				<div class="fi_left"><img src="http://elitechronicles.tk/wp-content/uploads/2013/02/The-Virtuous-Misfortune_DS2-66x100.png" alt=""></div>
				<div class="fi_right">
					<h3>Life Plan<span>Michael Hyatt</span></h3>
					<div class="rated">
						<img src="<?php echo get_template_directory_uri(); ?>/images/rating_on.gif" />
                        <img src="<?php echo get_template_directory_uri(); ?>/images/rating_on.gif" />
                        <img src="<?php echo get_template_directory_uri(); ?>/images/rating_on.gif" />
                        <img src="<?php echo get_template_directory_uri(); ?>/images/rating_off.gif" />
                        <img src="<?php echo get_template_directory_uri(); ?>/images/rating_off.gif" /> 
					</div>
					<div class="excerpt">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget lorem odio, id elementum massa. Cras arcu lacus, interdum et laoreet vitae, aliquet in odio. Etiam nec venenatis justo.</p>
					</div>
				</div>
			</div>
            <div class="featured_item">
				<div class="fi_left"><img src="http://elitechronicles.tk/wp-content/uploads/2013/02/The-Virtuous-Misfortune_DS2-66x100.png" alt=""></div>
				<div class="fi_right">
					<h3>Life Plan<span>Michael Hyatt</span></h3>
					<div class="rated">
						<img src="<?php echo get_template_directory_uri(); ?>/images/rating_on.gif" />
                        <img src="<?php echo get_template_directory_uri(); ?>/images/rating_on.gif" />
                        <img src="<?php echo get_template_directory_uri(); ?>/images/rating_on.gif" />
                        <img src="<?php echo get_template_directory_uri(); ?>/images/rating_off.gif" />
                        <img src="<?php echo get_template_directory_uri(); ?>/images/rating_off.gif" /> 
					</div>
					<div class="excerpt">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget lorem odio, id elementum massa. Cras arcu lacus, interdum et laoreet vitae, aliquet in odio. Etiam nec venenatis justo.</p>
					</div>
				</div>
			</div>
        </div>
        <div class="clmu fl ml15" id="center_sidebar">
        	<h5 class="title">Top Viewed</h5>
            <ul class="mlrp_ul">
            	 <?php getTopReviewd (5) ?>
            </ul>
            <a href="#" class="more">more Top Viewed Books</a>
        </div>
        <div class="clmu fl ml15" id="right_sidebar">
        	<h5 class="title">Top Rated</h5>
            <ul class="mlrp_ul">
            	<?php getHighestRation(5);?>
            </ul>
            <a href="#" class="more">more Top Viewed Books</a>
        </div>
        <div class="clmu fl" id="Genres">
        	<h5 class="title">Genres</h5>
            <ul class="index-list">
				<li><a href="<?php echo get_page_link(181); ?>">Fantasy</a></li>
				<li><a href="<?php echo get_page_link(184); ?>">Science Fiction</a></li>
				<li><a href="#">Playbook</a></li>
				<li><a href="#">Elite Universe</a></li>
                <li><a href="#">Playbook</a></li>
				<li><a href="#">Elite Universe</a></li> 
			</ul>
        </div>
        <?php
				$post_id = 121;
				$queried_post = get_post($post_id);
				$post_link = get_permalink($post_id);
			?>
        <div class="clmu fl ml15" id="News">
        	<h5 class="title">News</h5> 
           <p class="mt20"><font color="#6b2704"><?php echo $queried_post->post_title; ?></font><br />
                <?php echo $queried_post->post_excerpt; ?>.. <a href="<?php echo get_permalink(); ?>">Read more</a>
            </p>
        </div>
         <div class="clmu fl tag">
        	<h5 class="title">Tags</h5>
            <ul class="index-list">
				<?php the_tags('', ' '); ?>
			</ul>
        </div>
        <div class="clmu fl ml15" id="Lastest">
        	<h5 class="title">Lastest Update</h5> 
<div id="outer">
               <div id="focus">
                  <div class="dis">
                      <img id="img_l" src="<?php echo get_template_directory_uri(); ?>/images/back.jpg" onClick="doSlide(-1)" />
                  </div> 
                  <div id="description">
                       <div id="view_pic0" style="height:100px;width:1650px">
                        <ul id="view_pic"  class=view_pic>        
                          <li>
                            <h4>Chapter two</h4>
                            <p>little bit of the background. </p>
                            <a href="#">read more</a>
                          </li> 
                          <li>
                            <h4>Chapter two</h4>
                            <p>little bit of the background. </p>
                            <a href="#">read more</a>
                          </li> 
                          <li>
                            <h4>Chapter two</h4>
                            <p>little bit of the background. </p>
                            <a href="#">read more</a>
                          </li> 
                          <li>
                            <h4>Chapter two</h4>
                            <p>little bit of the background. </p>
                            <a href="#">read more</a>
                          </li> 
                          <li>
                            <h4>Chapter two</h4>
                            <p>little bit of the background. </p>
                            <a href="#">read more</a>
                          </li> 
                          <li>
                            <h4>Chapter two</h4>
                            <p>little bit of the background. </p>
                            <a href="#">read more</a>
                          </li> 
                          <li>
                            <h4>Chapter two</h4>
                            <p>little bit of the background. </p>
                            <a href="#">read more</a>
                          </li> 
                          <li>
                            <h4>Chapter two</h4>
                            <p>little bit of the background. </p>
                            <a href="#">read more</a>
                          </li> 
                        </ul>
                       </div>
                  </div> 
                  <div class="dis">
                      <img id="img_r" src="<?php echo get_template_directory_uri(); ?>/images/next.jpg" onClick="doSlide(1)" />
                  </div>
               </div>
            </div>
          </div>
          <script>
var ok_obj=document.getElementById("view_pic").getElementsByTagName("LI")
var ok=Math.ceil(ok_obj.length/3)-1
  var ele=document.getElementById("description");
  var w=ele.clientWidth;
  var n=20,t=50;
  var timers=new Array(n);
  var k=0;doSlide(0);
function doSlide(s){
  if (k>=ok &&s>0|| k<=0 &&s<0)MenuClick()
 else{
  k+=s;
    var x=ele.scrollLeft;
    var d=k*w-x;
    for(var i=0;i<n;i++)(
    	function(){
    		if(timers[i]) clearTimeout(timers[i]);
    		var j=i;
//    		alert(x)
    		timers[i]=setTimeout(function(){ele.scrollLeft=x+Math.round(d*Math.sin(Math.PI*(j+1)/(2*n)));},(i+1)*t);
    	}
    )();
}}
</script>
<SCRIPT language=javascript>
var intDelay=30; //设置菜单显示速度，越大越慢
var intInterval=5; 
function MenuClick(){
LayerMenu.filters.alpha.opacity=0; 
LayerMenu.style.display=""; 
GradientShow();
} 
function GradientShow() 
{ 
LayerMenu.filters.alpha.opacity+=intInterval; 
if (LayerMenu.filters.alpha.opacity<100) setTimeout("GradientShow()",intDelay); 
else setTimeout("GradientClose()",1500)
} 
function GradientClose() 
{ 
LayerMenu.filters.alpha.opacity-=intInterval; 
if (LayerMenu.filters.alpha.opacity>0) { 
setTimeout("GradientClose()",intDelay); 
} 
else { 
LayerMenu.style.display="none";
} 
}
GradientClose() 
</SCRIPT>
        <div class="clmu fl tag ml15">
        	<h5 class="title">Forum</h5>
            <ul class="index-list">
				<li><a href="#">What is this?</a></li> 
				<li><a href="#">Current Event</a></li>
				<li><a href="#">Playbook</a></li>
				<li><a href="#">Elite Universe</a></li>
                <li><a href="#">Playbook</a></li>
				<li><a href="#">Elite Universe</a></li> 
			</ul>
        </div>
        <div class="clmu fl blog">
        	<h5 class="title">Blog>Interviews</h5> 
            <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/photo03.jpg" class="fl" /></a>
            <?php
				$post_id = 123;
				$queried_post = get_post($post_id);
				$post_link = get_permalink($post_id);
			?>
            <p><font color="#6b2704"><?php echo $queried_post->post_title; ?></font><br />
               <?php echo $queried_post->post_excerpt; ?>.. <a href="<?php echo get_permalink(); ?>">Read more</a>
            </p>
        </div>
        <div class="clmu fl blog ml15">
        	<h5 class="title">Blog>Writers School</h5>  
        	<?php
				$post_id = 121;
				$queried_post = get_post($post_id);
				$post_link = get_permalink($post_id);
			?>
            <p><font color="#6b2704"><?php echo $queried_post->post_title; ?></font><br />
               <?php echo $queried_post->post_excerpt; ?>.. <a href="<?php echo get_permalink(); ?>">Read more</a>
            </p>
        </div>
       
    </div> 
<?php get_footer(); ?>