<!--opportunity_status modal code here -->
<div id="opportunityStatusModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><?= lang('opportunity_status_heading') ?></h5>
            </div>

            <div class="modal-body">
                <?php
                $form_id = array(
                    'id'=>'opportunityStatusDetails',
                    'method'=>'post',
                    'class'=>'form-horizontal'
                );?>
                <?= form_open('',$form_id); ?>
                <input type="hidden" name="opportunity_status_id" id="opportunity_status_id">
                <!-- opportunity_status  name -->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('opportunity_status_name') ?></label>
                    <div class="col-lg-9">
                        <input type="text" name="opportunity_status_name" id="opportunity_status_name" class="form-control"
                               placeholder="Enter <?= lang('opportunity_status_name') ?>">

                    </div>
                </div>

                <!-- Opportunity Status -->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('opportunity_status_type') ?></label>
                    <div class="col-lg-9">
                        <select data-placeholder="Select your <?= lang('opportunity_status_type') ?>" name="opportunity_status_type" id="opportunity_status_type"
                                class="select">
                            <option value=""></option>
                            <?= CreateOptionFromEnumValues(enumValues("tbl_opportunity_status","opportunity_status_type")); ?>
                        </select>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('description') ?></label>
                    <div class="col-lg-9">
                        <textarea name="description" id="description" class="ckeditor" rows="2" cols="2"></textarea>
                        <label id="description-error" class="validation-error-label" for="description"></label>
                    </div>
                </div>

                <!-- sort order -->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('sort_order') ?></label>
                    <div class="col-lg-9">
                        <input type="tel" name="sort_order" id="sort_order" class="form-control"
                               placeholder="Enter <?= lang('sort_order') ?>">

                    </div>
                </div>


                <!--  is default  -->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('is_default') ?></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery switchery-xs">
                            <label>
                                <input type="checkbox" name="is_default" id="is_default" class="switchery">
                            </label>
                        </div>
                    </div>
                </div>


                <!--  is close  -->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('is_close') ?></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery switchery-xs">
                            <label>
                                <input type="checkbox" name="is_close" id="is_close" class="switchery">
                            </label>
                        </div>
                    </div>
                </div>

                <!-- is active-->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('is_active') ?></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery switchery-xs">
                            <label>
                                <input type="checkbox" name="is_active" id="is_active" class="switchery">
                            </label>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="reset" name="cancel"
                       class="btn btn-xs border-slate text-slate btn-flat cancel"
                        data-dismiss="modal"><?= lang('cancel_btn') ?> <i class="icon-cross2 position-right"></i></button>
                <button type="submit" id="submit"
                        class="btn btn-xs border-blue text-blue btn-flat btn-ladda btn-ladda-progress submit"
                        data-spinner-color="<?= BTN_SPINNER_COLOR; ?>" data-style="fade">
                    <span class="ladda-label"><?= lang('submit_btn') ?></span>
                    <i id="icon-hide" class="icon-arrow-right8 position-right"></i>
                </button>

                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<!--  add,update code here-->
