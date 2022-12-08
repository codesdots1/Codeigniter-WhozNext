<div class="panel panel-flat border-left-lg border-left-slate">
    <div class="panel-heading ">
        <h5 class="panel-title"><?= lang('business_heading') ?><a class="heading-elements-toggle"><i class="icon-more"></i></a>
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
            'id' => 'businessDetails',
            'method' => 'post',
            'class' => 'form-horizontal'
        );
        echo form_open_multipart('', $form_id);
        $businessId = (isset($getBusinessData['business_id']) && ($getBusinessData['business_id'] != '')) ? $getBusinessData['business_id'] : '';
        $latitude = (isset($getBusinessData['lat']) && ($getBusinessData['lat'] != '')) ? $getBusinessData['lat'] : '';
        $longitude = (isset($getBusinessData['lng']) && ($getBusinessData['lng'] != '')) ? $getBusinessData['lng'] : '';
        ?>
        <input type="hidden" name="business_id"
               value="<?= (isset($getBusinessData['business_id']) && ($getBusinessData['business_id'] != '')) ? $getBusinessData['business_id'] : '' ?>"
               id="business_id">

        <!--language tabs-->
        <div class="tabbable">

            <ul class="nav nav-tabs">
                <?php foreach ($languages as $languageCount => $languageData) {
                    ?>
                    <li role="presentation" class="<?= ($languageCount == 0) ? "active" : ""; ?>">
                        <a aria-expanded="true" href="#tab_<?= $languageData['language_id']; ?>" data-toggle="tab">
                            <?= $languageData['language_name']; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>

            <div class="tab-content">
                <?php foreach ($languages as $languageCount => $languageData) {
                    ?>
                    <div role="tabpanel" class="<?= ($languageCount == 0) ? "tab-pane active" : "tab-pane"; ?>"
                         id="tab_<?= $languageData['language_id']; ?>">

                        <input type="hidden" name="language_id[]"
                               value="<?= (isset($languageData['language_id']) && ($languageData['language_id'] != '')) ? $languageData['language_id'] : '' ?>"
                               id="">
                        <input type="hidden" name="business_description_id[]"
                               value="<?= (isset($getBusinessDescription[$languageData['language_id']]['business_description_id']) && ($getBusinessDescription[$languageData['language_id']]['business_description_id'] != '')) ? $getBusinessDescription[$languageData['language_id']]['business_description_id'] : ''; ?>"
                               id="">

                        <?php if ($languageData['is_default'] == 1) { ?>
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('samaj_name') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <select name="samaj_id" id="samaj_id" data-init="1" data-placeholder="Select <?= lang('samaj_name') ?>" class="select">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('member') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <select name="member_id" id="member_id" class="form-control"
                                            data-placeholder="Select <?= lang('member') ?> ">
                                        <option value=""></option>

                                    </select>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Business Name -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('business_name') ?><span class="text-danger"> * </span></label>
                            <div class="col-lg-9">
                                <input type="text" name="business_name[]" id="business_name_<?= $languageData['language_id']; ?>" class="form-control"
                                       value="<?= (isset($getBusinessDescription[$languageData['language_id']]['business_name']) && ($getBusinessDescription[$languageData['language_id']]['business_name'] != '')) ? $getBusinessDescription[$languageData['language_id']]['business_name'] : ''; ?>"
                                       placeholder="Enter <?= lang('business_name') ?>">

                            </div>
                        </div>

                        <!-- Owner Name -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('owner_name') ?><span class="text-danger"> * </span></label>
                            <div class="col-lg-9">
                                <input type="text" name="owner_name[]" id="owner_name_<?= $languageData['language_id']?>" class="form-control"
                                       value="<?= (isset($getBusinessDescription[$languageData['language_id']]['owner_name']) && ($getBusinessDescription[$languageData['language_id']]['owner_name'] != '')) ? $getBusinessDescription[$languageData['language_id']]['owner_name'] : ''; ?>"
                                       placeholder="Enter <?= lang('owner_name') ?>">
                            </div>
                        </div>

                        <!--description-->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('description') ?><span class="text-danger"> * </span></label>
                            <div class="col-lg-9">
                                <textarea name="description[]" id="description_<?= $languageData['language_id']?>" class="ckeditor" rows="2"
                                          cols="2"><?= (isset($getBusinessDescription[$languageData['language_id']]['description']) && ($getBusinessDescription[$languageData['language_id']]['description'] != '')) ? $getBusinessDescription[$languageData['language_id']]['description'] : ''; ?></textarea>
                                <label id="description-error" class="validation-error-label" for="description"></label>
                            </div>
                        </div>

                        <?php if ($languageData['is_default'] == 1) { ?>
                        <!--state-->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('business_state') ?><span class="text-danger"> * </span></label>
                            <div class="col-lg-9">
                                <select name="state_id" id="state_id" class="form-control" data-placeholder="Select <?= lang('business_state') ?> ">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <!--city-->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('business_city') ?><span class="text-danger"> * </span></label>
                            <div class="col-lg-9">
                                <select name="city_id" id="city_id" class="form-control" data-placeholder="Select <?= lang('business_city') ?> ">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <!--pincode-->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('business_pincode') ?><span class="text-danger"> * </span></label>
                            <div class="col-lg-9">
                                <input type="text" name="business_pincode" id="business_pincode" class="form-control" maxlength="6" minlength="6"
                                       placeholder="Enter <?= lang('business_pincode') ?>" value="<?= (isset($getBusinessData['business_pincode']) && ($getBusinessData['business_pincode'] != '')) ? $getBusinessData['business_pincode'] : ''; ?>">
                            </div>
                        </div>
                        <?php } ?>


                        <!-- Address general-->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('address') ?><span class="text-danger"> * </span></label>
                            <div class="col-lg-9">
                                <textarea name="address[]" id="address_<?= $languageData['language_id']?>" class="form-control" rows="2"
                                          cols="2"><?= (isset($getBusinessDescription[$languageData['language_id']]['address']) && ($getBusinessDescription[$languageData['language_id']]['address'] != '')) ? $getBusinessDescription[$languageData['language_id']]['address'] : ''; ?></textarea>
                                <label id="address-error" class="validation-error-label" for="address"></label>
                            </div>
                        </div>

                        <?php if ($languageData['is_default'] == 1) { ?>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"></label>
                                <div class="col-lg-9">
                                    <div class="map-wrapper" style="height: 250px"></div>
                                </div>
                            </div>
                            <!-- address -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('address_geo') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="address_geo"
                                           value="<?= (isset($getBusinessData['address_geo']) && ($getBusinessData['address_geo'] != '')) ? $getBusinessData['address_geo'] : ''; ?>"
                                           id="address_geo" class="form-control"
                                           placeholder="Enter <?= lang('address_geo') ?>">
                                </div>
                            </div>

                            <!-- latitude -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('lat') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="lat"
                                           value="<?= (isset($getBusinessData['lat']) && ($getBusinessData['lat'] != '')) ? $getBusinessData['lat'] : ''; ?>"
                                           id="lat" class="form-control"
                                           placeholder="Enter <?= lang('lat') ?>" readonly>
                                </div>
                            </div>

                            <!-- longitude -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('lng') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="lng"
                                           value="<?= (isset($getBusinessData['lng']) && ($getBusinessData['lng'] != '')) ? $getBusinessData['lng'] : ''; ?>"
                                           id="lng" class="form-control"
                                           placeholder="Enter <?= lang('lng') ?>" readonly>
                                </div>
                            </div>

                            <!-- filename -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('filename') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <input type="file" accept="image/*"  name="filename[]" id="filename" class="file-styled-primary"
                                           multiple>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-lg-3 control-label"></label>
                                <div class="col-lg-9">
                                    <div class="form-group" id="imageListing"></div>
                                </div>
                            </div>

                            <!-- business_type -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('business_type_name') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <select data-placeholder="Select <?= lang('business_type_name') ?>" name="business_type_id" id="business_type_id">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group" id="rowMobileListing">
                                <label class="col-lg-3 control-label"><?= lang('mobile') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <table id='mobile_rows' class="table table-responsive">
                                        <thead style="border-bottom: hidden">
                                        <tr>
                                            <th>
                                                <?= lang('mobile') ?>
                                            </th>
                                            <th>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (isset($businessMobiles) && count($businessMobiles) > 0) {
                                            foreach ($businessMobiles as $key => $mobileData) { ?>
                                                <tr id="business_mobile_<?php echo $key; ?>">
                                                    <input type="hidden" class="form-control" required
                                                           value="<?= $mobileData['business_mobile_id']; ?>"
                                                           name="business_mobile[<?= $key; ?>][business_mobile_id]"
                                                           id="business_mobile<?= $key; ?>">
                                                    <td>
                                                        <input type="tel" class="form-control" required
                                                               value="<?= $mobileData['mobile']; ?>"
                                                               name="business_mobile[<?= $key; ?>][mobile]"
                                                               id="mobile<?= $key; ?>" >
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($key != 0) {
                                                            ?>
                                                            <a href='javascript:void(0);' data-popup='custom-tooltip'
                                                               data-original-title="<?= lang('delete') ?>"
                                                               title="<?= lang('delete') ?>"
                                                               class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord'
                                                               onclick='deleteMobileRow(<?= $key; ?>,<?= $mobileData['business_mobile_id']; ?>)'><i
                                                                        class="icon-trash"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr id="business_mobile_0">
                                                <td>
                                                    <input type="tel" class="form-control" placeholder="Enter Mobile Number" required
                                                           name="business_mobile[0][mobile]" id="mobile0">
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
                                                title="<?= lang('add') ?>"
                                        >
                                            <i class="icon-plus3"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group" id="rowEmailListing">
                                <label class="col-lg-3 control-label"><?= lang('email') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <table id='email_rows' class="table table-responsive">
                                        <thead style="border-bottom: hidden">
                                        <tr>
                                            <th>
                                                <?= lang('email') ?>
                                            </th>
                                            <th>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (isset($businessEmails) && count($businessEmails) > 0) {
                                            foreach ($businessEmails as $key => $emailData) { ?>
                                                <tr id="business_email_<?php echo $key; ?>">
                                                    <input type="hidden" class="form-control"
                                                           value="<?= $emailData['business_email_id']; ?>"
                                                           name="business_email[<?= $key; ?>][business_email_id]"
                                                           id="business_email<?= $key; ?>">
                                                    <td>
                                                        <input type="text" class="form-control"
                                                               value="<?= $emailData['email']; ?>"
                                                               name="business_email[<?= $key; ?>][email]"
                                                               id="email<?= $key; ?>" >
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($key != 0) {
                                                            ?>
                                                            <a href='javascript:void(0);' data-popup='custom-tooltip'
                                                               data-original-title="<?= lang('delete') ?>"
                                                               title="<?= lang('delete') ?>"
                                                               class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord'
                                                               onclick='deleteEmailRow(<?= $key; ?>,<?= $emailData['business_email_id']; ?>)'><i
                                                                        class="icon-trash"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr id="business_email_0">
                                                <td>
                                                    <input type="email" class="form-control" placeholder="Enter Email" required
                                                           name="business_email[0][email]" id="email0">
                                                </td>
                                                <td></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    <div id='post_add_remove'>
                                        <button type="button"
                                                class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded"
                                                onclick="AddEmailRow();"
                                                data-popup='custom-tooltip' data-original-title="<?= lang('add') ?>"
                                                title="<?= lang('add') ?>"
                                        >
                                            <i class="icon-plus3"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="rowTelephoneListing">
                                <label class="col-lg-3 control-label"><?= lang('telephone') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <table id='telephone_rows' class="table table-responsive">
                                        <thead style="border-bottom: hidden">
                                        <tr>
                                            <th>
                                                <?= lang('telephone') ?>
                                            </th>
                                            <th>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (isset($businessTelephones) && count($businessTelephones) > 0) {
                                            foreach ($businessTelephones as $key => $telephoneData) { ?>
                                                <tr id="business_telephone_<?php echo $key; ?>">
                                                    <input type="hidden" class="form-control"
                                                           value="<?= $telephoneData['business_telephone_id']; ?>"
                                                           name="business_telephone[<?= $key; ?>][business_telephone_id]"
                                                           id="business_telephone<?= $key; ?>">
                                                    <td>
                                                        <input type="tel" class="form-control"
                                                               value="<?= $telephoneData['telephone']; ?>"
                                                               name="business_telephone[<?= $key; ?>][telephone]"
                                                               id="telephone<?= $key; ?>" >
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($key != 0) {
                                                            ?>
                                                            <a href='javascript:void(0);' data-popup='custom-tooltip'
                                                               data-original-title="<?= lang('delete') ?>"
                                                               title="<?= lang('delete') ?>"
                                                               class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord'
                                                               onclick='deleteTelephoneRow(<?= $key; ?>,<?= $telephoneData['business_telephone_id']; ?>)'><i
                                                                        class="icon-trash"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr id="business_telephone_0">
                                                <td>
                                                    <input type="tel" class="form-control" placeholder="Enter Telephone"
                                                           name="business_telephone[0][telephone]" id="telephone0">
                                                </td>
                                                <td></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    <div id='post_add_remove'>
                                        <button type="button"
                                                class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded"
                                                onclick="AddTelephoneRow();"
                                                data-popup='custom-tooltip' data-original-title="<?= lang('add') ?>"
                                                title="<?= lang('add') ?>"
                                        >
                                            <i class="icon-plus3"></i>
                                        </button>
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
                    onclick="window.location.href='<?php echo site_url('Business'); ?>'"><?= lang('cancel_btn') ?> <i
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
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCuHX1kolcnapKN-MAW_hhgOLPXEbHVKQA&libraries=places"></script>

<script>
    function ImageLoad() {
        var businessId = $('#business_id').val();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Business/imageLoad');?>",
            dataType: "json",
            async: false,
            data: {business_id: businessId},
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
                    url: "<?php echo site_url('Business/imageDelete');?>",
                    dataType: "json",
                    //async: false,
                    data: {image_id: imageId, image_url: imageUrl},
                    success: function (data) {
                        if (data['success']) {
                            swal({
                                title: "<?= ucwords(lang('success'))?>",
                                text: data['msg'],
                                type: "<?= lang('success')?>",
                                confirmButtonColor: "<?= BTN_SUCCESS; ?>",
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
                                //ImageLoad();
                            });
                        }
                    }
                });
            });
    }
</script>

<!-- end image edit time image load and display-->

<script>
    function deleteMobileRow(index, rowId) {
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
                    url: "<?php echo site_url('Business/rowMobileDelete');?>",
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
                                $('tr#business_mobile_' + index).slideUp().hide().remove();
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

    function deleteTelephoneRow(index, rowId) {
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
                    url: "<?php echo site_url('Business/rowTelephoneDelete');?>",
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
                                $('tr#business_telephone_' + index).slideUp().hide().remove();
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

    function deleteEmailRow(index, rowId) {
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
                    url: "<?php echo site_url('Business/rowEmailDelete');?>",
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
                                $('tr#business_email_' + index).slideUp().hide().remove();
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
        Select2Init();
        FileKeyGen();

        stateDD('','#state_id');
        cityDD('','#city_id');

        $("#samaj_id").change(function () {
            $('#member_id').val("").trigger('change.select2');
            var samajId = $("#samaj_id").val();
            getMember(samajId,'');
        });

        $("#state_id").change(function () {
            $('#city_id').val("").trigger('change.select2');
            var stateId = $("#state_id").val();
        });

        samajDD('', '#samaj_id');
        businessTypeDD();

        var stateId = <?= isset($getBusinessData['state_id']) && ($getBusinessData['state_id'] != '') ? $getBusinessData['state_id'] : 0 ?>;
        var stateName = "<?= isset($getBusinessData['state_name']) && ($getBusinessData['state_name'] != '') ? $getBusinessData['state_name'] : '' ?>";
        selectStateValue(stateId, stateName);

        var cityId = <?= isset($getBusinessData['city_id']) && ($getBusinessData['city_id'] != '') ? $getBusinessData['city_id'] : 0 ?>;
        var cityName = "<?= isset($getBusinessData['city_name']) && ($getBusinessData['city_name'] != '') ? $getBusinessData['city_name'] : '' ?>";
        selectStateValue(cityId, cityName,"#city_id");



        jQuery.validator.addMethod("lettersonly", function (value, element) {
            return this.optional(element) || /^[a-z ]+$/i.test(value);
        }, "Only Letters are allowed");

        var validator = $("#businessDetails").validate({
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
                'business_name[]': {
                    required: true
                },
                'owner_name[]': {
                    required: true,
                },
                'description[]': {
                    required: function(textarea) {
                        CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                        var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                        return editorcontent.length === 0;
                    }
                },
                address_geo: {
                    required: true
                },
                business_type_id: {
                     required: true
                },
                member_id: {
                    required: true
                },
                samaj_id: {
                    required: true,
                },
                'address[]': {
                    required: true
                },
                lat: {
                    required: true
                },
                lng: {
                    required: true
                },
                state_id: {
                    required: true
                },
                city_id:{
                    required: true
                },
                business_pincode: {
                    required: true,
                    number: true,
                    maxlength: 6
                },
                "filename[]" :{
                    extension: "<?= FILE_UPLOAD_TYPE; ?>",
                    //filesize: "<?//= MAX_IMAGE_SIZE_LIMIT; ?>//"
                }
            },

            messages: {
                'business_name[]': {
                    required: "Please Enter <?= lang('business_name') ?>"
               },
               'owner_name[]': {
                    required: "Please Enter <?= lang('owner_name') ?>"

               },
               'description[]': {
                    required: "Please Enter <?= lang('description') ?>"
               },
               address_geo: {
                    required: "Please Enter <?= lang('address_geo') ?>"
               },
               business_type_id: {
                    required: "Please Enter <?= lang('business_type') ?>"
               },
               member_id: {
                    required: "Please Enter <?= lang('member') ?>"
               },
               samaj_id: {
                    required: "Please Enter <?= lang('samaj') ?>"
               },
               'address[]': {
                    required: "Please Enter <?= lang('address') ?>"
               },
               lat: {
                    required: "Please Enter <?= lang('lat') ?>"
               },
               lng: {
                    required: "Please Enter <?= lang('lng') ?>"
               },
               state_id: {
                    required: "Please Enter <?= lang('business_state') ?>"
               },
               city_id: {
                    required: "Please Enter <?= lang('business_city') ?>"
               },
               business_pincode: {
                    required: "Please Enter <?= lang('business_pincode') ?>",
                    maxlength:"It allows only 6 digits"
               },
               'filename[]':{
                   extension: "Please choose image with extension <?= FILE_UPLOAD_TYPE_MSG ?> ",
                   filesize: "File size is more than  expected size (2MB) "
               }

            },
            submitHandler: function (e) {

                $(e).ajaxSubmit({

                    url: '<?php echo site_url("Business/save");?>',
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
//                        alert();
                        if (resObj.success) {
//                            alert(resObj.success);
                            swal({
                                title: "<?= ucwords(lang('success')); ?>",
                                text: resObj.msg,
                                confirmButtonColor: "<?= BTN_SUCCESS; ?>",
                                type: "<?= lang('success'); ?>"
                            }, function () {
                                window.location.href = '<?php echo site_url('Business');?>';
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


        businessTypeDD('','#business_type_id');

        <?php if((isset($getBusinessData['business_type_name']) && !empty($getBusinessData['business_type_name']))){
        $getBusinessType = $getBusinessData['business_type_name'];
        ?>
        var option = new Option("<?= $getBusinessData['business_type_name']; ?>", "<?= $getBusinessData['business_type_id']; ?>", true, true);
        $('#business_type_id').append(option).trigger('change');
        <?php } ?>

        $("#address_geo").geocomplete({
                map: ".map-wrapper",
                details: "form",
                types: ["geocode", "establishment"],
                location: <?php if ($businessId) {
                echo "[" . $latitude . "," . $longitude . "]";
            } else {
                echo "[19.0759837,72.87765590000004]";
            }?>,
                markerOptions: {
                    draggable: true,
                },
            }
        );

        $("#address_geo").bind("geocode:dragged", function (business, latLng) {

            var map = $("#address_geo").geocomplete("map");
            map.panTo(latLng);

            var geocoder = new google.maps.Geocoder();

            geocoder.geocode({'latLng': latLng}, function (results, status) {

                if (status == google.maps.GeocoderStatus.OK) {
                    $('#address_geo').val(results[0]['formatted_address']);
                }


                $('#lat').val(latLng.lat());
                $('#lng').val(latLng.lng());
            });
        });



        function selectStateValue(Id = '', stateName = '',selectFor='#state_id'){
            if (Id != 0) {
                if ($.isArray(Id)) {
                    var Result = {};
                    // noinspection JSAnnotator
                    Id.forEach((Id, i) => Result[Id] = stateName[i]);
                    $.each(Result, function (key, val) {
                        var newOption = new Option(val, key, true, true);
                        $(selectFor).append(newOption);
                    });
                    $(selectFor).append(newOption).trigger('refresh');
                } else {
                    var newOption = new Option(stateName, Id, true, true);
                    $(selectFor).append(newOption).trigger('refresh');
                }
            }
        }



        $("#address_geo").focusout(function () {
            $('#lat').val('');
            $('#lng').val('');
            $("#address_geo").trigger("geocode");
        });

        ImageLoad();



        <?php if((isset($getBusinessData['samaj_name']) && !empty($getBusinessData['samaj_name']))){
        $samajName = $getBusinessData['samaj_name']; ?>
        var option = new Option("<?= $getBusinessData['samaj_name']; ?>", "<?= $getBusinessData['samaj_id']; ?>", true, true);
        $('#samaj_id').append(option).trigger('change');
        <?php } ?>

        <?php if((isset($getBusinessData['member_name']) && !empty($getBusinessData['member_name']))){
        $memberName = $getBusinessData['member_name']; ?>
        var option = new Option("<?= $getBusinessData['member_name']; ?>", "<?= $getBusinessData['member_id']; ?>", true, true);
        $('#member_id').append(option).trigger('change');
        <?php } ?>

    });

    var mobiles_index = <?= isset($businessMobiles) ? count($businessMobiles) : 0 + 1;?>;
    function AddMobileRow() {
        //remove = mobiles_index;
        mobiles_index++;
        iner_mobiles_index = mobiles_index;

        emailHtml = "<tr id='business_mobile_" + iner_mobiles_index + "'>" +

            "<td>" +
            "<input type='tel' placeholder='Enter Mobile Number' class='form-control' id='mobile" + iner_mobiles_index + "' name='business_mobile[" + iner_mobiles_index + "][mobile]'>" +
            "</td>" +

            "<td>" +
            "<a href='javascript:void(0);' data-popup='custom-tooltip' data-original-title='<?= lang('add')?>' title='<?= lang('add')?>' class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord' onclick='deleteMobileRow(" + iner_mobiles_index + ")'><i class='icon-trash'></i></a>" +
            "</td>" +
            "</tr>";

        $('table#mobile_rows tbody').append(emailHtml);


        addValidation("input", "#mobile" + iner_mobiles_index + "", {
            required: true,
            number: true,
            minlength: 10,
            maxlength: 10
//
        });

    }

    var emails_index = <?= isset($businessEmails) ? count($businessEmails) : 0 + 1;?>;
    function AddEmailRow() {
        //remove = emails_index;
        emails_index++;
        iner_emails_index = emails_index;

        emailHtml = "<tr id='business_email_" + iner_emails_index + "'>" +

            "<td>" +
            "<input type='email' placeholder='Enter Email' class='form-control' id='email" + iner_emails_index + "' name='business_email[" + iner_emails_index + "][email]'>" +
            "</td>" +


            "<td>" +
            "<a href='javascript:void(0);' data-popup='custom-tooltip' data-original-title='<?= lang('add')?>' title='<?= lang('add')?>' class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord' onclick='deleteEmailRow(" + iner_emails_index + ")'><i class='icon-trash'></i></a>" +
            "</td>" +
            "</tr>";

        $('table#email_rows tbody').append(emailHtml);


        addValidation("input", "#email" + iner_emails_index + "", {
            required: true,
            validEmail: true
        });

    }

    var telephones_index = <?= isset($businessTelephones) ? count($businessTelephones) : 0 + 1;?>;
    function AddTelephoneRow() {
        //remove = telephones_index;
        telephones_index++;
        iner_telephones_index = telephones_index;

        emailHtml = "<tr id='business_telephone_" + iner_telephones_index + "'>" +

            "<td>" +
            "<input type='tel' placeholder='Enter Telephone' class='form-control' id='telephone" + iner_telephones_index + "' name='business_telephone[" + iner_telephones_index + "][telephone]'>" +
            "</td>" +


            "<td>" +
            "<a href='javascript:void(0);' data-popup='custom-tooltip' data-original-title='<?= lang('add')?>' title='<?= lang('add')?>' class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord' onclick='deleteTelephoneRow(" + iner_telephones_index + ")'><i class='icon-trash'></i></a>" +
            "</td>" +
            "</tr>";

        $('table#telephone_rows tbody').append(emailHtml);


        addValidation("input", "#telephone" + iner_telephones_index + "", {
            required: true,
            number: true,
            maxlength: 10,
        });

    }
</script>

<?php if (isset($select2)) { ?>
    <?= $select2 ?>
<?php } ?>
