$(document).ready(function(){
	var pathname = window.location.pathname; // Returns path only
	var url      = window.location.href;
    var base_url = $('meta[name="base_url"]').attr('content');

    var trends_us = '';
    var trends_jakarta = '';
    var trends_indonesia = '';

    if(url === base_url+'index.php/trend'){
    	setInterval(function(){
    		$.ajax({
	    		type: 'GET',
	    		dataType: "json",
	    		url: base_url+"index.php/twitter/ajaxgettrends", 
	    		success: function(result){
	    			$.each(result.trends, function(trends, trend) {
	    				// console.log(trend);
	    				$.each(trend.trends, function(index, value) {
	    					trends_us += '<p>'+value.name+'</p>';
	    					console.log(value.name);
	    				});
	    			});
	    			$.each(result.trends_jakarta, function(trends, trend) {
	    				// console.log(trend);
	    				$.each(trend.trends, function(index, value) {
	    					trends_jakarta += '<p>'+value.name+'</p>';
	    					console.log(value.name);
	    				});
	    			});
	    			$.each(result.trends_indonesia, function(trends, trend) {
	    				// console.log(trend);
	    				$.each(trend.trends, function(index, value) {
	    					trends_indonesia += '<p>'+value.name+'</p>';
	    					console.log(value.name);
	    				});
	    			});
	    			$('.trends_us').append(trends_us);
	    			$('.trends_jakarta').append(trends_jakarta);
	    			$('.trends_indonesia').append(trends_indonesia);
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