
<?php
 /*
 Template Name: page_books
 */
 get_header(); ?>
 <div id="conter" class="fl">
    	<div class="tabbox">
        	<table cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;" >
            	<tr bgcolor="#eeeaeb" class="tabtitle">
                	<td width="245"><b>Book</b></td>
                    <td width="145"><b>Author</b></td>
                    <td width="65"><b>Category</b></td>
                    <td width="65"><b>Words</b></td>
                    <td width="65"><b>Progress</b></td>
                    <td width="95"><b>Rating</b></td>
                    <td width="50"><b>Date</b></td>
                </tr>
                <?php 
                	getBookInfo();
                ?>
                
            </table>  
        </div>
    </div> 
    <?php get_footer(); ?>