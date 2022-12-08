<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('language_heading') ?></h5>
        <div class="heading-elements">
            <?php if($this->dt_ci_acl->checkAccess("Language|save")){ ?>
                <button type="button" data-popup="custom-tooltip" data-original-title="<?= lang('add_language') ?>" title="<?= lang('add_language') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded addLanguage"><i class="icon-plus3"></i></button>
            <?php }?>
            <?php if($this->dt_ci_acl->checkAccess("Language|delete")){ ?>
                <button type="button" data-popup="custom-tooltip" data-original-title="<?= lang('delete_language') ?>" title="<?= lang('delete_language') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord"><i class="icon-trash"></i></button>
            <?php }?>
        </div>
    </div>

    <div class="table-responsive">

        <table id="languageTable" class="table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
                <th><?= lang('language_name') ?></th>
                <th><?= lang('language_code') ?></th>
                <?php if($this->dt_ci_acl->checkAccess("Language|changeActive")){ ?>
                    <th><?= lang('is_active') ?></th>
                <?php }?>
                <?php if($this->dt_ci_acl->checkAccess("Language|changeDefault")){ ?>
                    <th><?= lang('is_default') ?></th>
                <?php }?>
                <th><?= lang('action') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>

<?php echo $v_languageModal; ?>

<!--Display the language list-->
<script>
    $(document).ready(function () {

        dt_DataTable = $('#languageTable').DataTable({
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
                "url": "<?= site_url('Language/getLanguageListing'); ?>",
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
                {"data": "language_id"},
                {"data": "language_name"},
                {"data": "language_code"},
                <?php if($this->dt_ci_acl->checkAccess("Language|changeActive")){ ?>
                {"data": "is_active",
                    "render": function (data, type, row) {
                        var is_checked = '';
                        var id = row['language_id'];
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
                <?php }?>
                <?php if($this->dt_ci_acl->checkAccess("Language|changeDefault")){ ?>
                {"data": "is_default",
                    "render": function (data, type, row) {
                        var is_checked = '';
                        var id = row['language_id'];
                        if (data == 1) {
                            is_checked = 'checked="checked"';
                        }
                        var html = '';
                        html += '<div class="checkbox checkbox-switchery switchery-xs">';
                        html += '<label>';
                        html += '<input id="' + id + '" type="checkbox" class="dt_switchery isDefault" ' + is_checked + ' data-status="' + data + '"  >';
                        html += '</label>';
                        html += '</div>';
                        return html;
                    },

                    // "sortable": false,
                    "searchable": false

                },
                <?php }?>

                {
                    "data": "actions",
                    "render": function (data, type, row) {
                        var html = '';
                        var id = row['language_id'];
                        <?php if($this->dt_ci_acl->checkAccess("Language|save")){ ?>
                        html += "<button value='"+id+"' data-popup='custom-tooltip' data-original-title='<?= lang('edit_language') ?>' title='<?= lang('edit_language') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded editRecord'  ><i class='icon-pencil'></i></button>";
                        html += "&nbsp";
                        <?php }
                        if($this->dt_ci_acl->checkAccess("Language|delete")){ ?>
                        html += "<a href='javascript:void(0);' data-popup='custom-tooltip' onclick='DeleteRecord(" + id + ")' data-original-title='<?= lang('delete_language') ?>' title='<?= lang('delete_language') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
                        <?php }?>
                        return html;
                    },
                    "sortable": false,
                    "searchable": false
                },

            ],
            "columnDefs": [
                {
                    "targets": 0,
                    "width": "10%",
                    "render": function (data, type, row) {
                        <?php if($this->dt_ci_acl->checkAccess("Language|save") || $this->dt_ci_acl->checkAccess("Language|delete") ) { ?>
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['language_id'] + '" name="ids[]" ' +
                            'value="' + row['language_id'] + '"/><span class="lbl"></span></label>';
                        <?php }
                        else{?>
                        return '';
                        <?php   }
                        ?>
                    },
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



<script>
    /// Status change function
    $(document).on('click', '.is_active', function () {
        var languageId   = $(this).attr('id');
        var isActive   = $(this).data("status");
        $.ajax({
            type: "post",
            url: "<?= site_url("Language/changeActive")?>",
            dataType: "json",
            data: {language_Id: languageId, status: isActive},
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

    $(document).on('click', '.isDefault', function () {
        var languageId   = $(this).attr('id');
        var isDefault   = $(this).data("status");
        $.ajax({
            type: "post",
            url: "<?= site_url("Language/changeDefault")?>",
            dataType: "json",
            data: {language_Id: languageId, status: isDefault},
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
    function DeleteRecord(languageId) {
        $('#languageDetails tbody input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + languageId).prop('checked', true);
        $('.deleteRecord').click();
        CheckboxKeyGen();
    }


    //Delete Record
    $(document).on('click', '.deleteRecord', function () {
        $('form#languageDetails #is_active').siblings().remove();
        var deleteElement = $('#languageTable tbody input[class="dt-checkbox styled"]:checked');
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
                        url: "<?= base_url("Language/delete")?>",
                        dataType: "json",
                        data: {delete_id: deleteId},
                        success: function (data) {
                            if (data['success']) {
                                swal({
                                    title: "<?= ucwords(lang('success'))?>",
                                    text: data['msg'],
                                    type: "<?= lang('success')?>",
                                    confirmButtonColor: "<?= BTN_SUCCESS; ?>",
                                },function(){
                                    dt_DataTable.ajax.reload();
//                                     $('#checkAll').prop('checked', false);
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