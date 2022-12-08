<div class="panel panel-flat  border-left-lg border-left-slate">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang("asset_maintenance_form") ?></h5>
    </div>

    <div class="panel-body">
        <?php
        //create  form open tag
        $form_id = array(
            'id' => 'assetMaintenanceDetails',
            'method' => 'post',
            'autocomplete'=>'off'
        );
        echo form_open_multipart('', $form_id);
        ?>

        <input type="hidden" name="asset_maintenance_id" id="asset_maintenance_id"
               value="<?= isset($getAssetMaintenanceData['asset_maintenance_id']) ? $getAssetMaintenanceData['asset_maintenance_id'] : '' ?>">

        <fieldset class="content-group">
            <legend class="text-bold"><?= lang("details") ?></legend>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?= lang('asset') ?></label>
                            <select data-placeholder="Select Your <?= lang('asset') ?>" name="assets_id" id="assets_id">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?= lang('maintenance_team') ?></label>
                            <select data-placeholder="Select Your <?= lang('maintenance_team') ?>" name="maintenance_team_id" id="maintenance_team_id" class="select">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                             <label><?= lang('description') ?></label>
                             <textarea rows="2" cols="2" name="description" id="description" class="ckeditor">
                             <?= isset($getAssetMaintenanceData['description']) ? $getAssetMaintenanceData['description'] : ''  ?></textarea>
                             <label id="description-error" class="validation-error-label validation-valid-label" for="description"></label>
                        </div>
                    </div>
        </fieldset>

        <fieldset class="content-group">
            <legend class="text-bold"><?= lang("task") ?></legend>
            <?= $v_assetMaintenanceTaskData ?>
        </fieldset>



        <div class="text-right">
            <button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
                    onclick="window.location.href='<?php echo site_url('AssetMaintenance'); ?>'"><?= lang('cancel_btn') ?> <i
                    class="icon-cross2 position-right"></i></button>
            <button type="submit" id="submit"
                    class="btn btn-xs border-blue text-blue btn-flat btn-ladda btn-ladda-progress submit"
                    data-spinner-color="<?= BTN_SPINNER_COLOR; ?>" data-style="fade">
                <span class="ladda-label"><?= lang('submit_btn') ?></span>
                <i id="icon-hide" class="icon-arrow-right8 position-right"></i>
            </button>

        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script>

    var laddaSubmitBtn = Ladda.create(document.querySelector('.submit'));

    $(document).ready(function () {

        numberInit();
        CustomToolTip();
        CheckboxKeyGen();
        Select2Init();

        <?php if((isset($getAssetMaintenanceData['assets_id']) && ($getAssetMaintenanceData['assets_id'] != '') && ($getAssetMaintenanceData['assets_id'] > 0))){ ?>
        var option = new Option("<?= $getAssetMaintenanceData['assets_name']; ?>",
            "<?= $getAssetMaintenanceData['assets_id']; ?>", true, true);
        $('#assets_id').append(option).trigger('change.select2');
        <?php } ?>

        var location_id = $("#assets_id").val();

        $("#assets_id").select2({
            ajax: {
                url: "<?= site_url('Asset/getAssets') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '', // search term
                        location_id: location_id,
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

        var validator = $("#assetMaintenanceDetails").validate({
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
                assets_id: {
                    required: true
                },
                "asset_maintenance_task_name[]": {
                        required:true
                },
                "asset_maintenance_task_status_id[]": {
                        required:true
                },
                "asset_maintenance_type_id[]": {
                        required:true
                },
                "periodicity[]": {
                        required:true
                },
                "assign_to[]": {
                        required:true
                },
                "next_due_date[]": {
                        required:true
                }
            },
            messages: {
                assets_id: {
                    required: "Please Enter <?= lang('asset') ?>"
                },
                "asset_maintenance_task_name[]": {
                    required: "Please Enter <?= lang('asset_maintenance_task_name') ?>"
                },
                "asset_maintenance_task_status_id[]": {
                    required: "Please Enter <?= lang('asset_maintenance_task_status') ?>"
                },
                "asset_maintenance_type_id[]": {
                    required: "Please Enter <?= lang('asset_maintenance_type') ?>"
                },
                "periodicity[]": {
                    required: "Please Enter <?= lang('periodicity') ?>"
                },
                "assign_to[]": {
                    required: "Please Enter <?= lang('assign_to') ?>"
                },
                "next_due_date[]": {
                    required: "Please Enter <?= lang('next_due_date') ?>"
                }
            },
            submitHandler: function (e) {
                $('textarea.ckeditor').each(function () {
                    var $textarea = $(this);
                    $textarea.val(CKEDITOR.instances[$textarea.attr('name')].getData());
                });

                $(e).ajaxSubmit({
                    url: '<?php echo site_url("AssetMaintenance/save");?>',
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
                                window.location.href = '<?php echo site_url('AssetMaintenance');?>';
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

