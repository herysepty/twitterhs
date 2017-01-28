$(document).ready(function(){
	var pathname = window.location.pathname; // Returns path only
	var url      = window.location.href;
    var base_url = $('meta[name="base_url"]').attr('content');

    var trends_us = '';
    var trends_jakarta = '';
    var trends_indonesia = '';

    if(url === base_url+'index.php/trend'){
    	setInterval(function(){
    		$('.trends_us').html("");
    		$('.trends_jakarta').html("");
    		$('.trends_indonesia').html("");
    		$.ajax({
	    		type: 'GET',
	    		dataType: "json",
	    		url: base_url+"index.php/twitter/ajaxgettrends", 
	    		success: function(result){
	    			$.each(result.trends, function(trends, trend) {
	    				// console.log(trend);
	    				$.each(trend.trends, function(index, value) {
	    					trends_us += '<p>'+value.name+'</p>';
	    					// console.log(value.name);
	    				});
	    			});
	    			$.each(result.trends_jakarta, function(trends, trend) {
	    				// console.log(trend);
	    				$.each(trend.trends, function(index, value) {
	    					trends_jakarta += '<p>'+value.name+'</p>';
	    					// console.log(value.name);
	    				});
	    			});
	    			$.each(result.trends_indonesia, function(trends, trend) {
	    				// console.log(trend);
	    				$.each(trend.trends, function(index, value) {
	    					trends_indonesia += '<p>'+value.name+'</p>';
	    					// console.log(value.name);
	    				});
	    			});
<<<<<<< HEAD
	    			$('.trends_us').empty().html(trends_us);
	    			$('.trends_jakarta').empty().html(trends_jakarta);
	    			$('.trends_indonesia').empty().html(trends_indonesia);
=======
	    			$(".trends_us").html(trends_us);
	    			$(".trends_jakarta").html(trends_jakarta);
	    			$(".trends_indonesia").html(trends_indonesia);
>>>>>>> 6ec6791a296dfd50e4034f1ef5289c42a9fe15b3
	   			}
	   		});
	   	},10000);
    }
    $('#q').keyup(function(){
    	// console.log($('#q').val());
    	var q = $('#q').val();
    	var tweets = '';
    	if(q.length > 3) {
	    	$.ajax({
	           type:"post",
		    	dataType: "json",
	           url: base_url+"index.php/twitter/searchresult",
	           data:{
	                  'q' : q
	                },
	          success: function(data){
	          	var h = 0;
	              $.each(data, function(tweet_index, tweet_value) {
						tweets += '<p>'+h+++' '+tweet_value.text+'</p>';
					});
	              h=0
	    			$('.result_search').html(tweets);
	              	// console.log(tweets);
	          }
	        });
    	}
    });
});