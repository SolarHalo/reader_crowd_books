var userbookOpr = function (){
	return {
		bookAdd:function(pageUrl){
			jQuery(document).ready(function($) { 
				var bookDes = $('#bookDes').val();
				var progress = $('#progress').val();
				var category = $('#category').val();
				var bookname = $('#bookname').val();
				$.ajax({ 
					url: pageUrl,  
					data: {'method':'addbook','bookname':bookname,'bookDes':bookDes,'progress':progress,'category':category},  
					success: function(data){
						alert(data);
					},  
				});
			}); 

		},
		bookPhoto:function(pageUrl){
			jQuery(document).ready(function($) { 
				var method = "bookPhoto" ;
				var bookDes = $('#bookDes').val();
				var progress = $('#progress').val();
				var category = $('#category').val();
				var bookname = $('#bookname').val();
				
				var urls = pageUrl+'&method='+method+"&bookname="+bookname+"&bookDes="+bookDes+"&progress="+progress+"&category="+category;
				
				$.ajaxFileUpload({
					type:'post',
					url:urls,
			      	secureuri:false,
			      	fileElementId:'bookcover',
			     	dataType:'json',
			     	data:{'method': method},
			     	success:function (data, status){
			     		alert(data);
			      	},
			      	error:function (data, status, e){
			      		alert("error");
			        }
			    });
			}); 
		}
	}
	
}();