<div class="panel panel-flat border-left-lg border-left-slate">
    <div class="panel-heading ">
        <h5 class="panel-title"><?= lang('monk_heading') ?><a class="heading-elements-toggle"><i
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
            'id' => 'eventDetails',
            'method' => 'post',
            'class' => 'form-horizontal'
        );
        echo form_open_multipart('', $form_id);
        $monkId = (isset($getMonkData['monk_id']) && ($getMonkData['monk_id'] != '')) ? $getMonkData['monk_id'] : '';
        ?>
        <input type="hidden" name="monk_id" value="<?= $monkId; ?>" id="monk_id">
        <div class="tabbable">

            <ul class="nav nav-tabs">
                <?php  foreach ($languages as $languageCount => $languageData) {
                    ?>
                    <li role="presentation" class = "<?= ($languageCount == 0) ? "active" : ""; ?>">
                        <a aria-expanded="true" href="#tab_<?= $languageData['language_id']; ?>" data-toggle="tab">
                            <?=  $languageData['language_name'];?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <div class="tab-content">
                <?php  foreach ($languages as $languageCount => $languageData) {
                    ?>
                    <div role="tabpanel" class = "<?= ($languageCount == 0) ? "tab-pane active" : "tab-pane"; ?>"
                         id="tab_<?= $languageData['language_id']; ?>">
                        <input type="hidden" name="language_id[]"
                               value="<?= (isset($languageData['language_id']) && ($languageData['language_id'] != '')) ? $languageData['language_id'] : '' ?>"
                               id="">
                        <input type="hidden" name="event_description_id[]"
                               value="<?= (isset($getMonkDescription[$languageData['language_id']]['event_description_id']) && ($getMonkDescription[$languageData['language_id']]['event_description_id'] != '')) ? $getMonkDescription[$languageData['language_id']]['event_description_id'] : ''; ?>" id="">

                        <?php if($languageData['is_default'] == 1) { ?>

                            <!--Samaj-->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('samaj_name') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <select name="samaj_id" id="samaj_id" data-init="1" data-placeholder="Select <?= lang('samaj_name') ?>" class="select">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>

                            <!--Memeber-->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('member_name') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <select name="member_id" id="member_id" class="form-control"
                                            data-placeholder="Select <?= lang('member_name') ?> ">
                                        <option value=""></option>

                                    </select>
                                </div>
                            </div>

                        <?php } ?>

                        <!-- Monk Name -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('monk_name') ?><span class="text-danger"> * </span></label>
                            <div class="col-lg-9">
                                <input type="text" name="monk_name[]" value="<?= (isset($getMonkDescription[$languageData['language_id']]['monk_name']) && ($getMonkDescription[$languageData['language_id']]['monk_name'] != '')) ? $getMonkDescription[$languageData['language_id']]['monk_name'] : ''; ?>" id="event_name_<?= $languageData['language_id']; ?>" class="form-control"
                                       placeholder="Enter <?= lang('monk_name') ?>" id="event_name_<?= $languageData['language_id']; ?>" >
                            </div>
                        </div>

                        <!--description -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('description') ?><span class="text-danger"> * </span></label>
                            <div class="col-lg-9">
                            <textarea name="description[]" id="description<?= $languageData['language_id']; ?>" class="ckeditor" rows="2" cols="2">
                                 <?php echo (isset($getMonkDescription[$languageData['language_id']]['description']) && !empty($getMonkDescription[$languageData['language_id']]['description'])) ? $getMonkDescription[$languageData['language_id']]['description'] : ""; ?>
                            </textarea>
                                <label id="description-error" class="validation-error-label" for="description"></label>
                            </div>
                        </div>


                        <?php if($languageData['is_default'] == 1) { ?>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('diksha_date') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="diksha_date"
                                           name="diksha_date" value="<?= (isset($getMonkData['diksha_date'])) ? $getMonkData['diksha_date'] : date(PHP_DATE_FORMATE); ?>"
                                           placeholder="Select a <?= lang('start_date') ?>" readonly>
                                </div>
                            </div>

                            <?php } ?>

                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- create reset button-->
        <div class="text-right">
            <button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
                    onclick="window.location.href='<?php echo site_url('Monk'); ?>'"><?= lang('cancel_btn') ?> <i class="icon-cross2 position-right"></i> </button>

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
<!--<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCuHX1kolcnapKN-MAW_hhgOLPXEbHVKQA&libraries=places"></script>-->


<script>
    var laddaSubmitBtn = Ladda.create(document.querySelector('.submit'));

    $(document).ready(function () {
        // Full featured editor
//        CKEDITOR.replace( 'long_description', {
//            height: '400px',
//            extraPlugins: 'forms'
//        });

        Select2Init();
        $("#samaj_id").change(function () {
            $('#member_id').val("").trigger('change.select2');
            var samajId = $("#samaj_id").val();
            getMember(samajId,'');
        });
        samajDD('','#samaj_id');


        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param)
        });
        // Initialize
        var validator = $("#eventDetails").validate({
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
                    required  : true
                },
                'monk_name[]': {
                    required: true,
                    maxlength: 100
                },
                member_id: {
                     required: true
                },
                'description[]': {
                    required: function(textarea) {
                        CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                        var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                        return editorcontent.length === 0;
                    }
                },
                diksha_date: {
                    required:  true,
                    validDate: true
                }

            },
            messages: {
                samaj_id :{
                    required: "Please select <?= lang('samaj_name') ?>"

                },
                member_id :{
                    required: "Please select <?= lang('member_name') ?>"

                },
                'monk_name[]': {
                    required: "Please Enter <?= lang('monk_name') ?>",
                    maxlength: "Please Enter only 100 Characters"
                },
                'description[]': {
                    required: "Please Enter <?= lang('description') ?>"
                },
                diksha_date: {
                    required: "Please Enter <?= lang('diksha_date') ?>"
                }
            },
            submitHandler: function (e) {
                // $('textarea.ckeditor').each(function () {
//                    var $textarea = $(this);
//                    $textarea.val(CKEDITOR.instances[$textarea.attr('name')].getData());
//                });

                $(e).ajaxSubmit({
                    url: '<?php echo site_url("Monk/save");?>',
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
                                window.location.href = '<?php echo site_url('Monk');?>';
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
        FileValidate();
        FileKeyGen();
        TimePickerInit();
        $("#diksha_date").datepicker({
            dateFormat: "<?= DATE_FORMATE ?>",
            todayBtn:  "linked",
            autoclose: true,
            todayHighlight: true,
            onSelect: function(selected) {

                $("#end_date").datepicker("option", "minDate", selected)
                if ($(this).valid()) {
                    $(this).removeClass('invalid').addClass('success');
                }
//                else
//                {
//                    var endTime = endDate.getTime() + $('#_date').parseValToNumber();
//                    var startTime = startDate.getTime() + $('#end_date').parseValToNumber();
//                    return endTime > startTime;
//                }

                var id = $(this).attr('id');
                $("input[name="+id+"]").val($(this).val());

            }
        });

        $.validator.addMethod("validDate", function(value) {
            var currVal = value;
            if(currVal == '')
                return false;

            var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; //Declare Regex
            var dtArray = currVal.match(rxDatePattern); // is format OK?

            if (dtArray == null)
                return false;

            //Checks for mm/dd/yyyy format.
            dtDay = dtArray[1];
            dtMonth = dtArray[3];
            dtYear = dtArray[5];

            if (dtMonth < 1 || dtMonth > 12)
                return false;
            else if (dtDay < 1 || dtDay> 31)
                return false;
            else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31)
                return false;
            else if (dtMonth == 2)
            {
                var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
                if (dtDay> 29 || (dtDay ==29 && !isleap))
                    return false;
            }
            return true;
        }, 'Please enter a valid date');


        <?php if((isset($getMonkData['samaj_name']) && !empty($getMonkData['samaj_name']))){
        $samajName = $getMonkData['samaj_name']; ?>
        var option = new Option("<?= $getMonkData['samaj_name']; ?>", "<?= $getMonkData['samaj_id']; ?>", true, true);
        $('#samaj_id').append(option).trigger('change');
        <?php } ?>


        <?php if((isset($getMonkData['member_name']) && !empty($getMonkData['member_name']))){
        $memberName = $getMonkData['member_name']; ?>
        var option = new Option("<?= $getMonkData['member_name']; ?>", "<?= $getMonkData['member_id']; ?>", true, true);
        $('#member_id').append(option).trigger('change');
        <?php } ?>
    });

</script>

<?php if (isset($select2)) { ?>
    <?= $select2 ?>
<?php } ?>


