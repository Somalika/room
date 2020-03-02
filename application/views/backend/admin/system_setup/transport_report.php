 	<table class="table table-bordered datatable" id="table_export">
        <thead>
            <tr> 
                <th width="3%" style="text-align:center;"><strong>ល.រ</strong></th>    
                
                <th width="13%" style="text-align:center;"><strong>Student Code</strong></th> 
                <th width="13%" style="text-align:center;"><strong>Student Name</strong></th> 
                <th width="13%" style="text-align:center;"><strong>Stransport name</strong></th> 
                <th width="11%" style="text-align:center;"><strong> Ways </strong></th> 
                <th width="13%" style="text-align:center;"><strong>Price</strong></th> 
                <th width="13%" style="text-align:center;"><strong>Montd/Day</strong></th> 
          </tr>
        </thead>
        <tbody style="font-size:12px">
        	<?php 
			$i=0;
			foreach($student_list as $rows){
				$i++;
				echo '<tr>
						<td>'.$i.'</td>  
						<td>'.$rows["register_code"].'</td>
						<td>'.$rows["first_name_kh"].' '.$rows["first_name"].'</td>
						<td>'.$rows["route_name"].'</td>
										
						<td>'.$rows["name"].'</td> 
						<td align="right"> $ '.$rows["fee"].'</td>
						<td align="center">'.$rows["month_day"].'</td> 
					</tr>';
			}
			?>
        </tbody>        
	</table>  