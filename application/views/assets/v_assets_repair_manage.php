<?php
$html = '';
if (isset($getAssetsRepairItemData) && !empty($getAssetsRepairItemData)) {
    foreach ($getAssetsRepairItemData as $key => $value) {
        $index = $key + 1;
        if ($key == 0) {
            $button = "<a data-popup='custom-tooltip' title='" . lang('add_item') . "' data-original-title='". lang('add_item')."'  onclick='AddItemRow()' class='btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded'><i class='icon-plus3'></i></a>";
        } else {
            $button = "<a data-popup='custom-tooltip' title='" . lang('delete_item') . "' data-original-title='".lang('delete_item') ."' class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded DeleteItemRow'><i class='icon-trash'></i></a>";
        }

        $html .= "<tr data-id='tr_" . $index . "'>" .
            "<td>" .
            "<input type='hidden'  id='id_" . $index . "' name='item_mapper_id[]' value='" . $value['item_mapper_id'] . "'>" .
            "<select data-placeholder='Select Your " . lang('item_code') . "' name='item_code_add[]' id='item_code_add_" . $index . "'  class='item_DD'>" .
            "<option value=''></option>" .
            "</select>" .
            "</td>" .

            "<td>" .
            "<input type='text' class='form-control issueDate' name='issue_date[]' value='" . $value['issue_date'] . "' id='issue_date_" . $index . "'  placeholder='Please Select " . lang('issue_date') . "' >" .
            "</td>" .


            "<td>" .
            "<input type='tel' class='form-control numberInit' name='issue_quantity[]' value='" . $value['issue_quantity'] . "' id='issue_quantity_" . $index . "'  placeholder='Please Enter " . lang('issue_quantity') . "'>" .
            "</td>" .

            "<td>" .
            "<select data-placeholder='Select Your " . lang('issue_to') . "' name='issue_to[]' id='issue_to_" . $index . "'  class='issue_to'>" .
            "<option value=''></option>" .

            "</select>" .
            "</td>" .

            "<td>" .
            $button .
            "</td>" .
            "</tr>";
    }
}
?>

