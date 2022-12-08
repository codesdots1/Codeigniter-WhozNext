<div class="panel panel-flat border-left-lg border-left-slate">
    <div class="panel-heading ">
        <h5 class="panel-title"><?= lang('pachkhan_heading') ?><a class="heading-elements-toggle"><i
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
        //create form open tag
        $form_id = array(
            'id' => 'pachkhanDetails',
            'method' => 'post',
            'class' => 'form-horizontal'
        );
        echo form_open_multipart('', $form_id);
        ?>

        <input type="hidden" name="pachkhan_id" value="<?=(isset($getPachkhanData['pachkhan_id']) && ($getPachkhanData['pachkhan_id'] != '')) ? $getPachkhanData['pachkhan_id'] : '' ?>" id="pachkhan_id">
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
                <?php foreach ($languages as $languageCount => $languageData) {
                    ?>
                    <div role="tabpanel" class = "<?= ($languageCount == 0) ? "tab-pane active" : "tab-pane"; ?>"
                         id="tab_<?= $languageData['language_id']; ?>">
                        <input type="hidden" name="language_id[]"
                               value="<?= (isset($languageData['language_id']) && ($languageData['language_id'] != '')) ? $languageData['language_id'] : '' ?>"
                               id="">
                        <input type="hidden" name="pachkhan_description_id[]"
                               value="<?= (isset($getPachkhanDescription[$languageData['language_id']]['pachkhan_description_id']) && ($getPachkhanDescription[$languageData['language_id']]['pachkhan_description_id'] != '')) ? $getPachkhanDescription[$languageData['language_id']]['pachkhan_description_id'] : ''; ?>" id="">
                        
                        <!-- pachkhan Name -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('pachkhan_name') ?>
                                <span class="text-danger"> * </span>
                            </label>
                            <div class="col-lg-9">
                                <input type="text" name="pachkhan_name[]" value="<?= (isset($getPachkhanDescription[$languageData['language_id']]['pachkhan_name']) && ($getPachkhanDescription[$languageData['language_id']]['pachkhan_name'] != '')) ? $getPachkhanDescription[$languageData['language_id']]['pachkhan_name'] : ''; ?>" class="form-control"
                                       placeholder="Enter <?= lang('pachkhan_name') ?>" id="pachkhan_name_<?= $languageData['language_id']; ?>">
                            </div>
                        </div>
                        <!-- Short description -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('short_description') ?>
                                <span class="text-danger"> * </span>
                            </label>
                            <div class="col-lg-9">
                                <textarea name="short_description[]" id="short_description_<?= $languageData['language_id']; ?>" placeholder="Enter Only 255 Character" rows="5" cols="5"  class="form-control"><?php echo (isset($getPachkhanDescription[$languageData['language_id']]['short_description']) && ($getPachkhanDescription[$languageData['language_id']]['short_description'] != '')) ? $getPachkhanDescription[$languageData['language_id']]['short_description'] : '';?></textarea>
                                <label id="short_description-error" class="validation-error-label" for="short_description"></label>
                            </div>
                        </div>
                        <!-- Long description -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('long_description') ?>
                                <span class="text-danger"> * </span>
                            </label>
                            <div class="col-lg-9">
                                    <textarea name="long_description[]" id="long_description_<?= $languageData['language_id']; ?>" class="ckeditor" rows="2" cols="2"><?php echo (isset($getPachkhanDescription[$languageData['language_id']]['long_description']) && ($getPachkhanDescription[$languageData['language_id']]['long_description'] != '')) ? $getPachkhanDescription[$languageData['language_id']]['long_description'] : ""; ?> </textarea>
                                <label id="long_description-error" class="validation-error-label" for="long_description"></label>
                            </div>
                        </div>
                        <?php if($languageData['is_default'] == 1) { ?>
                            <?php if(isset($getFilename)) {?>
                            <!--filename-->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('audio_file') ?></label>
                                    <div class="col-lg-9">
                                        <input type="file" accept="audio/*" name="filename[]" id="filename" class="file-styled-primary">
                                    </div>
                                </div>

                            <?php } else{ ?>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('audio_file') ?></label>
                                    <div class="col-lg-9">
                                        <input type="file" accept="audio/*" name="filename[]" id="filename" class="file-styled-primary">
                                    </div>
                                </div>

                            <?php } ?>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"></label>
                                <div class="col-lg-9">
                                    <div class="form-group" id="audioListing">

                                    </div>
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
                    onclick="window.location.href='<?php echo site_url('Pachkhan'); ?>'"><?= lang('cancel_btn') ?> <i class="icon-cross2 position-right"></i> </button>

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

    function audioLoad() {
        var pachkhanId = $('#pachkhan_id').val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Pachkhan/audioLoad');?>",
            dataType: "json",
            async: false,
            data: {pachkhan_id: pachkhanId}, //change here
            beforeSend: function (formData, jqForm, options) {
//                var dialog = bootbox.dialog({
//                    message: 'Please have patience, images are loading',
//                });
            },
            complete: function () {
                // bootbox.hideAll();
            },
            success: function (resObj) {
                $('#audioListing').html(resObj);
            }
        });
    }




    function deleteImage(imageId, imageUrl) {

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
                    type: "post",
                    url: "<?php echo site_url('Event/imageDelete');?>",
                    dataType: "json",
                    //async: false,
                    data: {imageId: imageId, imageUrl: imageUrl},
                    success: function (data) {
                        if (data['success']) {
                            swal({
                                title: "<?= ucwords(lang('success'))?>",
                                text: data['msg'],
                                type: "<?= lang('success')?>",
                                confirmButtonColor: "<?= BTN_SUCCESS; ?>",
                            }, function () {
                                audioLoad();
                            });
                        } else {
                            swal({
                                title: "<?= ucwords(lang('error')); ?>",
                                text: data['msg'],
                                type: "<?= lang('error'); ?>",
                                confirmButtonColor: "<?= BTN_ERROR; ?>"
                            }, function () {
                                audioLoad();
                            });
                        }
                    }
                });
            });
    }

