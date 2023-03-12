<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='css/fullcalendar.css' rel='stylesheet' />
<link href='css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='js/moment.min.js'></script>
<script src='js/jquery.min.js'></script>
<script src='js/jquery-ui.min.js'></script>
<script src='js/fullcalendar.min.js'></script>
<link href = "css/jquery-ui.css" rel = "stylesheet">
	<link href="css/back_to_top.css" rel="stylesheet">
	
<script>		
	$(document).ready(function() {

		var zone = "00:00";  //Change this to your timezone

	$.ajax({
		url: 'process.php',
        type: 'POST', // Send post data
        data: 'type=fetch',
        async: false,
        success: function(s){
        	json_events = s;
        }
	});


	var currentMousePos = {
	    x: -1,
	    y: -1
	};
		jQuery(document).on("mousemove", function (event) {
        currentMousePos.x = event.pageX;
        currentMousePos.y = event.pageY;
    });

		/* initialize the external events
		-----------------------------------------------------------------*/

		$('#external-events .fc-event').each(function() {

			// store data so the calendar knows to render an event upon drop
			$(this).data('event', {
				title: $.trim($(this).text()), // use the element's text as the event title
				stick: true // maintain when user navigates (see docs on the renderEvent method)
			});

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});

		});


		/* initialize the calendar
		-----------------------------------------------------------------*/

		$('#calendar').fullCalendar({
			events: JSON.parse(json_events),
			//events: [{"id":"14","title":"New Event","start":"2015-01-24T16:00:00+04:00","allDay":false}],
			utc: true,
			header: {
				left: 'prev,next',
				center: 'title',
				right: 'agendaWeek,month'
			},
			defaultView: 'agendaWeek',
			editable: true,
			droppable: true, 
			slotDuration: '00:30:00',
			eventReceive: function(event){
				var title = event.title;
				var start = event.start.format("YYYY-MM-DD[T]HH:mm:SS");
				$.ajax({
		    		url: 'process.php',
		    		data: 'type=new&title='+title+'&startdate='+start+'&zone='+zone,
		    		type: 'POST',
		    		dataType: 'json',
		    		success: function(response){
		    			event.id = response.eventid;
		    			$('#calendar').fullCalendar('updateEvent',event);
		    		},
		    		error: function(e){
		    			console.log(e.responseText);

		    		}
		    	});
				$('#calendar').fullCalendar('updateEvent',event);
				console.log(event);
			},
			eventDrop: function(event, delta, revertFunc) {
		        var title = event.title;
		        var start = event.start.format();
		        var end = (event.end == null) ? start : event.end.format();
		        $.ajax({
					url: 'process.php',
					data: 'type=resetdate&title='+title+'&start='+start+'&end='+end+'&eventid='+event.id,
					type: 'POST',
					dataType: 'json',
					success: function(response){
						if(response.status != 'success')		    				
						revertFunc();
					},
					error: function(e){		    			
						revertFunc();
						alert('Error processing your request: '+e.responseText);
					}
				});
		    },
			eventClick: function(event, jsEvent, view) {
			   var title = prompt('Event Title:', event.title, { buttons: { Ok: true, Cancel: false} });
			   if (title){
			   event.title = title;
			   $.ajax({
				 url: 'process.php',
				 data: 'type=changetitle&title='+title+'&eventid='+event.id,
				 type: 'POST',
				 dataType: 'json',
				 success: function(response){
				   if(response.status == 'success')
				   $('#calendar').fullCalendar('updateEvent',event);
				 },
				 error: function(e){
				   alert('Error processing your request: '+e.responseText);
				 }
			   });
			   }
			},
			eventResize: function(event, delta, revertFunc) {
				console.log(event);
				var title = event.title;
				var end = event.end.format();
				var start = event.start.format();
		        $.ajax({
					url: 'process.php',
					data: 'type=resetdate&title='+title+'&start='+start+'&end='+end+'&eventid='+event.id,
					type: 'POST',
					dataType: 'json',
					success: function(response){
						if(response.status != 'success')		    				
						revertFunc();
					},
					error: function(e){		    			
						revertFunc();
						alert('Error processing your request: '+e.responseText);
					}
				});
		    },
			eventDragStop: function (event, jsEvent, ui, view) {
			    if (isElemOverDiv()) {
			    	var con = confirm('Are you sure to delete this event permanently?');
			    	if(con == true) {
						$.ajax({
				    		url: 'process.php',
				    		data: 'type=remove&eventid='+event.id,
				    		type: 'POST',
				    		dataType: 'json',
				    		success: function(response){
				    			console.log(response);
				    			if(response.status == 'success'){
				    				$('#calendar').fullCalendar('removeEvents');
            						getFreshEvents();
            					}
				    		},
				    		error: function(e){	
				    			alert('Error processing your request: '+e.responseText);
				    		}
			    		});
					}   
				}
			}
		});

	function getFreshEvents(){
		$.ajax({
			url: 'process.php',
	        type: 'POST', // Send post data
	        data: 'type=fetch',
	        async: false,
	        success: function(s){
	        	freshevents = s;
	        }
		});
		$('#calendar').fullCalendar('addEventSource', JSON.parse(freshevents));
	}


	function isElemOverDiv() {
        var trashEl = jQuery('#trash');

        var ofs = trashEl.offset();

        var x1 = ofs.left;
        var x2 = ofs.left + trashEl.outerWidth(true);
        var y1 = ofs.top;
        var y2 = ofs.top + trashEl.outerHeight(true);

        if (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&
            currentMousePos.y >= y1 && currentMousePos.y <= y2) {
            return true;
        }
        return false;
    }

	});

</script>
<style>

	#trash{
		width:75px;
		height:75px;
		float:left;
		padding-bottom: 15px;
		position: relative;
	}
		
		
	#external-events {
		width: 100px;
		padding: 0 10px;
		background: #eee;
	}

		
	#external-events .fc-event {
		margin: 10px 0;
		cursor: pointer;
	}
				
	#external-events p input {
		margin: 0;
		vertical-align: middle;
	}

	#calendar {
		float: center;
		width: 900px;
	}


	
</style>
</head>
<body>
	
		<div id='external-events'>
			<div class='fc-event'>New Event</div>
			<img src="img/trashcan.png" id="trash" alt="">
		</div>

		<div id='calendar'></div>

		<div style='clear:both'></div>
</body>
</html>
