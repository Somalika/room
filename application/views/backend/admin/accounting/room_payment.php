<div id="tab_div" class="box-header">
    
    <!---CONTROL TABS START-->
    <ul class="nav nav-tabs nav-tabs-left">
         <li  class="active"> 
            <a href="#unpaid" data-toggle="tab"><font color="black">Invoices</font>
            </a>
        </li> 
        <li>
            <a href="#paid" data-toggle="tab">
                <font color="black">Payment History</font> 
            </a>
        </li>
    </ul>
			
</div> 
<div class="box-content">        
	<div class="tab-content"> 
        <div class="tab-pane active" id="unpaid">
        <?php include_once('room_unpaid.php');?>           
    	</div>
        <div class="tab-pane" id="paid">
        <?php include_once('room_paid.php');?>    
        </div>
        
	</div>
</div>	 