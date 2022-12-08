<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('rack_heading') ?></h5>
        <div class="heading-elements">

            <a  href="<?= site_url('Rack/manage'); ?>" data-popup='custom-tooltip'  data-original-title="<?= lang('add_rack') ?>" title="<?= lang('add_rack') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded"><i class="icon-plus3"></i></a>
            <a type="button" data-popup='custom-tooltip'   data-original-title="<?= lang('delete_rack') ?>" title="<?= lang('delete_rack') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord"><i class="icon-trash"></i></a>
        </div>
    </div>

    <div class="table-responsive">

        <table id="rackTable" class="table " cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
                <th><?= lang('rack_code') ?></th>
                <th><?= lang('description') ?></th>
                <th><?= lang('length') ?></th>
                <th><?= lang('breadth') ?></th>
                <th><?= lang('height') ?></th>
                <th><?= lang('area') ?></th>
                <th><?= lang('is_active') ?></th>
                <th><?= lang('action') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>


<script>
    $(document).ready(function () {
        dt_DataTable = $('#rackTable').DataTable({
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
                "url": "<?= site_url('Rack/getRackListing'); ?>",
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
                {"data": "rack_id"},
                {"data": "rack_code"},
                {"data": "description"},
                {"data": "length"},
                {"data": "breadth"},
                {"data": "height"},
                {"data": "area_name"},
                {
                    "data": "is_active",
                    "render": function (data, type, row) {
                        var is_checked = '';
                        var id = row['rack_id'];
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
                        var id = row['rack_id'];
                        html += "<a  href='<?= site_url('Rack/manage/'); ?>" + id + "'  data-original-title='<?= lang('edit_rack') ?>' data-popup='custom-tooltip' onclick='EditRecord(" + id + ")' title='<?= lang('edit_rack') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded'><i class='icon-pencil'></i></a>";
                        html += "&nbsp";
                        html += "<a href='javascript:void(0);' onclick='DeleteRecord(" + id + ")' data-popup='custom-tooltip'  data-original-title='<?= lang('delete_rack') ?>' title='<?= lang('delete_rack') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
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
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['rack_id'] + '" name="ids[]" value="' + row['rack_id'] + '"/></label>';
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
                CheckboxKeyGen();
                CustomToolTip();
                ScrollToTop();
            }
        });
    });

</script>

<script>

    $(document).on('click', '.isActive', function () {
        var rackId = $(this).attr('id');
        var isActive   = $(this).data("status");
        $.ajax({
            type: "post",
            url: "<?= site_url("Rack/changeStatus")?>",
            dataType: "json",
            data: {rackId: rackId, status: isActive},
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
        $('#rackTable input[class="dt-checkbox styled"]').prop('checked', false);
        CheckboxKeyGen();
    });

    $(document).ready(function () {
        // Switchery
        // Initialize multiple switches
        SwitcheryKeyGen();
        CheckboxKeyGen('checkAll');
        CustomToolTip();

        //$('#checkAll').prop('checked', false);
        $('#checkAll').click(function () {
            var checkedStatus = this.checked;
            $('#rackTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
            CheckboxKeyGen();
        });

    });



    //Delete function
    function DeleteRecord(purchaseReceiptId) {
        $('#rackTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + purchaseReceiptId).prop('checked', true);
        $('.deleteRecord').click();
        CheckboxKeyGen();
    }


    //Delete Record
    $(document).on('click', '.deleteRecord', function () {
        var deleteElement = $('#rackTable tbody input[class="dt-checkbox styled"]:checked');
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
                        url: "<?= base_url("Rack/delete")?>",
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
    function EditRecord(purchaseReceiptId) {
        $('#rackTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + purchaseReceiptId).prop('checked', true);
       //$('.editRecord').click();
        CheckboxKeyGen();
    }

</script>