<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title"><?= lang('categories_heading') ?></h5>
		<div class="heading-elements">

		<a  href="<?= site_url('Categories/manage'); ?>" data-popup='custom-tooltip' data-original-title="<?= lang('add_categories') ?>"title="<?= lang('add_categories') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded"><i class="icon-plus3"></i></a>
			<a type="button" data-popup='custom-tooltip' data-original-title="<?= lang('delete_categories') ?>" title="<?= lang('delete_categories') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord"><i class="icon-trash"></i></a>

		</div>
	</div>

	<div class="table-responsive">

		<table id="categoriesTable" class="table" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
				<th><?= lang('business_name') ?></th>
				<th><?= lang('categories_name') ?></th>
				<th><?= lang('is_active') ?></th>
				<th><?= lang('action') ?></th>
			</tr>
			</thead>
		</table>
	</div>
</div>

<!--Display the country list-->
<script>
	$(document).ready(function () {

		dt_DataTable = $('#categoriesTable').DataTable({
			dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
			language: {
				search: '<span>Filter:</span> _INPUT_',
				searchPlaceholder: 'Type to filter...',
				lengthMenu: '<span>Show:</span> _MENU_',
				paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
			},
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?= site_url('Categories/getCategoriesListing'); ?>",
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
				{"data": "categories_id"},
				{"data": "business_name"},
				{"data": "categories_name"},
				{"data": "is_active",
					"render": function (data, type, row) {
						var is_checked = '';
						var id = row['categories_id'];
						if (data == 1) {
							is_checked = 'checked="checked"';
						}
						var html = '';
						html += '<div class="checkbox checkbox-switchery switchery-xs">';
						html += '<label>';
						html += '<input id="' + id + '" type="checkbox" class="dt_switchery isActive" ' + is_checked + ' data-status="' + data + '"  >';
						html += '</label>';
						html += '</div>';
						return html;
					},
					//    "sortable": false,
					"searchable": false

				},
				{
					"data": "actions",
					"render": function (data, type, row) {
						var html = '';
						var id = row['categories_id'];
						html += "<a  href='<?= site_url('Categories/manage/'); ?>" + id + "' data-popup='custom-tooltip' data-original-title='<?= lang('edit_categories') ?>'  onclick='EditRecord(" + id + ")' title='<?= lang('edit_categories') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded'><i class='icon-pencil'></i></a>";
						html += "&nbsp";
						html += "<a href='javascript:void(0);' onclick='DeleteRecord(" + id + ")' data-popup='custom-tooltip' data-original-title='<?= lang('delete_categories') ?>' title='<?= lang('delete_categories') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
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
						return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['categories_id'] + '" name="ids[]" value="' + row['categories_id'] + '"/></label>';
					},
					"sortable": false,
					"searchable": false
				},
				{
					"targets": 3,
					"sortable": false,
					"searchable": false
				},
			],

			fnDrawCallback: function (oSettings) {
				// Switchery
				// Initialize multiple switches
				DtSwitcheryKeyGen();
				CheckboxKeyGen('checkAll');
				CustomToolTip();
				ScrollToTop();
			}
		});
	});

</script>
