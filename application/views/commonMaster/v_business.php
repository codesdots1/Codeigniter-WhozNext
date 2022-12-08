
<?php
if(isset($filterModel) && $filterModel != '') {
    echo $filterModel;
}
?>

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('business_index_list') ?></h5>
        <div class="heading-elements">

            <button type="button" data-popup='custom-tooltip' data-original-title="<?= lang('export_business') ?>" title="<?= lang('export_member') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="icon-file-excel"></i> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
                <?php foreach($activeLanguage as $key) { ?>
                    <li><a href="javascript:void(0)" onclick="dataExport(<?php echo $key['language_id']; ?>)"><?php echo $key['language_name']; ?></a></li>
                <?php } ?>
            </ul>

            <a  href="<?= site_url('Business/manage'); ?>" data-popup='custom-tooltip' data-original-title="<?= lang('add_business') ?>"title="<?= lang('add_business') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded"><i class="icon-plus3"></i></a>
            <a type="button" data-popup='custom-tooltip' data-original-title="<?= lang('delete_business') ?>" title="<?= lang('delete_business') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord"><i class="icon-trash"></i></a>

        </div>
    </div>
    <div class="table-responsive">
        <table id="businessTable" class="table " cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
                <th><?= lang('samaj_name') ?></th>
                <th><?= lang('business_name') ?></th>
                <th><?= lang('member_name') ?></th>
                <th><?= lang('owner_name') ?></th>
                <th><?= lang('mobile') ?></th>
                <th><?= lang('email') ?></th>
                <th><?= lang('telephone') ?></th>
                <th><?= lang('business_state') ?></th>
                <th><?= lang('business_city') ?></th>
                <th><?= lang('business_pincode') ?></th>
                <th><?= lang('address') ?></th>
<!--                <th>--><?//= lang('address_geo') ?><!--</th>-->
<!--                <th>--><?//= lang('description') ?><!--</th>-->
                <th><?= lang('business_type_name') ?></th>
                <th><?= lang('action') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>



<script>
    $(document).ready(function () {

        samajDD('','#samaj_id');
        businessTypeDD('','#business_type_id');

        dt_DataTable = $('#businessTable').DataTable({
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
                "url": "<?= site_url('Business/getBusinessListing'); ?>",
                "type": "post",
                "data": function (d) {
                    return $.extend({}, d, {
                        "<?= $this->security->get_csrf_token_name() ?>": '<?= $this->security->get_csrf_hash() ?>'
                    });
                }
            },
            "fnServerParams": function (aoData) {
                var params = {};
                var filterData = $("#advanceFilter").serializeArray();
                $.each(filterData, function (i, val) {
                    var name = val.name;
                    if (typeof params[name] == 'undefined') {
                        params[name] = [];
                    }
                    params[name].push(val.value);
                });
                aoData.filterParams = params;
                server_params = aoData;
            },
            "iDisplayLength": "<?= PERPAGE_DISPLAY ?>",
            "order": [[1, "ASC"]],
            "stripeClasses": [ 'alpha-slate', 'even-row' ],
            "columns": [
                {"data": "business_id"},
                {"data": "samaj_name"},
                {"data": "business_name"},
                {"data": "member_name"},
                {"data": "owner_name"},
                {"data": "mobile"},
                {"data": "email"},
                {"data": "telephone"},
                {"data": "state_name"},
                {"data": "city_name"},
                {"data": "business_pincode"},
                {"data": "address"},
//                {"data": "address_geo"},
//                {"data": "description"},
                {"data": "business_type_name"},
                {
                    "data": "actions",
                    "render": function (data, type, row) {
                        var html = '';
                        var id = row['business_id'];
                        html += "<a  href='<?= site_url('Business/manage/'); ?>" + id + "' data-popup='custom-tooltip' data-original-title='<?= lang('edit_business') ?>'  onclick='EditRecord(" + id + ")' title='<?= lang('edit_business') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded'><i class='icon-pencil'></i></a>";
                        html += "&nbsp";
                        html += "<a href='javascript:void(0);' onclick='DeleteRecord(" + id + ")' data-popup='custom-tooltip' data-original-title='<?= lang('delete_business') ?>' title='<?= lang('delete_business') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
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
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['business_id'] + '" name="ids[]" value="' + row['business_id'] + '"/></label>';
                    },
                    "sortable": false,
                    "searchable": false
                }
            ],
            fnDrawCallback: function (oSettings) {
                CheckboxKeyGen();
                CustomToolTip();
                ScrollToTop();
            }
        });
    });

</script>

<script>
    $(document).on('click', '.cancel', function () {
        $('#businessTable input[class="dt-checkbox styled"]').prop('checked', false);
        CheckboxKeyGen();
    });

    $(document).ready(function () {
        CheckboxKeyGen('checkAll');
        CustomToolTip();
        $('#checkAll').click(function () {
            var checkedStatus = this.checked;
            $('#businessTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
            CheckboxKeyGen();
        });
    });

    function DeleteRecord(businessId) {
        $('#businessTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + businessId).prop('checked', true);
        $('.deleteRecord').click();
        CheckboxKeyGen();
    }

    $(document).on('click', '.deleteRecord', function () {
        var deleteElement = $('#businessTable tbody input[class="dt-checkbox styled"]:checked');
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
                        url: "<?= site_url("Business/delete")?>",
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

    function dataExport(language_id) {
        var table = $("#businessTable").dataTable();
        var postData = server_params;
        var language_id = language_id;
        $.ajax({
            type: "post",
            url: "<?= site_url("Business/exportBusinessData")?>",
            dataType: "html",
            data : { data : postData,language_id : language_id },
            success:function(download_url_from_server){
                document.location = download_url_from_server;
            }
        });
    }
</script>
<?php if (isset($select2)) { ?>
    <?= $select2 ?>
<?php } ?>
