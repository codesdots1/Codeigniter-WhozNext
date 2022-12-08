<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('business_type_list') ?></h5>
        <div class="heading-elements">

            <?php if($this->dt_ci_acl->checkAccess('BusinessType|modify')){ ?>
                <a  href="<?= site_url('BusinessType/manage'); ?>" data-popup='custom-tooltip'
                    title="<?= lang('add_business_type') ?>" data-original-title="<?= lang('add_business_type') ?>"
                    class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded"><i class="icon-plus3"></i></a>
            <?php }?>
            <?php if($this->dt_ci_acl->checkAccess('BusinessType|delete')){ ?>
                <button type="button" data-popup="custom-tooltip" data-original-title="<?= lang('delete_business_type') ?>"
                        title="<?= lang('delete_business_type') ?>"
                        class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord"><i class="icon-trash"></i></button>
            <?php }?>
        </div>
    </div>

    <div class="table-responsive">

        <table id="businessTypeTable" class="table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
                <th><?= lang('business_type_name') ?></th>
                <th><?= lang('parent_business_type_name') ?></th>
                <th><?= lang('samaj_name') ?></th>
                <th><?= lang('sort_order') ?></th>
                <?php if($this->dt_ci_acl->checkAccess("BusinessType|changeStatus")) {?>
                    <th><?= lang('is_active') ?></th>
                <?php } ?>
                <th><?= lang('action') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<!--Display the language list-->
<script>
    $(document).ready(function () {

        $('#checkAll').click(function () {
            var checkedStatus = this.checked;
            $('#businessTypeTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
            CheckboxKeyGen();
        });
        dt_DataTable = $('#businessTypeTable').DataTable({
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
                "url": "<?= site_url('BusinessType/getBusinessTypeListing'); ?>",
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
                {"data": "business_type_id"},
                {"data": "business_type_name"},
                {"data": "parent_business_type_name"},
                {"data": "samaj_name"},
                {"data": "sort_order"},
                <?php if($this->dt_ci_acl->checkAccess("BusinessType|changeStatus")){ ?>
                {"data": "is_active",
                    "render": function (data, type, row) {
                        var is_checked = '';
                        var id = row['business_type_id'];
                        if (data == 1) {
                            is_checked = 'checked="checked"';
                        }
                        var html = '';
                        html += '<div class="checkbox checkbox-switchery switchery-xs">';
                        html += '<label>';
                        html += '<input id="' + id + '" type="checkbox" class="dt_switchery is_active" ' + is_checked + ' data-status="' + data + '"  >';
                        html += '</label>';
                        html += '</div>';
                        return html;
                    },
                    // "sortable": false,
                    "searchable": false
                },
                <?php } ?>
                {
                    "data": "actions",
                    "render": function (data, type, row) {
                        var html = '';
                        var id = row['business_type_id'];
                        <?php if($this->dt_ci_acl->checkAccess("BusinessType|modify")){ ?>
                        html += "<a  href='<?= site_url('BusinessType/manage/'); ?>" + id + "' data-popup='custom-tooltip' onclick='EditRecord(" + id + ")' title='<?= lang('edit_business_type') ?>' data-original-title='<?= lang('edit_business_type') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded'><i class='icon-pencil'></i></a>";
                        html += "&nbsp";
                        <?php }
                        if($this->dt_ci_acl->checkAccess("BusinessType|delete")){?>
                        html += "<a href='javascript:void(0);' data-popup='custom-tooltip' onclick='DeleteRecord(" + id + ")' data-original-title='<?= lang('delete_business_type') ?>' title='<?= lang('delete_business_type') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
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
                        <?php if($this->dt_ci_acl->checkAccess("BusinessType|modify") || $this->dt_ci_acl->checkAccess("BusinessType|delete")) { ?>
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['business_type_id'] + '" name="ids[]" ' +
                            'value="' + row['business_type_id'] + '"/><span class="lbl"></span></label>';
                        <?php } else { ?>
                        return '';
                        <?php } ?>
                    },
                    "sortable": false,
                    "searchable": false
                }
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
<script>
    $(document).on('click', '.is_active', function () {
        var businessTypeId   = $(this).attr('id');
        var isActive   = $(this).data("status");
        $.ajax({
            type: "post",
            url: "<?= site_url("BusinessType/changeStatus")?>",
            dataType: "json",
            data: {business_type_id: businessTypeId, status: isActive},
            success: function (data) {
                if (data) {
                    swal({
                        title: "<?= ucwords(lang('success')); ?>",
                        text: data['msg'],
                        confirmButtonColor: "<?= BTN_SUCCESS; ?>",
                        type: "<?= lang('success'); ?>"
                    },function(){
                        dt_DataTable.ajax.reload(null,false);
                    });
                } else {
                    swal({
                        title: "<?= ucwords(lang('error')); ?>",
                        text: data['msg'],
                        type: "<?= lang('error'); ?>",
                        confirmButtonColor: "<?= BTN_ERROR; ?>"
                    });
                }
            }
        });
    });

    //Delete function
    function DeleteRecord(businessTypeId) {
        $('#business_type_details tbody input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + businessTypeId).prop('checked', true);
        $('.deleteRecord').click();
        CheckboxKeyGen();
    }

    // Delete Record
    $(document).on('click', '.deleteRecord', function ()
    {
        $('form#business_type_details #is_active').siblings().remove();
        var deleteElement = $('#businessTypeTable tbody input[class="dt-checkbox styled"]:checked');
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
                    url: "<?= base_url("BusinessType/delete")?>",
                    dataType: "json",
                    data: {delete_id: deleteId},
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

    //Edit function
    function EditRecord(businessTypeId) {
        $('#supplierTable  input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + businessTypeId).prop('checked', true);
        $('.editRecord').click();
        CheckboxKeyGen();
    }
</script>