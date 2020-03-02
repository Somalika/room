<?php
	$sql = " select 
				s.next_paid_date,
				r.name,
				s.staying_name,
				g.gender,s.job,
				inv.room_amount,
				inv.start_billing_date,
				inv.end_billing_date,
				
				ivd.water_old,
				ivd.water_new,
				ivd.water_usage,
				ivd.water_price, 
				
				ivd.elect_old,
				ivd.elect_new,
				ivd.elect_usage,
				ivd.elect_price,  
				
				inv.invoice_date,
				r.water_old_date,
				r.elect_old_date,
				
				ivd.total_water_price,
				ivd.total_elect_price 
				
			 from staying s 
			 inner join invoice inv on inv.room_id = s.room_id 
			 inner join invoice_detail ivd on ivd.invoice_id = inv.invoice_id
			 inner join room r on r.room_id = inv.room_id
			 inner join gender g on g.genderid = s.gender_id 
			 where inv.invoice_id = ?";
	$result = $this->db->query($sql,array($param2))->row();

	$arrStart = explode('-',$result->start_billing_date);
	$arrEnd = explode('-',$result->end_billing_date);
?>
<center>
    <a onclick="PrintElem('#invoice_print')" class="btn btn-default btn-icon icon-left hidden-print pull-right">
        Print Invoice
        <i class="entypo-print"></i>
    </a>
</center>
<br />
<br />
<div id="invoice_print">
	<div style="width:95%; margin-left:20px; margin-right:10px;">
        <table border="0" width="100%">
            <tbody><tr>
                <td width="53%" align="left">
                    <h5>សម្រាប់ខែ  .... <?php echo $arrStart[1]?> .... ឆ្នាំ <?php echo $arrStart[0]?> </h5>
                </td>
                <td width="34%" align="right">
                    <h5>បន្ទប់លេខ :</h5>
                </td>
                <td width="13%">
                    <h4>&nbsp; <?php echo $result->name?></h4>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="3">
                    <u><h4>បង្កាន់ដែទទួលប្រាក់</h4></u>
                </td>
            </tr>
        </tbody>
        </table>
        <table border="0" width="100%">
            <tbody>
                <tr>
                    <td align="left"><h5>ទទួលបានពីឈ្នោះ ..... <?php echo $result->staying_name?> ......</h5></td>
                    <td align="left">
                        <h5>ភេទ ... <?php echo $result->gender?> ...</h5>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" colspan="2">
                       <h5>ស្នាក់នៅពីថ្ងៃទី ... <?php echo $arrStart[2]?> ... ខែ ... <?php echo $arrStart[1]?> ... ឆ្នាំ <?php echo $arrStart[0]?> ... <span class="pull-right">ដល់ថ្ងៃទី ... <?php echo $arrEnd[2]?> ... ខែ ... <?php echo $arrEnd[1]?> ... ឆ្នាំ <?php echo $arrEnd[0]?> .............</span></h5>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" colspan="2">
                       <h5>មុខរបរជា ...... <?php echo $result->job?> ........ <span class="pull-right">ចំនួនទឹកប្រាក់ដែលត្រូវបង់: ... <?php echo $result->room_amount?> USD ....... ។</span></h5>
                       <h5>* សម្កាល់ សូមបង់ប្រាក់នៅរៀងរាល់ដើមខែនីមួយៗ ។        </h5>
                    </td>
                </tr>
            </tbody>
        </table>
        <center>
        <table border="0" width="85%">
            <tbody><tr>
                <td width="28%" align="center">
                    <h5>អ្នកទទួល</h5>
                    <h5>ហត្ថលេខា និងឈ្នោះ</h5>
        			<br />
                    <h5><?php echo $this->session->userdata('FULL_NAME_KH');?></h5>
                </td>
                <td width="40%" align="left">&nbsp;  </td>
                <td width="32%" align="center">
                    <h5>អ្នកបង់ប្រាក់</h5>
                    <h5>ហត្ថលេខា និងឈ្នោះ</h5>
                </td>
            </tr></tbody>
        </table>
        </center>
        <br />
        <br />
        <br />
        <hr>

        <br />
        <br />
        <table border="0" width="100%">
            <tbody>
            <tr>
                <td align="center" colspan="2">
                    <u><h4>វិក្កយបត្រភ្លើង</h4></u>
                </td>
            </tr>
        	</tbody>
        </table>
        <table border="0" width="100%">
            <tbody>
                <tr>
                    <td width="50%" align="left"><h5>លេខអំណានចាស់....... <?php echo $result->water_old?> .......</h5></td>
                    <td width="50%" align="left">
                        <h5>កាលបរិចេ្ចទ....... <?php echo $result->start_billing_date?> .......</h5>
                    </td>
                </tr> ​
                <tr>
                    <td align="left"><h5>លេខអំណានថ្មី............ <?php echo $result->water_new?> .......</h5></td>
                    <td align="left">
                        <h5>កាលបរិចេ្ចទ........ <?php echo $result->invoice_date?> .......</h5>
                    </td>
                </tr> ​
                <tr>
                    <td align="left"><h5>បរិមាណភ្លើងប្រើប្រាស់....... <?php echo $result->water_usage?> .......</h5></td>
                    <td align="left">
                        <h5>Kw x <?php echo $result->water_price?>រ = ....... <?php echo $result->total_water_price?> .......</h5>
                    </td>
                </tr>
            </tbody>
        </table>
         <table border="0" width="100%">
            <tbody>
            <tr>
                <td align="center" colspan="2">
                    <u><h4>វិក្កយបត្រទទឹក</h4></u>
                </td>
            </tr>
        	</tbody>
        </table>
        <table border="0" width="100%">
            <tbody>
                <tr>
                    <td width="50%" align="left"><h5>លេខអំណានចាស់....... <?php echo $result->elect_old?> .......</h5></td>
                    <td width="50%" align="left">
                        <h5>កាលបរិចេ្ចទ....... <?php echo $result->start_billing_date?> .......</h5>
                    </td>
                </tr> ​
                <tr>
                    <td align="left"><h5>លេខអំណានថ្មី............ <?php echo $result->elect_new?> .......</h5></td>
                    <td align="left">
                        <h5>កាលបរិចេ្ចទ........ <?php echo $result->invoice_date?> .......</h5>
                    </td>
                </tr> ​
                <tr>
                    <td align="left"><h5>បរិមាណភ្លើងប្រើប្រាស់....... <?php echo $result->elect_usage?> .......</h5></td>
                    <td align="left">
                        <h5>Kw x <?php echo $result->elect_price?>រ = ....... <?php echo $result->total_elect_price?> .......</h5>
                    </td>
                </tr>
            </tbody>
        </table>
		</div>

    </div>

    <script type="text/javascript">

    // print invoice function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {

        var divToPrint=document.getElementById('invoice_print');

        var newWin=window.open('','Print-Window');

        newWin.document.open();
        newWin.document.write('<html><head><title>Invoice</title><style>@page { size: A5; margin: 0;} h5 {font-size: 12px;} .pull-right { float: right;} </style>');
        newWin.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
        newWin.document.write('<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
        newWin.document.write('<body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

        newWin.document.close();

        setTimeout(function(){newWin.close();},10);
        return true;
    }

</script>