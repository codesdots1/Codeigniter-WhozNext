<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('area_heading') ?></h5>
        <div class="heading-elements">
            <a  href="<?= site_url('Area/manage'); ?>" data-popup='custom-tooltip'  data-original-title="<?= lang('add_area') ?>" title="<?= lang('add_area') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded"><i class="icon-plus3"></i></a>
            <a type="button" data-popup='custom-tooltip'   data-original-title="<?= lang('delete_area') ?>" title="<?= lang('delete_area') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord"><i class="icon-trash"></i></a>
        </div>
    </div>

    <div class="table-responsive">

        <table id="areaTable" class="table " cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
                <th><?= lang('area_name') ?></th>
                <th><?= lang('area_code') ?></th>
                <th><?= lang('area_description') ?></th>
                <th><?= lang('area_length') ?></th>
                <th><?= lang('area_breadth') ?></th>
                <th><?= lang('area_height') ?></th>
                <th><?= lang('warehouse_name') ?></th>
                <th><?= lang('action') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>


<script>
    $(document).ready(function () {
        dt_DataTable = $('#areaTable').DataTable({
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
                "url": "<?= site_url('Area/getAreaListing'); ?>",
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
                    "data": "area_id",
                    "width": "10%",
                    "render": function (data, type, row) {
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['area_id'] + '" name="ids[]" value="' + row['area_id'] + '"/></label>';
                    },
                    "sortable": false,
                    "searchable": false
                },
                {"data": "area_name"},
                {"data": "area_code"},
                {"data": "area_description"},
                {"data": "area_length"},
                {"data": "area_breadth"},
                {"data": "area_height"},
                {"data": "warehouse_name",
                    "render": function (data, type, row) {
                        if (row['warehouse_name'] != "" && row['warehouse_name'] != null) {
                            return row['warehouse_name'];
                        } else {
                            return "N/A";
                        }
                    }
                },
                {
                    "data": "actions",
                    "render": function (data, type, row) {
                        var html = '';
                        var id = row['area_id'];
                        html += "<a  href='<?= site_url('Area/manage/'); ?>" + id + "'  data-original-title='<?= lang('edit_area') ?>' data-popup='custom-tooltip' onclick='EditRecord(" + id + ")' title='<?= lang('edit_area') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded'><i class='icon-pencil'></i></a>";
                        html += "&nbsp";
                        html += "<a href='javascript:void(0);' onclick='DeleteRecord(" + id + ")' data-popup='custom-tooltip'  data-original-title='<?= lang('delete_area') ?>' title='<?= lang('delete_area') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
                        return html;
                    },
                    "sortable": false,
                    "searchable": false
                },

            ],
            fnDrawCallback: function (oSettings) {
                // Switchery
                // Initialize multiple switches
                CheckboxKeyGen('checkAll');
                CustomToolTip();
                ScrollToTop();
            }
        });
    });

</script>

<script>

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
            $('#areaTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
            CheckboxKeyGen();
        });

    });

    //Delete function
    function DeleteRecord(areaId) {
        $('#areaTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + areaId).prop('checked', true);
        $('.deleteRecord').click();
        CheckboxKeyGen();
    }

    //Delete Record
    $(document).on('click', '.deleteRecord', function () {
        var deleteElement = $('#areaTable tbody input[class="dt-checkbox styled"]:checked');
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
                        url: "<?= base_url("Area/delete")?>",
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
    function EditRecord(areaId) {
        $('#areaTable  input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + areaId).prop('checked', true);
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