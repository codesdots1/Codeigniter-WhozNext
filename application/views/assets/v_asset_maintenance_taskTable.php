<?php
$html = '';
//printArray($getAssetMaintenanceTaskData,1);
if(isset($getAssetMaintenanceTaskData) && !empty($getAssetMaintenanceTaskData)){

    foreach ($getAssetMaintenanceTaskData as $key => $value){
        $index = $key + 1;
        if($key == 0){
            $button ='<a data-popup=\"custom-tooltip\" title=\"'.lang('add_asset_maintenance_task').'\" onclick=\"AddAssetMaintenanceTaskRow()\" '.
                'class=\"btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded\"><i class=\"icon-plus3\"></i></a>';
        }else{
            $button ='<a data-popup=\"custom-tooltip\" title=\"'.lang('delete_asset_maintenance_task').'\" class=\"btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded DeleteAssetMaintenanceTaskRow\"><i class=\"icon-trash\"></i></a>';
        }


        $html .="<tr>".
            "<td>".
            "<input type='hidden'  id='asset_maintenance_task_id_".$index."' name='asset_maintenance_task_id[]' value='".$value['asset_maintenance_task_id']."'>".
            "<input type='text' class='asset_maintenance_task_name form-control' name='asset_maintenance_task_name[]' value='".$value['asset_maintenance_task_name']."' id='asset_maintenance_task_name' placeholder='Select a ".lang('asset_maintenance_task_name')."'>".
            "</td>".

            "<td>".
            "<select data-placeholder='".lang('asset_maintenance_task_status')."' name='asset_maintenance_task_status_id[]' id='asset_maintenance_task_status_id_". $index ."'  class='select'>".
            CreateOptions("html", "tbl_status", array("status_id", "status_name"), isset($value["status_id"]) ? $value["status_id"] : "",'',array("status_type"=>"assets maintenance")).
            "<option value=''></option>".
            "</select>".
            "</td>".

            "<td>".
            "<select data-placeholder='".lang('asset_maintenance_type')."' name='asset_maintenance_type_id[]' id='asset_maintenance_type_id'  class='asset_maintenance_type_DD'>".
            "<option value=''></option>".
            "</select>".
            "</td>".

            "<td>".
            "<input type='tel' class='form-control numberInit' name='periodicity[]' value='".$value['periodicity']."' id='periodicity' placeholder='Select a'".lang('periodicity')."'>".
            "</td>".

            "<td>".
            "<select data-placeholder='".lang('assign_to')."' name='assign_to[]' id='assign_to'  class='assign_to_DD'>".
            "<option value=''></option>".
            "</select>".
            "</td>".

            "<td>".
            "<input type='text' class='form-control next_due_date' id='next_due_date' value='".$value['next_due_date']."' name='next_due_date[]' placeholder='Select a".lang('next_due_date')."'>".
            "</td>".
            "<td>".
            $button.
            "</td>".
            "</tr>";

    }
}

?>