</script>
<script>
    function audioLoad() {
        var pachkhanId = $('#pachkhan_id').val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Pachkhan/audioLoad');?>",
            dataType: "json",
            async: false,
            data: {pachkhan_id: pachkhanId}, //change here
            beforeSend: function (formData, jqForm, options) {
            },
            complete: function () {
            },
            success: function (resObj) {
                $('#audioListing').html(resObj);
            }
        });
    }

    function deleteAudio(audioId, audioUrl) {

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
                    type: "post",
                    url: "<?php echo site_url('Pachkhan/audioDelete');?>",
                    dataType: "json",
                    //async: false,
                    data: {audio_id: audioId, audio_url: audioUrl},
                    success: function (data) {
                        if (data['success']) {
                            swal({
                                title: "<?= ucwords(lang('success'))?>",
                                text: data['msg'],
                                type: "<?= lang('success')?>",
                                confirmButtonColor: "<?= BTN_SUCCESS; ?>",
                            }, function () {
                                audioLoad();
                            });
                        } else {
                            swal({
                                title: "<?= ucwords(lang('error')); ?>",
                                text: data['msg'],
                                type: "<?= lang('error'); ?>",
                                confirmButtonColor: "<?= BTN_ERROR; ?>"
                            }, function () {
                                //ImageLoad();
                            });
                        }
                    }
                });
            });
    }
</script>

<script>
    var laddaSubmitBtn = Ladda.create(document.querySelector('.submit'));

    $(document).ready(function () {



        SwitcheryKeyGen();
        Select2Init();
        FileKeyGen();
        audioLoad();



        // Initialize
        var validator = $("#pachkhanDetails").validate({
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
                'pachkhan_name[]': {
                    required: true,
                    maxlength:100
                },
                'short_description[]': {
                    required: true,
                    maxlength: 255
                },
                'filename[]': {
//                    required: true
                },
                'long_description[]': {
                    required: function(textarea) {
                        CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                        var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                        return editorcontent.length === 0;
                    }
                }
            },
            messages: {
                'pachkhan_name[]': {
                    required: "Please Enter <?= lang('pachkhan_name') ?>",
                    maxlength: "Please Enter 100 character only"

                },
                'short_description[]': {
                    required: "Please Enter <?= lang('short_description') ?>",
                    maxlength: "Please Enter 255 character only"
                },
                'filename[]': {
                    required: "Please Enter <?= lang('audio_file') ?>"
                },

                'long_description[]': {
                    required: "Please Enter <?= lang('long_description') ?>",
                }

            },
            submitHandler: function (e) {

                $(e).ajaxSubmit({
                    url: '<?php echo site_url("Pachkhan/save");?>',
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
                                window.location.href = '<?php echo site_url('Pachkhan');?>';
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

</script>

