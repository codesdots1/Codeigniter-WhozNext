<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('monk_index_heading') ?></h5>
        <div class="heading-elements">
            <?php if($this->dt_ci_acl->checkAccess('Monk|manage')) {?>
                <a  href="<?= site_url('Monk/manage'); ?>" data-popup='custom-tooltip' data-original-title="<?= lang('add_monk') ?>"
                    title="<?= lang('add_monk') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded">
                    <i class="icon-plus3"></i></a>
            <?php } ?>
            <?php if($this->dt_ci_acl->checkAccess('Monk|delete')) {?>
                <a type="button" data-popup='custom-tooltip' data-original-title="<?= lang('delete_monk') ?>"
                   title="<?= lang('delete_monk') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord">
                    <i class="icon-trash"></i></a>
            <?php } ?>

        </div>
    </div>

    <div class="table-responsive">

        <table id="monkTable" class="table " cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
                <th><?= lang('samaj_name') ?></th>
                <th><?= lang('member_name') ?></th>
                <th><?= lang('monk_name') ?></th>
                <th><?= lang('diksha_date') ?></th>
                <th><?= lang('action') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        dt_DataTable = $('#monkTable').DataTable({
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
                "url": "<?= site_url('Monk/getMonkListing'); ?>",
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
                {"data": "monk_id"},
                {"data": "samaj_name"},
                {"data": "member_name"},
                {"data": "monk_name"},
                {"data": "diksha_date"},
                {
                    "data": "actions",
                    "render": function (data, type, row) {
                        var html = '';
                        var id = row['monk_id'];
                        <?php if($this->dt_ci_acl->checkAccess('Monk|manage')) {?>
                            html += "<a  href='<?= site_url('Monk/manage/'); ?>" + id + "' data-popup='custom-tooltip' data-original-title='<?= lang('edit_monk') ?>'  onclick='EditRecord(" + id + ")' title='<?= lang('edit_monk') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded'><i class='icon-pencil'></i></a>";
                        <?php }?>

                        html += "&nbsp";
                        <?php if($this->dt_ci_acl->checkAccess('Monk|delete')) {?>
                            html += "<a href='javascript:void(0);' onclick='DeleteRecord(" + id + ")' data-popup='custom-tooltip' data-original-title='<?= lang('delete_monk') ?>' title='<?= lang('delete_monk') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
                        <?php } ?>
                        html += "&nbsp";
                        html += "<a target='_blank' href='<?= site_url('MonkLocation/index/'); ?>?monk_id=" + id + "' data-popup='custom-tooltip' data-original-title='<?= lang('monk_location') ?>' title='<?= lang('monk_location') ?>' class='btn btn-xs border-slate-400 text-danger-400 btn-flat btn-icon btn-rounded'><i class='icon-location4'></i></a>";
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
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['monk_id'] + '" name="ids[]" value="' + row['monk_id'] + '"/></label>';
                    },
                    "sortable": false,
                    "searchable": false
                }
            ],

            fnDrawCallback: function (oSettings) {
                // Switchery
                // Initialize multiple switches
                DtSwitcheryKeyGen();
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
        $('#monkTable input[class="dt-checkbox styled"]').prop('checked', false);
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
            $('#monkTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
            CheckboxKeyGen();
        });

    });

    //Delete function
    function DeleteRecord(monkId) {
        $('#monkTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + monkId).prop('checked', true);
        $('.deleteRecord').click();
        CheckboxKeyGen();
    }


    //Delete Record
    $(document).on('click', '.deleteRecord', function () {
        var deleteElement = $('#monkTable tbody input[class="dt-checkbox styled"]:checked');
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
                    url: "<?= site_url("Monk/delete")?>",
                    dataType: "json",
                    data: {deleteId: deleteId},
                    success: function (data) {
                        if (data['success']) {
                            swal({
                                title: "<?= ucwords(lang('success'))?>",
                                text: data['msg'],
                                type: "<?= lang('success')?>",
                                confirmButtonColor: "<?= BTN_SUCCESS; ?>"
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
</script>