<script>

    var laddaSubmitBtn = Ladda.create(document.querySelector('.submit'));

    $(document).on('hide.bs.modal', '#opportunityStatusModal', function () {
        $('#opportunityStatusTable input').prop('checked', false);
        CheckboxKeyGen();
    });

    //Delete Time Cancel button click to remove checked value
    $(document).on('click', '.cancel', function () {
        $('#opportunityStatusTable input[class="dt-checkbox styled"]').prop('checked', false);
        CheckboxKeyGen();
    });

    $(document).ready(function () {
        Select2Init();
        CustomToolTip();
        CheckboxKeyGen('checkAll');

//        $('#checkAll').prop('checked', false);
        $('#checkAll').click(function () {
            var checkedStatus = this.checked;
            $('#opportunityStatusTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
            CheckboxKeyGen();
        });


        $('#opportunityStatusModal').on('shown.bs.modal', function () {
            $('#opportunity_status_name').focus();
        });

        //opportunity_status modal open
        $('.addOpportunityStatus').click(function () {
            DtFormClear('opportunityStatusDetails');
            $("form#opportunityStatusDetails input[name=opportunity_status_id]").val('');
            $('#opportunityStatusModal').modal('show');
        });

        //opportunity_status modal validation
        var validator = $("#opportunityStatusDetails").validate({
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-error-label',
            successClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },

            // Different components require proper error label placement
            errorPlacement: function(error, element) {

                // Styled checkboxes, radios, bootstrap switch
                if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                    if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                        error.appendTo( element.parent().parent().parent().parent() );
                    }
                    else {
                        error.appendTo( element.parent().parent().parent().parent().parent() );
                    }
                }

                // Unstyled checkboxes, radios
                else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                    error.appendTo( element.parent().parent().parent() );
                }

                // Input with icons and Select2
                else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo( element.parent() );
                }

                // Inline checkboxes, radios
                else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent() );
                }

                // Input group, styled file input
                else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                    error.appendTo( element.parent().parent() );
                }

                else {
                    error.insertAfter(element);
                }
            },
            validClass: "validation-valid-label",
            success: function(label) {
                label.addClass("validation-valid-label").text("Success.")
            },
            rules: {
                opportunity_status_name: {
                    required: true,
                    remote: {
                        url: "<?php echo site_url( "OpportunityStatus/NameExist");?>",
                        type: "post",
                        data: {
                            column_name: function () {
                                return "opportunity_status_name";
                            },
                            column_id: function () {
                                return $("#opportunity_status_id").val();
                            },
                            table_name: function () {
                                return "tbl_opportunity_status";
                            },
                        }
                    }
                },
                opportunity_status_type : {
                    required: true,
                },
                description : {
                    required: true,
                },
                sort_order:{
                    required: true,
                    number:true
                }
            },
            messages: {
                opportunity_status_name: {
                    required: "Please Enter <?= lang('opportunity_status_name') ?>",
                    remote  : "<?= lang('opportunity_status_name') ?> Already Exist",

                },
                opportunity_status_type: {
                    required: "Please Enter <?= lang('opportunity_status_type') ?>",
                },
                description : {
                    required: "Please Enter <?= lang('description') ?>",
                },
                sort_order:{
                    required: "Please Enter <?= lang('sort_order') ?>",
                    number: "Please Enter a valid <?= lang('sort_order') ?>",
                }
            },
            submitHandler: function (e) {
                $('textarea.ckeditor').each(function () {
                    var $textarea = $(this);
                    $textarea.val(CKEDITOR.instances[$textarea.attr('name')].getData());
                });
                $(e).ajaxSubmit({
                    url: '<?php echo site_url("OpportunityStatus/save");?>',
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
                        if(resObj.success){
                            $('#opportunityStatusModal').modal('hide');
                            swal({
                                    title: "<?= ucwords(lang('success')); ?>",
                                    text: resObj.msg,
                                    confirmButtonColor: "<?= BTN_SUCCESS; ?>",
                                    type: "<?= lang('success'); ?>"
                                },
                                function () {
                                    if(typeof dt_DataTable !== 'undefined' ) {
                                        dt_DataTable.ajax.reload();
                                    } else {
                                        var option = new Option(resObj.address_type, resObj.opportunity_status_id, true, true);
                                        $('#AddressTypeList').append(option).trigger('change');
                                    }
                            });
                        }else{
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
    });

         //Edit Record
    $(document).on('click', '.editRecord', function(){
        $('#opportunityStatusTable input[class="dt-checkbox styled"]').prop('checked',false);
        $("form#opportunityStatusDetails .validation-error-label").html('');
        var id = $(this).val();
        $("#ids_"+id).prop("checked",true);
        var edit_val = $('.dt-checkbox:checked').val();
        var selected_tr = $('.dt-checkbox:checked');
        var element = $(selected_tr).closest('tr').get(0);
        var aData = dt_DataTable.row(element).data();
        DtFormFill('opportunityStatusDetails',aData);

        $('#opportunityStatusModal').modal('show');

    });

</script>