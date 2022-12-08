<div class="panel panel-flat border-left-lg border-left-slate">
    <div class="panel-heading ">
        <h5 class="panel-title"><?= lang('post_heading') ?><a class="heading-elements-toggle"><i
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
            'id' => 'postDetails',
            'method' => 'post',
            'class' => 'form-horizontal'
        );
        echo form_open_multipart('', $form_id);
        ?>
        <input type="hidden" name="post_id" value="<?=(isset($getPostData['post_id']) && ($getPostData['post_id'] != '')) ? $getPostData['post_id'] : '' ?>" id="post_id">

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
                            <input type="hidden" name="post_description_id[]"
                                                           value="<?= (isset($getPostDescription[$languageData['language_id']]['post_description_id']) && ($getPostDescription[$languageData['language_id']]['post_description_id'] != '')) ? $getPostDescription[$languageData['language_id']]['post_description_id'] : ''; ?>" id="">

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

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('member') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <select name="member_id" id="member_id" class="form-control select"
                                                data-placeholder="Select <?= lang('member') ?> ">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                             <?php } ?>

                            <!-- Title -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('title') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="title[]"
                                           value="<?= (isset($getPostDescription[$languageData['language_id']]['title']) && ($getPostDescription[$languageData['language_id']]['title'] != '')) ? $getPostDescription[$languageData['language_id']]['title'] : ''; ?>"
                                           id="title_<?= $languageData['language_id']?>" class="form-control"
                                           placeholder="Enter <?= lang('title') ?>">
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('content') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <textarea name="content[]" id="content_<?= $languageData['language_id']?>" class="ckeditor" rows="2" cols="2">
                                        <?= (isset($getPostDescription[$languageData['language_id']]['content']) && ($getPostDescription[$languageData['language_id']]['content'] != '')) ? $getPostDescription[$languageData['language_id']]['content'] : ''; ?>
                                    </textarea>
                                    <label id="content-error" class="validation-error-label" for="content"></label>
                                </div>
                            </div>
                            <?php if ($languageData['is_default'] == 1) { ?>

                                <!-- category -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('category') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <select data-placeholder="Select <?= lang('category') ?>" name="category_id[]"
                                                id="category_id"
                                                class="select" multiple>
                                            <option value=""></option>
<!--                                            --><?//= CreateOptions("html","tbl_category_description", array('category_id','category_name'), (isset($getPostData['category_id']) && ($getPostData['category_id'] != '')) ? explode(",", $getPostData['category_id']) : '','',array('category_id' => $getPostData['category_id'], 'language_id' => $getDefaultLanguage['language_id'])); ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- tags -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('tags') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <select data-placeholder="Select <?= lang('tags') ?>" name="tags[]" id="tags"
                                                class="select-tag" multiple="multiple">
                                        </select>
                                    </div>
                                </div>

                                <!-- filename -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('filename') ?></label>
                                    <div class="col-lg-9">
                                        <input type="file" accept="image/*" name="filename[]" id="filename" class="file-styled-primary"
                                               multiple>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('filename') ?></label>
                                    <div class="col-lg-9">
                                        <div class="form-group" id="imageListing">

                                        </div>
                                    </div>
                                </div>
                                <!-- is active-->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('is_active') ?></label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery switchery-xs">
                                            <label>
                                                <input type="checkbox"
                                                       name="is_active" <?php if (isset($getPostData['is_active']) && $getPostData['is_active'] == 1) {
                                                    echo "checked";
                                                } else {
                                                    echo '';
                                                } ?> id="is_active" class="switchery">
                                            </label>
                                        </div>
                                    </div>
                                </div>
								<?php if(!isset($getPostData['post_id']) && empty($getPostData['post_id'])) {?>
									<div class="form-group">
										<label class="col-lg-3 control-label"><?= lang('send_notification') ?></label>
										<div class="col-lg-9">
											<div class="checkbox checkbox-switchery switchery-xs">
												<label>
													<input type="checkbox" name="send_notification" id="send_notification" class="switchery">
												</label>
											</div>
										</div>
									</div>
								<?php } ?>
                            <?php } ?>

                        </div>
                    <?php }
                }?>
            </div>
        </div>

        <!-- create reset button-->
        <div class="text-right">
            <button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
                    onclick="window.location.href='<?php echo site_url('Post'); ?>'"><?= lang('cancel_btn') ?> <i class="icon-cross2 position-right"></i> </button>

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

