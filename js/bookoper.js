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
					},  
				});
			}); 

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
            			data = data.split(":::");
            			if(data == "error"){
            				alert(data[1]);
            			}else{
            				$("#bookcoverimg").attr("src", data[1]);
            			}
            		}
				});
			}); 
		}
	}
	
}();