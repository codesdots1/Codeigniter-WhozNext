<div class="panel panel-flat  border-left-lg border-left-slate">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('bin_form')?> </h5>
    </div>

    <div class="panel-body">
        <?php
        //create  form open tag
        $form_id = array(
            'id' => 'BinDetails',
            'method' => 'post',
            'autocomplete'=>'off'
        );
        echo form_open_multipart('', $form_id);
        ?>


        <!--  Bin Details-->
        <fieldset class="content-group">
            <legend class="text-bold"> <?= lang('bin_details'); ?>  </legend>

            <div class="form-group">

                <div class="row">
                    <div class="col-md-6">

                        <input type="hidden" name="bin_id" value="<?= isset($getBinData['bin_id']) ? $getBinData['bin_id'] : '' ?>" id="bin_id">

                        <div class="form-group">
                            <label><?= lang('bin_code') ?></label>
                            <?php if(isset($getBinData['bin_id']) && $getBinData['bin_id'] != ''){ ?>
                                <input type="text" class="form-control" name="bin_code" id="bin_code" value="<?= $getBinData['bin_code']?>">
                            <?php } else { ?>
                                <input type="text" class="form-control" name="bin_code" id="bin_code" value="" placeholder = "Enter <?= lang('bin_code') ?>">
                            <?php } ?>
                        </div>

                        <div class="form-group" >
                            <label><?= lang('bin_type_name') ?></label>
                            <select data-placeholder="Select Your <?= lang('bin_type_name') ?>" name="bin_type_id" id="bin_type_id">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><?= lang('bin_volume') ?></label>
                            <input type="tel" class="form-control" id="bin_volume" name="bin_volume"
                                   value="<?= (isset($getBinData['bin_volume'])) ? $getBinData['bin_volume'] : "" ; ?>"
                                   placeholder="Enter a <?= lang('bin_volume') ?>">
                        </div>

                        <div class="form-group" >
                            <label><?= lang('unit_name') ?></label>
                            <select data-placeholder="Select Your <?= lang('unit_name') ?>" name="unit_id" id="unit_id">
                                <option value=""></option>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <!-- Posting Date -->
                        <div class="form-group">
                            <label><?= lang('bin_length') ?></label>
                            <input type="tel" class="form-control numberInit" id="bin_length" name="bin_length"
                                   value="<?= (isset($getBinData['bin_length'])) ? $getBinData['bin_length'] : "" ; ?>"
                                   placeholder="Enter a <?= lang('bin_length') ?>">
                        </div>

                        <div class="form-group">
                            <label><?= lang('bin_breadth') ?></label>
                            <input type="tel" class="form-control numberInit" id="bin_breadth" name="bin_breadth"
                                   value="<?= (isset($getBinData['bin_breadth'])) ? $getBinData['bin_breadth'] : "" ; ?>"
                                   placeholder="Enter a <?= lang('bin_breadth') ?>">
                        </div>

                        <div class="form-group">
                            <label><?= lang('bin_height') ?></label>
                            <input type="tel" class="form-control numberInit" id="bin_height" name="bin_height"
                                   value="<?= (isset($getBinData['bin_height'])) ? $getBinData['bin_height'] : "" ; ?>"
                                   placeholder="Enter a <?= lang('bin_height') ?>">
                        </div>

                        <div class="form-group" >
                            <label><?= lang('rack_code') ?></label>
                            <select data-placeholder="Select Your <?= lang('rack_code') ?>" name="rack_id" id="rack_id">
                                <option value=""></option>
                            </select>
                        </div>

                    </div>

                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?= lang('bin_description') ?></label>
                            <textarea rows="2" cols="2" name="bin_description" id="bin_description" class="ckeditor">
                                <?= isset($getBinData['bin_description']) ? $getBinData['bin_description'] : ''  ?></textarea>
                            <label id="bin_description-error" class="validation-error-label validation-valid-label" for="bin_description"></label>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <!-- End  Bin Details -->
        <div class="form-group">
            <label class="col-lg-3 control-label"><?= lang('is_active') ?></label>
            <div class="col-lg-9">
                <div class="checkbox checkbox-switchery switchery-xs">
                    <label>
                        <input type="checkbox" name="is_active" id="is_active" <?php if(isset($getBinData['is_active']) && $getBinData['is_active'] == 1) {  echo 'checked="checked"'; } else { echo ''; } ?>class="switchery">
                    </label>
                </div>
            </div>
        </div>

        <!-- create reset button-->
        <div class="text-right">
            <button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
                    onclick="window.location.href='<?php echo site_url('Bin'); ?>'"><?= lang('cancel_btn') ?>
                <i class="icon-cross2 position-right"></i></button>

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

    $(document).ready(function()
    {
        numberInit();
//        Unit Dropdown
        <?php if((isset($getBinData['unit_name']) && ($getBinData['unit_name'] != ''))){ ?>
        var option = new Option("<?= $getBinData['unit_name']; ?>",
            "<?= $getBinData['unit_id']; ?>", true, true);
        $('#unit_id').append(option).trigger('change.select2');
        <?php } ?>

        $("#unit_id").select2({
            ajax: {
                url: "<?= site_url('Unit/getUnit') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '', // search term
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
                }
                //cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            }
        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });

//        Bin Type Dropdown
        <?php if((isset($getBinData['bin_type_name']) && ($getBinData['bin_type_name'] != ''))){ ?>
        var option = new Option("<?= $getBinData['bin_type_name']; ?>",
            "<?= $getBinData['bin_type_id']; ?>", true, true);
        $('#bin_type_id').append(option).trigger('change.select2');
        <?php } ?>

        $("#bin_type_id").select2({
            ajax: {
                url: "<?= site_url('BinType/getBinType') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '', // search term
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
                }
                //cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            }
        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });

//        Rack Dropdown
        <?php if((isset($getBinData['rack_code']) && ($getBinData['rack_code'] != ''))){ ?>
        var option = new Option("<?= $getBinData['rack_code']; ?>",
            "<?= $getBinData['rack_id']; ?>", true, true);
        $('#rack_id').append(option).trigger('change.select2');
        <?php } ?>

        $("#rack_id").select2({
            ajax: {
                url: "<?= site_url('Rack/getRack') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '', // search term
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
                }
                //cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            }
        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });


        var validator = $("#BinDetails").validate({
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
                bin_code:{
                    required: true
                },
                bin_type_id: {
                    required: true
                },
                bin_volume: {
                    required: true
                },
                unit_id: {
                    required: true
                },
                bin_length: {
                    required: true
                },
                bin_breadth: {
                    required: true
                },
                bin_height: {
                    required: true
                },
                bin_description: {
                    required: function(textarea) {
                        CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                        var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                        return editorcontent.length === 0;
                    }
                }
            },
            messages: {
                bin_code: {
                    required: "Please Select <?= lang('bin_code') ?>"
                },
                bin_type_id: {
                    required: "Please Select <?= lang('bin_type') ?>"
                },
                bin_volume: {
                    required: "Please Enter <?= lang('bin_volume') ?>"
                },
                unit_id: {
                    required: "Please Enter <?= lang('unit_name')?>"
                },
                bin_length: {
                    required: "Please Enter <?= lang('bin_length')?>"
                },
                bin_breadth: {
                    required: "Please Enter <?= lang('bin_breadth')?>"
                },
                bin_height: {
                    required: "Please Enter <?= lang('bin_height')?>"
                },
                bin_description: {
                    required: "Please Enter <?= lang('bin_description')?>"
                }
            },
            submitHandler: function (e) {
                $('textarea.ckeditor').each(function () {
                    var $textarea = $(this);
                    $textarea.val(CKEDITOR.instances[$textarea.attr('name')].getData());
                });

                $(e).ajaxSubmit({
                    url: '<?php echo site_url("Bin/save");?>',
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
                                window.location.href = '<?php echo site_url('Bin');?>';
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

