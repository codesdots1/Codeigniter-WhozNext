
<?php if(isset($getOpportunityData['series'])) { ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title">Opportunity #OPP000<?= $getOpportunityData['series'] ?><a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
        <div class="heading-elements">
            <div class="btn-group heading-btn">
                <button type="button" class="btn btn-primary dropdown-toggle legitRipple" data-toggle="dropdown">Make<span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="<?= site_url('Quotation/manage'); ?>">Quotation</a></li>
                    <li><a href="<?= site_url('SupplierQuotation/manage'); ?>">Supplier Quotation</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <h4>Fulfillment</h4>
                <h6 class="mb-10">
                    <a href="<?= site_url('Quotation'); ?>" class="text-default">Quotation</a>
                    <span class="btn btn-xs text-blue btn-flat"><a href="<?= site_url('Quotation/manage?type_id='.$getOpportunityData['type_id'].'&type='.$getOpportunityData['opportunity_from']); ?>"><i class="fa fa-plus"></i></a></span>
                </h6>
                <h6 class="mb-10">
                    <a href="<?= site_url('SupplierQuotation'); ?>" class="text-default">Supplier Quotation</a>
                    <span class="btn btn-xs text-blue btn-flat"><a href="<?= site_url('SupplierQuotation/manage?opportunity_id='.$getOpportunityData['opportunity_id']); ?>"><i class="fa fa-plus"></i></a></span>
                </h6>
            </div>

        </div>
    </div>
</div>

<?php } ?>









