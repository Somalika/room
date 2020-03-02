<div class="row">
	<div class="col-md-8">
    	<div class="row">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">    
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body">
                                <div id="notice_calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
	<div class="col-md-4">
		<div class="row">
            <div class="col-md-12">
            
                <div class="tile-stats tile-white">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0" data-end="0" 
                    		data-postfix="" data-duration="1500" data-delay="0"><?php echo $room_avaiable;?></div>
                    
                    <h3><?php echo get_phrase('available_room');?></h3>
                   <p>Total available rooms</p>
                </div>
                
            </div>
            <div class="col-md-12">
            
                <div class="tile-stats tile-white">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num" data-start="0" data-end="0" 
                    		data-postfix="" data-duration="800" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('uppaid_room');?></h3>
                   <p>Total uppaid rooms</p>
                </div>
                
            </div> 
            <div class="col-md-12">
            
                <div class="tile-stats tile-white">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <div class="num" data-start="0" data-end="0" 
                    		data-postfix="" data-duration="500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('to_be_leave');?></h3>
                   <p>Total to be leaves</p>
                </div>
                
            </div>
    	</div>
    </div>
	
</div>



    <script>
  $(document).ready(function() {
	   var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
		var calendar = $('#notice_calendar');
				$('#notice_calendar').fullCalendar({
					header: {
						left: 'title',
						right: 'today prev,next'
					},
					
					//defaultView: 'basicWeek',
					
					editable: false,
					firstDay: 1,
					height: 530,
					droppable: false,
					
					selectable: true,
				  	selectHelper: true,
				  	
				  	editable: true,
				 	eventDrop: function (event, delta, revertFunc) {
						console.log(event.title); 
						console.log(event.start); 
						console.log(event.end); 
				  	}, 
					
					
					events: [
							 <?php 
								 $sql = "
										 select 
											 s.staying_id,
											 s.staying_name, 
											 date_format(s.next_paid_date,'%Y,%m,%d') next_date ,
											 r.name room_name,
											 inv.is_paid
										 from staying s
										 inner join room r on r.room_id = s.room_id
										 inner join invoice inv on inv.room_id = r.room_id
										 where s.status in(4,5)
									 ";
								 $staying = $this->db->query($sql)->result_array();
								 foreach ($staying as $row){  ?>
							{
							  title: '<?php echo '['.$row["room_name"].'] '.$row["staying_name"].' '.$row["is_paid"];?>',
							  start: new Date(<?php echo $row["next_date"];?>),
							  end: new Date(<?php echo $row["next_date"];?>), 
							  id : <?php echo $row["staying_id"];?>
							},
						<?php } ?>
					]
				});
	});
  </script>

  
