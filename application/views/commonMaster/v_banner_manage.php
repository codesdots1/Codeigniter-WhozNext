<div class="panel panel-flat border-left-lg border-left-slate">
    <div class="panel-heading ">
        <h5 class="panel-title"><?= lang('banner_heading') ?><a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
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
            'id' => 'bannerDetails',
            'method' => 'post',
            'class' => 'form-horizontal',
        );
        echo form_open_multipart('', $form_id);
            $bannerId = isset($getBannerData['banner_id']) && $getBannerData['banner_id'] != '' ? $getBannerData['banner_id'] : '';
        ?>
        <input type="hidden" name="banner_id" id="banner_id" value="<?= $bannerId; ?>">

        <div class="tabbable">

            <ul class="nav nav-tabs">

                <?php
                if (is_array($languages) && count($languages) > 0) {
                    foreach ($languages as $languageCount => $languageData) { ?>
                        <li role="presentation" class="<?= ($languageCount == 0) ? "active" : ""; ?>">
                            <a aria-expanded="true" href="#tab_<?= $languageData['language_id']; ?>" data-toggle="tab">
                                <?= $languageData['language_name']; ?>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>

            </ul>

            <div class="tab-content">
                <?php if (is_array($languages) && count($languages) > 0) {
                    foreach ($languages as $languageCount => $languageData) { ?>

                        <div role="tabpanel" class="<?= ($languageCount == 0) ? "tab-pane active" : "tab-pane"; ?>"
                             id="tab_<?= $languageData['language_id']; ?>">

                            <input type="hidden" name="language_id[]"
                                   value="<?= (isset($languageData['language_id']) && ($languageData['language_id'] != '')) ? $languageData['language_id'] : '' ?>"
                                   id="">
                            <input type="hidden" name="banner_description_id[]"
                                   value="<?= (isset($getBannerDescription[$languageData['language_id']]['banner_description_id']) && ($getBannerDescription[$languageData['language_id']]['banner_description_id'] != '')) ? $getBannerDescription[$languageData['language_id']]['banner_description_id'] : ''; ?>"
                                   id="">
                            <input type="hidden" name="banner_file_id[]"
                                   value="<?= (isset($getBannerDocument[$languageData['language_id']]['banner_file_id']) && ($getBannerDocument[$languageData['language_id']]['banner_file_id'] != '')) ? $getBannerDocument[$languageData['language_id']]['banner_file_id'] : ''; ?>"
                                   id="">

                            <?php if ($languageData['is_default'] == 1) { ?>
                                <!-- Samaj -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('samaj') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <select name="samaj_id" id="samaj_id" class="form-control" data-placeholder="Select <?= lang('samaj') ?> ">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>

                            <!-- Banner Name -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('banner_name') ?><span
                                            class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="banner_name[]"
                                           value="<?= (isset($getBannerDescription[$languageData['language_id']]['banner_name']) && ($getBannerDescription[$languageData['language_id']]['banner_name'] != '')) ? $getBannerDescription[$languageData['language_id']]['banner_name'] : ''; ?>"
                                           id="banner_name_<?= $languageData['language_id'] ?>" class="form-control"
                                           placeholder="Enter <?= lang('banner_name') ?>">
                                </div>
                            </div>

                            <!-- Short Description -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('short_description') ?> <span
                                            class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <textarea name="short_description[]"
                                              id="short_description_<?= $languageData['language_id']; ?>"
                                              placeholder="Enter <?= lang('short_description') ?>" rows="5" cols="5"
                                              class="form-control"> <?php echo (isset($getBannerDescription[$languageData['language_id']]['short_description']) && ($getBannerDescription[$languageData['language_id']]['short_description'] != '')) ? $getBannerDescription[$languageData['language_id']]['short_description'] : ''; ?></textarea>
                                    <label id="short_description-error" class="validation-error-label"
                                           for="short_description"></label>
                                </div>
                            </div>

                            <!-- Long description -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('long_description') ?> <span
                                            class="text-danger"> * </span> </label>
                                <div class="col-lg-9">
                                    <textarea name="long_description[]"
                                              id="long_description_<?= $languageData['language_id']; ?>"
                                              class="ckeditor" rows="2" cols="2">
                                     <?php echo (isset($getBannerDescription[$languageData['language_id']]['long_description']) && ($getBannerDescription[$languageData['language_id']]['long_description'] != ''))
                                         ? $getBannerDescription[$languageData['language_id']]['long_description'] : ""; ?>
                                    </textarea>
                                    <label id="long_description-error" class="validation-error-label" for="long_description"></label>
                                </div>
                            </div>

                            <!-- Banner Document -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('banner_document') ?></label>
                                <div class="col-lg-9">
                                    <input type="file" name="banner_document_<?= $languageData['language_id']?>[]"  id="banner_document" class="file-styled-primary" multiple>
                                </div>
                            </div>

                            <?php if (isset($bannerId) && $bannerId != '') {?>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('banner_document') ?></label>
                                    <div class="col-lg-9">
                                        <?php if (isset($getBannerDocument) && $getBannerDocument != '') {
                                            $html = '';
                                            foreach ($getBannerDocument as $key => $value) {
                                                foreach ($value as $getDocument) {
                                                    if ($key == $languageData['language_id']) {
                                                        $pushDocument = $this->config->item('banner_document_path') . $getDocument['filename'];
                                                        $ext          = pathinfo($getDocument['filename'], PATHINFO_EXTENSION);
                                                        if ($getDocument['filename'] != '' || $getDocument['filename'] != null) {
                                                            if ($ext == 'pdf') {
                                                                $bannerDocument = '<img src="' . site_url() . $this->config->item('banner_document_pdf') . '" alt="">';
                                                            } elseif ($ext == 'docx') {
                                                                $bannerDocument = '<img src="' . site_url() . $this->config->item('banner_document_docx') . '" alt="" style="height:140px; width:140px;">';
                                                            } else {
                                                                $bannerDocument = '<img src="' . site_url() . $this->config->item('banner_document_path') . $getDocument['filename'] . '" alt="" style="height:140px; width:140px;">';
                                                            }
                                                            $html .= '<div class="col-md-4">' .
                                                                '<div class="thumbnail" >' .
                                                                '<div class="thumb">';
                                                            $html .= $bannerDocument;
                                                            $html .= '<div class="caption-overflow">'.
                                                                '<span>' .
                                                                '<a title="View" href="' . site_url(). $this->config->item('banner_document_path') . $getDocument['filename'] . '" data-popup="lightbox" rel="member" class="btn btn-sm border-white text-white btn-flat btn-icon btn-rounded legitRipple"><i class="icon-eye"></i></a>' .
                                                                '<a download title="Download" href="'. site_url() . $this->config->item('banner_document_path') . $getDocument['filename'] . '" class="btn border-white btn-sm text-white btn-flat btn-icon btn-rounded legitRipple"><i class="icon-download4"></i></a>' .
                                                                '<a title="Delete" class="btn border-white text-white btn-sm btn-flat btn-icon btn-rounded legitRipple" onclick="deleteBannerDocument(' . $getDocument['banner_file_id'] . ',\'' . $pushDocument . '\')"><i class="icon-trash"></i></a>' .
                                                                '</span>' .
                                                                '</div>' .
                                                                '</div>' .
                                                                '</div>' .
                                                                '</div>';
                                                        }
                                                    }
                                                }
                                            }
                                            echo $html; ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($languageData['is_default'] == 1) { ?>

                                <!--Start Date-->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('start_date') ?> <span
                                                class="text-danger"> * </span> </label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="start_date"
                                               name="start_date"
                                               value="<?= (isset($getBannerData['start_date'])) ? $getBannerData['start_date'] : date(PHP_DATE_FORMATE); ?>"
                                               placeholder="Select a <?= lang('start_date') ?>" readonly>
                                    </div>
                                </div>

                                <!-- End Date -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('end_date') ?> <span
                                                class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="end_date"
                                               name="end_date"
                                               value="<?= (isset($getBannerData['end_date'])) ? $getBannerData['end_date'] : date(PHP_DATE_FORMATE); ?>"
                                               placeholder="Select a <?= lang('end_date') ?>" readonly>
                                    </div>
                                </div>

                                <!-- Is Active -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('is_active') ?></label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery switchery-xs">
                                            <label>
                                                <input type="checkbox"
                                                       name="is_active" <?php if (isset($getBannerData['is_active']) && $getBannerData['is_active'] == 1) {
                                                    echo 'checked="checked"';
                                                } else {
                                                    echo '';
                                                } ?> id="is_active" class="switchery">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
        <!-- create reset button-->
        <div class="text-right">
            <button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
                    onclick="window.location.href='<?php echo site_url('Banner'); ?>'"><?= lang('cancel_btn') ?> <i
                        class="icon-cross2 position-right"></i></button>

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

        numberInit();
        Select2Init();
        SwitcheryKeyGen();
        FileKeyGen();
        samajDD('', '#samaj_id');

        // Initialize
        jQuery.validator.addMethod("lettersonly", function (value, element) {
            return this.optional(element) || /^[a-z ]+$/i.test(value);
        }, "Only Letters are allowed");
        var validator = $("#bannerDetails").validate({
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
                samaj_id: {
                    required: true
                },
                'banner_document[]': {
                    extension: "<?= FILE_UPLOAD_TYPE; ?>",
                    filesize: "<?= MAX_DOCUMENT_SIZE_LIMIT; ?>"
                },
                'banner_name[]': {
                    required: true,
                    maxlength: 255
                },
                'short_description[]': {
                    required: true,
                    maxlength: 255
                },
                'long_description[]': {
                    required: function (textarea) {
                        CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                        var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                        return editorcontent.length === 0;
                    }
                },
                start_date: {
                    required: true,
                    validDate: true
                },
                end_date: {
                    required: true,
                    validDate: true
                }
            },
            messages: {
                samaj_id: {
                    required: "Please Enter <?= lang('samaj') ?>"
                },
                'banner_document[]': {
                    extension: "Please Enter File in extension as follows <?php echo FILE_UPLOAD_TYPE ?>",
                    filesize: "Please Upload File in <?= MAX_DOCUMENT_SIZE_LIMIT ?>"
                },
                'banner_name[]': {
                    required: "Please Enter <?= lang('banner_name') ?>",
                    maxlength: "Please Enter 255 character only"
                },
                'short_description[]': {
                    required: "Please Enter <?= lang('short_description') ?>",
                    maxlength: "Please Enter 255 character only"
                },
                'long_description[]': {
                    required: "Please Enter <?= lang('long_description') ?>"
                },
                start_date: {
                    required: "Please Enter <?= lang('start_date') ?>"
                },
                end_date: {
                    required: "Please Enter <?= lang('end_date') ?>"
                }
            },
            submitHandler: function (e) {
                $(e).ajaxSubmit({
                    url: '<?php echo site_url("Banner/save");?>',
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
                                window.location.href = '<?php echo site_url('Banner');?>';
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

        $("#start_date").datepicker({
            dateFormat: 'dd-mm-yy',
            todayBtn: "linked",
            autoclose: true,
            maxDate: 0,
            todayHighlight: true,
            onSelect: function (selected) {
                $("#end_date").datepicker("option", "minDate", selected)
                if ($(this).valid()) {
                    $(this).removeClass('invalid').addClass('success');
                }
                var id = $(this).attr('id');
                $("input[name="+id+"]").val($(this).val());
            }
        });

        $("#end_date").datepicker({
            dateFormat: "<?= DATE_FORMATE; ?>",
            todayBtn:  "linked",
            autoclose: true,
            todayHighlight: true,
            onSelect: function(selected) {
                if ($(this).valid()) {
                    $(this).removeClass('invalid').addClass('success');
                }
                var id = $(this).attr('id');
                $("input[name="+id+"]").val($(this).val());
            }
        });

        $.validator.addMethod("validDate", function (value) {
            var currVal = value;
            if (currVal == '')
                return false;

            var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; //Declare Regex
            var dtArray = currVal.match(rxDatePattern); // is format OK?

            if (dtArray == null)
                return false;
            dtDay = dtArray[1];
            dtMonth = dtArray[3];
            dtYear = dtArray[5];

            if (dtMonth < 1 || dtMonth > 12)
                return false;
            else if (dtDay < 1 || dtDay > 31)
                return false;
            else if ((dtMonth == 4 || dtMonth == 6 || dtMonth == 9 || dtMonth == 11) && dtDay == 31)
                return false;
            else if (dtMonth == 2) {
                var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
                if (dtDay > 29 || (dtDay == 29 && !isleap))
                    return false;
            }
            return true;
        }, 'Please enter a valid date');

        <?php if((isset($getBannerData['samaj_id']) && !empty($getBannerData['samaj_id']))){?>
        var option = new Option("<?= $getBannerData['samaj_name']; ?>", "<?= $getBannerData['samaj_id']; ?>", true, true);
        $('#samaj_id').append(option).trigger('change');
        <?php } ?>

    });

    function deleteBannerDocument(bannerDocumentId, bannerDocumentUrl) {
        swal({
            title: "<?= ucwords(lang('delete')); ?>",
            text: "<?= lang('delete_warning'); ?>",
            type: "<?= lang('warning'); ?>",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonColor: "<?= BTN_DELETE_WARNING; ?>",
            showLoaderOnConfirm: true
        },
        function () {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Banner/bannerDocumentDelete');?>",
                dataType: "json",
                //async: false,
                data: {banner_document_id: bannerDocumentId, banner_document_url: bannerDocumentUrl},
                success: function (data) {
                    if (data['success']) {
                        swal({
                            title: "<?= ucwords(lang('success'))?>",
                            text: data['msg'],
                            type: "<?= lang('success')?>",
                            confirmButtonColor: "<?= BTN_SUCCESS; ?>"
                        }, function () {
                            location.reload();
                        });
                    } else {
                        swal({
                            title: "<?= ucwords(lang('error')); ?>",
                            text: data['msg'],
                            type: "<?= lang('error'); ?>",
                            confirmButtonColor: "<?= BTN_ERROR; ?>"
                        }, function () {

                        });
                    }
                }
            });
        });
    }

    function FileKeyGen() {
        $(".file-styled-primary").uniform({
            fileButtonClass: 'action btn bg-blue'
        });
    }

</script>
<?php if (isset($select2)) { ?>
    <?= $select2 ?>
<?php } ?>
