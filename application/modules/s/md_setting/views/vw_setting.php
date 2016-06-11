<style>
td{
 color:#fff;
}
</style>
	<div class="easyui-layout" data-options="fit:true">
		<div data-options="region:'center',title:'Setting Display'">
		<div style="padding:0px 15px;color:#fff;">
			<form name="frmsetting" id="frmsetting" method="post" novalidate>
			
         <table width=100% cellpadding=15px cellspacing=15px>
		 <tr><td width=150px>Port Counter Display
			 <td><input name='Port_Counter_Display' id='Port_Counter_Display' class="easyui-numberbox" size="5" data-options="required:true">

		 <tr><td width=150px>Baudrate Counter Display
			 <td><input name='Baudrate_Counter_Display' id='Baudrate_Counter_Display' class="easyui-numberbox" size="20" data-options="required:true">

		 <tr><td width=150px>Touch Screen
			 <td><input name='Touch_Screen' id='Touch_Screen' class="easyui-numberbox" size="5" data-options="required:true">

		 <tr><td width=150px>LCD Display 1
			 <td><input name='LCD_Display' id='LCD_Display' class="easyui-numberbox" size="5" data-options="required:true">

		 <tr><td width=150px>LCD Display 2
			 <td><input name='Form_2' id='Form_2' class="easyui-numberbox" size="5" data-options="required:true">

		 <tr><td width=150px>Port Console
			 <td><input name='Port_Console' id='Port_Console' class="easyui-numberbox" size="20" data-options="required:true">

		 <tr><td width=150px>Port Printer
			 <td><input name='Port_Printer' id='Port_Printer' class="easyui-numberbox" size="5" data-options="required:true">

		 <tr><td width=150px>Baudrate Printer
			 <td><input name='Baudrate_Printer' id='Baudrate_Printer' class="easyui-numberbox" size="20" data-options="required:true">

		 <tr><td width=150px>Shutdown
			 <td><input name='Shutdown' id='Shutdown' size="10" data-options="required:true">
			 
 			<tr><td width=100px height=100px>Volume Video </td>
				<td> <input id='volume_video' name='volume_video' class="easyui-slider" value='<?php echo $volume_video; ?>' style="width:300px" data-options="showTip:true,rule:[0,'|',25,'|',50,'|',75,'|',100]">
			<tr><td height=100px>Text Speed</td>
				<td> <input id=text_speed name=text_speed class="easyui-slider" value='<?php echo $text_speed; ?>'  style="width:300px" data-options="showTip:true,rule:[0,'|',25,'|',50,'|',75,'|',100]">			

		</table>	   

		
		</div>		
		</div>
	
		<div data-options="region:'south',split:true" style="height:80px;padding:20px;">
						<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="fnSave()"><font color=#fff>Save</font></a>
			
		</div>

			</form>

	</div>


<div id="85_dlgsetting" class="easyui-dialog" data-options="cache: false, resizable: false, closable: true, modal: true, onResize: function(width, height){if(height!='auto') fnResize_85(width, height) }" closed="true" style="background-color:#F8F8F8;">  
    <div id="85_divWait" align="left" style="padding:10px; height:200px;"><img src="http://localhost/antrian/images/loading.gif" /> &nbsp;Loading...</div>
    <iframe name="85_frasetting" id="85_frasetting" frameborder="0" style="background-color:#F8F8F8"></iframe>
</div>
<script type="text/javascript">

			 $('#frmsetting').form('load','<?php echo base_url()?>index.php/md_setting/fnsettingRow_Port_Counter_Display/');
			 $('#frmsetting').form('load','<?php echo base_url()?>index.php/md_setting/fnsettingRow_Baudrate_Counter_Display/');
			 $('#frmsetting').form('load','<?php echo base_url()?>index.php/md_setting/fnsettingRow_Touch_Screen/');
			 $('#frmsetting').form('load','<?php echo base_url()?>index.php/md_setting/fnsettingRow_LCD_Display/');
			 $('#frmsetting').form('load','<?php echo base_url()?>index.php/md_setting/fnsettingRow_Form_2/');
			 $('#frmsetting').form('load','<?php echo base_url()?>index.php/md_setting/fnsettingRow_Port_Console/');
			 $('#frmsetting').form('load','<?php echo base_url()?>index.php/md_setting/fnsettingRow_Port_Printer/');
			 $('#frmsetting').form('load','<?php echo base_url()?>index.php/md_setting/fnsettingRow_Baudrate_Printer/');
			 $('#frmsetting').form('load','<?php echo base_url()?>index.php/md_setting/fnsettingRow_Volume_Video/');
			 $('#frmsetting').form('load','<?php echo base_url()?>index.php/md_setting/fnsettingRow_Text_Speed/');
			 $('#frmsetting').form('load','<?php echo base_url()?>index.php/md_setting/fnsettingRow_Shutdown/');

