var userbookOpr = function (){
	return {
		bookAdd:function(pageUrl){
			jQuery(document).ready(function($) { 
				var bookDes = $('#bookDes').val();
				var progress = $('#progress').val();
				var category = $('#category').val();
				var bookname = $('#bookname').val();
				var termid = $("#term_id").val();
				var userid = $('#userid').val();
				$.ajax({ 
					url: pageUrl,  
					data: {'method':'addbook','bookname':bookname,'bookDes':bookDes,'progress':progress,
						'category':category, "termid": termid, "user_id": userid},  
					success: function(data){
						var termid = $("#term_id").val(data);
						//alert("the book submit ,please upload the book image");
						console.log(data);
						alert("successful");
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
					alert("You must complete other form before upload Book Cover!");
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