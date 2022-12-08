<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('samaj_surname_heading') ?></h5>
        <div class="heading-elements">

            <button type="button" data-popup="custom-tooltip"  data-original-title="<?= lang('add_surname') ?>"  title="<?= lang('add_surname') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded addState"><i class="icon-plus3"></i></button>
            <button type="button" data-popup="custom-tooltip"  data-original-title="<?= lang('delete_surname') ?>"  title="<?= lang('delete_surname') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord"><i class="icon-trash"></i></button>

        </div>
    </div>

    <div class="table-responsive">

        <table id="surnameTable" class="table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
                <th><?= lang('samaj_surname') ?></th>
                <th><?= lang('samaj') ?></th>
<!--                <th>--><?//= lang('is_active') ?><!--</th>-->
                <th><?= lang('action') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>

<?= $v_samaj_surnameModal; ?>

<!--Display the state list-->
<script>
    $(document).ready(function () {

        dt_DataTable = $('#surnameTable').DataTable({
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
                "url": "<?= site_url('SamajSurname/getSurnameListing'); ?>",
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
                {"data": "surname_id"},
                {"data": "surname"},
                {"data": "samaj_name"},
                {
                    "data": "actions",
                    "render": function (data, type, row) {
                        var html = '';
                        var id = row['surname_id'];
                        html += "<button value='"+id+"' data-popup='custom-tooltip' data-original-title='<?= lang('edit_surname') ?>' title='<?= lang('edit_surname') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded editRecord'  ><i class='icon-pencil'></i></button>";
                        html += "&nbsp";
                        html += "<a href='javascript:void(0);' data-popup='custom-tooltip' onclick='DeleteRecord(" + id + ")' data-original-title='<?= lang('delete_surname') ?>' title='<?= lang('delete_surname') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
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
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['surname_id'] + '" name="ids[]" value="' + row['surname_id'] + '"/></label>';
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
            // alert('columns');
        });
    });

</script>

<script>

    //Delete function
    function DeleteRecord(surnameId) {
        $('#surnameTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + surnameId).prop('checked', true);
        $('.deleteRecord').click();
        CheckboxKeyGen();
    }


    //Delete Record
    $(document).on('click', '.deleteRecord', function () {
        $('form#stateDetails #is_active').siblings().remove();
        var deleteElement = $('#surnameTable tbody input[class="dt-checkbox styled"]:checked');
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
                        url: "<?= base_url("SamajSurname/delete")?>",
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