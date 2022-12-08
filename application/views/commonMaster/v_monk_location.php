<?php
if(isset($filterModel) && $filterModel != ''){
  echo $filterModel;
}?>

<?php
$monkId = isset($monk_id) ? $monk_id : "";
?>

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('monk_location_index_heading') ?></h5>
        <div class="heading-elements">
            <?php if($this->dt_ci_acl->checkAccess('MonkLocation|manage')) {?>
                <a  href="<?= site_url('MonkLocation/manage'); ?>" data-popup='custom-tooltip' data-original-title="<?= lang('add_monk_location') ?>"
                    title="<?= lang('add_monk_location') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded">
                    <i class="icon-plus3"></i></a>
            <?php }?>
            <?php if($this->dt_ci_acl->checkAccess('MonkLocation|delete')) {?>
            <a type="button" data-popup='custom-tooltip' data-original-title="<?= lang('delete_monk_location') ?>"
               title="<?= lang('delete_monk_location') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord">
                <i class="icon-trash"></i></a>
            <?php }?>
        </div>
    </div>

    <div class="table-responsive">
        <table id="monkLocationTable" class="table " cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
                <th><?= lang('monk_name') ?></th>
                <th><?= lang('location_name') ?></th>
                <th><?= lang('address') ?></th>
                <th><?= lang('google_address') ?></th>
                <th><?= lang('contact_person') ?></th>
                <th><?= lang('contact_person') ?></th>
                <th><?= lang('action') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        dt_DataTable = $('#monkLocationTable').DataTable({
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
                "url": "<?= site_url('MonkLocation/getMonkLocationListing'); ?>",
                "type": "post",
                "data": function (d) {
                    return $.extend({}, d, {
                        "monk_id": '<?= $monkId; ?>',
                        "<?= $this->security->get_csrf_token_name() ?>": '<?= $this->security->get_csrf_hash(); ?>'
                    });
                }
            },
            "fnServerParams": function (aoData) { //send other data to server side
                var params = {};
                var filterData = $("#advanceFilter").serializeArray();
                $.each(filterData, function (i, val) {
                    var name = val.name;
                    if (typeof params[name] == 'undefined') {
                        params[name] = [];
                    }
                    params[name].push(val.value);
                });
                aoData.filterParams = params;
                server_params = aoData;
            },
            "iDisplayLength": "<?= PERPAGE_DISPLAY ?>",
            "order": [[1, "ASC"]],
            "stripeClasses": [ 'alpha-slate', 'even-row' ],
            "columns": [
                {"data": "monk_location_id"},
                {"data": "monk_name"},
                {"data": "location_name"},
                {"data": "address"},
                {"data": "google_address"},
                {"data": "contact_person"},
                {"data": "contact_person_mobile"},
                {
                    "data": "actions",
                    "render": function (data, type, row) {
                        var html = '';
                        var id = row['monk_location_id'];
                        <?php if($this->dt_ci_acl->checkAccess('MonkLocation|manage')) {?>
                            html += "<a  href='<?= site_url('MonkLocation/manage/'); ?>" + id + "' data-popup='custom-tooltip' data-original-title='<?= lang('edit_monk_location') ?>'  onclick='EditRecord(" + id + ")' title='<?= lang('edit_monk_location') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded'><i class='icon-pencil'></i></a>";
                        <?php } ?>
                        html += "&nbsp";
                        <?php if($this->dt_ci_acl->checkAccess('MonkLocation|delete')) {?>
                            html += "<a href='javascript:void(0);' onclick='DeleteRecord(" + id + ")' data-popup='custom-tooltip' data-original-title='<?= lang('delete_monk_location') ?>' title='<?= lang('delete_monk_location') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
                        <?php }?>
                        return html;
                    },
                    "sortable": false,
                    "searchable": false
                }
            ],
            "columnDefs": [
                {
                    "targets": 0,
                    "width": "10%",
                    "render": function (data, type, row) {
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['monk_location_id'] + '" name="ids[]" value="' + row['monk_location_id'] + '"/></label>';
                    },
                    "sortable": false,
                    "searchable": false
                }
            ],
            fnDrawCallback: function (oSettings) {
                CheckboxKeyGen();
                CustomToolTip();
                ScrollToTop();
            }
        });
    });

</script>

<script>
    $(document).on('click', '.cancel', function () {
        $('#monkLocationTable input[class="dt-checkbox styled"]').prop('checked', false);
        CheckboxKeyGen();
    });

    $(document).ready(function () {

        SwitcheryKeyGen();
        CheckboxKeyGen('checkAll');
        CustomToolTip();
        monkDD('','#monk_id');
        samajDD('','#samaj_id');

        $('#checkAll').click(function () {
            var checkedStatus = this.checked;
            $('#monkLocationTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
            CheckboxKeyGen();
        });
    });

    //Delete function
    function DeleteRecord(monkLocationId) {
        $('#monkLocationTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + monkLocationId).prop('checked', true);
        $('.deleteRecord').click();
        CheckboxKeyGen();
    }

    //Delete Record
    $(document).on('click', '.deleteRecord', function () {
        var deleteElement = $('#monkLocationTable tbody input[class="dt-checkbox styled"]:checked');
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
                    url: "<?= site_url("MonkLocation/delete")?>",
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
    function EditRecord(monkLocationId) {
        $('#monkLocationTable  input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + eventId).prop('checked', true);
        CheckboxKeyGen();
    }
</script>

<?php if (isset($select2)) { ?>
    <?= $select2 ?>
<?php } ?>