<div class="table-responsive ">

    <table id="assetMaintenanceTaskTable" class="table table-bordered table-framed" cellspacing="0" width="100%">
        <thead>

        <tr>
            <th><?= lang('asset_maintenance_task_name') ?></th>
            <th><?= lang('asset_maintenance_task_status') ?></th>
            <th><?= lang('asset_maintenance_type') ?></th>
            <th><?= lang('periodicity') ?></th>
            <th><?= lang('assign_to') ?></th>
            <th><?= lang('next_due_date') ?></th>
            <th><?= lang('action') ?></th>
        </tr>

        </thead>
        <tbody>
        <tr>
            <td>
                <input type="hidden" name="asset_maintenance_task_id[]" id="asset_maintenance_task_id_0" value="">
                <input type="text" class="asset_maintenance_task_name form-control" name="asset_maintenance_task_name[]"
                       id="asset_maintenance_task_name" placeholder="Enter a <?= lang('asset_maintenance_task_name')?>">
            </td>
            <td>
                <select data-placeholder="Select your <?= lang('asset_maintenance_task_status') ?>" class="select"
                        name="asset_maintenance_task_status_id[]"id="asset_maintenance_task_status_id">
                    <option value=""></option>
                    <?= CreateOptions("html", "tbl_status", array('status_id', 'status_name'), '','',array('status_type'=>'assets maintenance')); ?>

                </select>
            </td>
            <td>
                <select data-placeholder="Select your <?= lang('asset_maintenance_type') ?>"
                        name="asset_maintenance_type_id[]"id="asset_maintenance_type_id"  class="asset_maintenance_type_DD">
                    <option value=""></option>
                </select>
            </td>
            <td>
                <input type="tel" class="form-control numberInit" name="periodicity[]" id="periodicity" placeholder="Enter <?= lang('periodicity') ?>">
            </td>
            <td>
                <select data-placeholder="Select your <?= lang('assign_to') ?>"
                        name="assign_to[]" id="assign_to"  class="assign_to_DD">
                    <option value=""></option>
                </select>
            </td>
            <td>
                <input type="text" class="form-control next_due_date" id="next_due_date" name="next_due_date[]" placeholder="Select a<?= lang('next_due_date')?>">
            </td>
            <td><a data-popup='custom-tooltip' title="<?= lang('add_asset_maintenance_task') ?>" onclick="AddAssetMaintenanceTaskRow()"
                   class="btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded "><i class="icon-plus3"></i></a></td>
        </tr>
        </tbody>
    </table>
</div>

