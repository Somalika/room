	/*
		print ticket
	*/
	function printDiv(printpage)
	{
		
		$("#tblHeader").css("display",'');
		$("#tblSolve").css("display",'');
		$("#tblFooter").css("display",'');
		$("#tblAPPROVAL").css("display",'none');
		
		var headstr = "<style>table {border-collapse: collapse; font-size:11px;}</style><body>";
		
		var footstr = "</body>";
		var newstr = document.all.item(printpage).innerHTML;
		var oldstr = document.body.innerHTML;
		document.body.innerHTML = headstr+newstr+footstr;
		window.print();
		document.body.innerHTML = oldstr;
		
		
		$("#tblHeader").css("display",'none');
		$("#tblSolve").css("display",'');
		$("#tblFooter").css("display",'none');
		$("#tblAPPROVAL").css("display",'');
		
		return false;
	}
	//
	function onClickButtonSubmit(){
		var approval = $("#approval").val();
		var comment = $("#comment");
		
		if(approval=='3' && comment.val()==''){
			alert("Please leave your comments.");
			comment.css("background-color","#F5FF90")
			return false;
		}
		$("#btnSubmit").attr('disabled',true);
		return true;
	}
	//
	function onChangeValue(val){ 
		if(val == 4){
			$("#tblRisk").css("display",'');
		}else{
			$("#tblRisk").css("display",'none');
		}
	}
	
	$.date = function(dateObject) {
		var d = new Date(dateObject);
		var day = d.getDate();
		var month = d.getMonth() + 1;
		var year = d.getFullYear();
		if (day < 10) {
			day = "0" + day;
		}
		if (month < 10) {
			month = "0" + month;
		}
		var date = year + "-" + month + "-" + day;
	
		return date;
	};
	
	//
	function onClickSubmit(){
		 
		var comment = $("#answer"); 
		//
		if(comment.val()==''){
			alert("Please answser your comments.");
			comment.css("background-color","#F5FF90")
			return false;
		}
		
		
		return true;
	} 
	
	function submitClose(){
		//
		$("#hidden_flage_btn").val(1);
		
		return true;
		 
	}
	
	function isCheck(val){
		if(val){
			$("#opt_mail").css("display",'');
		}else{
			$("#opt_mail").css("display",'none');
		}
	}
	
	function isRelative(val){
		//var dp=document.getElementByItd('department');
		if(val){
			//dp.css("display",'');
			$("#department").css("display",'');
			//$("#department_asg").css("display",'');
		}else{
			$("#department").css("display",'none');
			//$("#department_asg").css("display",'none');
		}
	}
	
	 
	///
	function test(based_url,id){ 
		window.location.href = based_url+'index.php?nvc/view_booking_meeting_room/'+id; 
	} 
	//function click radio show form 
	function RadioCheckExternal(val){
		$(document).ready(function(){
			if(val==true){
				$("#control_customer,#h").slideDown(500);
			}
			else{
				alert("Sorry show form error!");
			}
		});
	}
	function RadioInternal(val){
		$(document).ready(function(){
			if(val==true){
				$("#control_customer,#h").slideUp(2500);
			 }
			 else{
				alert("Sorry hide external Error!");
			 }
		});
	}
	//function check box food 
	function RadioCheckFood(val){
		$(document).ready(function(){
			$("#main_checkfood").click(function(){
				if(val==true){
			$("#main_checkfood").css('display','');
			//$("#main_checkfood").slideDown(1200);
			}
			});
		});
	}
	
	/* click view notification detail */
	function onViewDetail(notice_id,based_url){
	 window.location.href = based_url+'index.php?nvc/view_booking_meeting_room/'+notice_id+'/2016';  
	}
	
	
	// validation number only
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : evt.keyCode
		return !(charCode!=45 && charCode > 31 && (charCode < 48 || charCode > 57));
		
	} 