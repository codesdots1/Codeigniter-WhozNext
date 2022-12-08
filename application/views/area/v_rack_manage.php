<?php
//    printArray($getRackData,1);
?>


<div class="panel panel-flat  border-left-lg border-left-slate">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('rack_form')?> </h5>
    </div>

    <div class="panel-body">
        <?php
        //create  form open tag
        $form_id = array(
            'id' => 'RackDetails',
            'method' => 'post',
            'autocomplete'=>'off'
        );
        echo form_open_multipart('', $form_id);
        ?>

        <input type="hidden" name="rack_id" value="<?= isset($getRackData['rack_id']) ? $getRackData['rack_id'] : '' ?>" id="rack_id">

        <!--  Rack Details-->
        <fieldset class="content-group">
            <legend class="text-bold"> <?= lang('rack_details'); ?>  </legend>

            <div class="form-group">

                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label><?= lang('rack_code') ?></label>
                            <input type="text" class="form-control" name="rack_code" id="rack_code"
                                   value="<?= isset($getRackData['rack_code']) ? $getRackData['rack_code'] : '' ?>"
                                   placeholder="Please Enter <?= lang('rack_code') ?>">
                        </div>

                        <div class="form-group">
                            <label><?= lang('description') ?></label>
                            <textarea name="description" id="description" class="ckeditor" rows="2" cols="2">
                                      <?= (isset($getRackData['description']) && ($getRackData['description'] != '')) ? $getRackData['description'] : ''; ?>
                                    </textarea>
                            <label id="term_details-error" class="validation-error-label" for="description"></label>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label><?= lang('length') ?></label>
                            <input type="tel" class="form-control numberInit" name="length" id="length"
                                   value="<?= isset($getRackData['length']) && $getRackData['length'] != "" ? $getRackData['length'] : "" ?>"
                                   placeholder="Please Enter <?= lang('length') ?>">
                        </div>

                        <div class="form-group">
                            <label><?= lang('breadth') ?></label>
                            <input type="tel" class="form-control numberInit" name="breadth" id="breadth"
                                   value="<?= isset($getRackData['breadth']) && $getRackData['breadth'] != "" ? $getRackData['breadth'] : "" ?>"
                                   placeholder="Please Enter <?= lang('breadth') ?>">
                        </div>

                        <div class="form-group">
                            <label><?= lang('height') ?></label>
                            <input type="tel" class="form-control numberInit" name="height" id="height"
                                   value="<?= isset($getRackData['height']) && $getRackData['height'] != "" ? $getRackData['height'] : "" ?>"
                                   placeholder="Please Enter <?= lang('height') ?>">
                        </div>

                        <div class="form-group">
                            <label><?= lang('area') ?></label>
                            <select data-placeholder="Select your <?= lang('area') ?>" name="area_id"
                                    id="area_id" class="select">
                                <option value=""></option>
                                <!--                                 CreateOptions("html", "tbl_item", array('area_id', 'area_name'), isset($getRackData['area_id']) ? $getRackData['area_id'] : ''); ?>-->
                            </select>
                        </div>

                        <div class="form-group">
                            <label><?= lang('is_active') ?></label><br>
                                <div class="checkbox checkbox-switchery switchery-xs">
                                    <label>
                                        <input type="checkbox" name="is_active" <?php if(isset($getRackData['is_active']) && $getRackData['is_active'] == 1) {  echo 'checked="checked"'; } else { echo ''; } ?> id="is_active" class="switchery">
                                    </label>
                                </div>
                        </div>

                    </div>
                </div>
            </div>
        </fieldset>
        <!-- End  Rack Details -->

        <!-- create reset button-->
        <div class="text-right">
            <button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
                    onclick="window.location.href='<?php echo site_url('Rack'); ?>'"><?= lang('cancel_btn') ?>
                <i class="icon-cross2 position-right"></i></button>

            <button type="submit"
                    class="btn btn-xs border-blue text-blue btn-flat btn-ladda btn-ladda-progress submit"
                    data-spinner-color="<?= BTN_SPINNER_COLOR;  ?>" data-style="fade">
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
        CheckboxKeyGen();
        numberInit();
        Select2Init();

        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z]+$/i.test(value);
        }, "Please Enter Valid Price List Currency");

        // Initialize
        var validator = $("#RackDetails").validate({
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

                "rack_code":{
                    required: true,
                },
                "description":{
                    required: function(textarea) {
                        CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                        var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                        return editorcontent.length === 0;
                    }
                },
                "length":{
                    required: true,
                },
                "breadth":{
                    required: true,
                },
                "height":{
                    required: true,
                },
                "area_id":{
                    required: true,
                },

            },
            messages: {
                "rack_code":{
                    required: "Please Enter <?= lang('rack_code') ?>",
                },
                "description":{
                    required: "Please Enter <?= lang('description') ?>",
                },
                "length":{
                    required: "Please Enter <?= lang('length') ?>",
                },
                "breadth":{
                    required: "Please Enter <?= lang('breadth') ?>",
                },
                "height":{
                    required: "Please Enter <?= lang('height') ?>",
                },
                "area_id":{
                    required: "Please Select <?= lang('area') ?>",
                },

            },
            submitHandler: function (e) {
                $('textarea.ckeditor').each(function () {
                    var $textarea = $(this);
                    $textarea.val(CKEDITOR.instances[$textarea.attr('name')].getData());
                });

                $(e).ajaxSubmit({
                    url: '<?php echo site_url("Rack/save");?>',
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
                                window.location.href = '<?php echo site_url('Rack');?>';
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

        // ToDo Validation Change
        $("#area_id").select2({

            ajax: {
                url: "<?= site_url('Area/getArea') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '', // search term
                        area_id: "<?= isset($getRackData['area_id']) ? $getRackData['area_id'] : ''; ?>",
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

        <?php if(isset($getRackData['area_name']) && $getRackData['area_name'] != ''){ ?>
        var itemOption = new Option("<?= $getRackData['area_name']; ?>","<?= $getRackData['area_id']; ?>", true, true);
        $('#area_id').append(itemOption).trigger('change');
        <?php } ?>

        SwitcheryKeyGen();

    });



</script>

