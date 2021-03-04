$(document).ready(function(){

	$("select[name=_type]").change(function(){
		var type = $(this).val();
		if (type == 1) {
			$('#parent').html('');
		}else if(type ==2){
			getparent(type);
		}else{
		}
		
	});

	function  getparent(type){
		$.ajax({
			type:'get',
			url:'getparent/'+type,
			success:function(data){
				var html = [];
				for (var i = 0; i < data.length; i++) {
					html[i] = '<option value="'+data[i].id+'">'+data[i].name+'</option>';
				}
				$('#parent').html(html);

			}			
		});
	}
});