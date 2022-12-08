 <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"><?= lang('opportunity_status_index_heading') ?></h5>
            <div class="heading-elements">

                <button type="button" data-popup="custom-tooltip"  data-original-title="<?= lang('add_opportunity_status') ?>" title="<?= lang('add_opportunity_status') ?>"
                        class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded addOpportunityStatus">
                    <i class="icon-plus3"></i>
                </button>
                <button type="button" data-popup="custom-tooltip" data-original-title="<?= lang('delete_opportunity_status') ?>" title="<?= lang('delete_opportunity_status') ?>"
                        class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord">
                    <i class="icon-trash"></i>
                </button>

            </div>
        </div>

        <div class="table-responsive">

            <table id="opportunityStatusTable" class="table" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
                    <th><?= lang('opportunity_status_name') ?></th>
                    <th><?= lang('sort_order') ?></th>
                    <th><?= lang('is_active') ?></th>
                    <th><?= lang('action') ?></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

<?= $v_opportunity_statusModal; ?>

<!--Display the opportunityStatus list-->
<script>
    $(document).ready(function () {

        dt_DataTable = $('#opportunityStatusTable').DataTable({
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
                "url": "<?= site_url('OpportunityStatus/getOpportunityStatusListing'); ?>",
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
                {"data": "opportunity_status_id"},
                {"data": "opportunity_status_name"},
                {"data": "sort_order"},
                {"data": "is_active",
                    "render": function (data, type, row) {
                        var is_checked = '';
                        var id = row['opportunity_status_id'];
                        if (data == 1) {
                            is_checked = 'checked="checked"';
                        }
                        var html = '';
                        html += '<div class="checkbox checkbox-switchery switchery-xs">';
                        html += '<label>';
                        html += '<input id="' + id + '" type="checkbox" class="dt_switchery isActive" ' + is_checked + ' data-opportunity_status="' + data + '"  >';
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
                        var id = row['opportunity_status_id'];
                        html += "<button value='"+id+"' data-popup='custom-tooltip' data-original-title='<?= lang('edit_opportunity_status') ?>' " +
                            "title='<?= lang('edit_opportunity_status') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded editRecord'>" +
                            "<i class='icon-pencil'></i></button>";
                        html += "&nbsp";
                        html += "<a href='javascript:void(0);' data-popup='custom-tooltip' onclick='DeleteRecord(" + id + ")' title='<?= lang('delete_opportunity_status') ?>' " +
                            "data-original-title='<?= lang('delete_opportunity_status') ?>' class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' >" +
                            "<i class='icon-trash'></i></a>";
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
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['opportunity_status_id'] + '" ' +
                            'name="ids[]" value="' + row['opportunity_status_id'] + '"/><span class="lbl"></span></label>';
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
     /// opportunityStatus change function
     $(document).on('click', '.isActive', function () {
         var opportunityStatusId = $(this).attr('id');
         var isActive   = $(this).data("opportunity_status");
         $.ajax({
             type: "post",
             url: "<?= site_url("OpportunityStatus/changeOpportunityStatus")?>",
             dataType: "json",
             data: {opportunityStatusId: opportunityStatusId, opportunity_status : isActive},
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

     //Delete function
     function DeleteRecord(opportunityStatusId) {
         $('#opportunityStatusTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
         $('#ids_' + opportunityStatusId).prop('checked', true);
         $('.deleteRecord').click();
         CheckboxKeyGen();
     }


     //Delete Record
     $(document).on('click', '.deleteRecord', function () {
         $('form#opportunityStatusDetails #is_active').siblings().remove();
         $('form#opportunityStatusDetails #is_active').siblings().remove();
         var deleteElement = $('#opportunityStatusTable tbody input[class="dt-checkbox styled"]:checked');
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
                         url: "<?= base_url("OpportunityStatus/delete")?>",
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
//                                     $('#checkAll').prop('checked', false);
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