<?php $CI =& get_instance(); ?>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('native_heading') ?></h5>
        <div class="heading-elements">

            <?php if($this->dt_ci_acl->checkAccess('Native|manage')) {?>
            <a  href="<?= site_url('Native/manage'); ?>" data-popup='custom-tooltip' data-original-title="<?= lang('add_native') ?>"
                title="<?= lang('add_native') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded"><i class="icon-plus3"></i>
            </a>
            <?php } ?>

            <?php if($this->dt_ci_acl->checkAccess('Native|delete')) {?>
            <a type="button" data-popup='custom-tooltip' data-original-title="<?= lang('delete_native') ?>" title="<?= lang('delete_native') ?>"
               class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord"><i class="icon-trash"></i>
            </a>
            <?php } ?>

        </div>
    </div>

    <div class="table-responsive">
        <table id="nativeTable" class="table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input id="checkAll" type="checkbox" class="dt-checkbox styled"></th>
                <th><?= lang('samaj_name') ?></th>
                <th><?= lang('native_name') ?></th>
                <th><?= lang('action') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        dt_DataTable = $('#nativeTable').DataTable({
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
                "url": "<?= site_url('Native/getNativeListing'); ?>",
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
                {"data": "native_id"},
                {"data": "samaj_name"},
                {"data": "native_location"},
                {"data": "actions",
                    "render": function (data, type, row) {
                        var html = '';
                        var id = row['native_id'];

                        <?php if($this->dt_ci_acl->checkAccess('Native|manage')) {?>
                        html += "<a  href='<?= site_url('Native/manage/'); ?>" + id + "' data-popup='custom-tooltip' data-original-title='<?= lang('edit_native') ?>'  onclick='EditRecord(" + id + ")' title='<?= lang('edit_native') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded'><i class='icon-pencil'></i></a>";
                        <?php } ?>

                        html += "&nbsp";

                        <?php if($this->dt_ci_acl->checkAccess('Native|delete')) {?>
                        html += "<a href='javascript:void(0);' onclick='DeleteRecord(" + id + ")' data-popup='custom-tooltip' data-original-title='<?= lang('delete_native') ?>' title='<?= lang('delete_native') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
                        <?php } ?>

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
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['native_id'] + '" name="ids[]" value="' + row['native_id'] + '"/></label>';
                    },
                    "sortable": false,
                    "searchable": false
                }
            ],

            fnDrawCallback: function (oSettings) {
                DtSwitcheryKeyGen();
                CheckboxKeyGen('checkAll');
                CustomToolTip();
                ScrollToTop();
            }
        });
    });
</script>

<script>

    $(document).on('click', '.cancel', function () {
        $('#nativeTable input[class="dt-checkbox styled"]').prop('checked', false);
        CheckboxKeyGen();
    });

    $(document).ready(function () {
        SwitcheryKeyGen();
        CheckboxKeyGen('checkAll');
        CustomToolTip();

        $('#checkAll').click(function () {
            var checkedStatus = this.checked;
            $('#nativeTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
            CheckboxKeyGen();
        });
    });

    function EditRecord(nativeId) {
        $('#nativeTable  input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + nativeId).prop('checked', true);
        CheckboxKeyGen();
    }

    $(document).on('click', '.editRecord', function () {
        var editElement = $('#nativeTable  input[class=dt-checkbox]:checked');
        var selectedLength = editElement.size();
        if (selectedLength == 0) {
            swal({
                title: "Info",
                text: "Please select single record to edit.",
                confirmButtonColor: "<?= BTN_DELETE_INFO; ?>",
                type: "info"
            },function(){
                return false;
            });
        } else if (selectedLength > 1) {
            swal({
                title: "Multiple record selected",
                confirmButtonColor: "<?= BTN_DELETE_INFO; ?>"
            });
            return false;
        } else {
            href += editElement.val();
            $('.editRecord').attr('href', href);
        }
    });


    function DeleteRecord(nativeId) {
        $('#nativeTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + nativeId).prop('checked', true);
        $('.deleteRecord').click();
        CheckboxKeyGen();
    }

    $(document).on('click', '.deleteRecord', function () {
        $('form#nativeDetails #is_active').siblings().remove();
        var deleteElement = $('#nativeTable tbody input[class="dt-checkbox styled"]:checked');
        var selectedLength = deleteElement.size();
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
                        url: "<?= base_url("Native/deleteNativeLocation")?>",
                        dataType: "json",
                        data: {deleteId: deleteId},
                        success: function (data) {
                            if (data['success']) {
                                swal({
                                    title: "<?= ucwords(lang('success'))?>",
                                    text: data['msg'],
                                    type: "<?= lang('success')?>",
                                    confirmButtonColor: "<?= BTN_SUCCESS; ?>"
                                },function(){
                                    dt_DataTable.ajax.reload();
                                    CheckboxKeyGen('checkAll');
                                });
                            } else {
                                swal({
                                    title: "<?= ucwords(lang('error')); ?>",
                                    text: data['msg'],
                                    type: "<?= lang('error'); ?>",
                                    confirmButtonColor: "<?= BTN_ERROR; ?>"
                                },function(){
                                    dt_DataTable.ajax.reload();
                                    CheckboxKeyGen('checkAll');
                                });
                            }
                        }
                    });
                });
        }
    });
</script>