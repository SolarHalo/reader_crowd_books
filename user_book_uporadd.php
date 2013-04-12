<?php
 /*
 Template Name: user_book_addorup
 */
 get_header(); ?>
 <div class="startbut">
        <a href="#">Start a New Book</a>
     </div>
    <div id="conter"class="bookcontent fl"> 
    	<form> 
    	<div class="usertitle"><input type="text"  class="h-inpt" value="Write Your Chapter Name here"/></div> 
        <div class="mark fl">
        	<a href="#" class="viewbook">View Book</a>
        </div> 
        <div class="bookcontentbox">
        	<a href="#"><img src="images/bookcover.gif" class="fl" width="181"  height="270"/></a>
           <textarea class="bor-top booktextbox2">Write your story here</textarea>
            <ul>
            	<li><strong>Category:</strong>
                	<div class="bookmenubut">
                    	<span>Please specify</span>
                        <ul class="bookmenu">
                            <li><a href="#">Apocalypic and Post-apocalyptic</a></li>
                            <li><a href="#">Biopunk</a></li>
                            <li><a href="#">military science fiction </a></li>
                            <li><a href="#">time travel</a></li>
                            <li><a href="#">space opera</a></li>
                            <li><a href="#">superheroes</a></li>
                        </ul>
                    </div>
                </li>
                <li><strong>Words:</strong>0</li>
                <li><strong>Progress:</strong>
                	<div class="bookmenubut">
                    	<span>In-Progress</span>
                        <ul class="bookmenu">
                            <li><a href="#">In-Progress</a></li>
                            <li><a href="#">Finished</a></li> 
                        </ul>
                    </div>
                </li>
                <li><strong>Tags:</strong>
                	<span style="display:table; margin-top:10px;">Add some keword here</span>
                </li>
            </ul>
        </div>
         <div class="startbut bor-top">
            <a href="#">Update Book lnfo.</a>
         </div> 
        <div class="total">
        	<a href="#"><font>Add a New CHapter</font> </a>
        </div>
        </form>  
    </div>
<?php get_footer(); ?>