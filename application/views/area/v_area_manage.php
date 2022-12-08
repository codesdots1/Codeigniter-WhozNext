<div class="panel panel-flat  border-left-lg border-left-slate">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('area_form')?> </h5>
    </div>

    <div class="panel-body">
        <?php
        //create  form open tag
        $form_id = array(
            'id' => 'AreaDetails',
            'method' => 'post',
            'autocomplete'=>'off'
        );
        echo form_open_multipart('', $form_id);
        ?>


        <!--  Quotation Details-->
        <fieldset class="content-group">
            <legend class="text-bold"> <?= lang('area_details'); ?>  </legend>

            <div class="form-group">

                <div class="row">
                    <div class="col-md-6">

                        <input type="hidden" name="area_id" value="<?= isset($getAreaData['area_id']) ? $getAreaData['area_id'] : '' ?>" id="area_id">

                        <div class="form-group">
                            <label><?= lang('area_name') ?></label>
                            <?php if(isset($getAreaData['area_id']) && $getAreaData['area_id'] != ''){ ?>
                                <input type="text" class="form-control" name="area_name" id="area_name" value="<?= $getAreaData['area_name']?>">
                            <?php } else { ?>
                                <input type="text" class="form-control" name="area_name" id="area_name" value="" placeholder="Enter <?= lang('area_name') ?>">
                            <?php } ?>
                        </div>

                        <div class="form-group" >
                            <label><?= lang('area_code') ?></label>
                            <?php if(isset($getAreaData['area_id']) && $getAreaData['area_id'] != ''){ ?>
                                <input type="text" class="form-control" name="area_code" id="area_code" value="<?= $getAreaData['area_code']?>">
                            <?php } else { ?>
                                <input type="text" class="form-control" name="area_code" id="area_code" value="" placeholder="Enter <?= lang('area_code') ?>">
                            <?php } ?>
                        </div>

                        <div class="form-group" >
                            <label><?= lang('warehouse_name') ?></label>
                            <select data-placeholder="Select Your <?= lang('warehouse_name') ?>" name="warehouse_id" id="warehouse_id">
                                <option value=""></option>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <!-- Posting Date -->
                        <div class="form-group">
                            <label><?= lang('area_length') ?></label>
                            <input type="tel" class="form-control numberInit" id="area_length" name="area_length"
                                   value="<?= (isset($getAreaData['area_length'])) ? $getAreaData['area_length'] : "" ; ?>"
                                   placeholder="Enter a <?= lang('area_length') ?>">
                        </div>

                        <div class="form-group">
                            <label><?= lang('area_breadth') ?></label>
                            <input type="tel" class="form-control numberInit" id="area_breadth" name="area_breadth"
                                   value="<?= (isset($getAreaData['area_breadth'])) ? $getAreaData['area_breadth'] : "" ; ?>"
                                   placeholder="Enter a <?= lang('area_breadth') ?>">
                        </div>

                        <div class="form-group">
                            <label><?= lang('area_height') ?></label>
                            <input type="tel" class="form-control numberInit" id="area_height" name="area_height"
                                   value="<?= (isset($getAreaData['area_height'])) ? $getAreaData['area_height'] : "" ; ?>"
                                   placeholder="Enter a <?= lang('area_height') ?>">
                        </div>

                    </div>

                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?= lang('area_description') ?></label>
                            <textarea rows="2" cols="2" name="area_description" id="area_description" class="ckeditor" placeholder="Enter <?= lang('area_description') ?>">
                                <?= isset($getAreaData['area_description']) ? $getAreaData['area_description'] : ''  ?></textarea>
                            <label id="area_description-error" class="validation-error-label validation-valid-label" for="area_description"></label>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <!-- End  Area Details -->


        <!-- create reset button-->
        <div class="text-right">
            <button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
                    onclick="window.location.href='<?php echo site_url('Area'); ?>'"><?= lang('cancel_btn') ?>
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
        <?php if((isset($getAreaData['warehouse_name']) && ($getAreaData['warehouse_name'] != ''))){ ?>
        var option = new Option("<?= $getAreaData['warehouse_name']; ?>",
            "<?= $getAreaData['warehouse_id']; ?>", true, true);
        $('#warehouse_id').append(option).trigger('change.select2');
        <?php } ?>

        $("#warehouse_id").select2({
            ajax: {
                url: "<?= site_url('Warehouse/getWarehouse') ?>",
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

        var validator = $("#AreaDetails").validate({
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
                warehouse_id:{
                    required: true
                },
                area_name: {
                    required: true
                },
                area_code: {
                    required: true
                },
                area_length: {
                    required: true
                },
                area_breadth: {
                    required: true
                },
                area_height: {
                    required: true
                },
            },
            messages: {
                warehouse_id: {
                    required: "Please Select <?= lang('warehouse') ?>"
                },
                area_name: {
                    required: "Please Select <?= lang('area_name') ?>"
                },
                area_code: {
                    required: "Please Enter <?= lang('area_code') ?>"
                },
                area_length: {
                    required: "Please Enter <?= lang('area_length')?>"
                },
                area_breadth: {
                    required: "Please Enter <?= lang('area_breadth')?>"
                },
                area_height: {
                    required: "Please Enter <?= lang('area_height')?>"
                },
            },
            submitHandler: function (e) {
                $('textarea.ckeditor').each(function () {
                    var $textarea = $(this);
                    $textarea.val(CKEDITOR.instances[$textarea.attr('name')].getData());
                });

                $(e).ajaxSubmit({
                    url: '<?php echo site_url("Area/save");?>',
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
                                window.location.href = '<?php echo site_url('Area');?>';
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