<div class="panel panel-flat  border-left-lg border-left-slate">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang("opportunity_form") ?></h5>
    </div>

    <div class="panel-body">
        <?php
        //create  form open tag
        $form_id = array(
            'id' => 'opportunityDetails',
            'method' => 'post'
        );
        echo form_open_multipart('', $form_id);
        ?>

        <input type="hidden" name="opportunity_id" id="opportunity_id" value="<?= isset($getOpportunityData['opportunity_id']) ? $getOpportunityData['opportunity_id'] : '' ?>" >

        <fieldset class="content-group">
            <legend class="text-bold"><?= lang("opportunity_details") ?></legend>

            <div class="form-group">

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">
                            <label><?= lang('series') ?></label>
                            <?php if(isset($getOpportunityData['opportunity_id']) && $getOpportunityData['opportunity_id'] != ''){ ?>
                                <input type="text" class="form-control" name="series" id="series" value="<?= $getOpportunityData['prefix'] .$getOpportunityData['series'] ?>" readonly>
                            <?php } else { ?>
                                <input type="text" class="form-control" name="series" id="series" value="<?= OPPORTUNITY_PREFIX.$getNextAutoIncrementId ?>">
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <label><?= lang('opportunity_type') ?></label>
                            <select data-placeholder="Select your <?= lang('opportunity_type') ?>" name="opportunity_type_id" id="opportunity_type_id"
                                    class="select">
                                <option value=""></option>
                                <?= CreateOptions("html", "tbl_opportunity_type", array('opportunity_type_id', 'opportunity_type_name'), isset($getOpportunityData['opportunity_type_id']) ? $getOpportunityData['opportunity_type_id'] : '','','is_active = 1'); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><?= lang('opportunity_status') ?></label>
                            <select data-placeholder="Select your <?= lang('opportunity_status') ?>" name="opportunity_status_id" id="opportunity_status_id"
                                    class="select">
                                <option value=""></option>
                                <?= CreateOptions("html", "tbl_opportunity_status", array('opportunity_status_id', 'opportunity_status_name'), isset($getOpportunityData['opportunity_status_id']) ? $getOpportunityData['opportunity_status_id'] : '','','is_active = 1'); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><?= lang('company') ?></label>
                            <select data-placeholder="Select your <?= lang('company') ?>" name="company_id" id="company_id"
                                    class="select">
                                <option value=""></option>
                                <?= CreateOptions("html", "tbl_company", array('company_id', 'company_name'), isset($getOpportunityData['company_id']) ? $getOpportunityData['company_id'] : ''); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="checkbox" name="with_items" id="with_items" class="styled"
                                        <?= isset($getOpportunityData['with_items']) && $getOpportunityData['with_items'] == 1 ? "checked" : '' ?> >
                                    <label><?= lang('with_items') ?></label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?= lang('opportunity_from') ?></label>
                            <select data-placeholder="Select your <?= lang('opportunity_from') ?>" name="opportunity_from" id="opportunity_from"
                                    class="select">
                                <option value=""></option>
                                <?= CreateOptionFromEnumValues(enumValues("tbl_opportunity","opportunity_from"),isset($getOpportunityData['opportunity_from']) ? $getOpportunityData['opportunity_from'] : '') ?>
                            </select>
                        </div>
                        <div class="form-group" id="lead">
                            <label><?= lang('lead') ?></label>
                            <select data-placeholder="Select Your <?= lang('lead') ?>" name="type_id" id="lead_id" >
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group" id="customer">
                            <label><?= lang('customer') ?></label>
                            <select data-placeholder="Select Your <?= lang('customer') ?>" name="type_id" id="customer_id"  >
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><?= lang('sales_warehouse') ?></label>
                            <select data-placeholder="Select your <?= lang('sales_warehouse') ?>" name="warehouse_id" id="warehouse_id"
                                    class="select">
                                <option value=""></option>
                                <?= CreateOptions("html", "tbl_warehouse", array('warehouse_id', 'warehouse_name'), isset($getOpportunityData['warehouse_id']) ? $getOpportunityData['warehouse_id'] : ''); ?>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </fieldset>

        <!--  Item Info Details -->
        <fieldset class="content-group" id="itemDetailsFieldset">
            <legend class="text-bold"> <?= lang('item_info')?> </legend>
            <div class="form-group">
                <?= $v_itemInfoTable; ?>
            </div>
        </fieldset>
        <!-- End Item Info Details -->

        <!-- create reset button-->
            <div class="text-right">
                <button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
                        onclick="window.location.href='<?= site_url('Opportunity'); ?>'"><?= lang('cancel_btn') ?> <i
                            class="icon-cross2 position-right"></i></button>
                <button type="submit" id="submit"
                        class="btn btn-xs border-blue text-blue btn-flat btn-ladda btn-ladda-progress submit"
                        data-spinner-color="<?= BTN_SPINNER_COLOR; ?>" data-style="fade">
                    <span class="ladda-label"><?= lang('submit_btn') ?></span>
                    <i id="icon-hide" class="icon-arrow-right8 position-right"></i>
                </button>
            </div>
            <?= form_close(); ?>
</div>
</div>

<script>

    var laddaSubmitBtn = Ladda.create(document.querySelector('.submit'));

    jQuery.fn.loadandchange = function (event, handler) {
        handler();
        this.bind(event, handler);
        return this; // support chaining
    };

    $(function () {
        $('#opportunity_from').loadandchange('change', function () {
            var opportunityFrom = $("#opportunity_from").val();
            if ( opportunityFrom == 'customer'){
                $('#customer_id').attr("name","type_id");
                $('#customer').show();
                $('#lead_id').removeAttr("name");
                $('#lead').hide();
                $("#customer_id-error").html('');
                $("#lead_id-error").html('');
            } else if ( opportunityFrom == 'lead') {
                $('#lead_id').attr("name","type_id");
                $('#lead').show();
                $('#customer').hide();
                $('#customer_id').removeAttr("name");
                $("#customer_id-error").html('');
                $("#lead_id-error").html('');
            }
        });
    });

    $(document).ready(function () {

        <?php if(isset($getOpportunityData['with_items']) && $getOpportunityData['with_items'] == 1) { ?>
        $("#itemDetailsFieldset").show();
        <?php } else { ?>
        $("#itemDetailsFieldset").hide();
    <?php } ?>


        $("#end_of_life").datepicker({
            dateFormat: "dd-mm-yy",
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            minDate: new Date(),
            onSelect: function (selected) {
                $("#valid_till").datepicker("option", "minDate", selected)
                if ($(this).valid()) {
                    $(this).removeClass('invalid').addClass('success');
                }
            }
        });

        CheckboxKeyGen();
        Select2Init();
        CountryStateCityDD();

        // Initialize
        var validator = $("#opportunityDetails").validate({
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
                opportunity_from: {
                    required: true
                },
                opportunity_type_id: {
                      required: true,
                },
                opportunity_status_id: {
                    required: true,
                },
                company_id: {
                    required: true,
                },
                "item_code[]":{
                    required: function(element) {
                        return $("#with_items").is(":checked") ? true : false;
                    },
//                    required: true,
                },
                "item_quantity[]":{
                    required: function(element) {
                        return $("#with_items").is(":checked") ? true : false;
                    },
                    number: function(element) {
                        return $("#with_items").is(":checked") ? true : false;
                    },
//                    required: true,
//                    number: true,
                },
                "item_name[]":{
                    required: function(element) {
                        return $("#with_items").is(":checked") ? true : false;
                    },
//                    required: true,
                },
                type_id:{
                    required: function(element){
                        return $("#opportunity_from").val() != "" ? true : false;
                    }
                }
            },
            messages: {
                opportunity_from: {
                    required: "Please Select <?= lang('opportunity_from') ?>",
                },
                opportunity_type_id: {
                    required: "Please Select <?= lang('opportunity_type') ?>",
                },
                opportunity_status_id: {
                    required: "Please Select <?= lang('opportunity_status') ?>",
                },
                company_id: {
                    required: "Please Enter <?= lang('company') ?>",
                },
                "item_code[]":{
                    required: "Please Enter <?= lang('item_code') ?>",
                },
                "item_name[]":{
                    required: "Please Enter <?= lang('item_name') ?>",
                },
                "item_quantity[]":{
                    required: "Please Enter <?= lang('item_quantity') ?>",
                    number: "Please Enter a Valid <?= lang('item_quantity') ?>",

                },
                type_id:{
                    required: function(element){
                        if($('#lead').is(':visible') == true) {
                            return "Please Select <?= lang('lead') ?>";
                        } else {
                            return "Please Select <?= lang('customer') ?>";
                        }
                    }
                }
            },
            submitHandler: function (e) {

                $('textarea.ckeditor').each(function () {
                    var $textarea = $(this);
                    $textarea.val(CKEDITOR.instances[$textarea.attr('name')].getData());
                });
                $(e).ajaxSubmit({
                    url: '<?= site_url("Opportunity/save");?>',
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
                                window.location.href = '<?= site_url('Opportunity');?>';
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

        $("#lead_id").select2({
            ajax: {
                url: "<?= site_url('Customer/getLead') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '', // search term
                        lead_id: "<?= isset($getOpportunityData['type_id']) ? $getOpportunityData['type_id']: ''; ?>",
                        page: params.page || 1
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
//                    params.page = params.page || 1;

                    return {
                        results: data.result,
                        pagination: {
                            more: (data.page * 10) < data.totalRows

                        }
                    };
                },
                //cache: true
            },
            placeholder: 'Search For Your Lead',
            escapeMarkup: function (markup) {
                return markup;
            },

        });

        <?php if(isset($getOpportunityData['name']) && $getOpportunityData['name'] != '' && $getOpportunityData['opportunity_from'] == "lead"){ ?>
        var option = new Option("<?= $getOpportunityData['name']; ?>","<?= $getOpportunityData['type_id']; ?>", true, true);
        $('#lead_id').append(option).trigger('change');
        <?php } ?>

        $("#customer_id").select2({
            ajax: {
                url: "<?= site_url('Customer/getCustomer') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '', // search term
                        customer_id : "<?= isset($getOpportunityData['type_id']) ? $getOpportunityData['type_id']: ''; ?>",
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
            placeholder: 'Search For Your Lead',
            escapeMarkup: function (markup) {
                return markup;
            },
        });

        <?php if(isset($getOpportunityData['name']) && $getOpportunityData['name'] != '' && $getOpportunityData['opportunity_from'] == "customer"){ ?>
        var option = new Option("<?= $getOpportunityData['name']; ?>","<?= $getOpportunityData['type_id']; ?>", true, true);

        $('#customer_id').append(option).trigger('change');
        <?php } ?>

    });

    $(document).on('click','#with_items',function(){
        if($(this).is(":checked")){
           $('#itemDetailsFieldset').show();
       } else {
            $('#itemDetailsFieldset').hide();
       }
    });
</script>

