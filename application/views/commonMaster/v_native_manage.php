<div class="panel panel-flat border-left-lg border-left-slate">
    <div class="panel-heading ">
        <h5 class="panel-title"><?= lang('native_form') ?><a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        <?php
        $form_id = array(
            'id'     => 'nativeDetails',
            'method' => 'post',
            'class'  => 'form-horizontal'
        );
        echo form_open_multipart('', $form_id); ?>

        <input type="hidden" name="native_id" id="native_id"
               value="<?=(isset($nativeData['native_id']) && ($nativeData['native_id'] != '')) ? $nativeData['native_id'] : '' ?>">
        <div class="tabbable">

            <ul class="nav nav-tabs">
                <?php  foreach ($languages as $languageCount => $languageData) { ?>
                    <li role="presentation" class = "<?= ($languageCount == 0) ? "active" : ""; ?>">
                        <a aria-expanded="true" href="#tab_<?= $languageData['language_id']; ?>" data-toggle="tab">
                            <?=  $languageData['language_name'];?>
                        </a>
                    </li>
                <?php } ?>
            </ul>

            <div class="tab-content">
                <?php  foreach ($languages as $languageCount => $languageData) { ?>
                    <div role="tabpanel" class = "<?= ($languageCount == 0) ? "tab-pane active" : "tab-pane"; ?>" id="tab_<?= $languageData['language_id']; ?>">

                        <input type="hidden" name="language_id[]" id="language_id"
                               value="<?= (isset($languageData['language_id']) && ($languageData['language_id'] != '')) ? $languageData['language_id'] : '' ?>">

                        <input type="hidden" name="native_location_id[]"
                               value="<?= (isset($nativeLocationData[$languageData['language_id']]['native_location_id']) && ($nativeLocationData[$languageData['language_id']]['native_location_id'] != '')) ? $nativeLocationData[$languageData['language_id']]['native_location_id'] : ''; ?>"
                               id="native_location_id">

                        <?php if($languageData['is_default'] == 1){ ?>
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('samaj_name') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <select name="samaj_id" id="samaj_id" data-init="1" data-placeholder="Select <?= lang('samaj_name') ?>">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('native_name') ?><span class="text-danger"> * </span></label>
                            <div class="col-lg-9">
                                <input type="text" name="native_location[]" id="native_location_<?= $languageData['language_id']; ?>" class="form-control"
                                       value="<?= (isset($nativeLocationData[$languageData['language_id']]['native_location']) &&
                                           ($nativeLocationData[$languageData['language_id']]['native_location'] != '')) ?
                                           $nativeLocationData[$languageData['language_id']]['native_location'] : ''; ?>"
                                       placeholder="Enter <?= lang('native_name') ?>">
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="text-right">
            <button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
                    onclick="window.location.href='<?php echo site_url('Native'); ?>'"><?= lang('cancel_btn') ?> <i class="icon-cross2 position-right"></i> </button>

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
        SwitcheryKeyGen();
        samajDD('', '#samaj_id');

        var validator = $("#nativeDetails").validate({
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-error-label',
            successClass: 'validation-valid-label',
            highlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },
            errorPlacement: function (error, element) {
                if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container')) {
                    if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                        error.appendTo(element.parent().parent().parent().parent());
                    } else {
                        error.appendTo(element.parent().parent().parent().parent().parent());
                    }
                } else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                    error.appendTo(element.parent().parent().parent());
                } else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                } else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo(element.parent().parent());
                } else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                    error.appendTo(element.parent().parent());
                } else {
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
                'native_location[]': {
                    required: true,
                }
            },
            messages: {
                samaj_id: {
                    required: "Please Enter <?= lang('samaj_name') ?>"
                },
                'native_location[]': {
                    required: "Please Enter <?= lang('native_name') ?>",
                }
            },
            submitHandler: function (e) {
                $(e).ajaxSubmit({
                    url: '<?php echo site_url("Native/save");?>',
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
                                window.location.href = '<?php echo site_url('Native');?>';
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
        <?php if((isset($nativeData['samaj_name']) && !empty($nativeData['samaj_name']))){?>
            var option = new Option("<?= $nativeData['samaj_name']; ?>", "<?= $nativeData['samaj_id']; ?>", true, true);
        $('#samaj_id').append(option).trigger('change');
        <?php } ?>
    });
</script>
<?php if (isset($select2)) { ?>
    <?= $select2 ?>
<?php } ?>