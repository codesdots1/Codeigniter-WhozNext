 <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"><?= lang('assets_category_heading') ?></h5>
            <div class="heading-elements">

                <button type="button" data-popup="custom-tooltip"  data-original-title="<?= lang('add_assets_category') ?>" title="<?= lang('add_assets_category') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded addAssetsCategory"><i class="icon-plus3"></i></button>
                <button type="button" data-popup="custom-tooltip" data-original-title="<?= lang('delete_assets_category') ?>" title="<?= lang('delete_assets_category') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord"><i class="icon-trash"></i></button>

            </div>
        </div>

        <div class="table-responsive">

            <table id="assetsCategoryTable" class="table" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
                    <th><?= lang('assets_category_name') ?></th>
                    <th><?= lang('depreciation_method') ?></th>
                    <th><?= lang('frequency_of_depreciation') ?></th>
                    <th><?= lang('total_no_of_depreciation') ?></th>
                    <th><?= lang('action') ?></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

<?= $v_assets_categoryModal; ?>

<!--Display the customer group list-->
<script>
    $(document).ready(function () {

        dt_DataTable = $('#assetsCategoryTable').DataTable({
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
                "url": "<?= site_url('AssetsCategory/getAssetsCategoryListing'); ?>",
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
                {"data": "assets_category_id"},
                {"data": "assets_category_name"},
                {"data": "depreciation_method"},
                {"data": "frequency_of_depreciation"},
                {"data": "total_no_of_depreciation"},

                {
                    "data": "actions",
                    "render": function (data, type, row) {
                        var html = '';
                        var id = row['assets_category_id'];
                        html += "<button value='"+id+"' data-popup='custom-tooltip' data-original-title='<?= lang('edit_assets_category') ?>' title='<?= lang('edit_assets_category') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded editRecord'><i class='icon-pencil'></i></button>";
                        html += "&nbsp";
                        html += "<a href='javascript:void(0);' data-popup='custom-tooltip' onclick='DeleteRecord(" + id + ")' data-original-title='<?= lang('delete_assets_category') ?>' title='<?= lang('delete_assets_category') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
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
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['assets_category_id'] + '" name="ids[]" value="' + row['assets_category_id'] + '"/></label>';
                    },
                    "sortable": false,
                    "searchable": false
                },
            ],

            fnDrawCallback: function (oSettings) {
                // Switchery
                // Initialize multiple switches
                CheckboxKeyGen('checkAll');
                DtSwitcheryKeyGen();
                CustomToolTip();
                ScrollToTop();
            }
        });
    });

</script>


 <script>


     //Delete function
     function DeleteRecord(assetsCategoryId) {
         $('#assetsCategoryTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
         $('#ids_' + assetsCategoryId).prop('checked', true);
         $('.deleteRecord').click();
         CheckboxKeyGen();
     }


     //Delete Record
     $(document).on('click', '.deleteRecord', function () {
         $('form#paymentModeDetails #is_active').siblings().remove();
         var deleteElement = $('#assetsCategoryTable tbody input[class="dt-checkbox styled"]:checked');
         var selectedLength = deleteElement.size();
         //  CheckboxKeyGen();
         if (selectedLength == 0) {
             swal({
                 title: "<?= ucwords(lang('info')); ?>",
                 text: "<?= lang('delete_info'); ?>",
                 confirmButtonColor: "<?= BTN_DELETE_INFO; ?>",
                 type: "<?= lang('info'); ?>"
             }, function () {
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
                         url: "<?= base_url("AssetsCategory/delete")?>",
                         dataType: "json",
                         data: {deleteId: deleteId},
                         success: function (data) {
                             if (data['success']) {
                                 swal({
                                     title: "<?= ucwords(lang('success'))?>",
                                     text: data['msg'],
                                     type: "<?= lang('success')?>",
                                     confirmButtonColor: "<?= BTN_SUCCESS; ?>",
                                 }, function () {
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
                                 }, function () {
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