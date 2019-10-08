$( document ).ready(function() {
    $('.span_col').on('click',function(e){
    	if($(this).hasClass('free')){
    	}
    });
    $('.span_col').hover(function(){
    });
    $('.status_l').change(function() {
    	$.ajax({
	        type: "POST",
	        url: $(this).data('url'),
	        data: {
	            id: $(this).data('id')
	        },
	        cache: false,
	        dataType: 'json',
	        success: function (data) {
	        	if(data){
	        		alert('Выполено!');
	        	}
	            else{
	            	alert('Не выполено!');
	            }
	        },
	        error: function () {
	            alert('Не выполено!');
	        }
    	});
    });
    $('#select_date').click(function(e){
    	e.preventDefault();
    	$(this).data('params')['date']=$('#picker').val();
    	$(this).data('params')['coach'] = $('select[name="coach_filter"]').val();
    	$(this).data('params')['client'] = $('select[name="client_filter"]').val();
    });
    let w = $(".sheldule_table tbody").width();
    $(".table-head thead").width(w);
    let f_width = $(".sheldule_table tbody tr:nth-child(1) th").width();
    $(".table-head thead tr:nth-child(1) th:nth-child(1)").width(f_width);
    $(".table-head thead tr:nth-child(2) th").each(function(i){
        $(this).width($(".sheldule_table tbody tr:nth-child(1) td:nth-child("+(i+2)+")").width());
    });
    
    $(".table-head").scroll(function(){
        $(".sheldule_table").scrollLeft($(".table-head").scrollLeft());
      });
     $(".sheldule_table").scroll(function(){
        $(".table-head").scrollLeft($(".sheldule_table").scrollLeft());
      });

});
var box;
$( window).scroll(function(){
    box = $('.sheldule_table').width();
    if($(window).scrollTop()>210){
        $(".table-head").addClass('stiky'); 
        $(".table-head").css('width',box+'px');
    }
    else{
        $(".table-head").removeClass('stiky'); 
        $(".table-head").css('width',box+'px');
    }
    //if()
});