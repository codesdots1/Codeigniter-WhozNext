<div class="panel panel-flat border-left-lg border-left-slate">
    <div class="panel-heading ">
        <h5 class="panel-title"><?= lang('terms_condition_heading') ?><a class="heading-elements-toggle"><i
                        class="icon-more"></i></a>
        </h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        <?php
        //create  form open tag
        $form_id = array(
            'id' => 'termsConditionDetails',
            'method' => 'post',
            'class' => 'form-horizontal'
        );
        echo form_open_multipart('', $form_id);
        ?>
        <input type="hidden" name="terms_condition_id" value="<?=(isset($getTermsConditionData['terms_condition_id']) && ($getTermsConditionData['terms_condition_id'] != '')) ? $getTermsConditionData['terms_condition_id'] : '' ?>" id="terms_condition_id">
        <!-- Title -->
        <div class="form-group">
            <label class="col-lg-3 control-label"><?= lang('title') ?></label>
            <div class="col-lg-9">
                <input type="text" name="title" value="<?= (isset($getTermsConditionData['title']) && ($getTermsConditionData['title'] != '')) ? $getTermsConditionData['title'] : ''; ?>" id="title" class="form-control"
                       placeholder="Enter <?= lang('title') ?>">
            </div>
        </div>


        <!-- Description -->
        <div class="form-group">
            <label class="col-lg-3 control-label"><?= lang('description') ?></label>
            <div class="col-lg-9">
                <textarea name="description" id="description" class="ckeditor" rows="2" cols="2">
                    <?= (isset($getTermsConditionData['description']) && ($getTermsConditionData['description'] != '')) ? $getTermsConditionData['description'] : ''; ?>
                </textarea>
                <label id="description-error" class="validation-error-label" for="description"></label>
            </div>
        </div>




        <!-- is active-->
        <div class="form-group">
            <label class="col-lg-3 control-label"><?= lang('is_active') ?></label>
            <div class="col-lg-9">
                <div class="checkbox checkbox-switchery switchery-xs">
                    <label>
                        <input type="checkbox" name="is_active" <?php if(isset($getTermsConditionData['is_active']) && $getTermsConditionData['is_active'] == 1) {  echo "checked"; } else { echo ''; } ?> id="is_active" class="switchery"   >
                    </label>
                </div>
            </div>
        </div>



        <!-- create reset button-->
        <div class="text-right">
            <button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
                    onclick="window.location.href='<?php echo site_url('TermsCondition'); ?>'"><?= lang('cancel_btn') ?> <i class="icon-cross2 position-right"></i> </button>

            <button type="submit"
                    class="btn btn-xs border-blue text-blue btn-flat btn-ladda btn-ladda-progress submit"
                    data-spinner-color="#03A9F4" data-style="fade"><span
                        class="ladda-label"><?= lang('submit_btn') ?></span>
                <i id="icon-hide" class="icon-arrow-right8 position-right"></i>
            </button>

        </div>
        <?php echo form_close(); ?>
    </div>
</div>


<script>
    var laddaSubmitBtn = Ladda.create(document.querySelector('.submit'));

    $(document).ready(function () {
        // Full featured editor
//        CKEDITOR.replace( 'description', {
//            height: '400px',
//            extraPlugins: 'forms'
//        });


        // Initialize
        var validator = $("#termsConditionDetails").validate({
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
                title: {
                    required: true,
                    remote: {
//                        url: "<?php //echo site_url( "TermsCondition/titleExist");?>//",
                        url: "<?php echo site_url( "TermsCondition/NameExist");?>",
                        type: "post",
                        data: {
                            column_name: function () {
                                return "title";
                            },
                            column_id: function () {
                                return $("#terms_condition_id").val();
                            },
                            table_name: function () {
                                return "tbl_terms_conditions";
                            },
                        }
                    }
                },
                description: {
                    required: function(textarea) {
                        CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                        var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                        return editorcontent.length === 0;
                    }
                }

            },
            messages: {
                title: {
                    required: "Please Enter <?= lang('title') ?>",
                    remote  : "<?= lang('title') ?> Already Exist",
                },
                description: {
                    required: "Please Enter <?= lang('description') ?>",
                }

            },
            submitHandler: function (e) {
                $('textarea.ckeditor').each(function () {
                    var $textarea = $(this);
                    $textarea.val(CKEDITOR.instances[$textarea.attr('name')].getData());
                });

                $(e).ajaxSubmit({
                    url: '<?php echo site_url("TermsCondition/save");?>',
                    type: 'post',
                    beforeSubmit: function (formData, jqForm, options) {
                    },
                    complete: function () {
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
                                window.location.href = '<?php echo site_url('TermsCondition');?>';
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