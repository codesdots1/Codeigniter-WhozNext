<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('poll_index_list') ?></h5>
        <div class="heading-elements">

            <a  href="<?= site_url('Poll/manage'); ?>" data-popup='custom-tooltip' data-original-title="<?= lang('add_poll') ?>"title="<?= lang('add_poll') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded"><i class="icon-plus3"></i></a>
            <a type="button" data-popup='custom-tooltip' data-original-title="<?= lang('delete_poll') ?>" title="<?= lang('delete_poll') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord"><i class="icon-trash"></i></a>

        </div>
    </div>

    <div class="table-responsive">

        <table id="pollTable" class="table " cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
                <th><?= lang('question') ?></th>
                <th><?= lang('field_type') ?></th>
                <th><?= lang('poll_value') ?></th>
                <th><?= lang('sort_order') ?></th>
                <th><?= lang('samaj') ?></th>
                <th><?= lang('is_active') ?></th>
                <th><?= lang('is_required') ?></th>
                <th><?= lang('is_multiple') ?></th>
                <th><?= lang('action') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>


<script>
    $(document).ready(function () {
        dt_DataTable = $('#pollTable').DataTable({
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
                "url": "<?= site_url('Poll/getPollListing'); ?>",
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
                {"data": "poll_id"},
                {"data": "question"},
                {"data": "field_type"},
                {"data": "poll_value"},
                {"data": "sort_order"},
                {"data": "samaj_name"},
                {"data": "is_active",
                    "render": function (data, type, row) {
                        var is_checked = '';
                        var id = row['poll_id'];
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
                 //   "sortable": false,
                    "searchable": false
                },
                {"data": "is_required",
                    "render": function (data, type, row) {
                        var is_required = '';
                        var id = row['poll_id'];
                        if (data == 1) {
                            is_required = 'checked="checked"';
                        }
                        var html = '';
                        html += '<div class="checkbox checkbox-switchery switchery-xs">';
                        html += '<label>';
                        html += '<input id="' + id + '" type="checkbox" class="dt_switchery isRequired" ' + is_required + ' data-status="' + data + '"  >';
                        html += '</label>';
                        html += '</div>';
                        return html;
                    },
                    //    "sortable": false,
                    "searchable": false

                },
                {"data": "is_multiple",
                    "render": function (data, type, row) {
                        var is_checked = '';
                        var id = row['poll_id'];
                        if (data == 1) {
                            is_checked = 'checked="checked"';
                        }
                        var html = '';
                        html += '<div class="checkbox checkbox-switchery switchery-xs">';
                        html += '<label>';
                        html += '<input id="' + id + '" type="checkbox" class="dt_switchery isMultiple" ' + is_checked + ' data-status="' + data + '"  >';
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
                        var id = row['poll_id'];
                        html += "<a  href='<?= site_url('Poll/manage/'); ?>" + id + "' data-popup='custom-tooltip' data-original-title='<?= lang('edit_poll') ?>'  onclick='EditRecord(" + id + ")' title='<?= lang('edit_poll') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded'><i class='icon-pencil'></i></a>";
                        html += "&nbsp";
                        html += "<a href='javascript:void(0);' onclick='DeleteRecord(" + id + ")' data-popup='custom-tooltip' data-original-title='<?= lang('delete_poll') ?>' title='<?= lang('delete_poll') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
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
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['poll_id'] + '" name="ids[]" value="' + row['poll_id'] + '"/></label>';
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
        $('#pollTable input[class="dt-checkbox styled"]').prop('checked', false);
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
            $('#pollTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
            CheckboxKeyGen();
        });

    });

    /// Status change function
    $(document).on('click', '.isActive', function () {
        var pollId = $(this).attr('id');
        var isActive   = $(this).data("status");
        $.ajax({
            type: "post",
            url: "<?= site_url("Poll/changeStatus")?>",
            dataType: "json",
            data: {pollId: pollId, status: isActive},
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
    function DeleteRecord(pollId) {
        $('#pollTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + pollId).prop('checked', true);
        $('.deleteRecord').click();
        CheckboxKeyGen();
    }


    //Delete Record
    $(document).on('click', '.deleteRecord', function () {
        var deleteElement = $('#pollTable tbody input[class="dt-checkbox styled"]:checked');
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
                        url: "<?= site_url("Poll/delete")?>",
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
    function EditRecord(pollId) {
        $('#pollTable  input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + pollId).prop('checked', true);
        //$('.editRecord').click();
        CheckboxKeyGen();

    }

    //Edit Record
//    $(document).on('click', '.editRecord', function () {
//        var editElement = $('#pollTable  input[class=dt-checkbox]:checked');
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
//            href = "//= site_url('Currency/manage'); ?>//";
//            href += editElement.val();
//            $('.editRecord').attr('href', href);
//        }
//    });



    ///required Status change function
    $(document).on('click', '.isRequired', function () {
        var pollId = $(this).attr('id');
        var isRequired   = $(this).data("status");
        $.ajax({
            type: "post",
            url: "<?= site_url("Poll/changeRequiredStatus")?>",
            dataType: "json",
            data: {pollId: pollId, status: isRequired},
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


    ///multiple Status change function
    $(document).on('click', '.isMultiple', function () {
        var pollId = $(this).attr('id');
        var isMultiple   = $(this).data("status");
        $.ajax({
            type: "post",
            url: "<?= site_url("Poll/changeMultipleStatus")?>",
            dataType: "json",
            data: {pollId: pollId, status: isMultiple},
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
</script>
