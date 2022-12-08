<!-- source modal code here -->
<div id="languageModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><?= lang('language_heading') ?></h5>
            </div>

            <div class="modal-body">
                <?php
                $form_id = array(
                    'id' => 'language_Details',
                    'method' => 'post',
                    'class' => 'form-horizontal'
                ); ?>
                <?= form_open('', $form_id); ?>
                <input type="hidden" name="language_id" id="language_id">

                <!-- Language  name -->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('language_name') ?></label>
                    <div class="col-lg-9">
                        <input type="text" name="language_name" id="language_name" class="form-control"
                               placeholder="Enter <?= lang('language_name') ?>">

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('language_code') ?></label>
                    <div class="col-lg-9">
                        <input type="text" maxlength="6" name="language_code" id="language_code" class="form-control"
                               placeholder="Enter <?= lang('language_code') ?>">

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
                        data-dismiss="modal"><?= lang('cancel_btn') ?> <i class="icon-cross2 position-right"></i>
                </button>
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

    $(document).on('hide.bs.modal', '#languageModal', function () {
        $('#languageTable input').prop('checked', false);
        CheckboxKeyGen();
    });

    //Delete Time Cancel button click to remove checked value
    $(document).on('click', '.cancel', function () {
        $('#languageTable input[class="dt-checkbox styled"]').prop('checked', false);
        CheckboxKeyGen();
    });

    $(document).ready(function () {
        CustomToolTip();
        CheckboxKeyGen('checkAll');

        $('#checkAll').click(function () {
            var checkedStatus = this.checked;
            $('#languageTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
            CheckboxKeyGen();
        });


        $('#languageModal').on('shown.bs.modal', function () {
            $('#language_name').focus();
        });

        //Language modal open
        $('.addLanguage').click(function () {
            DtFormClear('language_Details');
            $("form#language_Details input[name=language_id]").val('');
            $('#languageModal').modal('show');
        });
        jQuery.validator.addMethod("lettersonly",function (value,element) {
            return this.optional(element) || /^[a-z ]+$/i.test(value);
        });
        //Language modal validation
        var validator = $("#language_Details").validate({
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
                language_name: {
                    required: true,
                    lettersonly:true,
                    remote: {
                        url: "<?php echo site_url("Language/NameExist");?>",
                        type: "post",
                        data: {
                            column_name: function () {
                                return "language_name";
                            },
                            column_id: function () {
                                return $("#language_id").val();
                            },
                            table_name: function () {
                                return "tbl_language_master";
                            }
                        }
                    }
                },
                language_code: {
                    required: true,
                    lettersonly:true,
                    maxlength:6,
                    remote: {
                        url: "<?php echo site_url("Language/NameExist");?>",
                        type: "post",
                        data: {
                            column_name: function () {
                                return "language_code";
                            },
                            column_id: function () {
                                return $("#language_id").val();
                            },
                            table_name: function () {
                                return "tbl_language_master";
                            }
                        }
                    }
                },

            },
            messages: {
                language_name: {
                    required: "Please Enter <?= lang('language_name') ?>",
                    lettersonly:"Enter only letters",
                    remote: "<?= lang('language_name') ?> Already Exist"
                },
                language_code: {
                    required: "Please Enter <?= lang('language_code') ?>",
                    remote: "<?= lang('language_code') ?> Already Exist",
                    lettersonly:"Enter only letters",
                    maxlength:"Only 6 Characters are allowed"
                },

            },
            submitHandler: function (e) {
                $(e).ajaxSubmit({
                    url: '<?php echo site_url("Language/save");?>',
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
                            $('#languageModal').modal('hide');
                            dt_DataTable.ajax.reload();
                            swal({
                                    title: "<?= ucwords(lang('success')); ?>",
                                    text: resObj.msg,
                                    confirmButtonColor: "<?= BTN_SUCCESS; ?>",
                                    type: "<?= lang('success'); ?>"
                                },
                                function () {
                                    if (typeof dt_DataTable !== 'undefined') {
                                        dt_DataTable.ajax.reload();
                                    } else {
                                        var option = new Option(resObj.language_name, resObj.language_id, true, true);
                                        $('#language_id').append(option).trigger('change');
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
    });


    //Edit Record
    $(document).on('click', '.editRecord', function () {
        $('#languageTable input[class="dt-checkbox styled"]').prop('checked', false);
        $("form#language_Details .validation-error-label").html('');
        var edit_id = $(this).val();
        $("#ids_" + edit_id).prop("checked", true);
        var edit_val = $('.dt-checkbox:checked').val();


        var selected_tr = $('.dt-checkbox:checked');
        var element = $(selected_tr).closest('tr').get(0);
        var aData = dt_DataTable.row(element).data();
//        console.log(aData);

        DtFormFill('language_Details',aData);
        $('#languageModal').modal('show');

    });

</script>