<?php
$html = '';
if (isset($getDepreciationScheduleAssetsData) && !empty($getDepreciationScheduleAssetsData)) {
    foreach ($getDepreciationScheduleAssetsData as $key => $value) {
        $index = $key + 1;
        if ($key == 0) {
            $button = "<a data-popup='custom-tooltip'  title='" . lang('add_schedule') . "' data-original-title='" . lang('add_schedule') . "'  onclick='AddScheduleRow()' class='btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded'><i class='icon-plus3'></i></a>";
        } else {
            $button = "<a data-popup='custom-tooltip' title='" . lang('delete_schedule') . "' data-original-title='" . lang('delete_schedule') . "'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded DeleteScheduleRow'><i class='icon-trash'></i></a>";
        }

        $html .= "<tr data-id='tr_" . $index . "'>" .
            "<td>" .
            "<input type='hidden'  id='id_" . $index . "' name='schedule_mapper_id[]' value='" . $value['schedule_mapper_id'] . "'>" .
            "<input type='tel' class='form-control scheduleDate' name='schedule_date[]' value='" . $value['schedule_date'] . "' id='schedule_date_" . $index . "'  placeholder='Please Select" . lang('schedule_date') . "'>" .
            "</td>" .

            "<td>" .
            "<input type='tel' class='form-control numberInit' name='depreciation_amount[]' value='" . $value['depreciation_amount'] . "' id='depreciation_amount_" . $index . "'  placeholder='Please Enter" . lang('depreciation_amount') . "'>" .
            "</td>" .


            "<td>" .
            "<input type='tel' class='form-control' name='accumulated_depreciation[]' value='" . $value['accumulated_depreciation'] . "' id='accumulated_depreciation_" . $index . "'  placeholder='" . lang('accumulated_depreciation') . "' readonly>" .
            "</td>" .

            "<td>" .
            "<input type='tel' class='form-control' name='journal_entry[]' value='" . $value['journal_entry'] . "' id='journal_entry_" . $index . "'  placeholder='" . lang('journal_entry') . "' readonly>" .
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
        <h5 class="panel-title"><?= lang('assets_form') ?> </h5>
    </div>

    <div class="panel-body">
        <?php
        //create  form open tag
        $form_id = array(
            'id' => 'assetsDetails',
            'method' => 'post',
            'autocomplete' => 'off'
        );
        echo form_open_multipart('', $form_id);
        ?>

        <input type="hidden" name="assets_id"
               value="<?= isset($getAssetsData['assets_id']) ? $getAssetsData['assets_id'] : '' ?>" id="assets_id">

        <!--  Assets Details-->
        <fieldset class="content-group">
            <legend class="text-bold"> <?= lang('assets_details'); ?>  </legend>

            <div class="form-group">

                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label><?= lang('assets_name') ?></label>
                            <input type="text" class="form-control" name="assets_name" id="assets_name"
                                   value="<?= isset($getAssetsData['assets_name']) ? $getAssetsData['assets_name'] : '' ?>"
                                   placeholder="Please Enter <?= lang('assets_name') ?>">
                        </div>


                        <div class="form-group">
                            <label><?= lang('item_code') ?></label>
                            <select data-placeholder="Your <?= lang('item_code') ?>" name="item_id" id="item_id"
                                    class="item_DD">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><?= lang('item_name') ?></label>
                            <input type="text" class="form-control" name="item_name" id="item_name"
                                   value="<?= isset($getAssetsData['item_name']) ? $getAssetsData['item_name'] : '' ?>"
                                   placeholder="<?= lang('item_name') ?>" readonly>
                        </div>


                        <div class="form-group">
                            <label><?= lang('status') ?></label>
                            <select data-placeholder="Your <?= lang('status') ?>" name="status_id" id="status_id"
                                    class="select">
                                <option value=""></option>
                                <?= CreateOptions("html", "tbl_status", array('status_id', 'status_name'), isset($getAssetsData['status_id']) ? $getAssetsData['status_id'] : '', '', array('status_type' => 'assets')); ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label><?= lang('company') ?></label>
                            <select data-placeholder="Your <?= lang('company') ?>" name="company_id"
                                    id="company_id" class="select">
                                <option value=""></option>
                                <!--                                --><? //= CreateOptions("html", "tbl_company", array('company_id', 'company_name'),isset($getLeadData['company_id']) ? $getLeadData['company_id'] : ''); ?>
                                <?= CreateOptions("html", "tbl_company", array('company_id', 'company_name'), isset($this->session->userdata['company_id']) ? $this->session->userdata('company_id') : '', '', isset($this->session->userdata['company_id']) ? 'company_id=' . $this->session->userdata("company_id") : ''); ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <input type="checkbox" name="calculate_depreciation" id="calculate_depreciation"
                                <?= isset($getAssetsData['calculate_depreciation']) && $getAssetsData['calculate_depreciation'] == 1 ? "checked" : '' ?>
                                   class="styled">
                            <label><?= lang('calculate_depreciation') ?></label>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label><?= lang('warehouse') ?></label>
                            <select data-placeholder="Your <?= lang('warehouse') ?>" name="warehouse_id"
                                    id="warehouse_id" class="select">
                                <option value=""></option>
                                <?= CreateOptions("html", "tbl_warehouse", array('warehouse_id', 'warehouse_name'), isset($getAssetsData['warehouse_id']) ? $getAssetsData['warehouse_id'] : ''); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><?= lang('purchase_date') ?></label>
                            <input type="text" class="form-control" name="purchase_date" id="purchase_date"
                                   value="<?= isset($getAssetsData['purchase_date']) ? $getAssetsData['purchase_date'] : '' ?>"
                                   placeholder="Pick a date&hellip;" readonly>
                        </div>

                        <div class="form-group">
                            <label><?= lang('department') ?></label>
                            <select data-placeholder="Your <?= lang('department') ?>" name="department_id"
                                    id="department_id" class="select">
                                <option value=""></option>
                                <?= CreateOptions("html", "tbl_department", array('department_id', 'department_name'), isset($getAssetsData['department_id']) ? $getAssetsData['department_id'] : ''); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><?= lang('gross_purchase_amount') ?></label>
                            <input type="tel" class="form-control numberInit" name="gross_purchase_amount"
                                   id="gross_purchase_amount"
                                   value="<?= isset($getAssetsData['gross_purchase_amount']) ? $getAssetsData['gross_purchase_amount'] : '' ?>"
                                   placeholder="Please Enter <?= lang('gross_purchase_amount') ?>">
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="is_maintenance_require" id="is_maintenance_require"
                                <?= isset($getAssetsData['is_maintenance_require']) && $getAssetsData['is_maintenance_require'] == 1 ? "checked" : '' ?>
                                   class="styled">
                            <label><?= lang('is_maintenance_require') ?></label>
                            <span class="help-block"><?= lang('help_maintenance') ?></span>

                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="is_existing_assets" id="is_existing_assets"
                                <?= isset($getAssetsData['is_existing_assets']) && $getAssetsData['is_existing_assets'] == 1 ? "checked" : '' ?>
                                   class="styled">
                            <label><?= lang('is_existing_assets') ?></label>

                        </div>

                    </div>
                </div>
            </div>
        </fieldset>
        <!-- End Assets Details -->

        <!--  Calculate Depreciation -->
        <fieldset class="content-group" style="display: none" id="depreciationMethod">
            <!--            <legend class="text-bold"> --><? //= lang('assets_details'); ?><!--  </legend>-->

            <div class="form-group">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?= lang('depreciation_method') ?></label>
                            <select data-placeholder="Your <?= lang('depreciation_method') ?>"
                                    name="depreciation_method" id="depreciation_method" class="select">
                                <option value=""></option>
                                <?= CreateOptionFromEnumValues(enumValues("tbl_assets", "depreciation_method"), isset($getAssetsData['depreciation_method']) ? $getAssetsData['depreciation_method'] : ''); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><?= lang('total_no_of_depreciation') ?></label>
                            <input type="tel" class="form-control numberInit" name="total_no_of_depreciation"
                                   id="total_no_of_depreciation"
                                   value="<?= isset($getAssetsData['total_no_of_depreciation']) ? $getAssetsData['total_no_of_depreciation'] : '' ?>"
                                   placeholder="Please Enter <?= lang('total_no_of_depreciation') ?>">
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label><?= lang('frequency_of_depreciation') ?></label>
                            <input type="tel" class="form-control numberInit" name="frequency_of_depreciation"
                                   id="frequency_of_depreciation"
                                   value="<?= isset($getAssetsData['frequency_of_depreciation']) ? $getAssetsData['frequency_of_depreciation'] : '' ?>"
                                   placeholder="Please Enter <?= lang('frequency_of_depreciation') ?>">
                        </div>


                        <div class="form-group">
                            <label><?= lang('next_depreciation_date') ?></label>
                            <input type="text" class="form-control" name="next_depreciation_date"
                                   id="next_depreciation_date"
                                   value="<?= isset($getAssetsData['next_depreciation_date']) && $getAssetsData['next_depreciation_date'] != '01-01-1970' && $getAssetsData['next_depreciation_date'] != '00-00-0000' ? $getAssetsData['next_depreciation_date'] : date('d-m-Y') ?>"
                                   placeholder="Pick a date&hellip;" readonly>
                        </div>


                    </div>
                </div>
            </div>
        </fieldset>
        <!-- End Calculate Depreciation -->



        <!--  Depreciation Schedule Details -->
        <fieldset class="content-group" id="depreciationSchedule">
            <legend class="text-bold"> <?= lang('depreciation_schedule'); ?> </legend>

            <div class="form-group">

                <div class="table-responsive table-bordered table-framed">

                    <table id="depreciationScheduleTable" class="table table-bordered table-framed" cellspacing="0" width="100%">
                        <thead>


                        <tr>
                            <th><?= lang('schedule_date') ?></th>
                            <th><?= lang('depreciation_amount') ?></th>
                            <th><?= lang('accumulated_depreciation') ?></th>
                            <th><?= lang('journal_entry') ?></th>
                            <th><?= lang('action') ?></th>
                        </tr>

                        </thead>
                        <tbody>
                        <tr data-id="tr_0">
                            <td>
                                <input type='hidden' name='schedule_mapper_id[]' id='id_0' />
                                <input type="tel" class="form-control scheduleDate" name="schedule_date[]" id="schedule_date" placeholder="Please Select <?= lang('schedule_date') ?>&hellip;" >
                            </td>

                            <td>
                                <input type="tel" class="form-control numberInit" name="depreciation_amount[]"
                                       id="depreciation_amount" placeholder="Please Enter <?= lang('depreciation_amount') ?>">
                            </td>
                            <td>
                                <input type="tel" class="form-control" name="accumulated_depreciation[]" id="accumulated_depreciation"
                                       placeholder="<?= lang('accumulated_depreciation') ?>" readonly>
                            </td>
                            <td>
                                <input type="tel" class="form-control" name="journal_entry[]" id="journal_entry"
                                       placeholder="<?= lang('journal_entry') ?>" readonly>
                            </td>
                            <td>
                                <a data-popup='custom-tooltip' data-original-title="<?= lang('add_schedule') ?>"
                                   title="<?= lang('add_schedule') ?>" onclick="AddScheduleRow()"
                                   class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded "><i
                                            class="icon-plus3"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </fieldset>
        <!--  END Depreciation Schedule Details -->


        <!-- create reset button-->
        <div class="text-right">
            <button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
                    onclick="window.location.href='<?php echo site_url('Asset'); ?>'"><?= lang('cancel_btn') ?> <i
                        class="icon-cross2 position-right"></i></button>

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
        $(".scheduleDate").datepicker({
            dateFormat: "<?= DATE_FORMATE ?>",
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            minDate: "<?= isset($getAssetsData['purchase_date']) ? $getAssetsData['purchase_date'] : TODAY_DATE ?>",
            onSelect: function (selected) {
                if ($(this).valid()) {
                    $(this).removeClass('invalid').addClass('success');
                }
            },
        });
    }


    var index = <?php echo (isset($getAssetsData) && !empty($getAssetsData)) ? count($getAssetsData) : 0; ?>;

    function AddScheduleRow() {

        var lastIndex = $("#depreciationScheduleTable tr:last").data("id").split("_").pop();
        index = parseInt(lastIndex) + 1;

        var html = "<tr data-id='tr_" + index + "'>";

        html += "<td>" +
            "<input type='hidden' name='schedule_mapper_id[]' id='id_" + index + "' />" +
            "<input type='tel' class='form-control scheduleDate' name='schedule_date[]' id='schedule_date_" + index + "'  placeholder='Please Select <?= lang('schedule_date') ?>&hellip;'></td>" +
            "<td>" +
            "<input type='tel' class='form-control numberInit' name='depreciation_amount[]'  id='depreciation_amount_" + index + "' placeholder='Please Enter <?= lang('depreciation_amount') ?>'>" +
            "</td>" +
            "<td>" +
            "<input type='tel' class='form-control' name='accumulated_depreciation[]' id='accumulated_depreciation_" + index + "' placeholder='<?= lang('accumulated_depreciation') ?>' readonly>"+
            "</td>" +
            "<td>" +
            "<input type='tel' class='form-control' name='journal_entry[]' id='journal_entry_" + index + "' placeholder='<?= lang('journal_entry') ?>' readonly>" +
            "</td>" +
            "<td>" +
            "<a data-popup='custom-tooltip' data-original-title='<?= lang('delete_schedule') ?>'  title='<?= lang('delete_schedule') ?>' class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded DeleteScheduleRow'><i class='icon-trash'></i></a>" +
            "</td>" +
            "</tr>";

        $('table#depreciationScheduleTable tbody').append(html);
        numberInit();
        DateInit();
        CustomToolTip();

    }


    $(document).on('click', '.DeleteScheduleRow', function () {
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
                    url: "<?php echo site_url($this->uri->segment(1) . '/deleteScheduleRow');?>",
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



<script>

//    jQuery.fn.loadAndClick = function (event, handler) {
//        handler();
//        this.bind(event, handler);
//        return this; // support chaining
//    };
//
//    $(function () {
//        $('#calculate_depreciation').loadAndClick('click', function () {
//            if ($('#calculate_depreciation').is(':checked')) {
//                $("#depreciationMethod").show();
//             //   $("#depreciation_method").val('').trigger('change');
//
//                $("#depreciation_method-error").html('');
//
//            } else {
//                $("#depreciationMethod").hide();
//                $("#depreciation_method").val('').trigger('change');
//              //  $('#depreciation_method').trigger('change');
//                $("#depreciation_method-error").html('');
//            }
//        });
//    });

//    $('#calculate_depreciation').bind('load click', function () {
//        if ($('#calculate_depreciation').is(':checked')) {
//            $("#depreciationMethod").show();
//            //   $("#depreciation_method").val('').trigger('change');
//
//            $("#depreciation_method-error").html('');
//
//        } else {
//            $("#depreciationMethod").hide();
//            $("#depreciation_method").val('').trigger('change');
//            $('#depreciation_method').trigger('change');
//            $("#depreciation_method-error").html('');
//        }
//    });
//
//
//        $('#depreciation_method').bind('load change', function () {
//            var depreciationMethod = $("#depreciation_method").val();
//            if (depreciationMethod == 'manual') {
//                $('#depreciationSchedule').show();
//            } else{
//                $('#depreciationSchedule').hide();
//            }
//        });


    jQuery.fn.loadAndClick = function (event, handler) {
        handler();
        this.bind(event, handler);
        return this; // support chaining
    };

    $(function () {
        $('#calculate_depreciation').loadAndClick('click', function () {
            if ($('#calculate_depreciation').is(':checked')) {
                $("#depreciationMethod").show();
             //   $("#depreciation_method").val('').trigger('change');

                $("#depreciation_method-error").html('');

            } else {
                $("#depreciationMethod").hide();
                $("#depreciation_method").val('').trigger('change');
                $('#depreciation_method').trigger('change');
                $("#depreciation_method-error").html('');
            }
        });
    });


    jQuery.fn.loadandchange = function (event, handler) {
        handler();
        this.bind(event, handler);
        return this; // support chaining
    };

    $(function () {
        $('#depreciation_method').loadandchange('change', function () {
            var depreciationMethod = $("#depreciation_method").val();
            if (depreciationMethod == 'manual') {
                $('#depreciationSchedule').show();
            } else{
                $('#depreciationSchedule').hide();
            }
        });
    });


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
                        item_id: "<?= isset($itemMaterialRequestItemData['item_id']) ? $itemMaterialRequestItemData['item_id'] : ''; ?>",
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
</script>

<!-- item code change to item name fill in ajax-->
<script>

    $(document).on('change', '#item_id', function () {
        var itemId = $('#item_id').val();
        $.ajax({
            url: "<?php echo site_url('Asset/getItemName');?>",
            type: 'POST',
            data: {itemId: itemId},
            dataType: 'json',
            success: function (data) {
                if (data) {
                    $('#item_name').val(data['item_name']);
                } else {
                    $('#item_name').val('');
                }

            }
        });
    });
</script>
<!-- item code change to item name fill in ajax -->


<script>
    var laddaSubmitBtn = Ladda.create(document.querySelector('.submit'));

    $(document).ready(function () {
        itemSelect2Init();
        Select2Init();
        CheckboxKeyGen();
        numberInit();
        DateInit();
        CustomToolTip();


        $("#purchase_date").datepicker({
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
                $("#next_depreciation_date").datepicker("option", "minDate", selectedDate);
                $(".scheduleDate").datepicker("option", "minDate", selectedDate);
            }

        });

        $("#next_depreciation_date").datepicker({
            dateFormat: "<?= DATE_FORMATE ?>",
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            minDate: "<?= isset($getAssetsData['purchase_date']) ? $getAssetsData['purchase_date'] : TODAY_DATE ?>",
            onSelect: function (selected) {
                //alert();
                if ($(this).valid()) {
                    $(this).removeClass('invalid').addClass('success');
                }
            },


        });


        <?php if(isset($getDepreciationScheduleAssetsData) && !empty($getDepreciationScheduleAssetsData) && $html != ''){ ?>
        $('table#depreciationScheduleTable tbody').html("<?= $html ?>");
        numberInit();
        DateInit();
        CustomToolTip();
        <?php } ?>


        <?php if((isset($getAssetsData['item_code']) && ($getAssetsData['item_code'] != ''))){ ?>
        var option = new Option("<?= $getAssetsData['item_code']; ?>","<?= $getAssetsData['item_id']; ?>", true, true);
        $('#item_id').append(option).trigger('change.select2');
        <?php } ?>




        // Initialize
        var validator = $("#assetsDetails").validate({
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
                assets_name: {
                    required: true,
                    remote: {
                        url: "<?php echo site_url("Asset/NameExist");?>",
                        type: "post",
                        data: {
                            column_name: function () {
                                return "assets_name";
                            },
                            column_id: function () {
                                return $("#assets_id").val();
                            },
                            table_name: function () {
                                return "tbl_assets";
                            }
                        }
                    }
                },
                item_id: {
                    required: true,
                },
                status_id: {
                    required: true,
                },
                company_id: {
                    required: true,
                },
                warehouse_id: {
                    required: true,
                },
                purchase_date: {
                    required: true,
                },
                department_id: {
                    required: true,
                },
                gross_purchase_amount: {
                    required: true,
                },
                depreciation_method: {
                    required: function (element) {
                        if ($("#calculate_depreciation").is(':checked')) {
                            return true;
                        }
                    }
                },
                frequency_of_depreciation: {
                    required: function (element) {
                        if ($("#calculate_depreciation").is(':checked')) {
                            return true;
                        }
                    }
                },
                total_no_of_depreciation: {
                    required: function (element) {
                        if ($("#calculate_depreciation").is(':checked')) {
                            return true;
                        }
                    }
                },
                next_depreciation_date: {
                    required: function (element) {
                        if ($("#calculate_depreciation").is(':checked')) {
                            return true;
                        }
                    }
                },
                "schedule_date[]": {
                    required: {
                        depends: function (element) {
                            return $("#depreciation_method").val() == "manual";
                        }
                    }
                },
                "depreciation_amount[]": {
                    required: {
                        depends: function (element) {
                            return $("#depreciation_method").val() == "manual";
                        }
                    }
                },



            },
            messages: {
                assets_name: {
                    required: "Please Enter <?= lang('assets_name') ?>",
                    remote: "<?= lang('assets_name') ?> Already Exist",
                },
                item_id: {
                    required: "Please Select <?= lang('item_code') ?>",
                },
                status_id: {
                    required: "Please Select <?= lang('status') ?>",
                },
                company_id: {
                    required: "Please Select <?= lang('company') ?>",
                },
                warehouse_id: {
                    required: "Please Select <?= lang('warehouse') ?>"
                },
                purchase_date: {
                    required: "Please Select <?= lang('purchase_date') ?>"
                },
                department_id: {
                    required: "Please Select <?= lang('department') ?>"
                },
                gross_purchase_amount: {
                    required: "Please Enter <?= lang('gross_purchase_amount') ?>",
                },
                depreciation_method: {
                    required: "Please Select <?= lang('depreciation_method') ?>"
                },
                frequency_of_depreciation: {
                    required: "Please Enter <?= lang('frequency_of_depreciation') ?>"
                },
                total_no_of_depreciation: {
                    required: "Please Enter <?= lang('total_no_of_depreciation') ?>"
                },
                next_depreciation_date: {
                    required: "Please Enter <?= lang('next_depreciation_date') ?>"
                },
                "schedule_date[]": {
                    required: "Please Select <?= lang('schedule_date') ?>"
                },
                "depreciation_amount[]": {
                    required: "Please Enter <?= lang('depreciation_amount') ?>"
                },
            },
            submitHandler: function (e) {
                $(e).ajaxSubmit({
                    url: '<?php echo site_url("Asset/save");?>',
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
                                window.location.href = '<?php echo site_url('Asset');?>';
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

