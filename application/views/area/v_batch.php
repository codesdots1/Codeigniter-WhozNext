<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('batch_heading') ?></h5>
        <div class="heading-elements">
            <a  href="<?= site_url('Batch/manage'); ?>" data-popup='custom-tooltip'  data-original-title="<?= lang('add_batch') ?>" title="<?= lang('add_batch') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded"><i class="icon-plus3"></i></a>
            <a type="button" data-popup='custom-tooltip'   data-original-title="<?= lang('delete_batch') ?>" title="<?= lang('delete_batch') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord"><i class="icon-trash"></i></a>
        </div>
    </div>

    <div class="table-responsive">

        <table id="batchTable" class="table " cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
                <th><?= lang('batch_id') ?></th>
                <th><?= lang('item_name') ?></th>
                <th><?= lang('batch_expiry_date') ?></th>
                <th><?= lang('batch_description') ?></th>
                <th><?= lang('batch_input_date') ?></th>
                <th><?= lang('created_at') ?></th>
                <th><?= lang('is_active') ?></th>
                <th><?= lang('action') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>


<script>
    $(document).ready(function () {
        dt_DataTable = $('#batchTable').DataTable({
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
                "url": "<?= site_url('Batch/getBatchListing'); ?>",
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
                {
                    "data": "batch_id",
                    "width": "10%",
                    "render": function (data, type, row) {
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['batch_id'] + '" name="ids[]" value="' + row['batch_id'] + '"/></label>';
                    },
                    "sortable": false,
                    "searchable": false
                },
                {"data": "batch_code"},
                {"data": "item_name",
                    "render": function (data, type, row) {
                        if (row['item_name'] != "" && row['item_name'] != null) {
                            return row['item_name'];
                        } else {
                            return "N/A";
                        }
                    }
                },
                {"data": "batch_expiry_date"},
                {"data": "batch_description"},
                {"data": "batch_input_date"},
                {"data": "created_at"},
                {
                    "data": "is_active",
                    "render": function (data, type, row) {
                        var is_checked = '';
                        var id = row['batch_id'];
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
                    }
                },
                {
                    "data": "actions",
                    "render": function (data, type, row) {
                        var html = '';
                        var id = row['batch_id'];
                        html += "<a  href='<?= site_url('Batch/manage/'); ?>" + id + "'  data-original-title='<?= lang('edit_batch') ?>' data-popup='custom-tooltip' onclick='EditRecord(" + id + ")' title='<?= lang('edit_batch') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded'><i class='icon-pencil'></i></a>";
                        html += "&nbsp";
                        html += "<a href='javascript:void(0);' onclick='DeleteRecord(" + id + ")' data-popup='custom-tooltip'  data-original-title='<?= lang('delete_batch') ?>' title='<?= lang('delete_batch') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
                        return html;
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

    $(document).on('click', '.isActive', function () {
        var batchId = $(this).attr('id');
        var isActive   = $(this).data("status");
        $.ajax({
            type: "post",
            url: "<?= site_url("Batch/changeStatus")?>",
            dataType: "json",
            data: {batchId: batchId, status: isActive},
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
                    },function(){
                        CheckboxKeyGen('checkAll');
                    });
                }
            }
        });
    });

    //Delete Time Cancel button click to remove checked value
    $(document).on('click', '.cancel', function () {
        $('#areaTable input[class="dt-checkbox styled"]').prop('checked', false);
        CheckboxKeyGen();
    });

    $(document).ready(function () {
        // Switchery
        // Initialize multiple switches
        SwitcheryKeyGen();
        CheckboxKeyGen('checkAll');
        CustomToolTip();

        $('#checkAll').click(function () {
            var checkedStatus = this.checked;
            $('#batchTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
            CheckboxKeyGen();
        });

    });

    //Delete function
    function DeleteRecord(batchId) {
        $('#batchTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + batchId).prop('checked', true);
        $('.deleteRecord').click();
        CheckboxKeyGen();
    }

    //Delete Record
    $(document).on('click', '.deleteRecord', function () {
        var deleteElement = $('#batchTable tbody input[class="dt-checkbox styled"]:checked');
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
                        url: "<?= base_url("Batch/delete")?>",
                        dataType: "json",
                        data: {deleteId: deleteId},
                        success: function (data) {
                            if (data['success']) {
                                swal({
                                    title: "<?= ucwords(lang('success'))?>",
                                    text: data['msg'],
                                    type: "<?= lang('success')?>",
                                    confirmButtonColor: "<?= BTN_SUCCESS; ?>",
                                },function () {
                                    dt_DataTable.ajax.reload();
                                    $('#checkAll').prop('checked', false);
                                    CheckboxKeyGen();
                                });
                            } else {
                                swal({
                                    title: "<?= ucwords(lang('error')); ?>",
                                    text: data['msg'],
                                    type: "<?= lang('error'); ?>",
                                    confirmButtonColor: "<?= BTN_ERROR; ?>"
                                },function (){
                                    dt_DataTable.ajax.reload();
                                });
                            }
                        }
                    });
                });
        }
    });

    //Edit function
    function EditRecord(batchId) {
        $('#areaTable  input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + batchId).prop('checked', true);
        $('.editRecord').click();
        CheckboxKeyGen();
    }

    ////    Edit Record
    //    $(document).on('click', '.editRecord', function () {
    //        var editElement = $('#quotationTable  input[class=dt-checkbox]:checked');
    //        var selectedLength = editElement.size();
    //
    //        if (selectedLength == 0) {
    //            swal({
    //                title: "Info",
    //                text: "Please select single record to edit.",
    //                confirmButtonColor: "#2196F3",
    //                type: "info"
    //            },function(){
    //                return false;
    //            });
    //        } else if (selectedLength > 1) {
    //            swal({
    //                title: "Multiple record selected.",
    //                confirmButtonColor: "#2196F3"
    //            });
    //            return false;
    //        } else {
    //            href = "<?php //echo site_url('SalesInvoice/manage'); ?>//";
    //            href += editElement.val();
    //            $('.editRecord').attr('href', href);
    //        }
    //    });
</script>