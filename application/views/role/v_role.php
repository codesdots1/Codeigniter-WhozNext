<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title"><?= lang('role_index_heading') ?></h5>
		<div class="heading-elements">

			<a  href="<?= site_url('Role/manage'); ?>" data-popup='custom-tooltip' data-original-title="<?= lang('add_role') ?>"title="<?= lang('add_role') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded"><i class="icon-plus3"></i></a>
			<a type="button" data-popup='custom-tooltip' data-original-title="<?= lang('delete_role') ?>" title="<?= lang('delete_role') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord"><i class="icon-trash"></i></a>

		</div>
	</div>

	<div class="table-responsive">

		<table id="roleTable" class="table " cellspacing="0" width="100%">
			<thead>
			<tr>
				<th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
				<th><?= lang('role') ?></th>
				<th><?= lang('description') ?></th>
				<th><?= lang('action') ?></th>
			</tr>
			</thead>
		</table>
	</div>
</div>


<script>
	$(document).ready(function () {
		dt_DataTable = $('#roleTable').DataTable({
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
				"url": "<?= site_url('Role/getRoleListing'); ?>",
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
				{"data": "role_id"},
				{"data": "role"},
				{"data": "description",
					"render": function (data, type, row) {
						if(data == ''){
							var html = '<?= lang('no_description_added'); ?>';
							return html;
						}else{
							return data;
						}

					}
				},
				{
					"data": "actions",
					"render": function (data, type, row) {
						var html = '';
						var id = row['role_id'];
						html += "<a  href='<?= site_url('Role/manage/'); ?>" + id + "' data-popup='custom-tooltip' data-original-title='<?= lang('edit_role') ?>'  onclick='EditRecord(" + id + ")' title='<?= lang('edit_role') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded'><i class='icon-pencil'></i></a>";
						html += "&nbsp";
						html += "<a href='javascript:void(0);' onclick='DeleteRecord(" + id + ")' data-popup='custom-tooltip' data-original-title='<?= lang('delete_role') ?>' title='<?= lang('delete_role') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
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
						return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['role_id'] + '" name="ids[]" value="' + row['role_id'] + '"/></label>';
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
		$('#roleTable input[class="dt-checkbox styled"]').prop('checked', false);
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
			$('#roleTable tbody tr').find('td:first :checkbox').each(function () {
				$(this).prop('checked', checkedStatus);
			});
			CheckboxKeyGen();
		});

	});

	//Delete function
	function DeleteRecord(roleId) {
		$('#roleTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
		$('#ids_' + roleId).prop('checked', true);
		$('.deleteRecord').click();
		CheckboxKeyGen();
	}


	//Delete Record
	$(document).on('click', '.deleteRecord', function () {
		var deleteElement = $('#roleTable tbody input[class="dt-checkbox styled"]:checked');
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
						url: "<?= site_url("Role/delete")?>",
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
	function EditRecord(roleId) {
		$('#roleTable  input[class="dt-checkbox styled"]').prop('checked', false);
		$('#ids_' + roleId).prop('checked', true);
		//$('.editRecord').click();
		CheckboxKeyGen();

	}
</script>
