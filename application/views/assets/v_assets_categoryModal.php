<!-- assets category modal code here -->
<div id="assetsCategoryModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><?= lang('assets_category_form') ?></h5>
            </div>

            <div class="modal-body">
                <?php
                $form_id = array(
                    'id' => 'assetsCategoryDetails',
                    'method' => 'post',
                    'class' => 'form-horizontal'
                ); ?>
                <?= form_open('', $form_id); ?>
                <input type="hidden" name="assets_category_id" id="assets_category_id">

                <!-- assets category name -->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('assets_category_name') ?></label>
                    <div class="col-lg-9">
                        <input type="text" name="assets_category_name" id="assets_category_name" class="form-control"
                               placeholder="Enter <?= lang('assets_category_name') ?>">

                    </div>
                </div>


                <!-- payment Mode type -->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('depreciation_method') ?></label>
                    <div class="col-lg-9">
                        <select data-placeholder="Select Your <?= lang('depreciation_method') ?>"
                                name="depreciation_method" id="depreciation_method" class="select">
                            <option value=""></option>
                            <?= CreateOptionFromEnumValues(enumValues("tbl_assets", "depreciation_method"), isset($getAssetsData['depreciation_method']) ? $getAssetsData['depreciation_method'] : ''); ?>
                        </select>
                    </div>
                </div>

                <!-- frequency of depreciation -->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('frequency_of_depreciation') ?></label>
                    <div class="col-lg-9">
                    <input type="tel" class="form-control numberInit" name="frequency_of_depreciation"
                           id="frequency_of_depreciation"
                           value="<?= isset($getAssetsData['frequency_of_depreciation']) ? $getAssetsData['frequency_of_depreciation'] : '' ?>"
                           placeholder="Please Enter <?= lang('frequency_of_depreciation') ?>">
                    </div>
                </div>


                <!-- total no of depreciation -->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('total_no_of_depreciation') ?></label>
                    <div class="col-lg-9">
                    <input type="tel" class="form-control numberInit" name="total_no_of_depreciation"
                           id="total_no_of_depreciation"
                           value="<?= isset($getAssetsData['total_no_of_depreciation']) ? $getAssetsData['total_no_of_depreciation'] : '' ?>"
                           placeholder="Please Enter <?= lang('total_no_of_depreciation') ?>">
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="reset" name="cancel"
                        class="btn btn-xs border-slate text-slate btn-flat cancel"
                        data-dismiss="modal"><?= lang('cancel_btn') ?> <i class="icon-cross2 position-right"></i>
                </button>
                <button type="submit"
                        class="btn btn-xs border-blue text-blue btn-flat btn-ladda btn-ladda-progress submit"
                        data-spinner-color="<?= BTN_SPINNER_COLOR ?>" data-style="fade"><span
                            class="ladda-label"><?= lang('submit_btn') ?></span>
                    <i id="icon-hide" class="icon-arrow-right8 position-right"></i>
                </button>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<!--  add and update modal code here-->
<script>
    var laddaSubmitBtn = Ladda.create(document.querySelector('.submit'));

    $(document).on('hide.bs.modal', '#assetsCategoryModal', function () {
        $('#assetsCategoryTable input').prop('checked', false);
        CheckboxKeyGen();
    });

    //Delete Time Cancel button click to remove checked value
    $(document).on('click', '.cancel', function () {
        $('#assetsCategoryTable input[class="dt-checkbox styled"]').prop('checked', false);
        CheckboxKeyGen();
    });

    $(document).ready(function () {
        CustomToolTip();
        CheckboxKeyGen('checkAll');
        Select2Init();
        numberInit();

        //$('#checkAll').prop('checked', false);
        $('#checkAll').click(function () {
            var checkedStatus = this.checked;
            $('#assetsCategoryTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
            CheckboxKeyGen();
        });


        $('#assetsCategoryModal').on('shown.bs.modal', function () {
            $('#assets_category_name').focus();
        });

        //assets category modal open
        $('.addAssetsCategory').click(function () {
            DtFormClear('assetsCategoryDetails');
            $("form#assetsCategoryDetails input[name=assets_category_id]").val('');
            $('#assetsCategoryModal').modal('show');
        });

        //AssetsCategory modal validation
        var validator = $("#assetsCategoryDetails").validate({
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
                assets_category_name: {
                    required: true,
                    remote: {
                        url: "<?php echo site_url( "AssetsCategory/NameExist");?>",
                        type: "post",
                        data: {
                            column_name: function () {
                                return "assets_category_name";
                            },
                            column_id: function () {
                                return $("#assets_category_id").val();
                            },
                            table_name: function () {
                                return "tbl_assets_category";
                            }
                        }
                    }
                },
                depreciation_method: {
                    required: true,
                },
                frequency_of_depreciation: {
                    required: true,
                },
                total_no_of_depreciation: {
                    required: true,
                },
            },
            messages: {
                assets_category_name: {
                    required: "Please Enter <?= lang('assets_category_name') ?>",
                    remote: "<?= lang('assets_category_name') ?> Already Exist",
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
            },
            submitHandler: function (e) {
                $(e).ajaxSubmit({
                    url: '<?php echo site_url("AssetsCategory/save");?>',
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
                            $('#assetsCategoryModal').modal('hide');
                            swal({
                                    title: "<?= ucwords(lang('success')); ?>",
                                    text: resObj.msg,
                                    confirmButtonColor: "<?= BTN_SUCCESS; ?>",
                                    type: "<?= lang('success'); ?>"
                                },
                                function () {
                                    if (typeof dt_DataTable !== 'undefined') {
                                        dt_DataTable.ajax.reload();
                                    } else {
                                        var option = new Option(resObj.assets_category_name, resObj.assets_category_id, true, true);
                                        $('#paymentModeList').append(option).trigger('change');
                                    }
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
    });



    //Edit function
    function EditRecord(assetsCategoryId) {
        $('#assetsCategoryTable  input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + assetsCategoryId).prop('checked', true);
        $('.editRecord').click();
    }


    //Edit Record
    $(document).on('click', '.editRecord', function () {
        $('#assetsCategoryTable input[class="dt-checkbox styled"]').prop('checked', false);
        $("form#assetsCategoryDetails .validation-error-label").html('');

        var id = $(this).val();
        $("#ids_" + id).prop("checked", true);
        var edit_val = $('.dt-checkbox:checked').val();

        var selected_tr = $('.dt-checkbox:checked');
        var element = $(selected_tr).closest('tr').get(0);
        var aData = dt_DataTable.row(element).data();

        DtFormFill('assetsCategoryDetails', aData);

        $('#assetsCategoryModal').modal('show');

    });



</script>