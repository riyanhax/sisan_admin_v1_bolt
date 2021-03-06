<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href='<?php echo base_url(); ?>assets/easyui/themes/gray/easyui-modified.css'>
<link rel="stylesheet" type="text/css" href='<?php echo base_url(); ?>assets/bens.css'>
<link rel="stylesheet" type="text/css" href='<?php echo base_url(); ?>assets/easyui/themes/icon.css'>
<script type="text/javascript" src='<?php echo base_url(); ?>assets/easyui/jquery.min.js'></script>
<script type="text/javascript" src='<?php echo base_url(); ?>assets/easyui/jquery.easyui.min.js'></script>
</head>
<body>
<div class="easyui-layout" style="width:495px; height:450px; background-color:#FFF;">
	<div data-options="region:'center',border:false">
		<div style="padding:0px 15px;">
			<form name="frmoutbox_sms" id="frmoutbox_sms" method="post" novalidate>
			<div class="frmTitle">Data New Sms</div>
			       
       
			<div class="frmItem">
				<label>Message</label>
			    <textarea id="f_outbox_message" name="f_outbox_message" rows="3" cols="60" data-options="required:true,missingMessage:'Must be filled.'" ></textarea>				
				
			</div>
    
       
			<div class="frmItem">
				<label>Remark</label>
				<input name='f_outbox_remark' id='f_outbox_remark' class="easyui-validatebox" size="30" >
			</div>
       
			<div class="frmItem">
				<label>Filter By</label>
				<hr>
			</div>
			<div class="frmItem">
				<label>Com</label>
				<input name='f_com_id' id='f_com_id' class="easyui-validatebox" size="20" >
			</div>


			<div class="frmItem">
				<label>Status</label>
				<input name='f_status_id' id='f_status_id'  size="20" >
			</div>
			
			<div class="frmItem">
				<label>Kota / Kabupaten</label>
				<input name='f_city_id' id='f_city_id' size="10" >
			</div>

			<div class="frmItem">
				<label>Kecamatan</label>
				<input name='f_kec_id' id='f_kec_id' size="10" >														
			</div>
       			
			<div class="frmItem">
				<label>Tanggal Lahir</label>
				<input name='f_emp_birthdate' id='f_emp_birthdate' class="easyui-datebox" size="10" >														
			</div>
	   
			</form>
		</div>
	</div>
	<div data-options="region:'south',border:false" style="height:35px; background-color:#F8F8F8;">
		<div id="btnoutbox_sms" align="right" style="padding:5px;">
			<div id="footBarLeft" style="float:left; width:auto; margin:5px 0px 0px 5px;">
				<span style="background-color:#FF9; border:1px solid #666">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Must be filled.
			</div>
			<div id="footBarRight" style="float:right; width:auto; clear:right;">
				<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="fnSave()">Save</a>
				<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="fnCancel()">Cancel</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function() {
	window.parent.$('#75_divWait').hide();
	window.parent.$('#75_fraoutbox_sms').show();
});
<?php if(isset($voutbox_smsId)) { ?>
$('#frmoutbox_sms').form('load','<?php echo base_url()?>index.php/md_outbox_sms/fnoutbox_smsRow/<?php echo $voutbox_smsId; ?>');
url = '<?php echo base_url(); ?>index.php/md_outbox_sms/fnoutbox_smsUpdate/<?php echo $voutbox_smsId; ?>';
<?php } else { ?>
$('#frmoutbox_sms').form('clear');
url = '<?php echo base_url(); ?>index.php/md_outbox_sms/fnbulkoutbox_smsCreate/';
<?php } ?>
$.fn.validatebox.defaults.missingMessage = 'Must be filled.';
$(function() {
	$('#f_com_id').combobox({
		valueField:'f_com_id',
		textField:'f_com',
		mode:'remote',
		panelWidth:200,
		panelHeight:'auto',		
		url:'<?php echo base_url(); ?>index.php/md_com/fncomComboData/'
	});
		
	$('#f_status_id').combobox({
		valueField:'f_status_id',
		textField:'f_status_name',
		mode:'remote',
		panelWidth:200,
		panelHeight:'auto',		
		url:'<?php echo base_url(); ?>index.php/md_status/fnstatusComboData/'
	});

	
	$('#f_city_id').combobox({
		valueField:'f_city_id',
		textField:'f_city_name',
		mode:'remote',
		panelWidth:200,
		onChange: function(){
			var CityId = $('#f_city_id').combobox('getValue');
			$('#f_kec_id').combobox({
				valueField:'f_kec_id',
				textField:'f_kec_name',
				mode:'remote',
				panelWidth:200,
				panelHeight:'auto',
				url:'<?php echo base_url(); ?>index.php/md_kecamatan/fnkecamatanComboData2/'+CityId
			});

		},		
		panelHeight:'auto',
		url:'<?php echo base_url(); ?>index.php/md_city/fncityComboData/'
	});
			$('#f_kec_id').combobox({
				valueField:'f_kec_id',
				textField:'f_kec_name',
				mode:'remote',
				panelWidth:200,
				panelHeight:'auto',
				url:'<?php echo base_url(); ?>index.php/md_kecamatan/fnkecamatanComboData/'
			});
	$('#f_emp_birthdate').datebox({  
    required:true,
   formatter:myformatter
	}); 	

	<?php if(isset($voutbox_smsId)) { ?>
	$('#fldLogin').attr('disabled','disabled');
	<?php } ?>
});
function fnSave() {
	fnSaveData();
}
function fnSaveData() {
	$('#frmoutbox_sms').form('submit',{
		url: url,
		onSubmit: function() {
			return $(this).form('validate');
		},
		success: function(result) {
			var result = eval('('+result+')');
			if (result.success) {
				window.parent.$('#75_dtgoutbox_sms').datagrid('reload');
				window.parent.$('#75_dlgoutbox_sms').dialog('close');
			} else {
				var msg = result.msg;
				alert(msg);
			}
		}
	});
}
function fnCancel() {
	window.parent.$('#75_dlgoutbox_sms').dialog('close');
}
</script>