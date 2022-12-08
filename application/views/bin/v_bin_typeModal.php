<!--Bin type modal code here -->
<div id="binTypeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><?= lang('bin_type_form') ?></h5>
            </div>

            <div class="modal-body">
                <?php
                $form_id = array(
                    'id'=>'BinTypeDetails',
                    'method'=>'post',
                    'class'=>'form-horizontal'
                );?>
                <?= form_open('',$form_id); ?>
                <input type="hidden" name="bin_type_id" id="bin_type_id" value="">
                <!-- Bin Type name -->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('bin_type_name') ?></label>
                    <div class="col-lg-9">
                        <input type="text" name="bin_type_name" id="bin_type_name" class="form-control"
                               placeholder="Enter <?= lang('bin_type_name') ?>">
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

<!--  add,update and delete model code here-->
<script>

    var laddaSubmitBtn = Ladda.create(document.querySelector('.submit'));

    $(document).on('hide.bs.modal', '#binTypeModal', function () {
        $('#binTypeTable input').prop('checked', false);
        CheckboxKeyGen();
    });

    //Delete Time Cancel button click to remove checked value
    $(document).on('click', '.cancel', function () {
        $('#binTypeTable input[class="dt-checkbox styled"]').prop('checked', false);
        CheckboxKeyGen();
    });

    $(document).ready(function () {
        CustomToolTip();
        CheckboxKeyGen('checkAll');

//        $('#checkAll').prop('checked', false);
        $('#checkAll').click(function () {
            var checkedStatus = this.checked;
            $('#binTypeTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
            CheckboxKeyGen();
        });


        $('#binTypeModal').on('shown.bs.modal', function () {
            $('#bin_type_name').focus();
        });

        //bin type model open
        $('.addBinTYpe').click(function () {
            DtFormClear('BinTypeDetails');
            $("form#BinTypeDetails input[name=bin_type_id]").val('');
            $('#binTypeModal').modal('show');
        });

        //Bin Type model validation
        var validator = $("#BinTypeDetails").validate({
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
                bin_type_name: {
                    required: true,
                    remote: {
                        url: "<?php echo site_url( "BinType/NameExist");?>",
                        type: "post",
                        data: {
                            column_name: function () {
                                return "bin_type_name";
                            },
                            column_id: function () {
                                return $("#bin_type_id").val();
                            },
                            table_name: function () {
                                return "tbl_bin_type";
                            }
                        }
                    }
                }
            },
            messages: {
                bin_type_name: {
                    required: "Please Enter <?= lang('bin_type_name') ?>",
                    remote  : "<?= lang('bin_type_name') ?> Already Exist"
                }
            },
            submitHandler: function (e) {
                $(e).ajaxSubmit({
                    url: '<?php echo site_url("BinType/save");?>',
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
                            $('#binTypeModal').modal('hide');
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
                                        var option = new Option(resObj.bin_type_name, resObj.bin_type_id, true, true);
                                        $('#BinTypeList').append(option).trigger('change');
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

    //Edit function
    function EditRecord(binTypeId) {
        $('#binTypeTable input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + binTypeId).prop('checked', true);
        $('.editRecord').click();
    }


    //Edit Record
    $(document).on('click', '.editRecord', function(){
        $('#binTypeTable input[class="dt-checkbox styled"]').prop('checked',false);
        $("form#BinTypeDetails .validation-error-label").html('');
        var id = $(this).val();
        $("#ids_"+id).prop("checked",true);
        var edit_val = $('.dt-checkbox:checked').val();
        var selected_tr = $('.dt-checkbox:checked');
        var element = $(selected_tr).closest('tr').get(0);
        var aData = dt_DataTable.row(element).data();

        DtFormFill('BinTypeDetails',aData);
        $('#binTypeModal').modal('show');
    });

</script>