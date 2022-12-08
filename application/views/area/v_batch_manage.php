<div class="panel panel-flat  border-left-lg border-left-slate">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('batch_form')?> </h5>
    </div>

    <div class="panel-body">
        <?php
        //create  form open tag
        $form_id = array(
            'id' => 'BatchDetails',
            'method' => 'post',
            'autocomplete'=>'off'
        );
        echo form_open_multipart('', $form_id);
        ?>


        <!--  Quotation Details-->
        <fieldset class="content-group">
            <legend class="text-bold"> <?= lang('batch_details'); ?>  </legend>

            <div class="form-group">

                <div class="row">
                    <div class="col-md-6">

                        <input type="hidden" name="batch_id" value="<?= isset($getBatchData['batch_id']) ? $getBatchData['batch_id'] : '' ?>" id="batch_id">

                        <div class="form-group">
                            <label><?= lang('batch_id') ?></label>
                            <?php if(isset($getBatchData['batch_id']) && $getBatchData['batch_id'] != ''){ ?>
                                <input type="text" class="form-control" name="batch_code" id="batch_code" value="<?= $getBatchData['batch_code']?>">
                            <?php } else { ?>
                                <input type="text" class="form-control" name="batch_code" id="batch_code" value="" placeholder="Enter a <?= lang('batch_id') ?>">
                            <?php } ?>
                        </div>

                        <div class="form-group" >
                            <label><?= lang('item_name') ?></label>
                            <select data-placeholder="Your <?= lang('item_name') ?>" name="item_id" id="item_id">
                                <option value=""></option>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label><?= lang('batch_input_date') ?></label>
                            <input type="hidden"
                                   value="<?= isset($getBatchData['batch_input_date']) ? $getBatchData['batch_input_date'] : date(PHP_DATE_FORMATE) ?>">
                            <input type="text" class="form-control" id="batch_input_date" name="batch_input_date"
                                   value="<?= (isset($getBatchData['batch_input_date'])) ? $getBatchData['batch_input_date'] : date(PHP_DATE_FORMATE); ?>"
                                   placeholder="Select a <?= lang('batch_input_date') ?>">
                        </div>

                        <div class="form-group">
                            <label><?= lang('batch_expiry_date') ?></label>
                            <input type="hidden"
                                   value="<?= isset($getBatchData['batch_expiry_date']) ? $getBatchData['batch_expiry_date'] : date(PHP_DATE_FORMATE) ?>">
                            <input type="text" class="form-control" id="batch_expiry_date" name="batch_expiry_date"
                                   value="<?= (isset($getBatchData['batch_expiry_date'])) ? $getBatchData['batch_expiry_date'] : date(PHP_DATE_FORMATE); ?>"
                                   placeholder="Select a <?= lang('batch_expiry_date') ?>">
                        </div>

                    </div>

                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?= lang('batch_description') ?></label>
                            <textarea rows="3" cols="5" name="batch_description" id="batch_description" class="ckeditor" placeholder="Enter <?= lang('batch_description') ?>">
                                <?= isset($getBatchData['batch_description']) ? $getBatchData['batch_description'] : ''  ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?= lang('is_active') ?></label>
            <div class="col-lg-9">
                <div class="checkbox checkbox-switchery switchery-xs">
                    <label>
                        <input type="checkbox" name="is_active" <?php if(isset($getBatchData['is_active']) && $getBatchData['is_active'] == 1) {  echo 'checked="checked"'; } else { echo ''; } ?> id="is_active" class="switchery">
                    </label>
                </div>
            </div>
        </div>
        <!-- End  Batch Details -->


        <!-- create reset button-->
        <div class="text-right">
            <button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
                    onclick="window.location.href='<?php echo site_url('Batch'); ?>'"><?= lang('cancel_btn') ?>
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
        $("#batch_input_date").datepicker({
            dateFormat: "<?= DATE_FORMATE ?>",
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            onSelect: function (selected) {
                if ($(this).valid()) {
                    $(this).removeClass('invalid').addClass('success');
                }
                var id = $(this).attr('id');
                $("input[name=" + id + "]").val($(this).val());
                $("#batch_expiry_date").datepicker("option", "minDate", selected);
            }

        });


        $("#batch_expiry_date").datepicker({
            dateFormat: "<?= DATE_FORMATE ?>",
            todayBtn:  "linked",
            autoclose: true,
            todayHighlight: true,
            minDate : new Date(),
            onSelect: function(selected) {
                if($(this).valid()){
                    $(this).removeClass('invalid').addClass('success');
                }
                var id = $(this).attr('id');
                $("input[name=" + id + "]").val($(this).val());
            }

        });

        <?php if((isset($getBatchData['item_name']) && ($getBatchData['item_name'] != ''))){ ?>
        var option = new Option("<?= $getBatchData['item_name']; ?>",
            "<?= $getBatchData['item_id']; ?>", true, true);
        $('#item_id').append(option).trigger('change.select2');
        <?php } ?>

        $("#item_id").select2({
            ajax: {
                url: "<?= site_url('Item/getItem') ?>",
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

        var validator = $("#BatchDetails").validate({
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
                item_id:{
                    required: true
                },
                batch_code: {
                    required: true
                },
                batch_input_date: {
                    required: true
                },
                batch_expiry_date: {
                    required: true
                }
            },
            messages: {
                item_id: {
                    required: "Please Select <?= lang('item') ?>"
                },
                batch_code: {
                    required: "Please Select <?= lang('batch_id') ?>"
                },
                batch_input_date: {
                    required: "Please Enter <?= lang('batch_input_data') ?>"
                },
                batch_expiry_date: {
                    required: "Please Enter <?= lang('batch_expiry_date')?>"
                }
            },
            submitHandler: function (e) {
                $('textarea.ckeditor').each(function () {
                    var $textarea = $(this);
                    $textarea.val(CKEDITOR.instances[$textarea.attr('name')].getData());
                });

                $(e).ajaxSubmit({
                    url: '<?php echo site_url("Batch/save");?>',
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
                                window.location.href = '<?php echo site_url('Batch');?>';
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