<div class="panel panel-flat  border-left-lg border-left-slate">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('assets_repair_form') ?> </h5>
    </div>

    <div class="panel-body">
        <?php
        //create  form open tag
        $form_id = array(
            'id' => 'assetsRepairDetails',
            'method' => 'post',
            'autocomplete' => 'off'
        );
        echo form_open_multipart('', $form_id);
        ?>

        <input type="hidden" name="assets_repair_id"
               value="<?= isset($getAssetsRepairData['assets_repair_id']) ? $getAssetsRepairData['assets_repair_id'] : '' ?>"
               id="assets_repair_id">

        <!--  Assets Repair Details-->
        <fieldset class="content-group">
            <legend class="text-bold"> <?= lang('assets_repair_details'); ?>  </legend>

            <div class="form-group">

                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label><?= lang('series') ?></label>
                            <?php if (isset($getAssetsRepairData['assets_repair_id']) && $getAssetsRepairData['assets_repair_id'] != '') { ?>
                                <input type="text" class="form-control" name="series" id="series"
                                       value="<?= $getAssetsRepairData['prefix'] . $getAssetsRepairData['series'] ?>"
                                       readonly>
                            <?php } else { ?>
                                <input type="text" class="form-control" name="series" id="series"
                                       value="<?= ASSETS_REPAIR_PREFIX . $getNextAutoIncrementId ?>">
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <label><?= lang('assets_name') ?></label>
                            <select data-placeholder="Select Your <?= lang('assets_name') ?>" name="assets_id"
                                    id="assets_id"
                                    class="select">
                                <option value=""></option>
                                <?= CreateOptions("html", "tbl_assets", array('assets_id', 'assets_name'), isset($getAssetsRepairData['assets_id']) ? $getAssetsRepairData['assets_id'] : ''); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><?= lang('failure_date') ?></label>
                            <input type="text" class="form-control" name="failure_date" id="failure_date"
                                   value="<?= isset($getAssetsRepairData['failure_date']) ? $getAssetsRepairData['failure_date'] : '' ?>"
                                   placeholder="Pick a date&hellip;" readonly>
                        </div>


                        <div class="form-group">
                            <label><?= lang('assign_to') ?></label>
                            <select data-placeholder="Select Your <?= lang('assign_to') ?>" name="assign_to"
                                    id="assign_to" class="">
                                <option value=""></option>
<!--                                --><?//= CreateOptions("html", "tbl_users", array('id', 'concat(first_name," ",last_name)'), isset($getAssetsRepairData['assign_to']) ? $getAssetsRepairData['assign_to'] : ''); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><?= lang('assign_to_name') ?></label>
                            <input type="tel" class="form-control numberInit" name="assign_to_name" id="assign_to_name"
                                   value="<?= isset($getAssetsRepairData['assign_to_name']) ? $getAssetsRepairData['assign_to_name'] : '' ?>"
                                   placeholder=" <?= lang('assign_to_name') ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label><?= lang('error_description') ?></label>

                            <textarea name="error_description" id="error_description" class="ckeditor" rows="2"
                                      cols="2">
                                 <?= (isset($getAssetsRepairData['error_description']) && ($getAssetsRepairData['error_description'] != '')) ? $getAssetsRepairData['error_description'] : ''; ?>
                                  </textarea>
                            <label id="error_description-error" class="validation-error-label"
                                   for="error_description"></label>

                        </div>


                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label><?= lang('item_code') ?></label>
                            <input type="text" class="form-control" name="item_code" id="item_code"
                                   value="<?= isset($getAssetsRepairData['item_code']) ? $getAssetsRepairData['item_code'] : '' ?>"
                                   placeholder="<?= lang('item_code') ?>" readonly>

                            <input type="hidden" name="item_id"
                                   value="<?= isset($getAssetsRepairData['item_id']) ? $getAssetsRepairData['item_id'] : '' ?>"
                                   id="item_id">
                        </div>

                        <div class="form-group">
                            <label><?= lang('item_name') ?></label>
                            <input type="text" class="form-control" name="item_name" id="item_name"
                                   value="<?= isset($getAssetsRepairData['item_name']) ? $getAssetsRepairData['item_name'] : '' ?>"
                                   placeholder="<?= lang('item_name') ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label><?= lang('completion_date') ?></label>
                            <input type="text" class="form-control" name="completion_date" id="completion_date"
                                   value="<?= isset($getAssetsRepairData['completion_date']) ? $getAssetsRepairData['completion_date'] : '' ?>"
                                   placeholder="Pick a date&hellip;" readonly>
                        </div>

                        <div class="form-group">
                            <label><?= lang('repair_status') ?></label>
                            <select data-placeholder="Select Your <?= lang('repair_status') ?>" name="status_id"
                                    id="status_id" class="select">
                                <option value=""></option>
                                <?= CreateOptions("html", "tbl_status", array('status_id', 'status_name'), isset($getAssetsRepairData['repair_status_id']) ? $getAssetsRepairData['repair_status_id'] : '', '', array('status_type' => 'assets repair')); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><?= lang('repair_cost') ?></label>
                            <input type="tel" class="form-control numberInit" name="repair_cost" id="repair_cost"
                                   value="<?= isset($getAssetsRepairData['repair_cost']) ? $getAssetsRepairData['repair_cost'] : '' ?>"
                                   placeholder="Please Enter <?= lang('repair_cost') ?>">
                        </div>

                        <div class="form-group">
                            <label><?= lang('actions_performed') ?></label>

                            <textarea name="actions_performed" id="actions_performed" class="ckeditor" rows="2"
                                      cols="2">
                                 <?= (isset($getAssetsRepairData['actions_performed']) && ($getAssetsRepairData['actions_performed'] != '')) ? $getAssetsRepairData['actions_performed'] : ''; ?>
                                  </textarea>
                            <label id="actions_performed-error" class="validation-error-label"
                                   for="actions_performed"></label>

                        </div>


                    </div>
                </div>
            </div>
        </fieldset>
        <!-- End Assets Repair Details -->


        <!--  Item Details -->
        <fieldset class="content-group">
            <legend class="text-bold"> <?= lang('item_details') ?> </legend>

            <div class="form-group">

                <div class="table-responsive table-bordered table-framed">

                    <table id="itemTable" class="table table-bordered table-framed" cellspacing="0" width="100%">
                        <thead>


                        <tr>
                            <th><?= lang('item_code') ?></th>
                            <th><?= lang('issue_date') ?></th>
                            <th><?= lang('issue_quantity') ?></th>
                            <th><?= lang('issue_to') ?></th>
                            <th><?= lang('action') ?></th>
                        </tr>

                        </thead>
                        <tbody>
                        <tr data-id="tr_0">

                            <td>
                                <input type='hidden' name='item_mapper_id[]' id='id_0' />
                                <select data-placeholder="Select Your <?= lang('item_code') ?>" name="item_code_add[]" id="item_code_add" class="item_DD">
                                    <option value=""></option>
                                </select>
                            </td>

                            <td><input type="text" class="form-control issueDate" name="issue_date[]" id="issue_date"
                                       placeholder="Please Select <?= lang('issue_date') ?>&hellip;">
                            </td>


                            <td>
                                <input type="tel" class="form-control numberInit" name="issue_quantity[]"
                                       id="issue_quantity" placeholder="Please Enter <?= lang('issue_quantity') ?>">
                            </td>
                            <td>

                                <select data-placeholder="Select Your <?= lang('issue_to') ?>" name="issue_to[]"  id="issue_to" class="issue_to">
                                    <option value=""></option>
<!--                                    --><?//= CreateOptions("html", "tbl_users", array('id', 'concat(first_name," ",last_name)')); ?>
                                </select>
                            </td>

                            <td><a data-popup='custom-tooltip' data-original-title="<?= lang('add_item') ?>"
                                   title="<?= lang('add_item') ?>" onclick="AddItemRow()"
                                   class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded ">
                                    <i class="icon-plus3"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </fieldset>
        <!-- End Item Details -->


        <!-- create reset button-->
        <div class="text-right">
            <button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
                    onclick="window.location.href='<?php echo site_url('AssetsRepair'); ?>'"><?= lang('cancel_btn') ?>
                <i class="icon-cross2 position-right"></i></button>

            <button type="submit"
                    class="btn btn-xs border-blue text-blue btn-flat btn-ladda btn-ladda-progress submit"
                    data-spinner-color="<?= BTN_SPINNER_COLOR ?>" data-style="fade">
                <span class="ladda-label"><?= lang('submit_btn') ?></span>
                <i id="icon-hide" class="icon-arrow-right8 position-right"></i>

        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    function DateInit() {
        $(".issueDate").datepicker({
            dateFormat: "<?= DATE_FORMATE ?>",
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            minDate: "<?= isset($getAssetsRepairData['failure_date']) ? $getAssetsRepairData['failure_date'] : TODAY_DATE ?>",
            onSelect: function (selected) {
                if ($(this).valid()) {
                    $(this).removeClass('invalid').addClass('success');
                }
            }
        });
    }

    function itemSelect2Init() {
        //Ajax send item code
        $(".item_DD").select2({
            ajax: {
                url: "<?= site_url('Item/getItem') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '', // search term
//                        item_id: "<?//= isset($getQuotationData['lead_id']) ? $getQuotationData['lead_id'] : ''; ?>//",
                        page: params.page || 1,
                        condition: {maintain_stock: 0, is_fixed_asset: 1}
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
    function userSelect2Init() {
        $(".issue_to").select2({

            ajax: {
                url: "<?= site_url('Auth/getUsersDD') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '', // search term
                        user_id: "<?= isset($getQualityInspectionData['inspector_id']) ? $getQualityInspectionData['inspector_id'] : ''; ?>",
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
            // allowClear: true

        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });
    }

    var index = <?php echo (isset($getAssetsRepairData) && !empty($getAssetsRepairData)) ? count($getAssetsRepairData) : 0; ?>;

    function AddItemRow() {
        var lastIndex = $("#itemTable tr:last").data("id").split("_").pop();
        index = parseInt(lastIndex) + 1;

        var html = "<tr data-id='tr_" + index + "'>";

        html += "<td>" +
            "<input type='hidden' name='item_mapper_id[]' id='id_" + index + "' />" +
            "<select data-placeholder='Select Your <?= lang('item_code') ?>' name='item_code_add[]' id='item_code_add_" + index + "' class='item_DD'>" +
            "<option value=''></option>" +
            "</select>" +
            "</td>" +

            "<td>" +
            "<input type='text' class='form-control issueDate' name='issue_date[]' id='issue_date_" + index + "'  placeholder='Please Select <?= lang('issue_date') ?>&hellip;'>"+
            "</td>" +

            "<td>" +
            "<input type='tel' class='form-control numberInit' name='issue_quantity[]'  id='issue_quantity_" + index + "' placeholder='Please Enter <?= lang('issue_quantity') ?>'>" +
            "</td>" +

            "<td>" +
            "<select data-placeholder='Select Your <?= lang('issue_to') ?>' name='issue_to[]' id='issue_to_" + index + "' class='issue_to'>" +
            "<option value=''></option>" +
            "</select>" +
            "</td>" +

            "<td><a data-popup='custom-tooltip' data-original-title='<?= lang('delete_item') ?>'  title='<?= lang('delete_item') ?>' class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded DeleteItemRow'><i class='icon-trash'></i></a></td>" +
            "</tr>";

        $('table#itemTable tbody').append(html);
        itemSelect2Init();
        userSelect2Init();
        numberInit();
        DateInit();
        CustomToolTip();
        Select2Init();


    }

    $(document).on('click', '.DeleteItemRow', function () {
        var trField = $(this).closest('tr');

        var id = $(this).closest('tr').find("input[type=hidden]").val();

        if (id != '') {
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
                    url: "<?php echo site_url($this->uri->segment(1) . '/deleteItemRow');?>",
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
        } else {
            $(trField).remove();
        }
    });

</script>


<!--  Assets  change to item code and item name fill in ajax -->
<script>

    $(document).on('change', '#assets_id', function () {
        var assetsId = $('#assets_id').val();
        $.ajax({
            url: "<?php echo site_url('AssetsRepair/getAssetsItemName');?>",
            type: 'POST',
            data: {assetsId: assetsId},
            dataType: 'json',
            success: function (data) {
                if (data) {
                    $('#item_name').val(data['item_name']);
                    $('#item_code').val(data['item_code']);
                    $('#item_id').val(data['item_id']);
                    if ($('#item_name,#item_code').valid()) {
                        $('#item_name,#item_code').removeClass('invalid').addClass('success');
                    }
                } else {
                    $('#item_name').val('');
                    $('#item_id').val('');
                    $('#item_code').val('');
                }

            }
        });
    });

    $(document).on('change', '#assign_to', function () {
        var assignTo = $('#assign_to option:selected').text();
        $('#assign_to_name').val(assignTo);
    });
</script>
<!-- Assets  change to item code and item name fill in ajax  -->


<script>
    var laddaSubmitBtn = Ladda.create(document.querySelector('.submit'));

    $(document).ready(function () {
        Select2Init();
        numberInit();
        CustomToolTip();
        itemSelect2Init();
        userSelect2Init();
        DateInit();



        //  load data edit time assets repair item
        <?php if(isset($getAssetsRepairItemData) && !empty($getAssetsRepairItemData) && $html != ''){ ?>
        $('table#itemTable tbody').html("<?= $html ?>");
        CustomToolTip();
        itemSelect2Init();
        userSelect2Init();
        DateInit();
        Select2Init();
        <?php } ?>

        <?php if((isset($getAssetsRepairItemData) && !empty($getAssetsRepairItemData))){
        foreach ($getAssetsRepairItemData as $key => $value){
        ?>
        var option = new Option("<?= $value['item_code']; ?>","<?= $value['item_id']; ?>", true, true);
        $('#itemTable tbody').find("tr:eq(<?= $key; ?>) select:first").append(option).trigger('change');

        var useroption = new Option("<?= $value['name']; ?>","<?= $value['issue_to']; ?>", true, true);
        $('#itemTable tbody').find("tr:eq(<?= $key; ?>) select:last").append(useroption).trigger('change');

        <?php } } ?>





        $("#failure_date").datepicker({
            dateFormat: "<?= DATE_FORMATE ?>",
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            // minDate: new Date(),
            onSelect: function (selected) {
                if ($(this).valid()) {
                    $(this).removeClass('invalid').addClass('success');
                }
            },
            onClose: function (selectedDate) {
                $("#completion_date").datepicker("option", "minDate", selectedDate);
            }

        });



        $("#assign_to").select2({

            ajax: {
                url: "<?= site_url('Auth/getUsersDD') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '', // search term
                        user_id: "<?= isset($getQualityInspectionData['inspector_id']) ? $getQualityInspectionData['inspector_id'] : ''; ?>",
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
           // allowClear: true

        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });

        <?php if(isset($getAssetsRepairData['name']) && $getAssetsRepairData['name'] != ''){ ?>
        var inspectorOption = new Option("<?= $getAssetsRepairData['name']; ?>","<?= $getAssetsRepairData['assign_to']; ?>", true, true);
        $('#assign_to').append(inspectorOption).trigger('change');
        <?php } ?>

        $("#completion_date").datepicker({
            dateFormat: "<?= DATE_FORMATE ?>",
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            minDate: "<?= isset($getAssetsRepairData['failure_date']) ? $getAssetsRepairData['failure_date'] : TODAY_DATE ?>",
            onSelect: function (selected) {
                if ($(this).valid()) {
                    $(this).removeClass('invalid').addClass('success');
                }
            },
            onClose: function (selectedDate) {
                $("#completion_date").datepicker("option", "minDate", selectedDate);
            }

        });



        // Initialize
        var validator = $("#assetsRepairDetails").validate({
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-error-label',
            successClass: 'validation-valid-label',
            highlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },

            // Different components require proper error label placement
            errorPlacement: function (error, element) {

                // Styled checkboxes, radios, bootstrap switch
                if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container')) {
                    if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                        error.appendTo(element.parent().parent().parent().parent());
                    }
                    else {
                        error.appendTo(element.parent().parent().parent().parent().parent());
                    }
                }

                // Unstyled checkboxes, radios
                else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                    error.appendTo(element.parent().parent().parent());
                }

                // Input with icons and Select2
                else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                }

                // Inline checkboxes, radios
                else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo(element.parent().parent());
                }

                // Input group, styled file input
                else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                    error.appendTo(element.parent().parent());
                }

                else {
                    error.insertAfter(element);
                }
            },
            validClass: "validation-valid-label",
            success: function (label) {
                label.addClass("validation-valid-label").text("Success.")
            },
            rules: {
                series: {
                    required: true,
                },
                assets_id: {
                    required: true,
                },
                item_code: {
                    required: true,
                },
                item_name: {
                    required: true,
                },
                status_id: {
                    required: true,
                },
                failure_date: {
                    required: true,
                },
                assign_to: {
                    required: true,
                },
                error_description: {
                    required: function (textarea) {
                        CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                        var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                        return editorcontent.length === 0;
                    }
                },
                "item_code_add[]": {
                    required: true,
                },
                "issue_date[]": {
                    required: true,
                },
                "issue_quantity[]": {
                    required: true,
                },
                "issue_to[]": {
                    required: true,
                }


            },
            messages: {
                series: {
                    required: "Please Enter <?= lang('series') ?>",
                },
                assets_id: {
                    required: "Please Select <?= lang('assets_name') ?>",
                },
                item_code: {
                    required: "Please Select <?= lang('item_code') ?>",
                },
                item_name: {
                    required: "Please Select <?= lang('item_name') ?>",
                },
                status_id: {
                    required: "Please Select <?= lang('repair_status') ?>",
                },
                failure_date: {
                    required: "Please Select <?= lang('failure_date') ?>",
                },
                assign_to: {
                    required: "Please Select <?= lang('assign_to') ?>"
                },

                error_description: {
                    required: "Please Enter <?= lang('error_description') ?>",
                },
                "item_code_add[]": {
                    required: "Please Select <?= lang('item_code') ?>"
                },
                "issue_date[]": {
                    required: "Please Select <?= lang('issue_date') ?>"
                },
                "issue_quantity[]": {
                    required: "Please Enter <?= lang('issue_quantity') ?>",
                },
                "issue_to[]": {
                    required: "Please Select <?= lang('issue_to') ?>"
                }

            },
            submitHandler: function (e) {
                $('textarea.ckeditor').each(function () {
                    var $textarea = $(this);
                    $textarea.val(CKEDITOR.instances[$textarea.attr('name')].getData());
                });

                $(e).ajaxSubmit({
                    url: '<?php echo site_url("AssetsRepair/save");?>',
                    type: 'post',
                    beforeSubmit: function (formData, jqForm, options) {
                        laddaStart();
                    },
                    complete: function () {
                        laddaStop();
                    },
                    dataType: 'json',
                    clearForm: false,
                    success: function (resObj) {
                        if (resObj.success) {
                            swal({
                                title: "<?= ucwords(lang('success')); ?>",
                                text: resObj.msg,
                                confirmButtonColor: "<?= BTN_SUCCESS; ?>",
                                type: "<?= lang('success'); ?>"
                            }, function () {
                                window.location.href = '<?php echo site_url('AssetsRepair');?>';
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
            }
        });
        SwitcheryKeyGen();
    });
</script>

