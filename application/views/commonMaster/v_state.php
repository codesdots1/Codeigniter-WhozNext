 <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"><?= lang('state_heading') ?></h5>
            <div class="heading-elements">

                <button type="button" data-popup="custom-tooltip"  data-original-title="<?= lang('add_state') ?>"  title="<?= lang('add_state') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded addState"><i class="icon-plus3"></i></button>
                <button type="button" data-popup="custom-tooltip"  data-original-title="<?= lang('delete_state') ?>"  title="<?= lang('delete_state') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord"><i class="icon-trash"></i></button>

            </div>
        </div>

        <div class="table-responsive">

            <table id="stateTable" class="table" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
                    <th><?= lang('state') ?></th>
                    <th><?= lang('country') ?></th>
                    <th><?= lang('is_active') ?></th>
                    <th><?= lang('action') ?></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

<?= $v_stateModal; ?>

<!--Display the state list-->
<script>
    $(document).ready(function () {

        dt_DataTable = $('#stateTable').DataTable({
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
                "url": "<?= site_url('State/getStateListing'); ?>",
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
                {"data": "state_id"},
                {"data": "state_name"},
                {"data": "country_name"},
                {"data": "is_active",
                    "render": function (data, type, row) {
                        var is_checked = '';
                        var id = row['state_id'];
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
                  //  "sortable": false,
                    "searchable": false

                },
                {
                    "data": "actions",
                    "render": function (data, type, row) {
                        var html = '';
                        var id = row['state_id'];
                        html += "<button value='"+id+"' data-popup='custom-tooltip' data-original-title='<?= lang('edit_state') ?>' title='<?= lang('edit_state') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded editRecord'  ><i class='icon-pencil'></i></button>";
                        html += "&nbsp";
                        html += "<a href='javascript:void(0);' data-popup='custom-tooltip' onclick='DeleteRecord(" + id + ")' data-original-title='<?= lang('delete_state') ?>' title='<?= lang('delete_state') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
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
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['state_id'] + '" name="ids[]" value="' + row['state_id'] + '"/></label>';
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
                CustomToolTip();
                ScrollToTop();
            }
        });
    });

</script>

 <script>

     /// Status change function
     $(document).on('click', '.isActive', function () {
         var stateId = $(this).attr('id');
         var isActive   = $(this).data("status");
         $.ajax({
             type: "post",
             url: "<?= site_url("State/changeStatus")?>",
             dataType: "json",
             data: {stateId: stateId, status: isActive},
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
     function DeleteRecord(stateId) {
         $('#stateTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
         $('#ids_' + stateId).prop('checked', true);
         $('.deleteRecord').click();
         CheckboxKeyGen();
     }


     //Delete Record
     $(document).on('click', '.deleteRecord', function () {
         $('form#stateDetails #is_active').siblings().remove();
         var deleteElement = $('#stateTable tbody input[class="dt-checkbox styled"]:checked');
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
                         url: "<?= base_url("State/delete")?>",
                         dataType: "json",
                         data: {deleteId: deleteId},
                         success: function (data) {
                             if (data['success']) {
                                 swal({
                                     title: "<?= ucwords(lang('success'))?>",
                                     text: data['msg'],
                                     type: "<?= lang('success')?>",
                                     confirmButtonColor: "<?= BTN_SUCCESS; ?>",
                                 },function(){
                                     dt_DataTable.ajax.reload();
                                     //$('#checkAll').prop('checked', false);
                                     CheckboxKeyGen('checkAll');
                                 });
                             } else {
                                 swal({
                                     title: "<?= ucwords(lang('error')); ?>",
                                     text: data['msg'],
                                     type: "<?= lang('error'); ?>",
                                     confirmButtonColor: "<?= BTN_ERROR; ?>"
                                 },function(){
                                     dt_DataTable.ajax.reload();
                                     CheckboxKeyGen('checkAll');
                                 });
                             }
                         }
                     });
                 });
         }
     });


 </script>