<!--image edit time image load and display-->
<script>

    function ImageLoad() {
        var postId = $('#post_id').val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Post/imageLoad');?>",
            dataType: "json",
            async: false,
            data: {post_id: postId},
            beforeSend: function (formData, jqForm, options) {
            },
            complete: function () {
            },
            success: function (resObj) {
                $('#imageListing').html(resObj);
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
                url: "<?php echo site_url('Post/imageDelete');?>",
                dataType: "json",
                //async: false,
                data: {image_id: imageId, image_url: imageUrl},
                success: function (data) {
                    if (data['success']) {
                        swal({
                            title: "<?= ucwords(lang('success'))?>",
                            text: data['msg'],
                            type: "<?= lang('success')?>",
                            confirmButtonColor: "<?= BTN_SUCCESS; ?>"
                        }, function () {
                             ImageLoad();
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
</script>

<!-- end image edit time image load and display-->

<script>
    var laddaSubmitBtn = Ladda.create(document.querySelector('.submit'));

    $(document).ready(function () {
        // Full featured editor
//        CKEDITOR.replace( 'content', {
//            height: '400px',
//            extraPlugins: 'forms'
//        });
        FileValidate();
        FileKeyGen();
        Select2Init();
        Select2TagsInit();
        ImageLoad();

        $("#samaj_id").change(function () {
            $('#member_id').val("").trigger('change.select2');
            var samajId = $("#samaj_id").val();
            getMember(samajId,'');
        });

        samajDD('', '#samaj_id');

        // samajDD();
        // memberDD('','#member_id');
        $("#category_id").select2().on('change', function() {
           if($("#category_id").valid()){
               $("#category_id").removeClass('invalid').addClass('success');
           }
        });

        $("#category_id").select2({
           ajax: {
                url: "<?= site_url('Category/getCategoryDD') ?>",
               dataType: 'json',
               type: 'post',
               delay: 250,
               data: function (params) {
                   var categoryId = $('#category_id').val();
                   return {
                       filter_param: params.term || '', // search term
                       page: params.page || 1,
                       category_id : categoryId
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

           escapeMarkup: function (markup) {
               return markup;
           }
        }).on('select2:select', function () {
           if ($("#" + $(this).attr('id')).valid()) {
               $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
           }
        });

        // Initialize
        var validator = $("#postDetails").validate({
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
               'title[]': {
                   required: true,
                },
                'content[]': {
                    required: function (textarea) {
                        CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                        var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                        return editorcontent.length === 0;
                    }
                },
                "category_id[]" : {
                    required: true
                },
                member_id : {
                    required: true
                },
                "tags[]" : {
                   // required : true
                },
                "filename[]": {
                    extension: "<?= FILE_UPLOAD_TYPE ?>",
                    //filesize: "<?//= MAX_IMAGE_SIZE_LIMIT ?>//"
                },
                samaj_id: {
                    required: true,
                },
            },
            messages: {
                'title[]': {
                    required: "Please Enter <?= lang('title') ?>",
                    remote  : "<?= lang('title') ?> Already Exist",
                },
                'content[]': {
                    required: "Please Enter <?= lang('content') ?>",
                },
                "filename[]":{
                    extension: "Please choose image with extension <?= FILE_UPLOAD_TYPE_MSG ?>",
                },
                "category_id[]": {
                    required: "Please Enter <?= lang('category') ?>",
                },
                "tags[]": {
                    required: "Please Enter <?= lang('tags') ?>",
                },
                samaj_id: {
                    required: "Please Enter <?= lang('samaj') ?>",
                },
                member_id: {
                    required: "Please Enter <?= lang('member') ?>",
                },

            },
            submitHandler: function (e) {

                $(e).ajaxSubmit({
                    url: '<?php echo site_url("Post/save");?>',
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
                                window.location.href = '<?php echo site_url('Post');?>';
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

        <?php if((isset($getPostData['tags']) && !empty($getPostData['tags']))){
        $getTags = explode(",",$getPostData['tags']);
        foreach ($getTags as $key => $value){
        ?>
        var option = new Option("<?= $value; ?>", "<?= $value; ?>", true, true);
        $('#tags').append(option).trigger('change');
        <?php } } ?>

        <?php if((isset($getPostData['samaj_name']) && !empty($getPostData['samaj_name']))){
        $getSamaj = $getPostData['samaj_name'];
        ?>
        var option = new Option("<?= $getPostData['samaj_name']; ?>", "<?= $getPostData['samaj_id']; ?>", true, true);
        $('#samaj_id').append(option).trigger('change');
        <?php } ?>


        <?php if((isset($getPostData['member_name']) && !empty($getPostData['member_name']))){
        $getMember = $getPostData['member_name'];
        ?>
        var option = new Option("<?= $getPostData['member_name']; ?>", "<?= $getPostData['member_id']; ?>", true, true);
        $('#member_id').append(option).trigger('change');
        <?php } ?>

        <?php if((isset($getPostData['category_name']) && !empty($getPostData['category_name']))){
        $getSamaj = $getPostData['category_name'];
        ?>
        <?php foreach ($getPostData['category_name'] as $key => $value) {?>

        var option = new Option("<?= $getPostData['category_name'][$key]; ?>", "<?= $getPostData['category_id'][$key]; ?>", true, true);
        $('#category_id').append(option).trigger('change');

        <?php } ?>

        <?php } ?>

    });
    
</script>
<?php if(isset($select2)){ ?>

<?= $select2 ?>

<?php } ?>


