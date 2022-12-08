<?php
if(isset($filterModel) && $filterModel != '') {
    echo $filterModel;
}
?>

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('post_index_list') ?></h5>
        <div class="heading-elements">

            <a  href="<?= site_url('Post/manage'); ?>" data-popup='custom-tooltip' data-original-title="<?= lang('add_post') ?>"title="<?= lang('add_post') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded"><i class="icon-plus3"></i></a>
            <a type="button" data-popup='custom-tooltip' data-original-title="<?= lang('delete_post') ?>" title="<?= lang('delete_post') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord"><i class="icon-trash"></i></a>

        </div>
    </div>

    <div class="table-responsive">

        <table id="postTable" class="table " cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
                <th><?= lang('title') ?></th>
                <th><?= lang('category') ?></th>
                <th><?= lang('samaj') ?></th>
                <th><?= lang('member') ?></th>
                <th><?= lang('post_date') ?></th>
                <th><?= lang('is_active') ?></th>
                <th><?= lang('action') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>


<script>
    $(document).ready(function () {
        dt_DataTable = $('#postTable').DataTable({
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
                "url": "<?= site_url('Post/getPostListing'); ?>",
                "type": "post",
                "data": function (d) {
                    return $.extend({}, d, {
                        "<?= $this->security->get_csrf_token_name() ?>": '<?= $this->security->get_csrf_hash() ?>'
                    });
                }
            },
            "fnServerParams": function (aoData) { //send other data to server side
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
                {"data": "post_id"},
                {"data": "title"},
                {"data": "category_name"},
                {"data": "samaj_name"},
                {"data": "member_name"},
                {"data": "post_date"},
                {"data": "is_active",
                    "render": function (data, type, row) {
                        var is_checked = '';
                        var id = row['post_id'];
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
                {
                    "data": "actions",
                    "render": function (data, type, row) {
                        var html = '';
                        var id = row['post_id'];
                        html += "<a  href='<?= site_url('Post/manage/'); ?>" + id + "' data-popup='custom-tooltip' data-original-title='<?= lang('edit_post') ?>'  onclick='EditRecord(" + id + ")' title='<?= lang('edit_post') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded'><i class='icon-pencil'></i></a>";
                        html += "&nbsp";
                        html += "<a href='javascript:void(0);' onclick='DeleteRecord(" + id + ")' data-popup='custom-tooltip' data-original-title='<?= lang('delete_post') ?>' title='<?= lang('delete_post') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
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
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['post_id'] + '" name="ids[]" value="' + row['post_id'] + '"/></label>';
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
        $('#postTable input[class="dt-checkbox styled"]').prop('checked', false);
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
            $('#postTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
            CheckboxKeyGen();
        });

    });

    /// Status change function
    $(document).on('click', '.isActive', function () {
        var postId = $(this).attr('id');
        var isActive   = $(this).data("status");
        $.ajax({
            type: "post",
            url: "<?= site_url("Post/changeStatus")?>",
            dataType: "json",
            data: {post_id: postId, status: isActive},
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
    function DeleteRecord(postId) {
        $('#postTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + postId).prop('checked', true);
        $('.deleteRecord').click();
        CheckboxKeyGen();
    }


    //Delete Record
    $(document).on('click', '.deleteRecord', function () {
        var deleteElement = $('#postTable tbody input[class="dt-checkbox styled"]:checked');
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
                        url: "<?= site_url("Post/delete")?>",
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
    function EditRecord(postId) {
        $('#postTable  input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + postId).prop('checked', true);
        //$('.editRecord').click();
        CheckboxKeyGen();

    }

    //Edit Record
//    $(document).on('click', '.editRecord', function () {
//        var editElement = $('#postTable  input[class=dt-checkbox]:checked');
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
</script>