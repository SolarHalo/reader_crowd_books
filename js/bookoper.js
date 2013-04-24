var userbookOpr = function (){
	return {
		bookChapter:function(chapterUrl){
			jQuery(document).ready(function($) { 
				var termid = $("#term_id").val();
				if(termid == null || "" == termid ){
					alert("must update book info first!");
				}else{
					var url =  chapterUrl+"&series_id="+termid;
					window.location.href=url;
					//document.location.href = url;
				}
			}); 
		},
		bookAdd:function(pageUrl){
			jQuery(document).ready(function($) { 
				var bookDes = $('#bookDes').val();
				var progress = $('#progress').val();
				var category = $('#category').val();
				var bookname = $('#bookname').val();
				if(bookname == null || bookname.replace(/[ ]/g,"")=="" || 'Write Your Book Title here'==bookname){
					alert("Book Title not be empty!");
					return ;
				}
				var termid = $("#term_id").val();
				var userid = $('#userid').val();
				$.ajax({ 
					url: pageUrl,  
					data: {'method':'addbook','bookname':bookname,'bookDes':bookDes,'progress':progress,
						'category':category, "termid": termid, "user_id": userid},  
					success: function(data){
						var termid = $("#term_id").val(data);
						alert("the book submit successful  ,please upload the book image");
						//console.log(data);
						//alert("successful");
					} 
				});
			}); 

		},
		bookDel:function(pageUrl,termid){
			if(confirm("Are you sure?")){
				jQuery(document).ready(function($) { 
					$.ajax({ 
						url: pageUrl,  
						dataType:'text',
						data: {'method':'delbook','term_id':termid},  
						success: function(obj){
							if("successful"==obj){
								document.location.reload();
							}
						} 
					});
				}); 
			}
		},
		chapterDel:function(pageUrl,chapterid){
			if(confirm("Are you sure?")){
				jQuery(document).ready(function($) { 
					
					$.ajax({ 
						url: pageUrl,  
						dataType:'text',
						data: {'method':'delchapter','chapterid':chapterid},  
						success: function(obj){
							if("successful"==obj){
								document.location.reload();
							}
						} 
					});
					
				}); 
			}
		}, 
		bookPhoto:function(pageUrl){
			jQuery(document).ready(function($) { 
				
				var termid = $("#term_id").val();
				if(termid == ""){
					alert("Please update book info first, then upload a book cover.");
					return ;
				}
				
				var method = "bookPhoto" ;
				var userid = $('#userid').val();
				
				var urls = pageUrl+'&method='+method+"&termid="+termid+"&userid="+userid;
				urls = encodeURI(urls);
				console.log(urls);
				$("#fileform").ajaxSubmit({
					type: "post",
            		url: urls,
            		success: function(data){
            			var datas = data.split(":::");
            			if(data == "error"){
            				alert(data[1]);
            			}else{
            				$("#bookcoverimg").attr("src", datas[1]);
            				console.log(datas);
            				
            			}
            		}
				});
			}); 
		}
	}
	
}();