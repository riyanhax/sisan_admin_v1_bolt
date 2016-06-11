<div id="71_tlbuser" style="padding:5px;">
	<div style="float:left;">
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="fnEdituser_71()">Edit</a>
			
	</div>
</div>
<table id="71_dtguser" class="easyui-datagrid" data-options="title:'Data user',url:'<?php echo base_url(); ?>index.php/md_user/fnuserData/',toolbar:'#71_tlbuser',rownumbers:true,border:false,singleSelect:true,striped:true,fit:true,pagination:true,pageSize:20,pageList:[20,50,100,500]">
<thead>
	<tr>
           
		   <th data-options="field:'f_user_id',title:'<b>Id</b>',width:40,sortable:true" halign="center"></th>

		   <th data-options="field:'f_emp_no',title:'<b>Employee No</b>',width:160,sortable:true" halign="center"></th>

		   <th data-options="field:'f_emp_name',title:'<b>Employee Name</b>',width:240,sortable:true" halign="center"></th>

		   <th data-options="field:'f_comp_branch_name',title:'<b>Units Name</b>',width:160,sortable:true" halign="center"></th>

		   <th data-options="field:'f_dept_name',title:'<b>Department</b>',width:160,sortable:true" halign="center"></th>

		   <th data-options="field:'f_position_name',title:'<b>Position</b>',width:160,sortable:true" halign="center"></th>
           
		   <th data-options="field:'f_user_login',title:'<b>Username</b>',width:200,sortable:true" halign="center"></th>
                      	
   </tr>
</thead>
</table>
<div id="71_dlguser" class="easyui-dialog" data-options="cache: false, resizable: false, closable: true, modal: true, onResize: function(width, height){if(height!='auto') fnResize_71(width, height) }" closed="true" style="background-color:#F8F8F8;">  
    <div id="71_divWait" align="left" style="padding:10px; height:200px;"><img src="http://localhost/attendance/images/loading.gif" /> &nbsp;Loading...</div>
    <iframe name="71_frauser" id="71_frauser" frameborder="0" style="background-color:#F8F8F8"></iframe>
</div>
<script type="text/javascript">
function fnSearch_71() {
	$('#71_dtguser').datagrid('load',{
		userKeyword: $('#71_txtuser').val()
	});
}
function fnResize_71(width,height) {
	$('#71_frauser').width(width-14);
	$('#71_frauser').height(height-40);
}
function fnResize_71(width,height) {
	$('#71_frauser').width(width-14);
	$('#71_frauser').height(height-40);
}
function fnAdduser_71() {
	$('#71_dlguser').dialog({
		title: 'Input Data user',
		width: 510,
		height: 390
	});
	$('#71_divWait').show();
	$('#71_frauser').hide();
	$('#71_frauser').attr('src','<?php echo base_url(); ?>index.php/md_user/fnuserAdd');
	$('#71_dlguser').window('open');
}
function fnEdituser_71() {
	var singleRow = $('#71_dtguser').datagrid('getSelected');
	if(singleRow) {
		$('#71_dlguser').dialog({
			title: 'Edit Data User',
			width: 510,
			height: 390
		});
		$('#71_divWait').show();
		$('#71_frauser').hide();
						
		$('#71_frauser').attr('src','<?php echo base_url(); ?>index.php/md_user/fnuserEdit/'+singleRow.f_user_id);
				

		$('#71_dlguser').window('open');
	} else {
		alert('Select which user data you want to edit.');
	}
}
function fnSelectuser_71() {
	var singleRow = $('#71_dtguser').datagrid('getSelected');
	if(singleRow) {
		var vuserId = singleRow.user_uid;
		var vuserLogin = singleRow.user_ulogin;
		$('#71_dlguser').dialog({
			title: 'Select user for '+vuserLogin,
			width: 365,
			height: 290
		});
		$('#71_divWait').show();
		$('#71_frauser').hide();
				
		$('#71_frauser').attr('src','<?php echo base_url(); ?>index.php/md_user/fnuserChoose/'+vf_user_id);
				
		$('#71_dlguser').window('open');
	} else {
		alert('Select user Datagrid row first.');
	}
}
function fnDeleteuser_71() {
	var singleRow = $('#71_dtguser').datagrid('getSelected');
	if (singleRow) {
		$.messager.confirm('Confirm','Are you sure you want to delete this data?',function(res) {
			if (res) {
				
				$.post('<?php echo base_url(); ?>index.php/md_user/fnuserDelete/',{Id:singleRow.f_user_id},function(result) {
				
					if (result.success) {
						$('#71_dtguser').datagrid('reload');
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