<script>

    function DateInit()
    {
        $(".next_due_date").datepicker({
            dateFormat: "<?= DATE_FORMATE ?>",
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            minDate : new Date(),
            onSelect: function (selected) {
                if ($(this).valid()) {
                    $(this).removeClass('invalid').addClass('success');
                }
                var id = $(this).attr('id');
                $("input[name=" + id + "]").val($(this).val());
            }

        });
    }
    function assetMaintenanceTaskSelect2Init(){
        //Ajax send item code

        $(".asset_maintenance_type_DD").select2({

            ajax: {
                url: "<?= site_url('AssetMaintenanceType/getAssetMaintenanceType') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '', // search term
                        status_id: "<?= isset($getAssetMaintenanceTaskData['maintenance_type_id']) ? $getAssetMaintenanceTaskData['maintenance_type_id'] : ''; ?>",
                        page: params.page || 1
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.result,
                        pagination: {
                            more: (data.page * 10) < data.totalRows

                        }
                    };
                },
                //cache: true
            },

            escapeMarkup: function (markup) {
                return markup;
            },

        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });

        $(".assign_to_DD").select2({

            ajax: {
                url: "<?= site_url('Auth/getUsersDD') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '', // search term
                        status_id: "<?= isset($getAssetMaintenanceTaskData['assign_to']) ? $getAssetMaintenanceTaskData['assign_to'] : ''; ?>",
                        page: params.page || 1
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.result,
                        pagination: {
                            more: (data.page * 10) < data.totalRows

                        }
                    };
                },
                //cache: true
            },

            escapeMarkup: function (markup) {
                return markup;
            },

        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });
    }





    var index = <?php echo (isset($getAssetMaintenanceTaskData) && !empty($getAssetMaintenanceTaskData)) ? count($getAssetMaintenanceTaskData) : 0; ?>;

    function AddAssetMaintenanceTaskRow(){
        index = index + 1;
        var html = "<tr>"+
            "<td>"+
            "<input type='hidden' name='asset_maintenance_task_id[]' id='asset_maintenance_task_id_"+index+"'/>"+
            "<input type='text' class='asset_maintenance_task_name form-control' name='asset_maintenance_task_name[]' id='asset_maintenance_task_name_"+index+"' placeholder='Select a <?= lang('asset_maintenance_task_name')?>''>"+
            "</td>"+

            "<td>"+
            "<select data-placeholder='Select your <?= lang('asset_maintenance_task_status')?>' name='asset_maintenance_task_status_id[]' id='asset_maintenance_task_status_id_"+index+"'  class='select'>"+
            "<option value=''></option>"+
            "<?= CreateOptions('html', 'tbl_status', array('status_id', 'status_name'), '','',array('status_type'=>'assets maintenance')); ?>"+
            "</select>"+
            "</td>"+

            "<td>"+
            "<select data-placeholder='Select your <?= lang('asset_maintenance_type') ?>' name='asset_maintenance_type_id[]' id='asset_maintenance_type_id_"+index+"'  class='asset_maintenance_type_DD'>"+
            "<option value=''></option>"+
            "</select>"+
            "</td>"+

            "<td>"+
            "<input type='tel' class='form-control' name='periodicity[]' id='periodicity_"+index+"' placeholder='Enter <?= lang('periodicity') ?>'>"+
            "</td>"+

            "<td>"+
            "<select data-placeholder='Select your <?= lang('assign_to') ?>' name='assign_to[]' id='assign_to_"+index+"' class='assign_to_DD'>"+
            "<option value=''></option>"+
            "</select>"+
            "</td>"+

            "<td>"+
            "<input type='text' class='form-control next_due_date' id='next_due_date_"+index+"' name='next_due_date[]' placeholder='Select <?= lang('next_due_date')?>'>"+
            "</td>"+

            "<td>"+
            "<a data-popup='custom-tooltip' title='<?= lang('delete_asset_maintenance_task')?>' class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded DeleteAssetMaintenanceTaskRow'><i class='icon-trash'></i></a>"+
            "</td>"+
            "</tr>";

        $('table#assetMaintenanceTaskTable tbody').append(html);
        CustomToolTip();
        assetMaintenanceTaskSelect2Init();
        Select2Init();
        DateInit();
    }

    $(document).on('click', '.DeleteAssetMaintenanceTaskRow', function() {

        var trField = $(this).closest('tr');
//        trField.remove();
        var value = $(this).closest('tr').find("input[type=hidden]").val();
        var id = value.split("_").pop();
        if(value != '') {
            swal({
                title: "<?= ucwords(lang('delete')); ?>",
                text: "<?= lang('delete_warning'); ?>",
                type: "<?= lang('warning'); ?>",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonColor: "<?= BTN_DELETE_WARNING; ?>",
                showLoaderOnConfirm: true

            }, function () {

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url().$this->uri->segment(1);?>/deleteAssetMaintenanceTaskRow",
                    dataType: "json",
                    data: {row_id: id},
                    success: function (resObj) {
                        if (resObj.success) {
                            swal({
                                title: "<?= ucwords(lang('success'))?>",
                                text: resObj.msg,
                                type: "<?= lang('success')?>",
                                confirmButtonColor: "<?= BTN_SUCCESS; ?>",
                            }, function () {
                                $(trField).remove();
                            });
                        } else {
                            swal({
                                title: "<?= ucwords(lang('error')); ?>",
                                text: resObj.msg,
                                type: "<?= lang('error'); ?>",
                                confirmButtonColor: "<?= BTN_ERROR; ?>"
                            });
                        }
                    }
                });

            });
        } else{
            $(trField).remove();
        }
    });
</script>

<script>
    $(document).ready( function() {
        <?php if(isset($getAssetMaintenanceTaskData) && !empty($getAssetMaintenanceTaskData) && $html != ''){ ?>
        $('table#assetMaintenanceTaskTable tbody').html("<?= $html ?>");
        CustomToolTip();
        assetMaintenanceTaskSelect2Init();
        Select2Init();
        DateInit();
        <?php } ?>

        assetMaintenanceTaskSelect2Init();
        DateInit();
        numberInit();

        <?php if((isset($getAssetMaintenanceTaskData) && !empty($getAssetMaintenanceTaskData))){
                foreach ($getAssetMaintenanceTaskData as $key => $value){ ?>
        var option = new Option("<?= $value['asset_maintenance_type_name']; ?>","<?= $value['asset_maintenance_type_id']; ?>", true, true);
        $('#assetMaintenanceTaskTable tbody').find("tr:eq(<?= $key; ?>) select:eq(1)").append(option).trigger('change');

        var userOption = new Option("<?= $value['name']; ?>","<?= $value['id']; ?>", true, true);
        $('#assetMaintenanceTaskTable tbody').find("tr:eq(<?= $key; ?>) select:eq(2)").append(userOption).trigger('change');
        <?php } } ?>

    });
</script>