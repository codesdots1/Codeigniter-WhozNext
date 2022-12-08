<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('banner_heading_list') ?></h5>
        <div class="heading-elements">
            <?php if($this->dt_ci_acl->checkAccess('Banner|manage')) {?>
                <a  href="<?= site_url('Banner/manage'); ?>" data-popup='custom-tooltip' data-original-title="<?= lang('add_banner') ?>"
                    title="<?= lang('add_banner') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded">
                    <i class="icon-plus3"></i></a>
            <?php } ?>
            <?php if($this->dt_ci_acl->checkAccess('Banner|delete')) {?>
            <a type="button" data-popup='custom-tooltip' data-original-title="<?= lang('delete_banner') ?>"
               title="<?= lang('delete_banner') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord">
                <i class="icon-trash"></i></a>
            <?php } ?>
        </div>
    </div>

    <div class="table-responsive">

        <table id="bannerTable" class="table " cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
                <th><?= lang('banner_name') ?></th>
                <th><?= lang('samaj_name') ?></th>
                <th><?= lang('start_date') ?></th>
                <th><?= lang('end_date') ?></th>
                <th><?= lang('is_active') ?></th>
                <th><?= lang('action') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>


<script>
    $(document).ready(function () {
        dt_DataTable = $('#bannerTable').DataTable({
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
                "url": "<?= site_url('Banner/getBannerListing'); ?>",
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
                {"data": "banner_id"},
                {"data": "banner_name"},
                {"data": "samaj_name"},
                {"data": "start_date"},
                {"data": "end_date"},
                {"data": "is_active",
                    "render": function (data, type, row) {
                        var is_checked = '';
                        var id = row['banner_id'];
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
                {"data": "actions",
                    "render": function (data, type, row) {
                        var html = '';
                        var id = row['banner_id'];

                        <?php if($this->dt_ci_acl->checkAccess('Banner|manage')) {?>
                            html += "<a  href='<?= site_url('Banner/manage/'); ?>" + id + "' data-popup='custom-tooltip' data-original-title='<?= lang('edit_banner') ?>'  onclick='EditRecord(" + id + ")' title='<?= lang('edit_banner') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded'><i class='icon-pencil'></i></a>";
                        <?php } ?>

                        html += "&nbsp";

                        <?php if($this->dt_ci_acl->checkAccess('Banner|delete')) {?>
                        html += "<a href='javascript:void(0);' onclick='DeleteRecord(" + id + ")' data-popup='custom-tooltip' data-original-title='<?= lang('delete_banner') ?>' title='<?= lang('delete_banner') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
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
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['banner_id'] + '" name="ids[]" ' +
                            'value="' + row['banner_id'] + '"/><span class="lbl"></span></label>';
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

    $(document).on('click', '.is_active', function () {
        var bannerId   = $(this).attr('id');
        var isActive   = $(this).data("status");
        $.ajax({
            type: "post",
            url: "<?= site_url("Banner/changeStatus")?>",
            dataType: "json",
            data: {banner_id: bannerId, status: isActive},
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

    //Delete Time Cancel button click to remove checked value
    $(document).on('click', '.cancel', function () {
        $('#bannerTable input[class="dt-checkbox styled"]').prop('checked', false);
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
            $('#bannerTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
            CheckboxKeyGen();
        });

    });

    //Delete function
    function DeleteRecord(bannerId) {
        $('#bannerTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + bannerId).prop('checked', true);
        $('.deleteRecord').click();
        CheckboxKeyGen();
    }


    //Delete Record
    $(document).on('click', '.deleteRecord', function () {
        var deleteElement = $('#bannerTable tbody input[class="dt-checkbox styled"]:checked');
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
                    url: "<?= site_url("Banner/delete")?>",
                    dataType: "json",
                    data: {delete_id: deleteId},
                    success: function (data) {
                        if (data['success']) {
                            swal({
                                title: "<?= ucwords(lang('success'))?>",
                                text: data['msg'],
                                type: "<?= lang('success')?>",
                                confirmButtonColor: "<?= BTN_SUCCESS; ?>"
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
    function EditRecord(bannerId) {
        $('#bannerTable  input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + bannerId).prop('checked', true);
        //$('.editRecord').click();
        CheckboxKeyGen();
    }
</script>