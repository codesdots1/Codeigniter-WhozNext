<div class="panel panel-flat border-left-lg border-left-slate">
    <div class="panel-heading ">
        <h5 class="panel-title"><?= lang('page_heading') ?><a class="heading-elements-toggle"><i
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
            'id' => 'pageDetails',
            'method' => 'post',
            'class' => 'form-horizontal'
        );
        echo form_open_multipart('', $form_id);
        ?>
        <input type="hidden" name="page_id" value="<?=(isset($getPageData['page_id']) && ($getPageData['page_id'] != '')) ? $getPageData['page_id'] : '' ?>" id="page_id">
        <input type="hidden" name="slug" value="<?= (isset($getPageData['slug']) && ($getPageData['slug'] != '')) ? $getPageData['slug'] : $slug; ?>" id="slug" class="form-control">

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
                        <?php }
                    } ?>

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
                            <input type="hidden" name="page_description_id[]"
                                   value="<?= (isset($getPageDescription[$languageData['language_id']]['page_description_id']) && ($getPageDescription[$languageData['language_id']]['page_description_id'] != '')) ? $getPageDescription[$languageData['language_id']]['page_description_id'] : ''; ?>" id="">

                            <?php if ($languageData['is_default'] == 1) { ?>

                                <!-- samaj -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('samaj') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <select data-placeholder="Select <?= lang('samaj') ?>" name="samaj_id"
                                                id="samaj_id"
                                                class="select">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                            <?php } ?>
                            <!-- Page name -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('page_name') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="page_name[]"
                                           value="<?= (isset($getPageDescription[$languageData['language_id']]['page_name']) && ($getPageDescription[$languageData['language_id']]['page_name'] != '')) ? $getPageDescription[$languageData['language_id']]['page_name'] : ''; ?>"
                                           id="page_name_<?= $languageData['language_id']?>" class="form-control"
                                           placeholder="Enter <?= lang('page_name') ?>">
                                </div>
                            </div>

                            <!-- Short description -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('short_description') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <textarea name="short_description[]" id="short_description_<?= $languageData['language_id']?>" class="form-control"
                                              rows="2"
                                              cols="2"><?= (isset($getPageDescription[$languageData['language_id']]['short_description']) && ($getPageDescription[$languageData['language_id']]['short_description'] != '')) ? $getPageDescription[$languageData['language_id']]['short_description'] : ''; ?></textarea>
                                    <label id="short_description-error" class="validation-error-label"
                                           for="short_description"></label>
                                </div>
                            </div>

                            <!-- Long description -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('long_description') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                <textarea name="long_description[]" id="long_description_<?= $languageData['language_id']?>" class="ckeditor" rows="2"
                                          cols="2"><?= (isset($getPageDescription[$languageData['language_id']]['long_description']) && ($getPageDescription[$languageData['language_id']]['long_description'] != '')) ? $getPageDescription[$languageData['language_id']]['long_description'] : ''; ?>
                                </textarea>
                                    <label id="long_description-error" class="validation-error-label"
                                           for="long_description"></label>
                                </div>
                            </div>

                            <?php if ($languageData['is_default'] == 1) { ?>

                                <!-- is active-->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('is_active') ?></label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery switchery-xs">
                                            <label>
                                                <input type="checkbox"
                                                       name="is_active" <?php if (isset($getPageData['is_active']) && $getPageData['is_active'] == 1) {
                                                    echo "checked";
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
                }?>
            </div>

        </div>

        <!-- create reset button-->
        <div class="text-right">
            <button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
                    onclick="window.location.href='<?php echo site_url('Page'); ?>'"><?= lang('cancel_btn') ?> <i class="icon-cross2 position-right"></i> </button>

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
        // Full featured editor
//        CKEDITOR.replace( 'long_description', {
//            height: '400px',
//            extraPlugins: 'forms'
//        });
        Select2Init();
        samajDD();

        // Initialize
        var validator = $("#pageDetails").validate({
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
                'page_name[]': {
                   required: true,
                //    //remote: {
                //    //    url: "<?php ////echo site_url( "Page/NameExist");?>////",
                //    //    type: "post",
                //    //    data: {
                //    //        column_name: function () {
                //    //            return "page_name";
                //    //        },
                //    //        column_id: function () {
                //    //            return $("#page_id").val();
                //    //        },
                //    //        table_name: function () {
                //    //            return "tbl_pages";
                //    //        },
                //    //    }
                //    //}
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
                samaj_id: {
                   required: true,
                }

            },
            messages: {
                'page_name[]': {
                    required: "Please Enter <?= lang('page_name') ?>",
                //    remote  : "<?//= lang('page_name') ?>// Already Exist",
                },
                'short_description[]': {
                    required: "Please Enter <?= lang('short_description') ?>",
                    maxlength: "Please Enter 255 character only",
                },

                'long_description[]': {
                    required: "Please Enter <?= lang('long_description') ?>",
                },
                samaj_id: {
                    required: "Please Enter <?= lang('samaj') ?>",
                },

            },
            submitHandler: function (e) {
//                $('textarea.ckeditor').each(function () {
//                    var $textarea = $(this);
//                    $textarea.val(CKEDITOR.instances[$textarea.attr('name')].getData());
//                });

                $(e).ajaxSubmit({
                    url: '<?php echo site_url("Page/save");?>',
                    type: 'post',
                    beforeSubmit: function (formData, jqForm, options) {
                    },
                    complete: function () {
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
                                window.location.href = '<?php echo site_url('Page');?>';
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


        <?php if((isset($getPageData['samaj_name']) && !empty($getPageData['samaj_name']))){
        $getSamaj = $getPageData['samaj_name'];
        ?>
        var option = new Option("<?= $getPageData['samaj_name']; ?>", "<?= $getPageData['samaj_id']; ?>", true, true);
        $('#samaj_id').append(option).trigger('change');
        <?php } ?>
    });


</script>
<?php if(isset($select2)){ ?>

    <?= $select2 ?>

<?php } ?>