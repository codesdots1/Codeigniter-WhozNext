<?php
if(isset($filterModel) && $filterModel != '') {
    echo $filterModel;
}
?>

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('member_index_heading') ?></h5>
        <div class="heading-elements">

            <button type="button" data-popup='custom-tooltip' data-original-title="<?= lang('export_member') ?>" title="<?= lang('export_member') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="icon-file-excel"></i> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
                 <?php foreach($activeLanguage as $key) { ?>
                        <li><a href="javascript:void(0)" onclick="dataExport(<?php echo $key['language_id']; ?>)"><?php echo $key['language_name']; ?></a></li>
                <?php } ?>
            </ul>

            <a  href="<?= site_url('Member/manage'); ?>" data-popup='custom-tooltip' data-original-title="<?= lang('add_member') ?>" title="<?= lang('add_member') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded"><i class="icon-plus3"></i></a>
            <a type="button" data-popup='custom-tooltip' data-original-title="<?= lang('delete_member') ?>" title="<?= lang('delete_member') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord"><i class="icon-trash"></i></a>
        </div>
    </div>
    <div class="table-responsive">
        <table id="memberTable" class="table " cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
                <th><?= lang('samaj') ?></th>
                <th><?= lang('otp') ?></th>
                <th><?= lang('member_number') ?></th>
                <th><?= lang('first_name') ?></th>
                <th><?= lang('middle_name') ?></th>
                <th><?= lang('surname') ?></th>
                <th><?= lang('mobile') ?></th>
                <th><?= lang('email') ?></th>
                <th><?= lang('native_place') ?></th>
                <th><?= lang('member_education') ?></th>
                <th><?= lang('blood_group') ?></th>
                <th><?= lang('gender') ?></th>
                <th><?= lang('marital_status') ?></th>
                <th><?= lang('member_state') ?></th>
                <th><?= lang('member_city') ?></th>
                <th><?= lang('member_pincode') ?></th>
                <th><?= lang('member_address') ?></th>
                <th><?= lang('date_of_birth') ?></th>
                <th><?= lang('aadhar_card_no') ?></th>
                <th><?= lang('is_active') ?></th>
                <th><?= lang('action') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>


<script>
    $(document).ready(function () {
        dt_DataTable = $('#memberTable').DataTable({
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
                "url": "<?= site_url('Member/getMemberListing'); ?>",
                "type": "post",
                "data": function (d) {
                    var params = {};
                    params["<?= $this->security->get_csrf_token_name(); ?>"] = "<?= $this->security->get_csrf_hash() ?>";
//                    var filterData = $("#advanceFilter").serializeArray();
//                    $.each(filterData, function (i, val) {
//                        var name = val.name;
//                        if (typeof params[name] == 'undefined') {
//                            params[name] = val.value;
//                        } else if($.isArray(params[name])){
//                            params[name].push(val.value);
//                        } else {
//                            params[name] = [params[name]];
//                            params[name].push(val.value);
//                        }
//                    });
                    return $.extend({}, d,params);
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
                {"data": "member_id"},
                {"data": "samaj_name"},
                {"data": "otp"},
                {"data": "member_number"},
                {"data": "first_name"},
                {"data": "middle_name"},
                {"data": "surname"},
                {"data": "mobile"},
                {"data": "email"},
                {"data": "native_location"},
                {"data": "education_name"},
                {"data": "blood_group"},
                {"data": "gender_name"},
                {"data": "marital_status"},
                {"data": "state_name"},
                {"data": "city_name"},
                {"data": "member_pincode"},
                {"data": "member_address"},
                {"data": "date_of_birth"},
                {"data": "aadhar_card_no"},
                {"data": "is_active",
                   "render": function (data, type, row) {
                       var is_checked = '';
                       var id = row['member_id'];
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
                        var id = row['member_id'];
                        html += "<a  href='<?= site_url('Member/manage/'); ?>" + id + "' data-popup='custom-tooltip' data-original-title='<?= lang('edit_member') ?>' title='<?= lang('edit_member') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded'><i class='icon-pencil'></i></a>";
                        html += "&nbsp";
                        html += "<a href='javascript:void(0);' onclick='DeleteRecord(" + id + ")' data-popup='custom-tooltip' data-original-title='<?= lang('delete_member') ?>' title='<?= lang('delete_member') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
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
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['member_id'] + '" name="ids[]" value="' + row['member_id'] + '"/></label>';
                    },
                    "sortable": false,
                    "searchable": false
                }
            ],
            fnDrawCallback: function (oSettings) {
                DtSwitcheryKeyGen();
                CheckboxKeyGen();
                CustomToolTip();
                ScrollToTop();
            }
        });
    });

    function dataExport(language_id) {
//       var postData = dt_DataTable.ajax.params();
//       var language_id = language_id;

        var table = $("#memberTable").dataTable();
        var postData = server_params;
        var language_id = language_id;

       $.ajax({
           type: "post",
           url: "<?= site_url("Member/exportMemberData")?>",
           dataType: "html",
           data : { data : postData,language_id : language_id },
           success:function(download_url_from_server){
               document.location = download_url_from_server;
           }
       });
    }
</script>

<script>
    $(document).on('click', '.cancel', function () {
        $('#memberTable input[class="dt-checkbox styled"]').prop('checked', false);
        CheckboxKeyGen();
    });
   $(document).on('click', '.isActive', function () {
       var memberId   = $(this).attr('id');

       var isActive   = $(this).data("status");
       $.ajax({
           type: "post",
            url: "<?= site_url("Member/changeActive")?>",
           dataType: "json",
           data: {member_id: memberId, status: isActive},
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

    $(document).ready(function () {
        CheckboxKeyGen('checkAll');
        CustomToolTip();
        $('#checkAll').click(function () {
            var checkedStatus = this.checked;
            $('#memberTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
            CheckboxKeyGen();
        });
    });

    function DeleteRecord(memberId) {
        $('#memberTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + memberId).prop('checked', true);
        $('.deleteRecord').click();
        CheckboxKeyGen();
    }

    $(document).on('click', '.deleteRecord', function () {
        var deleteElement = $('#memberTable tbody input[class="dt-checkbox styled"]:checked');
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
                        url: "<?= site_url("Member/delete")?>",
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
</script>