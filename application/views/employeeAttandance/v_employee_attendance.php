<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title"><?= lang('student_index_heading') ?></h5>
		<div class="heading-elements">

			<a  href="<?= site_url('EmployeeAttendance/manage'); ?>" data-popup='custom-tooltip' data-original-title="<?= lang('add_student') ?>"title="<?= lang('add_student') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded"><i class="icon-plus3"></i></a>
			<a type="button" data-popup='custom-tooltip' data-original-title="<?= lang('delete_student') ?>" title="<?= lang('delete_student') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord"><i class="icon-trash"></i></a>

		</div>
	</div>

	<div class="table-responsive">

		<table id="employeeTable" class="table " cellspacing="0" width="100%">
			<thead>
			<tr>
				<th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
				<th><?= lang('name') ?></th>
				<th><?= lang('login') ?></th>
                <th><?= lang('logout') ?></th>
                <th><?= lang('date') ?></th>
				<th><?= lang('action') ?></th>
			</tr>
			</thead>
		</table>
	</div>
</div>


<script>
	$(document).ready(function () {
		dt_DataTable = $('#employeeTable').DataTable({
			dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
			language: {
				search: '<span>Filter:</span> _INPUT_',
				searchPlaceholder: 'Type to filter',
				lengthMenu: '<span>Show:</span> _MENU_',
				paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
			},
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?= site_url('EmployeeAttendance/getEmployeeAttendanceListing'); ?>",
				"type": "post",
				"data": function (d) {
					return $.extend({}, d, {
						"<?= $this->security->get_csrf_token_name() ?>": '<?= $this->security->get_csrf_hash() ?>'
					});
				}
			},
			"iDisplayLength": "<?= PERPAGE_DISPLAY ?>",
			"order": [[1, "ASC"]],
			"stripeClasses": [ 'alpha-slate', 'even-row' ],
			"columns": [
				{"data": "student_attendance_id"},
				{"data": "emp_name"},
                {"data": "login_time"},
                {"data": "logout_time"},
                {"data": "attendance_date"},
				{
					"data": "actions",
					"render": function (data, type, row) {
						var html = '';
						var id = row['student_attendance_id'];
						html += "<a  href='<?= site_url('EmployeeAttendance/manage/'); ?>" + id + "' data-popup='custom-tooltip' data-original-title='<?= lang('edit_student') ?>'  onclick='EditRecord(" + id + ")' title='<?= lang('edit_student') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded'><i class='icon-pencil'></i></a>";
						html += "&nbsp";
						html += "<a href='javascript:void(0);' onclick='DeleteRecord(" + id + ")' data-popup='custom-tooltip' data-original-title='<?= lang('delete_student') ?>' title='<?= lang('delete_student') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
						return html;
					},
					"sortable": false,
					"searchable": false
				},

			],
			"columnDefs": [
				{
					"targets": 0,
					"render": function (data, type, row) {
						return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['student_attendance_id'] + '" name="ids[]" value="' + row['student_attendance_id'] + '"/></label>';
					},
				},
				{
					"targets": [0,2,3],
					"sortable": false,
					"searchable": false
				},
			],
			fnDrawCallback: function (oSettings) {
				// Switchery
				// Initialize multiple switches
				CheckboxKeyGen();
				CustomToolTip();
				ScrollToTop();
			}
		});
	});

</script>

<script>

	//Delete Time Cancel button click to remove checked value
	$(document).on('click', '.cancel', function () {
		$('#employeeTable input[class="dt-checkbox styled"]').prop('checked', false);
		CheckboxKeyGen();
	});

	$(document).ready(function () {
		// Switchery
		// Initialize multiple switches
		SwitcheryKeyGen();
		CheckboxKeyGen('checkAll');
		CustomToolTip();

		///$('#checkAll').prop('checked', false);
		$('#checkAll').click(function () {
			var checkedStatus = this.checked;
			$('#employeeTable tbody tr').find('td:first :checkbox').each(function () {
				$(this).prop('checked', checkedStatus);
			});
			CheckboxKeyGen();
		});

	});

	//Delete function
	function DeleteRecord(employeeId) {
		$('#employeeTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
		$('#ids_' + employeeId).prop('checked', true);
		$('.deleteRecord').click();
		CheckboxKeyGen();
	}


	//Delete Record
	$(document).on('click', '.deleteRecord', function () {
		var deleteElement = $('#employeeTable tbody input[class="dt-checkbox styled"]:checked');
		var selectedLength = deleteElement.size();
		//  CheckboxKeyGen();
		if (selectedLength == 0) {
			swal({
				title: "<?= ucwords(lang('info')); ?>",
				text: "<?= lang('delete_info'); ?>",
				confirmButtonColor: "<?= BTN_DELETE_INFO; ?>",
				type: "<?= lang('info'); ?>"
			},function(){
				return false;
			});
		} else {
			var deleteId = [];
			$.each(deleteElement, function (i, ele) {
				deleteId.push($(ele).val());
			});

			swal({
					title: "<?= ucwords(lang('delete')); ?>",
					text: "<?= lang('delete_warning'); ?>",
					type: "<?= lang('warning'); ?>",
					showCancelButton: true,
					closeOnConfirm: false,
					confirmButtonColor: "<?= BTN_DELETE_WARNING; ?>",
					showLoaderOnConfirm: true
				},
				function () {
					$.ajax({
						type: "post",
						url: "<?= site_url("EmployeeAttendance/delete")?>",
						dataType: "json",
						data: {deleteId: deleteId},
						success: function (data) {
							if (data['success']) {
								swal({
									title: "<?= ucwords(lang('success'))?>",
									text: data['msg'],
									type: "<?= lang('success')?>",
									confirmButtonColor: "<?= BTN_SUCCESS; ?>",
								});
								dt_DataTable.ajax.reload();
								//$('#checkAll').prop('checked', false);
								CheckboxKeyGen('checkAll');
							} else {
								swal({
									title: "<?= ucwords(lang('error')); ?>",
									text: data['msg'],
									type: "<?= lang('error'); ?>",
									confirmButtonColor: "<?= BTN_ERROR; ?>"
								});
								dt_DataTable.ajax.reload();
								CheckboxKeyGen('checkAll');
							}
						}
					});
				});
		}
	});


	//Edit function
	function EditRecord(employeeId) {
		$('#employeeTable  input[class="dt-checkbox styled"]').prop('checked', false);
		$('#ids_' + employeeId).prop('checked', true);
		//$('.editRecord').click();
		CheckboxKeyGen();

	}
</script>
