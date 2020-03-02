<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div><?php echo get_phrase('No');?></div></th>
            <th><div><?php echo get_phrase('Promotion');?></div></th>
            <th class="span2"><div><?php echo get_phrase('Limited');?></div></th>
            <th class="span2"><div><?php echo get_phrase('Joined');?></div></th>
            <th><div><?php echo get_phrase('Start_date');?></div></th>
            <th><div><?php echo get_phrase('End_date');?></div></th>
            <th><div><?php echo get_phrase('Is_active');?></div></th>
        </tr>
    </thead>
    <tbody>  
    <?php $count = 1;foreach($promotion as $row):?> 
        <tr>
            <td align="center"><?php echo $count++;?></td>
            <td align="center"><?php echo $row['discription'];?></td>
            <td><?php echo $row['limited_number'];?></td> 
            <td align="center"><?php echo $row['join_number'];?></td>
            <td align="center"><?php echo $row['start_date'];?></td>
            <td align="center"><?php echo $row['end_date'];?></td>
            <td align="center"><?php echo $row['statu'];?></td>
            
        </tr>
        <?php endforeach;?>
    </tbody>
</table>