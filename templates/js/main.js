$(document).ready(function(){
	
	function changeTime() {
		var $time = $('#timer'),
			offset = $time.attr('data-offset');
		
		$.post("/time/"+offset, {}, function(data){
			$time.text(data);
			//console.log(data);
			//console.log(offset);
		});
	}
	
	setInterval(function() {
		changeTime();
		//console.log('1');
	},1000);
	
});