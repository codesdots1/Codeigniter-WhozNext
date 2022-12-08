<div class="panel panel-flat border-left-lg border-left-slate">
    <div class="panel-heading ">
        <h5 class="panel-title"><?= lang('business_type_form') ?><a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
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
            'id' => 'business_type_details',
            'method' => 'post',
            'class' => 'form-horizontal',
            'autocomplete' => 'off'
        );

        echo form_open_multipart('', $form_id);
        ?>

        <input type="hidden" name="business_type_id" id="business_type_id"
               value="<?= (isset($businessTypeData['business_type_id']) && ($businessTypeData['business_type_id'] != '')) ?
                   $businessTypeData['business_type_id'] : '' ?>">

        <div class="tabbable">

            <ul class="nav nav-tabs">
                <?php if(!empty($languages)) { ?>
                    <?php  foreach ($languages as $languageCount => $languageData) { ?>
                        <li role="presentation" class = "<?= ($languageCount == 0) ? "active" : ""; ?>">
                            <a  aria-expanded="true" href="#tab_<?= $languageData['language_id']; ?>" data-toggle="tab"><?=  $languageData['language_name'];?></a>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>

            <div class="tab-content">
                <?php if(!empty($languages)) { ?>
                    <?php  foreach ($languages as $languageCount => $languageData) { ?>
                        <div role="tabpanel" class = "<?= ($languageCount == 0) ? "tab-pane active" : "tab-pane"; ?>"
                             id="tab_<?= $languageData['language_id']; ?>">

                            <input type="hidden" name="language_id[]"
                                   value="<?= (isset($languageData['language_id']) && ($languageData['language_id'] != '')) ? $languageData['language_id'] : '' ?>" id="">
                            <input type="hidden" name="business_type_description_id[]"
                                   value="<?= (isset($businessTypeDescription[$languageData['language_id']]['business_type_description_id']) && ($businessTypeDescription[$languageData['language_id']]['business_type_description_id'] != '')) ?
                                       $businessTypeDescription[$languageData['language_id']]['business_type_description_id'] : ''; ?>" id="">
                        <?php if($languageData['is_default'] == 1) { ?>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('samaj_name') ?> <span class="text-danger"> * </span> </label>
                                <div class="col-lg-9">
                                    <select name="samaj_id" id="samaj_id" data-init="1" data-placeholder="Select <?= lang('samaj_name') ?>" class="select">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('parent_business_type_name') ?></label>
                                <div class="col-lg-9">
                                    <select name="parent_business_type_id" data-init="1" id="parent_business_type_id" class="select" data-placeholder="Select <?= lang('parent_business_type_name') ?>">
                                        <option value="" ></option>
<!--                                        --><?//= CreateOptions("html","tbl_business_types",array("business_type_id","business_type_name"),(isset($businessTypeData['business_type_id']) && ($businessTypeData['business_type_id'] != '')) ? $businessTypeData['parent_business_type_id'] : ''); ?>
                                    </select>
                                </div>
                            </div>

                        <?php } ?>
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('business_type_name') ?> <span class="text-danger"> * </span> </label>
                                <div class="col-lg-9">
                                    <input type="text" name="business_type_name[]" value="<?= (isset($businessTypeDescription[$languageData['language_id']]['business_type_name']) && ($businessTypeDescription[$languageData['language_id']]['business_type_name'] != '')) ? $businessTypeDescription[$languageData['language_id']]['business_type_name'] : ''; ?>"
                                           id="business_type_name_<?= $languageData['language_id']; ?>" class="form-control"
                                           placeholder="Enter <?= lang('business_type_name') ?>">
                                </div>
                            </div>

                            <?php if($languageData['is_default'] == 1) { ?>
                                <!-- sort order -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('sort_order') ?> <span class="text-danger"> * </span> </label>
                                    <div class="col-lg-9">
                                        <input type="tel" maxlength="6" name="sort_order"  value="<?= (isset($businessTypeData['sort_order']) && ($businessTypeData['sort_order'] != '')) ? $businessTypeData['sort_order'] : ''; ?>" id="sort_order" class="form-control"
                                               placeholder="Enter <?= lang('sort_order') ?>">
                                    </div>
                                </div>

                                <!-- is active-->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('is_active') ?></label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery switchery-xs">
                                            <label>
                                                <input type="checkbox" name="is_active" <?php if(isset($businessTypeData['is_active']) && $businessTypeData['is_active'] == 1) {  echo 'checked="checked"'; } else { echo ''; } ?>
                                                       id="is_active" class="switchery"></label>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                <div class="text-right">
                    <button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
                            onclick="window.location.href='<?php echo site_url('BusinessType'); ?>'"><?= lang('cancel_btn') ?>
                        <i class="icon-cross2 position-right"></i> </button>
                    <button type="submit" id="submit" class="btn btn-xs border-blue text-blue btn-flat btn-ladda btn-ladda-progress submit"
                            data-spinner-color="<?= BTN_SPINNER_COLOR; ?>" data-style="fade"><span class="ladda-label"><?= lang('submit_btn') ?></span>
                        <i id="icon-hide" class="icon-arrow-right8 position-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo form_close(); ?>

<script>
    var laddaSubmitBtn = Ladda.create(document.querySelector('.submit'));
    $(document).ready(function () {
        FileKeyGen();
        Select2Init();

        samajDD('','#samaj_id');
        businessTypeDD('','#parent_business_type_id');

        $("#parent_business_type_id").select2().on('change', function() {
            if($("#parent_business_type_id").valid()){
                $("#parent_business_type_id").removeClass('invalid').addClass('success');
            }
        });
        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param)
        });
        // Initialize
        var validator = $("#business_type_details").validate({
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
                samaj_id : {
                    required: true
                },
                'business_type_name[]' : {
                    required: true
                },
                sort_order : {
                    required: true,
                    number: true
                },
                business_type_id : {
                    required: true
                }
            },
            messages: {
                samaj_id: {
                    required: "Please Select <?= lang('samaj_name') ?>"
                },
                'business_type_name[]': {
                    required: "Please Enter <?= lang('business_type_name') ?>"
                },
                sort_order: {
                    required: "Please Enter <?= lang('sort_order') ?>"
                },
                business_type_id: {
                    required: "Please Enter <?= lang('business_type') ?>"
                }
            },
            submitHandler: function (e) {
                $(e).ajaxSubmit({
                    url: '<?php echo site_url("BusinessType/save");?>',
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
                            },
                            function () {
                                if(typeof resObj.business_type_id == 'undefined') {
                                    window.location.href = '<?php echo site_url('BusinessType');?>';
                                } else {
                                    window.location.href = '<?php echo site_url('BusinessType');?>';
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
        SwitcheryKeyGen();
        $("#parent_business_type_id").select2({
            ajax: {
                url: "<?= site_url('BusinessType/getBusinessTypeName') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    var businessTypeId = $('#business_type_id').val();
                    return {
                        filter_param: params.term || '', // search term
                        page: params.page || 1,
                        business_type_id : businessTypeId
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
            },

            escapeMarkup: function (markup) {
                return markup;
            }

        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });
        <?php if((isset($businessTypeData['samaj_name']) && !empty($businessTypeData['samaj_name']))){
        $samajName = $businessTypeData['samaj_name']; ?>
        var option = new Option("<?= $businessTypeData['samaj_name']; ?>", "<?= $businessTypeData['samaj_id']; ?>", true, true);
        $('#samaj_id').append(option).trigger('change');
        <?php } ?>

        <?php if((isset($businessTypeData['parent_business_type_id']) && !empty($businessTypeData['parent_business_type_id']))){
        $businessTypeName = $businessTypeData['business_type_name']; ?>
        var option = new Option("<?= $businessTypeData['business_type_name']; ?>", "<?= $businessTypeData['parent_business_type_id']; ?>", true, true);
        $('#parent_business_type_id').append(option).trigger('change');
        <?php } ?>

    });

    function FileKeyGen() {
        $(".file-styled-primary").uniform({
            fileButtonClass: 'action btn bg-blue'
        });
    }
</script>
<?php if (isset($select2)) { ?>
    <?= $select2 ?>
<?php } ?>