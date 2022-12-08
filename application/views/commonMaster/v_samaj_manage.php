<div class="panel panel-flat border-left-lg border-left-slate">
    <div class="panel-heading ">
        <h5 class="panel-title"><?= lang('samaj_heading') ?><a class="heading-elements-toggle"><i
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
            'id' => 'samajDetails',
            'method' => 'post',
            'class' => 'form-horizontal'
        );
        echo form_open_multipart('', $form_id);
        ?>
        <input type="hidden" name="samaj_id" value="<?=(isset($getSamajData['samaj_id']) && ($getSamajData['samaj_id'] != '')) ? $getSamajData['samaj_id'] : '' ?>" id="samaj_id">
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
                        <input type="hidden" name="samaj_description_id[]"
                               value="<?= (isset($getSamajDescription[$languageData['language_id']]['samaj_description_id']) && ($getSamajDescription[$languageData['language_id']]['samaj_description_id'] != '')) ? $getSamajDescription[$languageData['language_id']]['samaj_description_id'] : ''; ?>" id="">

                        <?php if($languageData['is_default'] == 1) { ?>
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('parent_samaj') ?></label>
                                <div class="col-lg-9">
                                    <select name="parent_samaj" id="parent_samaj" class="form-control" data-placeholder="Select ">
                                        <option value="" ></option>
                                        <?= CreateOptions("html", "tbl_samaj_description", array("samaj_id", "samaj_name"), (isset($getSamajData['parent_samaj_id']) && ($getSamajData['parent_samaj_id'] != '')) ? $getSamajData['parent_samaj_id'] : '','null',array('samaj_id' => $getSamajData['parent_samaj_id'], 'language_id' => $getDefaultLanguages['language_id'])); ?>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Samaj Name -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('samaj_name') ?>
                                <span class="text-danger"> * </span>
                            </label>
                            <div class="col-lg-9">
                                <input type="text" name="samaj_name[]" value="<?= (isset($getSamajDescription[$languageData['language_id']]['samaj_name']) && ($getSamajDescription[$languageData['language_id']]['samaj_name'] != '')) ? $getSamajDescription[$languageData['language_id']]['samaj_name'] : ''; ?>" class="form-control"
                                       placeholder="Enter <?= lang('samaj_name') ?>" id="samaj_name_<?= $languageData['language_id']; ?>">
                            </div>
                        </div>
                        <!-- Short description -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('short_description') ?>
                                <span class="text-danger"> * </span>
                            </label>
                            <div class="col-lg-9">
                                <textarea name="short_description[]" id="short_description_<?= $languageData['language_id']; ?>" placeholder="Enter Only 255 Character" rows="5" cols="5"  class="form-control"> <?php echo (isset($getSamajDescription[$languageData['language_id']]['short_description']) && ($getSamajDescription[$languageData['language_id']]['short_description'] != '')) ? $getSamajDescription[$languageData['language_id']]['short_description'] : '';?></textarea>
                                <label id="short_description-error" class="validation-error-label" for="short_description"></label>
                            </div>
                        </div>
                        <!-- Long description -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('long_description') ?>
                                <span class="text-danger"> * </span>
                            </label>
                            <div class="col-lg-9">
                                    <textarea name="long_description[]" id="long_description_<?= $languageData['language_id']; ?>" class="ckeditor" rows="2" cols="2">
                                     <?php echo (isset($getSamajDescription[$languageData['language_id']]['long_description']) &&
                                         ($getSamajDescription[$languageData['language_id']]['long_description'] != ''))
                                         ? $getSamajDescription[$languageData['language_id']]['long_description'] : "";
                                     ?>
                                    </textarea>
                                <label id="long_description-error" class="validation-error-label" for="long_description"></label>
                            </div>
                        </div>
                        <?php if($languageData['is_default'] == 1) { ?>

                            <!--Contact -->
                            <div class="form-group" id="rowContactListing">
                                <label class="col-lg-3 control-label"><?= lang('contact_number') ?> <span class="text-danger"> * </span> </label>
                                <div class="col-lg-9">
                                    <table id='contact_rows' class="table table-responsive">
                                        <thead style="border-bottom: hidden">
                                        <tr>
                                            <th><?= lang('contact_name') ?></th>
                                            <th><?= lang('contact_number') ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (isset($getSamajContactData) && count($getSamajContactData) > 0) {
                                            foreach ($getSamajContactData as $key => $contactData) { ?>
                                                <tr id="samaj_contact_<?php echo $key; ?>">
                                                    <input type="hidden" class="form-control" value="<?= $contactData['samaj_contact_id']; ?>"
                                                           name="member_contact[<?= $key; ?>][member_contact]" id="member_contact<?= $key; ?>">

                                                    <td>
                                                        <input type="text" class="form-control numberInit" placeholder="Name" value="<?= $contactData['member_name']; ?>"
                                                               name="samaj_member_contact_name[<?= $key; ?>][member_name]" id="member_name<?= $key; ?>" required>
                                                    </td>

                                                    <td>
                                                        <input type="tel" class="form-control" placeholder="Number"  maxlength="10" minlength="10"
                                                               value="<?= $contactData['member_number']; ?>" name="samaj_member_number[<?= $key; ?>][member_number]"
                                                               id="member_number<?= $key; ?>" required>
                                                    </td>

                                                    <td>
                                                        <?php
                                                        if ($key != 0) { ?>
                                                            <a href='javascript:void(0);' data-popup='custom-tooltip' data-original-title="<?= lang('delete') ?>"
                                                               title="<?= lang('delete') ?>"
                                                               class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord'
                                                               onclick='deleteMobileRow(<?= $key; ?>,<?= $contactData['samaj_contact_id']; ?>)'><i class="icon-trash"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr id="samaj_contact_0">
                                                <td>
                                                    <input type="text" class="form-control" placeholder="Name" required
                                                           name="samaj_member_contact_name[0][member_name]" id="member_name0">
                                                </td>
                                                <td>
                                                    <input type="tel" class="form-control" placeholder="Number" value="" maxlength="10" minlength="10"
                                                           name="samaj_member_number[0][member_number]" id="member_number0" required>
                                                </td>
                                                <td></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    <div id='post_add_remove'>
                                        <button type="button"
                                                class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded"
                                                onclick="AddMobileRow();"
                                                data-popup='custom-tooltip' data-original-title="<?= lang('add') ?>"
                                                title="<?= lang('add') ?>">
                                            <i class="icon-plus3"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- is active-->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('is_active') ?></label>
                                <div class="col-lg-9">
                                    <div class="checkbox checkbox-switchery switchery-xs">
                                        <label>
                                            <input type="checkbox" name="is_active"
                                                <?php if(isset($getSamajData['is_active']) && $getSamajData['is_active'] == 1)
                                                {
                                                    echo 'checked="checked"';
                                                } else {
                                                    echo '';
                                                } ?>
                                                   id="is_active" class="switchery">
                                        </label>
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
                    onclick="window.location.href='<?php echo site_url('Samaj'); ?>'"><?= lang('cancel_btn') ?> <i class="icon-cross2 position-right"></i> </button>

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
        SwitcheryKeyGen();
        Select2Init();
        $("#parenr_samaj").select2().on('change', function() {
            if($("#parenr_samaj").valid()){
                $("#parenr_samaj").removeClass('invalid').addClass('success');
            }
        });
        $("#parent_samaj").select2({
            ajax: {
                url: "<?= site_url('Samaj/getParentSamaj/') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {

                    return {
                        filter_param: params.term || '', // search term
                        page: params.page || 1,
                        samaj_id : $('#samaj_id').val()
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.result,
                        pagination: {
                            more: (data.page * 10) < data.totalRows
                        }
                    };
                }
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
        var validator = $("#samajDetails").validate({
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
                'samaj_name[]': {
                    required: true,
                },
                'short_description[]': {
                    required: true,
                    maxlength: 255
                },
                'long_description[]': {
                    required: function(textarea) {
                        CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                        var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                        return editorcontent.length === 0;
                    }
                },

            },
            messages: {
                'samaj_name[]': {
                    required: "Please Enter <?= lang('samaj_name') ?>",
                },
                'short_description[]': {
                    required: "Please Enter <?= lang('short_description') ?>",
                    maxlength: "Please Enter 255 character only"
                },

                'long_description[]': {
                    required: "Please Enter <?= lang('long_description') ?>",
                }

            },
            submitHandler: function (e) {
//                $('textarea.ckeditor').each(function () {
//                    var $textarea = $(this);
//                    $textarea.val(CKEDITOR.instances[$textarea.attr('name')].getData());
//                });

                $(e).ajaxSubmit({
                    url: '<?php echo site_url("Samaj/save");?>',
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
                                window.location.href = '<?php echo site_url('Samaj');?>';
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
<script>

    var contact_index = <?= isset($getSamajContactData) ? count($getSamajContactData) : 1;?>;
    function AddMobileRow(){
        contact_index ++;
        iner_name_index = contact_index;
        iner_number_index= contact_index;

        emailHtml = "<tr id='samaj_contact_" + iner_name_index + "'>" +
            "<td>"+
            "<input type='name'  class='form-control numberInit' placeholder='Name' id='member_name" + iner_name_index + "' name='samaj_member_contact_name["+iner_name_index+"][member_name]'>"+
            "</td>"+

            "<td>"+
            "<input type='tel' placeholder='Number'  class='form-control' id='member_number" + iner_number_index+ "' name='samaj_member_number["+iner_number_index+"][member_number]'>"+
            "</td>"+

            "<td>" +
            "<a href='javascript:void(0);' data-popup='custom-tooltip' data-original-title='<?= lang('delete')?>' title='<?= lang('delete')?>' class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord' onclick='deleteMobileRow("+iner_name_index+")'><i class='icon-trash'></i></a>" +
            "</td>"+
            "</tr>";

        $('table#contact_rows tbody').append(emailHtml);



        addValidation("input","#member_name"+iner_name_index+"",{
            required: true,

        });
        addValidation("input","#member_number"+iner_number_index+"",{
            required: true,
            number: true,
            minlength:10,
            maxlength:10
        });

    }


    function deleteMobileRow(index,rowId) {
        // console.log(index);

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
                    url: "<?php echo site_url('Samaj/rowMobileDelete');?>",
                    dataType: "json",
                    //async: false,
                    data: {row_Id: rowId},
                    success: function (data) {
                        if (data['success']) {
                            swal({
                                title: "<?= ucwords(lang('success'))?>",
                                text: data['msg'],
                                type: "<?= lang('success')?>",
                                confirmButtonColor: "<?= BTN_SUCCESS; ?>",
                            }, function () {
                                $('tr#samaj_contact_' + index).slideUp().hide().remove();
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
