<div class="panel panel-flat border-left-lg border-left-slate">
    <div class="panel-heading ">
        <h5 class="panel-title"><?= lang('category_form') ?><a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
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
            'id'=>'categoryDetails',
            'method'=>'post',
            'class'=>'form-horizontal'
        );
        echo form_open_multipart('', $form_id);
        $surnameId = (isset($getCategoryData['category_id']) && ($getCategoryData['category_id'] != '')) ? $getCategoryData['category_id'] : '';
        ?>
        <input type="hidden" name="category_id" value="<?= $surnameId ?>" id="category_id">
        <div class="tabbable">
            <ul class="nav nav-tabs">
                <?php
                if(is_array($languages) && count($languages) > 0){
                    foreach ($languages as $languageCount => $languageData) {
                        ?>
                        <li role="presentation" class = "<?= ($languageCount == 0) ? "active" : ""; ?>">
                            <a aria-expanded="true" href="#tab_<?= $languageData['language_id']; ?>" data-toggle="tab">
                                <?=  $languageData['language_name'];?>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>

            </ul>

            <div class="tab-content">
                <?php if(is_array($languages) && count($languages) > 0) {
                    foreach ($languages as $languageCount => $languageData) {
                        ?>

                        <div role="tabpanel" class="<?= ($languageCount == 0) ? "tab-pane active" : "tab-pane"; ?>"
                             id="tab_<?= $languageData['language_id']; ?>">

                            <input type="hidden" name="language_id[]"
                                   value="<?= (isset($languageData['language_id']) && ($languageData['language_id'] != '')) ? $languageData['language_id'] : '' ?>"
                                   id="">
                            <input type="hidden" name="category_description_id[]"
                                   value="<?= (isset($getCategoryDescription[$languageData['language_id']]['category_description_id']) &&
                                       ($getCategoryDescription[$languageData['language_id']]['category_description_id'] != '')) ?
                                       $getCategoryDescription[$languageData['language_id']]['category_description_id'] : ''; ?>" id="category_description_id">

                            <?php if($languageData['is_default'] == 1){ ?>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('samaj_name') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <select name="samaj_id" id="samaj_id" data-init="1" data-placeholder="Select <?= lang('samaj_name') ?>" class="select">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>

                            <!-- Category name -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('category_name') ?></label>
                                <div class="col-lg-9">
                                    <input type="text" name="category_name[]" id="category_name" class="form-control"
                                           value="<?= (isset($getCategoryDescription[$languageData['language_id']]['category_name']) &&
                                               ($getCategoryDescription[$languageData['language_id']]['category_name'] != '')) ?
                                               $getCategoryDescription[$languageData['language_id']]['category_name'] : ''; ?>"
                                           placeholder="Enter <?= lang('category_name') ?>">
                                </div>
                            </div>

                            <?php if($languageData['is_default'] == 1){ ?>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('is_active') ?></label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery switchery-xs">
                                            <label>
                                                <input type="checkbox" name="is_active"
                                                    <?php if(isset($getCategoryData['is_active']) && $getCategoryData['is_active'] == 1) {
                                                        echo 'checked="checked"';
                                                    } else {
                                                        echo '';
                                                    } ?>
                                                       id="is_active" class="switchery">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php }
                }?>
            </div>
        </div>

        <!-- create reset button-->
        <div class="text-right">
            <button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
                    onclick="window.location.href='<?php echo site_url('Category'); ?>'"><?= lang('cancel_btn') ?> <i class="icon-cross2 position-right"></i> </button>

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
        ImageLoad();
        numberInit();
        Select2Init();
        SwitcheryKeyGen();
        FileKeyGen();

        samajDD('','#samaj_id');

        // Initialize
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z ]+$/i.test(value);
        }, "Only Letters are allowed");
        var validator = $("#categoryDetails").validate({
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
                samaj_id:{
                    required: true
                },
                'category_name[]': {
                     required: true
                }
            },
            messages: {
                samaj_id:{
                    required: "Please Enter <?= lang('samaj_name') ?>"
                },
                'category_name[]': {
                    required: "Please Select <?= lang('category') ?>"
                }
            },submitHandler: function (e) {
                $(e).ajaxSubmit({
                    url: '<?php echo site_url("Category/save");?>',
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
                                window.location.href = '<?php echo site_url('Category');?>';
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

        <?php if((isset($getCategoryData['samaj_name']) && !empty($getCategoryData['samaj_name']))){
        $samajName = $getCategoryData['samaj_name']; ?>
        var option = new Option("<?= $getCategoryData['samaj_name']; ?>", "<?= $getCategoryData['samaj_id']; ?>", true, true);
        $('#samaj_id').append(option).trigger('change');
        <?php } ?>
    });


    function ImageLoad() {
        var memberId = $('#member_id').val();
        $.ajax({
            type: "post",
            url: "<?php echo site_url('Member/imageLoad');?>",
            dataType: "json",
            async: false,
            data: {member_id: memberId},
            beforeSend: function (formData, jqForm, options) {
            },
            complete: function () {
            },
            success: function (resObj) {
                $('#imageListing').html(resObj);
            }
        });
    }
</script>
<?php if (isset($select2)) { ?>
    <?= $select2 ?>
<?php } ?>