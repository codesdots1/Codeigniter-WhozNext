<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('bin_heading') ?></h5>
        <div class="heading-elements">
<!--           <a href="--><?//= site_url('Bin/exportCsdCsv'); ?><!--" data-popup='custom-tooltip' onclick="DataToExport()">Export</a>-->
            <a href="javascript:void(0)" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded" data-popup='custom-tooltip' onclick="dataExport()"><i class="icon-file-excel"></i></a>
            <a  href="<?= site_url('Bin/manage'); ?>" data-popup='custom-tooltip'  data-original-title="<?= lang('add_bin') ?>" title="<?= lang('add_bin') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded"><i class="icon-plus3"></i></a>
            <a type="button" data-popup='custom-tooltip'   data-original-title="<?= lang('delete_bin') ?>" title="<?= lang('delete_bin') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord"><i class="icon-trash"></i></a>
        </div>
    </div>

    <div class="table-responsive">
        <input type="hidden" id="allowFilter" value="<?= (SEARCH_FILTER_EXPORT == 1) ? 1 : 0 ?>">

        <table id="binTable" class="table " cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
                <th><?= lang('bin_code') ?></th>
                <th><?= lang('bin_type_name') ?></th>
                <th><?= lang('bin_description') ?></th>
                <th><?= lang('bin_length') ?></th>
                <th><?= lang('bin_breadth') ?></th>
                <th><?= lang('bin_height') ?></th>
                <th><?= lang('bin_volume') ?></th>
                <th><?= lang('unit_name') ?></th>
                <th><?= lang('rack_code') ?></th>
                <th><?= lang('is_active') ?></th>
                <th><?= lang('action') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>


<script>
    var dt_DataTable;
    $(document).ready(function () {
        dt_DataTable = $('#binTable').DataTable({
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
                "url": "<?= site_url('Bin/getBinListing'); ?>",
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
                    "data": "bin_id",
                    "width": "10%",
                    "render": function (data, type, row) {
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['bin_id'] + '" name="ids[]" value="' + row['bin_id'] + '"/></label>';
                    },
                    "sortable": false,
                    "searchable": false
                },
                {"data": "bin_code"},
                {
                    "data": "bin_type_name",
                    "render": function (data, type, row) {
                        if (row['bin_type_name'] != "" && row['bin_type_name'] != null) {
                            return row['bin_type_name'];
                        } else {
                            return "N/A";
                        }
                    }
                },
                {"data": "bin_description"},
                {"data": "bin_length"},
                {"data": "bin_breadth"},
                {"data": "bin_height"},
                {"data": "bin_volume"},
                {
                    "data": "unit_name",
                    "render": function (data, type, row) {
                        if (row['unit_name'] != "" && row['unit_name'] != null) {
                            return row['unit_name'];
                        } else {
                            return "N/A";
                        }
                    }
                },
                {
                    "data": "rack_code",
                    "render": function (data, type, row) {
                        if (row['rack_code'] != "" && row['rack_code'] != null) {
                            return row['rack_code'];
                        } else {
                            return "N/A";
                        }
                    }
                },
                {
                    "data": "is_active",
                    "render": function (data, type, row) {
                        var is_checked = '';
                        var id = row['bin_id'];
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
                        var id = row['bin_id'];
                        html += "<a  href='<?= site_url('Bin/manage/'); ?>" + id + "'  data-original-title='<?= lang('edit_bin') ?>' data-popup='custom-tooltip' onclick='EditRecord(" + id + ")' title='<?= lang('edit_bin') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded'><i class='icon-pencil'></i></a>";
                        html += "&nbsp";
                        html += "<a href='javascript:void(0);' onclick='DeleteRecord(" + id + ")' data-popup='custom-tooltip'  data-original-title='<?= lang('delete_area') ?>' title='<?= lang('delete_bin') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
                        return html;
                    },
                    "sortable": false,
                    "searchable": false
                }

            ],
            "fnServerParams" : function ( aoData ) { //send other data to server side
                server_params = aoData;
            },
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

    function dataExport() {
        var table = $("#binTable").dataTable();

        var allowFilter = $('#allowFilter').val();

        if(allowFilter == 1)
        {
            var data = table.fnServerParams;
            var postData = server_params;
            console.log(postData);

            $.ajax({
            type: "post",
            url: "<?= site_url("Bin/exportBin")?>",
            dataType: "html",
            data : { data : postData },
            success:function(download_url_from_server){
                document.location = download_url_from_server;
            }});
        }
    else
        {
            table.fnFilter('');
            var data = table.fnServerParams;
            var postData = server_params;
            console.log(postData);

            $.ajax({
                type: "post",
                url: "<?= site_url("Bin/exportBin")?>",
                dataType: "html",
                data : { data : postData },
                success:function(download_url_from_server){
                    document.location = download_url_from_server;
                }});

        }
    }

</script>

<script>

    $(document).on('click', '.isActive', function () {
        var binId = $(this).attr('id');
        var isActive   = $(this).data("status");
        $.ajax({
            type: "post",
            url: "<?= site_url("Bin/changeStatus")?>",
            dataType: "json",
            data: {binId: binId, status: isActive},
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
                }
                else {
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
        $('#binTable input[class="dt-checkbox styled"]').prop('checked', false);
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
            $('#binTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
            CheckboxKeyGen();
        });

    });

    //Delete function
    function DeleteRecord(binId) {
        $('#binTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + binId).prop('checked', true);
        $('.deleteRecord').click();
        CheckboxKeyGen();
    }

    //Delete Record
    $(document).on('click', '.deleteRecord', function () {
        var deleteElement = $('#binTable tbody input[class="dt-checkbox styled"]:checked');
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
        }
        else {
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
                        url: "<?= base_url("Bin/delete")?>",
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
                            }
                            else {
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
    function EditRecord(binId) {
        $('#binTable  input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + binId).prop('checked', true);
        $('.editRecord').click();
        CheckboxKeyGen();
    }

</script>