
<div class="panel panel-flat border-left-lg border-left-slate">
    <div class="panel-heading ">
        <h5 class="panel-title"><?= lang('poll_heading') ?><a class="heading-elements-toggle"><i
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
            'id' => 'pollDetails',
            'method' => 'post',
            'class' => 'form-horizontal'
        );
        echo form_open_multipart('', $form_id);
        ?>
        <input type="hidden" name="poll_id" value="<?=(isset($getPollData['poll_id']) && ($getPollData['poll_id'] != '')) ? $getPollData['poll_id'] : '' ?>" id="poll_id">

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
                    <?php } ?>
                <?php } ?>

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
                            <input type="hidden" name="poll_description_id[]"
                                   value="<?= (isset($getPollDescription[$languageData['language_id']]['poll_description_id']) && ($getPollDescription[$languageData['language_id']]['poll_description_id'] != '')) ? $getPollDescription[$languageData['language_id']]['poll_description_id'] : ''; ?>"
                                   id="">

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

                            <!-- Question -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('question') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="question[]"
                                           value="<?= (isset($getPollDescription[$languageData['language_id']]['question']) && ($getPollDescription[$languageData['language_id']]['question'] != '')) ? $getPollDescription[$languageData['language_id']]['question'] : ''; ?>"
                                           id="question_<?= $languageData['language_id']?>" class="form-control"
                                           placeholder="Enter <?= lang('question') ?>">
                                </div>
                            </div>


                            <?php if ($languageData['is_default'] == 1) { ?>
                                <!-- field_type -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('field_type') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <select data-placeholder="Select <?= lang('field_type') ?>" name="field_type"
                                                id="field_type"
                                                class="select">
                                            <option value=""></option>
                                            <optgroup label="Choose">
                                                <option data-poll=1
                                                        value="select" <?= (isset($getPollData['field_type']) && $getPollData['field_type'] == 'select') ? "selected" : ""; ?>>
                                                    Select
                                                </option>
                                                <option data-poll=1
                                                        value="radio" <?= (isset($getPollData['field_type']) && $getPollData['field_type'] == 'radio') ? "selected" : ""; ?>>
                                                    Radio
                                                </option>
                                                <option data-poll=1
                                                        value="checkbox" <?= (isset($getPollData['field_type']) && $getPollData['field_type'] == 'checkbox') ? "selected" : ""; ?>>
                                                    Checkbox
                                                </option>
                                            </optgroup>
                                            <optgroup label="Input">
                                                <option value="text" <?= (isset($getPollData['field_type']) && $getPollData['field_type'] == 'text') ? "selected" : ""; ?>>
                                                    Text
                                                </option>
                                                <option value="textarea" <?= (isset($getPollData['field_type']) && $getPollData['field_type'] == 'textarea') ? "selected" : ""; ?>>
                                                    Textarea
                                                </option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group" id="rowListing">
                                    <label class="col-lg-3 control-label"><?= lang('poll_value') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <table id='post_rows' class="table table-responsive">
                                            <thead style="border-bottom: hidden">
                                            <tr>
                                                <th>
                                                    <?= lang('poll_value') ?>
                                                </th>
                                                <th>
                                                    <?= lang('sort_order') ?>
                                                </th>
                                                <th>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if (isset($pollValues) && count($pollValues) > 0) {
                                                foreach ($pollValues as $key => $valueData) { ?>
                                                    <tr id="poll_value_<?php echo $key; ?>">
                                                        <input type="hidden" class="form-control"
                                                               value="<?= $valueData['poll_value_id']; ?>"
                                                               name="poll_value[<?= $key; ?>][poll_value_id]"
                                                               id="poll_value<?= $key; ?>">
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                   value="<?= $valueData['poll_value']; ?>"
                                                                   name="poll_value[<?= $key; ?>][poll_value]"
                                                                   id="poll_value<?= $key; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="tel" class="form-control"
                                                                   value="<?= $valueData['sort_order']; ?>"
                                                                   name="poll_value[<?= $key; ?>][sort_order]"
                                                                   id="sort_order<?= $key; ?>">
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($key != 0) {
                                                                ?>
                                                                <a href='javascript:void(0);'
                                                                   data-popup='custom-tooltip'
                                                                   data-original-title="<?= lang('delete') ?>"
                                                                   title="<?= lang('delete') ?>"
                                                                   class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord'
                                                                   onclick='deleteRow(<?= $key; ?>,<?= $valueData['poll_value_id']; ?>)'><i
                                                                            class="icon-trash"></i></a>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <tr id="poll_value_0">
                                                    <td>
                                                        <input type="text" class="form-control" placeholder=""
                                                               name="poll_value[0][poll_value]" id="poll_value0">
                                                    </td>
                                                    <td>
                                                        <input type="tel" class="form-control" placeholder=""
                                                               name="poll_value[0][sort_order]" id="sort_order0">
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                        <div id='post_add_remove'>
                                            <button type="button"
                                                    class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded"
                                                    onclick="AddSizeRow();"
                                                    data-popup='custom-tooltip' data-original-title="<?= lang('add') ?>"
                                                    title="<?= lang('add') ?>"
                                            >
                                                <i class="icon-plus3"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- sort order -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('sort_order') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <input type="tel" name="sort_order" id="sort_order" class="form-control"
                                               value="<?= (isset($getPollData['sort_order']) && ($getPollData['sort_order'] != '')) ? $getPollData['sort_order'] : ''; ?>"
                                               placeholder="Enter <?= lang('sort_order') ?>">

                                    </div>
                                </div>


                                <!-- is active-->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('is_active') ?></label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery switchery-xs">
                                            <label>
                                                <input type="checkbox"
                                                       name="is_active" <?php if (isset($getPollData['is_active']) && $getPollData['is_active'] == 1) {
                                                    echo "checked";
                                                } else {
                                                    echo '';
                                                } ?> id="is_active" class="switchery">
                                            </label>
                                        </div>
                                    </div>
                                </div>


                                <!-- is required-->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('is_required') ?></label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery switchery-xs">
                                            <label>
                                                <input type="checkbox"
                                                       name="is_required" <?php if (isset($getPollData['is_required']) && $getPollData['is_required'] == 1) {
                                                    echo "checked";
                                                } else {
                                                    echo '';
                                                } ?> id="is_required" class="switchery">
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- is multiple-->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('is_multiple') ?></label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery switchery-xs">
                                            <label>
                                                <input type="checkbox"
                                                       name="is_multiple" <?php if (isset($getPollData['is_multiple']) && $getPollData['is_multiple'] == 1) {
                                                    echo "checked";
                                                } else {
                                                    echo '';
                                                } ?> id="is_multiple" class="switchery">
                                            </label>
                                        </div>
                                    </div>
                                </div>
								<?php if(!isset($getPollData['poll_id']) && empty($getPollData['poll_id'])) {?>
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
                    onclick="window.location.href='<?php echo site_url('Poll'); ?>'"><?= lang('cancel_btn') ?> <i class="icon-cross2 position-right"></i> </button>

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
    function deleteRow(index,rowId) {

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
                    url: "<?php echo site_url('Poll/rowDelete');?>",
                    dataType: "json",
                    //async: false,
                    data: {rowId: rowId},
                    success: function (data) {
                        if (data['success']) {
                            swal({
                                title: "<?= ucwords(lang('success'))?>",
                                text: data['msg'],
                                type: "<?= lang('success')?>",
                                confirmButtonColor: "<?= BTN_SUCCESS; ?>",
                            }, function () {
                                $('tr#poll_value_' + index).slideUp().hide().remove();
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

<script>
    var laddaSubmitBtn = Ladda.create(document.querySelector('.submit'));

    $(document).ready(function () {
        // Full featured editor
//        CKEDITOR.replace( 'content', {
//            height: '400px',
//            extraPlugins: 'forms'
//        });
        Select2Init();
        samajDD();

        // Initialize
        var validator = $("#pollDetails").validate({
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
                   'question[]': {
                   required: true,
                //    //remote: {
                //    //    url: "<?php ////echo site_url( "Poll/NameExist");?>////",
                //    //    type: "post",
                //    //    data: {
                //    //        column_name: function () {
                //    //            return "question";
                //    //        },
                //    //        column_id: function () {
                //    //            return $("#poll_id").val();
                //    //        },
                //    //        table_name: function () {
                //    //            return "tbl_polls";
                //    //        },
                //    //    }
                //    //}
                },

                sort_order:{
                   required: true,
                //    number:true,
                //    remote: {
                //        url: "<?php //echo site_url("Poll/NameExist");?>//",
                //        type: "post",
                //        data: {
                //            column_name: function () {
                //                return "sort_order";
                //            },
                //            column_id: function () {
                //                return $("#poll_id").val();
                //            },
                //            table_name: function () {
                //                return "tbl_polls";
                //            },
                //        }
                //    }
                },
                field_type:{
                   required: true,
                },
                samaj_id: {
                   required: true,
                }

            },
            messages: {
                'question[]': {
                    required: "Please Enter <?= lang('question') ?>",
                    remote: "<?= lang('question') ?> Already Exist",
                },
                sort_order:{
                    required: "Please Enter <?= lang('sort_order') ?>",
                    number: "Please Enter a valid <?= lang('sort_order') ?>",
                    remote: "<?= lang('sort_order') ?> Already Exist",
                },
                field_type:{
                    required: "Please Enter <?= lang('field_type') ?>",
                },
                samaj_id: {
                    required: "Please Enter <?= lang('samaj') ?>",
                },

            },
            submitHandler: function (e) {
                $(e).ajaxSubmit({
                    url: '<?php echo site_url("Poll/save");?>',
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
                                window.location.href = '<?php echo site_url('Poll');?>';
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
        $("#field_type").change(function(){
            var poll = $(this).find(':selected').data("poll");
            if(poll == 1){
                $("#rowListing").show();
            }  else {
                $("#post_rows tbody tr:not(:first)").remove();
                $("#post_rows input").val(' ');
                $("#rowListing").hide();
            }
        })
        $("#rowListing").hide();
        <?php if(isset($getPollData)) {?>
        $("#field_type").change();
        <?php }?>


        <?php if((isset($getPollData['samaj_name']) && !empty($getPollData['samaj_name']))){
        $getSamaj = $getPollData['samaj_name'];
        ?>
        var option = new Option("<?= $getPollData['samaj_name']; ?>", "<?= $getPollData['samaj_id']; ?>", true, true);
        $('#samaj_id').append(option).trigger('change');
        <?php } ?>
        <?php if(isset($getPollData['field_type']) && $getPollData['field_type'] != '') {?>
        $("#field_type").select2({
           allowclear :false
        });
        $('#field_type option', this).not(':eq(0), :selected').attr('disabled','disabled');
        <?php } ?>

    });

    var news_index = <?= isset($pollValues) ? count($pollValues) : 0 + 1;?>;
    function AddSizeRow(){
        //remove = news_index;
        news_index ++;
        iner_news_index = news_index;

        emailHtml = "<tr id='poll_value_" + iner_news_index + "'>" +

            "<td>"+
            "<input type='text'  class='form-control' id='poll_value" + iner_news_index + "' name='poll_value["+iner_news_index+"][poll_value]'>"+
            "</td>"+

            "<td>"+
            "<input type='tel'  class='form-control' id='sort_order" + iner_news_index + "' name='poll_value["+iner_news_index+"][sort_order]'>"+
            "</td>"+

            "<td>" +
            "<a href='javascript:void(0);' data-popup='custom-tooltip' data-original-title='<?= lang('add')?>' title='<?= lang('add')?>' class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord' onclick='deleteRow("+iner_news_index+")'><i class='icon-trash'></i></a>" +
            "</td>"+
            "</tr>";

        $('table#post_rows tbody').append(emailHtml);



        addValidation("input","#poll_value"+iner_news_index+"",{
            required: true
        });

        addValidation("input","#sort_order"+iner_news_index+"",{
            required: true,
            number: true
        });




    }
</script>
<?php if(isset($select2)){ ?>

    <?= $select2 ?>

<?php } ?>
