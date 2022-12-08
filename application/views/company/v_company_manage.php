<div class="panel panel-flat  border-left-lg border-left-slate">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('company_form') ?></h5>
    </div>

    <div class="panel-body">
        <?php
        //create  form open tag
        $form_id = array(
            'id' => 'companyDetails',
            'method' => 'post',
            'autocomplete' => 'off'
        );
        echo form_open_multipart('', $form_id);
        ?>

        <input type="hidden" name="company_id" value="<?= isset($getCompanyData['company_id']) ? $getCompanyData['company_id'] : '' ?>" id="company_id">
        <!-- Company Information -->
        <fieldset class="content-group">
            <legend class="text-bold"><?= lang('company_info') ?></legend>

            <div class="form-group">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label><?= lang('company_name') ?></label>
                        <input type="text" class="form-control" name="company_name" id="company_name"
                               value="<?= isset($getCompanyData['company_name']) ? $getCompanyData['company_name'] : '' ?>"
                               placeholder="Please Enter <?= lang('company_name') ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label><?= lang('abbr') ?></label>
                        <input type="text" class="form-control" name="abbr" id="abbr"
                               value="<?= isset($getCompanyData['abbr']) ? $getCompanyData['abbr'] : '' ?>"
                               placeholder="Please Enter <?= lang('abbr') ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label><?= lang('email') ?></label>
                        <input type="email" class="form-control" name="email" id="email"
                               value="<?= isset($getCompanyData['email']) ? $getCompanyData['email'] : '' ?>"
                               placeholder="Please Enter <?= lang('email') ?>">
                    </div>

                    <div class="form-group col-md-3">
                        <label><?= lang('phone_no') ?></label>
                        <input type="tel" class="form-control numberInit" name="phone_no" id="phone_no"
                               value="<?= isset($getCompanyData['phone_no']) ? $getCompanyData['phone_no'] : '' ?>"
                               placeholder="Please Enter <?= lang('phone_no') ?>">
                    </div>

                    <div class="form-group col-md-3">
                        <label><?= lang('fax') ?></label>
                        <input type="tel" class="form-control numberInit" name="fax" id="fax"
                               value="<?= isset($getCompanyData['fax']) ? $getCompanyData['fax'] : '' ?>"
                               placeholder="Please Enter <?= lang('fax') ?>">
                    </div>
                </div>

            </div>
        </fieldset>
        <!-- End Company Information -->

        <!--Default Values-->
        <fieldset class="content-group">
            <legend class="text-bold"><?= lang('default_values') ?></legend>
            <div class="form-group">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label><?= lang('default_currency') ?></label>
                        <select class="form-control select" name="currency_id" id="currency_id" value="" data-placeholder="Please Select <?= lang('default_currency') ?>">
                            <option value=""></option>
                            <?= CreateOptions("html","tbl_currency",array("currency_id","currency_name"),isset($getCompanyData['currency_id']) ? $getCompanyData['currency_id'] : '' ); ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label><?= lang('default_country') ?></label>
                        <select class="form-control" name="country_id" id="country_id" value="" data-placeholder="Please Select <?= lang('default_country') ?>">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label><?= lang('default_letter_head') ?></label>
                        <select class="form-control select" name="letter_head_id" id="letter_head_id" value="" data-placeholder="Please Enter <?= lang('default_letter_head') ?>">
                            <option value=""></option>
                            <?= CreateOptions("html", "tbl_letter_head", array("letter_head_id", "letter_head_name"), isset($getCompanyData['letter_head_id']) ? $getCompanyData['letter_head_id'] : ''); ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label><?= lang('default_holiday_list') ?></label>
                        <select class="form-control select" name="holiday_id" id="holiday_id" value="" data-placeholder="Please Enter <?= lang('default_holiday_list') ?>">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label><?= lang('default_terms') ?></label>
                        <select class="form-control select" name="terms_condition_id" id="terms_condition_id" value="" data-placeholder="Please Enter <?= lang('default_terms') ?>">
                            <option value=""></option>
                            <?= CreateOptions("html", "tbl_terms_conditions", array('terms_condition_id', 'title'), isset($getCompanyData['terms_condition_id']) ? $getCompanyData['terms_condition_id'] : ''); ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label><?= lang('tax_id') ?></label>
                        <input type="text" class="form-control" name="tax_id" id="tax_id"
                               value="<?= isset($getCompanyData['tax_id']) ? $getCompanyData['tax_id'] : '' ?>"
                               placeholder="Please Enter <?= lang('tax_id') ?>">
                    </div>
                </div>
            </div>


        </fieldset>
        <!-- End Address and contact -->

        <!-- create reset button-->
        <div class="text-right">
            <button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
                    onclick="window.location.href='<?php echo site_url('Company'); ?>'"><?= lang('cancel_btn') ?> <i
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

        <?php if((isset($getCompanyData['country_name']) && ($getCompanyData['country_name'] != ''))){ ?>
        var option = new Option("<?= $getCompanyData['country_name']; ?>",
            "<?= $getCompanyData['country_id']; ?>", true, true);
        $('#country_id').append(option).trigger('change');
        <?php } ?>

        CountryStateCityDD();
        Select2Init();
        numberInit();

        $("#holiday_id").select2({

            ajax: {
                url: "<?= site_url('Holiday/getHoliday') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '', // search term
                        condition : { holiday_id : "<?= isset($getCompanyData['holiday_id']) ? $getCompanyData['holiday_id'] : ''; ?>"},
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

        <?php if((isset($getCompanyData['holiday_name']) && ($getCompanyData['holiday_name'] != ''))){ ?>
        var option = new Option("<?= $getCompanyData['holiday_name']; ?>",
            "<?= $getCompanyData['holiday_id']; ?>", true, true);
        $('#holiday_id').append(option).trigger('change');
        <?php } ?>

        // Initialize
        var validator = $("#companyDetails").validate({
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
                company_name:{
                    required:true
                },
                abbr:{
                    required:true
                },
                email:{
                    required:true,
                    email:true
                },
                phone_no:{
                    required:true,
                    number:true
                },
                fax:{
                    required:true,
                    number:true
                },
                currency_id:{
                    required:true
                },
                country_id:{
                    required:true
                }
            },
            messages: {
                company_name:{
                    required:"Please Enter <?= lang('company_name') ?>"
                },
                abbr:{
                    required:"Please Enter <?= lang('abbr') ?>"
                },
                email:{
                    required:"Please Enter <?= lang('email') ?>",
                    email:"Please Enter a Valid <?= lang('email') ?>"
                },
                phone_no:{
                    required:"Please Enter <?= lang('phone_no') ?>",
                    number:"Please Enter a Valid <?= lang('phone_no') ?>"
                },
                fax:{
                    required:"Please Enter <?= lang('fax') ?>",
                    number:"Please Enter a Valid <?= lang('fax') ?>"
                },
                currency_id:{
                    required:"Please Select <?= lang('currency') ?>"
                },
                country_id:{
                    required:"Please Select <?= lang('country') ?>"
                }

            },
            submitHandler: function (e) {
                $(e).ajaxSubmit({
                    url: '<?php echo site_url("Company/save");?>',
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
                                window.location.href = '<?php echo site_url('Company');?>';
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