url = '<?php echo base_url(); ?>index.php/md_setting/fnsettingUpdate_Port_Counter_Display/';			 
$(function() {

 $('#volume_video').slider('setValue',25);
    $('#Shutdown').timespinner({
    min: '00:00',
    required: true,
    showSeconds: false
    }); 
     
});
function fnSave() {
	$('#frmsetting').form('submit',{
		url: url,
		onSubmit: function() {
			return $(this).form('validate');
		},
		success: function(result) {
			var result = eval('('+result+')');
			if (result.success) {
				window.parent.$('#85_dtgsetting').datagrid('reload');
				window.parent.$('#85_dlgsetting').dialog('close');
			} else {
				var msg = result.msg;
				alert(msg);
			}
		}
	});
}

function fnSearch_85() {
	$('#85_dtgsetting').datagrid('load',{
		settingKeyword: $('#85_txtsetting').val()
	});
}
function fnResize_85(width,height) {
	$('#85_frasetting').width(width-14);
	$('#85_frasetting').height(height-40);
}
function fnResize_85(width,height) {
	$('#85_frasetting').width(width-14);
	$('#85_frasetting').height(height-40);
}
function fnAddsetting_85() {
	$('#85_dlgsetting').dialog({
		title: 'Input Data setting',
		width: 510,
		height: 390
	});
	$('#85_divWait').show();
	$('#85_frasetting').hide();
	$('#85_frasetting').attr('src','<?php echo base_url(); ?>index.php/md_setting/fnsettingAdd');
	$('#85_dlgsetting').window('open');
}
function fnEditsetting_85() {
	var singleRow = $('#85_dtgsetting').datagrid('getSelected');
	if(singleRow) {
		$('#85_dlgsetting').dialog({
			title: 'Edit Data Setting',
			width: 510,
			height: 390
		});
		$('#85_divWait').show();
		$('#85_frasetting').hide();
						
		$('#85_frasetting').attr('src','<?php echo base_url(); ?>index.php/md_setting/fnsettingEdit/'+singleRow.id_setting);
				

		$('#85_dlgsetting').window('open');
	} else {
		alert('Select which setting data you want to edit.');
	}
}
function fnSelectsetting_85() {
	var singleRow = $('#85_dtgsetting').datagrid('getSelected');
	if(singleRow) {
		var vsettingId = singleRow.setting_uid;
		var vsettingLogin = singleRow.setting_ulogin;
		$('#85_dlgsetting').dialog({
			title: 'Select setting for '+vsettingLogin,
			width: 365,
			height: 290
		});
		$('#85_divWait').show();
		$('#85_frasetting').hide();
				
		$('#85_frasetting').attr('src','<?php echo base_url(); ?>index.php/md_setting/fnsettingChoose/'+vid_setting);
				
		$('#85_dlgsetting').window('open');
	} else {
		alert('Select setting Datagrid row first.');
	}
}
function fnDeletesetting_85() {
	var singleRow = $('#85_dtgsetting').datagrid('getSelected');
	if (singleRow) {
		$.messager.confirm('Confirm','Are you sure you want to delete this data?',function(res) {
			if (res) {
				
				$.post('<?php echo base_url(); ?>index.php/md_setting/fnsettingDelete/',{Id:singleRow.id_setting},function(result) {
				
					if (result.success) {
						$('#85_dtgsetting').datagrid('reload');
					} else {
						$.messager.show({title:'Error',msg:result.msg});
					}
				},'json');
			}
		});
	} else {
		alert('Select the data that you want to Delete.');
	}
}
</script>