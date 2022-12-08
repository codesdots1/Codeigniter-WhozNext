<?php $CI =& get_instance(); ?>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('category_list') ?></h5>
        <div class="heading-elements">

            <?php  if($this->dt_ci_acl->checkAccess('Category|manage')) {?>
            <a  href="<?= site_url('Category/manage'); ?>" data-popup='custom-tooltip' data-original-title="<?= lang('add_category') ?>"title="<?= lang('add_category') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded"><i class="icon-plus3"></i></a>
            <?php } ?>

            <a type="button" data-popup='custom-tooltip' data-original-title="<?= lang('delete_category') ?>" title="<?= lang('delete_category') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord"><i class="icon-trash"></i></a>

        </div>
    </div>

    <div class="table-responsive">

        <table id="categoryTable" class="table " cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
                <th><?= lang('samaj_name') ?></th>
                <th><?= lang('category_name') ?></th>
                <th><?= lang('is_active') ?></th>
                <th><?= lang('action') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>


<script>
    $(document).ready(function () {
        dt_DataTable = $('#categoryTable').DataTable({
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
                "url": "<?= site_url('Category/getCategoryListing'); ?>",
                "type": "post",
                "data": function (d) {
                    return $.extend({}, d, {
                        "<?= $this->security->get_csrf_token_name(); ?>": '<?= $this->security->get_csrf_hash(); ?>'
                    });
                }
            },
            "iDisplayLength": "<?= PERPAGE_DISPLAY; ?>",
            "order": [[1, "ASC"]],
            "stripeClasses": [ 'alpha-slate', 'even-row' ],
            "columns": [
                {"data": "category_id"},
                {"data": "samaj_name"},
                {"data": "category_name"},
                {"data": "is_active",
                    "render": function (data, type, row) {
                        var is_checked = '';
                        var id = row['category_id'];
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
                    "sortable": false,
                    "searchable": false
                },
                {
                    "data": "actions",
                    "render": function (data, type, row) {
                        var html = '';
                        var id = row['category_id'];

                        <?php  if($this->dt_ci_acl->checkAccess('Category|manage')) {?>
                        html += "<a  href='<?= site_url('Category/manage/'); ?>" + id + "' data-popup='custom-tooltip' data-original-title='<?= lang('edit_category') ?>'  onclick='EditRecord(" + id + ")' title='<?= lang('edit_category') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded'><i class='icon-pencil'></i></a>";
                        <?php } ?>

                        html += "&nbsp";
                        html += "<a href='javascript:void(0);' onclick='DeleteRecord(" + id + ")' data-popup='custom-tooltip' data-original-title='<?= lang('delete_category') ?>' title='<?= lang('delete_category') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
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
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['category_id'] + '" name="ids[]" value="' + row['category_id'] + '"/></label>';
                    },
                    "sortable": false,
                    "searchable": false
                },
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
        $('#categoryTable input[class="dt-checkbox styled"]').prop('checked', false);
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
            $('#categoryTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
            CheckboxKeyGen();
        });

    });

    /// Status change function
    $(document).on('click', '.isActive', function () {
        var categoryId = $(this).attr('id');
        var isActive   = $(this).data("status");
        $.ajax({
            type: "post",
            url: "<?= site_url("Category/changeStatus")?>",
            dataType: "json",
            data: {category_id: categoryId, status: isActive},
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
    function DeleteRecord(categoryId) {
        $('#categoryTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + categoryId).prop('checked', true);
        $('.deleteRecord').click();
        CheckboxKeyGen();
    }


    //Delete Record
    $(document).on('click', '.deleteRecord', function () {
        var deleteElement = $('#categoryTable tbody input[class="dt-checkbox styled"]:checked');
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
                        url: "<?= site_url("Category/delete")?>",
                        dataType: "json",
                        data: {delete_id: deleteId},
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
    function EditRecord(categoryId) {
        $('#categoryTable  input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + categoryId).prop('checked', true);
        //$('.editRecord').click();
        CheckboxKeyGen();

    }


</script>