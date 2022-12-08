
<?php
    $yesSelected = '';
    $noSelected = '';
    if(isset($getMemberData['relationship_master_id']) && $getMemberData['relationship_master_id'] != ''){
        $noSelected = 'checked';
    } else {
        $yesSelected = 'checked';
    }


?>
<div class="panel panel-flat border-left-lg border-left-slate">
    <div class="panel-heading ">
        <h5 class="panel-title"><?= lang('member_heading') ?><a class="heading-elements-toggle"><i class="icon-more"></i></a>
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
            'id' => 'memberDetails',
            'method' => 'post',
            'class' => 'form-horizontal',
        );
        echo form_open_multipart('', $form_id);
        $memberId = (isset($getMemberData['member_id']) && ($getMemberData['member_id'] != '')) ? $getMemberData['member_id'] : '';
        $relationshipId = (isset($getRelationshipData['relationship_master_id']) && ($getRelationshipData['relationship_master_id'] != '')) ? $getRelationshipData['relationship_master_id'] : '';
        ?>
        <input type="hidden" name="member_id" value="<?= $memberId ?>" id="member_id">

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
                            <input type="hidden" name="member_description_id[]"
                                   value="<?= (isset($getMemberDescription[$languageData['language_id']]['member_description_id']) && ($getMemberDescription[$languageData['language_id']]['member_description_id'] != '')) ? $getMemberDescription[$languageData['language_id']]['member_description_id'] : ''; ?>"
                                   id="">


                            <?php if ($languageData['is_default'] == 1) { ?>

                                <!--Samaj-->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('samaj') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <select name="samaj_id" id="samaj_id" class="form-control"
                                                data-placeholder="Select <?= lang('samaj') ?> ">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                                <!-- surname -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('surname') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <select name="surname_id" id="surname_id" class="form-control" data-placeholder="Select <?= lang('surname') ?> ">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>

                            <!-- First Name -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('first_name') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="first_name[]"
                                           value="<?= (isset($getMemberDescription[$languageData['language_id']]['first_name']) && ($getMemberDescription[$languageData['language_id']]['first_name'] != '')) ? $getMemberDescription[$languageData['language_id']]['first_name'] : ''; ?>"
                                           id="first_name_<?= $languageData['language_id']?>" class="form-control"
                                           placeholder="Enter <?= lang('first_name') ?>">
                                </div>
                            </div>
                            <!-- Middle Name -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?= lang('middle_name') ?><span class="text-danger"> * </span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="middle_name[]"
                                           value="<?= (isset($getMemberDescription[$languageData['language_id']]['middle_name']) && ($getMemberDescription[$languageData['language_id']]['middle_name'] != '')) ? $getMemberDescription[$languageData['language_id']]['middle_name'] : ''; ?>"
                                           id="middle_name_<?= $languageData['language_id']?>" class="form-control"
                                           placeholder="Enter <?= lang('middle_name') ?>">
                                </div>
                            </div>

                            <?php if ($languageData['is_default'] == 1) { ?>
                                <!--parent member-->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('parent_member') ?></label>
                                    <div class="col-lg-9">
                                        <select name="parent_member_id" id="parent_member_id" class="form-control"
                                                data-placeholder="Select <?= lang('parent_member') ?>">
                                            <!--                                            <option value=""></option>-->

                                            <?= CreateOptions("html", "tbl_member_description", array("member_id", "concat(first_name,' ',middle_name)"), (isset($getMemberData['parent_member_id']) && ($getMemberData['parent_member_id'] != '')) ? $getMemberData['parent_member_id'] : '','null',array('member_id' => isset($getMemberData['parent_member_id']) ? $getMemberData['parent_member_id'] : '' , 'language_id' => isset($getDefaultLanguage['language_id']) ? $getDefaultLanguage['language_id'] : '')); ?>

                                        </select>
                                    </div>
                                </div>

                                <!-- education -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('member_education') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <select name="education_id[]" id="education_id" class="form-control" multiple
                                                data-placeholder="Select <?= lang('member_education') ?> ">
<!--                                            <option value=""></option>-->
                                        </select>
                                    </div>
                                </div>

                                <!-- Date of birth -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('date_of_birth') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <input type="tel" class="form-control" id="date_of_birth"
                                               name="date_of_birth"
                                               value="<?= (isset($getMemberData['date_of_birth'])) ? $getMemberData['date_of_birth'] : ''; ?>"
                                               placeholder="Select a <?= lang('date_of_birth') ?>" readonly>
                                    </div>
                                </div>


                                <!--state-->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('member_state') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <select name="state_id" id="state_id" class="form-control" data-placeholder="Select <?= lang('member_state') ?> ">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>


                                <!--city-->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('member_city') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <select name="city_id" id="city_id" class="form-control" data-placeholder="Select <?= lang('member_city') ?> ">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                                <!--pincode-->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('member_pincode') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <input type="text" name="member_pincode" id="member_pincode" class="form-control" maxlength="6" minlength="6"
                                               placeholder="Enter <?= lang('member_pincode') ?>" value="<?= (isset($getMemberData['member_pincode']) && ($getMemberData['member_pincode'] != '')) ? $getMemberData['member_pincode'] : ''; ?>">
                                    </div>
                                </div>
                                <?php } ?>


                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('member_address') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <input type="text" name="member_address[]"
                                               value="<?= (isset($getMemberDescription[$languageData['language_id']]['member_address']) && ($getMemberDescription[$languageData['language_id']]['member_address'] != '')) ? $getMemberDescription[$languageData['language_id']]['member_address'] : ''; ?>"
                                               id="first_name_<?= $languageData['language_id']?>" class="form-control"
                                               placeholder="Enter <?= lang('member_address') ?>">
                                    </div>
                                </div>


                            <?php if ($languageData['is_default'] == 1) { ?>

                                <!-- currently work-->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('member_current_work') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <input type="text" name="current_work"
                                               value="<?= (isset($getMemberData['current_work']) && ($getMemberData['current_work'] != '')) ? $getMemberData['current_work'] : ''; ?>"
                                               id="current_work" class="form-control"
                                               placeholder="Enter <?= lang('member_current_work') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('member_number') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <input type="text" name="member_number" id="member_number"
                                               value="<?= (isset($getMemberData['member_number']) && ($getMemberData['member_number'] != '')) ? $getMemberData['member_number'] : ''; ?>"
                                               class="form-control"
                                               placeholder="Enter <?= lang('member_number') ?>">
                                    </div>
                                </div>

                                <!--Mobile-->
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
                                            if (isset($memberMobiles) && count($memberMobiles) > 0) {
                                                foreach ($memberMobiles as $key => $mobileData) { ?>
                                                    <tr id="member_mobile_<?php echo $key; ?>">
                                                        <input type="hidden" class="form-control"
                                                               value="<?= $mobileData['member_mobile_id']; ?>"
                                                               name="member_mobile[<?= $key; ?>][member_mobile_id]"
                                                               id="member_mobile<?= $key; ?>">
                                                        <td>
                                                            <input type="tel" class="form-control numberInit"
                                                                   placeholder="Mobile Number"  maxlength="10" minlength="10"
                                                                   value="<?= $mobileData['mobile']; ?>"
                                                                   name="member_mobile[<?= $key; ?>][mobile]"
                                                                   id="mobile<?= $key; ?>" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                   placeholder="Mobile Number Type"
                                                                   value="<?= $mobileData['mobile_type']; ?>"
                                                                   name="member_mobile_type[<?= $key; ?>][type]"
                                                                   id="type<?= $key; ?>" required>
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
                                                                   onclick='deleteMobileRow(<?= $key; ?>,<?= $mobileData['member_mobile_id']; ?>)'><i
                                                                            class="icon-trash"></i></a>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <tr id="member_mobile_0">
                                                    <td>
                                                        <input type="tel" class="form-control"
                                                               placeholder="Mobile Number" required
                                                               minlength="10" maxlength="10"
                                                               name="member_mobile[0][mobile]" id="mobile0">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                               placeholder="Mobile Number Type" value=""
                                                               name="member_mobile_type[0][type]" id="type0" required>
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


                                <!--Email-->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('email') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <input type="email" name="email"
                                               value="<?= (isset($getMemberData['email']) && ($getMemberData['email'] != '')) ? $getMemberData['email'] : ''; ?>"
                                               id="email" class="form-control"
                                               placeholder="Enter <?= lang('email') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('member_biodata') ?></label>
                                    <div class="col-lg-9">
                                        <input type="file" name="member_biodata[]"  id="member_biodata" class="file-styled-primary" multiple>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"></label>
                                    <div class="col-lg-9">
                                        <div class="form-group" id="bioDataListing">

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('blood_group') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <select name="blood_group" id="blood_group" class="form-control select"
                                                data-placeholder="Select <?= lang('blood_group') ?>">
                                            <option value=""></option>
                                            <?= CreateOptions("html", "tbl_blood_groups", array("blood_group_id", "blood_group"),(isset($getMemberData['blood_group_id']) && ($getMemberData['blood_group_id'] != '')) ? $getMemberData['blood_group_id'] : '');  ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('marital_status') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <select name="marital_status_id" id="marital_status_id" class="form-control"
                                                data-placeholder="Select <?= lang('marital_status') ?>">
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group hideMarriageDate">
                                    <label class="col-lg-3 control-label"><?= lang('marriage_date') ?></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="marriage_date" name="marriage_date"
                                               value="<?= (isset($getMemberData['marriage_date'])) ? $getMemberData['marriage_date'] : ''; ?>"
                                               placeholder="Select a <?= lang('marriage_date') ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('gender') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <select name="gender_id" id="gender_id" class="form-control" data-placeholder="Select <?= lang('gender') ?>">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('native_place') ?><span class="text-danger"> * </span></label>
                                    <div class="col-lg-9">
                                        <select name="native_id" id="native_id" class="form-control" data-placeholder="Select <?= lang('native_place') ?>">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>



                                <!--Aadhar_card_no-->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('aadhar_card_no') ?></label>
                                    <div class="col-lg-9">
                                        <input type="text" name="aadhar_card_no" maxlength="12" minlength="12"
                                               value="<?= (isset($getMemberData['aadhar_card_no']) && ($getMemberData['aadhar_card_no'] != '')) ?
                                                   $getMemberData['aadhar_card_no'] : ''; ?>" id="aadhar_card_no" class="form-control"
                                               placeholder="Enter <?= lang('aadhar_card_no') ?>">
                                    </div>
                                </div>
                                <!-- filename -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('member_image') ?></label>
                                    <div class="col-lg-9">
                                        <input type="file" accept="image/*" name="filename[]" id="filename" class="file-styled-primary"
                                               multiple>
                                        <!--                <img width="100" height="100">-->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"></label>
                                    <div class="col-lg-9">
                                        <div class="form-group" id="imageListing">

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('family_head')?></label>
                                    <div class="col-lg-9">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="family_head" <?= isset($yesSelected) ? $yesSelected : '' ?> value="yes" id="yesSelected" class="styled">
                                                Yes
                                            </label>
                                        </div>

                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="family_head" <?= isset($noSelected) ? $noSelected : '' ?> id="noSelected" value="no" class="styled">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="hideFamilyHeadInfo">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"><?= lang('relationship_name') ?><span class="text-danger"> * </span></label>
                                        <div class="col-lg-9">
                                            <select name="relationship_master_id" id="relationship_master_id" class="form-control"
                                                    data-placeholder="Select <?= lang('relationship_name') ?> ">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= lang('is_active') ?></label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery switchery-xs">
                                            <label>
                                                <input type="checkbox"
                                                       name="is_active" <?php if (isset($getMemberData['is_active']) && $getMemberData['is_active'] == 1) {
                                                    echo 'checked="checked"';
                                                } else {
                                                    echo '';
                                                } ?> id="is_active" class="switchery">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!isset($getMemberData['member_id'])) { ?>
                                    <?php if($this->ion_auth->is_admin()) { ?>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label"><?= lang('is_admin') ?></label>
                                            <div class="col-lg-9">
                                                <div class="checkbox checkbox-switchery switchery-xs">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="is_admin" <?php if (isset($getMemberData['is_admin']) && $getMemberData['is_admin'] == 1) {
                                                            echo 'checked="checked"';
                                                        } else {
                                                            echo '';
                                                        } ?> id="is_admin" class="switchery">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
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
                    onclick="window.location.href='<?php echo site_url('Member'); ?>'"><?= lang('cancel_btn') ?> <i class="icon-cross2 position-right"></i> </button>

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

        ImageLoad();
        bioDataLoad();
        numberInit();
        Select2Init();
        SwitcheryKeyGen();
        FileKeyGen();
        surnameDD('','#surname_id');
        samajDD('','#samaj_id');
        educationDD('','#education_id');
        genderDD('','#gender_id');
        nativeDD('','#native_id');
        maritalStatusDD('','#marital_status_id');
        stateDD('','#state_id');
        cityDD('','#city_id');
        relationshipDD('','#relationship_master_id');

        var radioValue = <?= isset($getMemberData['relationship_master_id']) && $getMemberData['relationship_master_id'] != 0 ? $getMemberData['relationship_master_id'] : 0 ?>;
        if(radioValue != 0){
            $('.hideFamilyHeadInfo').show();
        } else {
            $('.hideFamilyHeadInfo').hide();
        }
        $('.hideMarriageDate').hide();


        $("#parent_member_id").select2().on('change', function() {
            if($("#parent_member_id").valid()){
                $("#parent_member_id").removeClass('invalid').addClass('success');
            }
        });

        $("#parent_member_id").select2({
            ajax: {
                url: "<?= site_url('Member/getParentMemberName') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {

                    return {
                        filter_param: params.term || '', // search term
                        page: params.page || 1,
                        member_id : $('#member_id').val()
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


        $("#samaj_id").change(function () {
            $('#surname_id').val("").trigger('change.select2');
            $('#education_id').val("").trigger('change.select2');
            $('#native_id').val("").trigger('change.select2');
            var samajId = $("#samaj_id").val();
        });

        $("#state_id").change(function () {
            $('#city_id').val("").trigger('change.select2');
            var stateId = $("#state_id").val();
        });


        var samajId = <?= isset($getMemberData['samaj_id']) && ($getMemberData['samaj_id'] != '') ? $getMemberData['samaj_id'] : 0 ?>;
        var samajName = "<?= isset($getMemberData['samaj_name']) && ($getMemberData['samaj_name'] != '') ? $getMemberData['samaj_name'] : '' ?>";
        selectSamajValue(samajId, samajName);

        var surnameId = <?= isset($getMemberData['surname_id']) && ($getMemberData['surname_id'] != '') ? $getMemberData['surname_id'] : 0 ?>;
        var surname = "<?= isset($getMemberData['surname']) && ($getMemberData['surname'] != '') ? $getMemberData['surname'] : '' ?>";
        selectSamajValue(surnameId, surname,"#surname_id");

        var stateId = <?= isset($getMemberData['state_id']) && ($getMemberData['state_id'] != '') ? $getMemberData['state_id'] : 0 ?>;
        var stateName = "<?= isset($getMemberData['state_name']) && ($getMemberData['state_name'] != '') ? $getMemberData['state_name'] : '' ?>";
        selectStateValue(stateId, stateName);

        var cityId = <?= isset($getMemberData['city_id']) && ($getMemberData['city_id'] != '') ? $getMemberData['city_id'] : 0 ?>;
        var cityName = "<?= isset($getMemberData['city_name']) && ($getMemberData['city_name'] != '') ? $getMemberData['city_name'] : '' ?>";
        selectStateValue(cityId, cityName,"#city_id");


        // Initialize
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z ]+$/i.test(value);
        }, "Only Letters are allowed");
        var validator = $("#memberDetails").validate({
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
                samaj_id:{
                    required: true
                },
                parent_member_id:{
                    // required: true
                },
                'member_biodata[]': {
                    extension: "<?= FILE_UPLOAD_TYPE; ?>"
                },
                member_number:{
                    required: true,
                    remote: {
                        url: "<?php echo site_url( "Member/NameExist");?>",
                        type: "post",
                        data: {
                            column_name: function () {
                                return "member_number";
                            },
                            column_id: function () {
                                return $("#member_id").val();
                            },
                            table_name: function () {
                                return "tbl_members";
                            }
                        }
                    }
                },
                'first_name[]': {
                    required: true
                },
                'middle_name[]': {
                    required: true
                },
                surname_id: {
                    required: true
                },
                mobile: {
                    required: true,
                    number: true,
                    maxlength: 12
                },
                member_type:{
                    lettersonly:true
                },
                'education_id[]': {
                     required: true
                },
                email: {
                    required: true,
                    email: true,
                    validEmail: true,
                    remote: {
                        url: "<?php echo site_url( "Member/NameExist");?>",
                        type: "post",
                        data: {
                            column_name: function () {
                                return "email";
                            },
                            column_id: function () {
                                return $("#member_id").val();
                            },
                            table_name: function () {
                                return "tbl_members";
                            }
                        }
                    }
                },
                blood_group: {
                    required: true
                },
                marital_status_id: {
                    required: true

                },
                gender_id: {
                    required: true

                },
                date_of_birth: {
                    required: true,
                    validDate: true
                },
                state_id: {
                    required: true
                },
                city_id: {
                    required: true
                },
                member_pincode: {
                    required: true,
                    number: true,
                    maxlength: 6
                },
                'member_address[]': {
                    required: true
                },
                aadhar_card_no: {
//                    required: true,
                    aadhar: true,
                    remote: {
                        url: "<?php echo site_url( "Member/NameExist");?>",
                        type: "post",
                        data: {
                            column_name: function () {
                                return "aadhar_card_no";
                            },
                            column_id: function () {
                                return $("#member_id").val();
                            },
                            table_name: function () {
                                return "tbl_members";
                            }
                        }
                    }
                },
                "filename[]": {
                    extension: "<?= FILE_UPLOAD_TYPE ?>",
                    //filesize: "<?//= MAX_IMAGE_SIZE_LIMIT ?>//"
                },
                native_id:{
                    required: true
                }
            },
            messages: {
                samaj_id:{
                    required: "Please Enter <?= lang('samaj') ?>"
                },
                'member_biodata[]': {
                    extension: "Please Enter File in extension as follows <?php echo FILE_UPLOAD_TYPE ?>"
                },
                member_number:{
                    required: "Please Enter <?= lang('member_number') ?>",
                    remote  : "<?= lang('member_number') ?> Already Exist"
                },
                'first_name[]':{
                    required: "Please Enter <?= lang('first_name') ?>"
                },
                'middle_name[]': {
                    required: "Please Enter <?= lang('middle_name') ?>"
                },
                surname_id: {
                    required: "Please Enter <?= lang('surname') ?>"
                },
                mobile: {
                    required: "Please Enter <?= lang('mobile') ?>",
                    maxlength:"Please enter no more than 12 number."
                },
                member_type:{
                    lettersonly: "Only Letters are allowed"
                },
                'education_id[]': {
                    required: "Please Enter <?= lang('member_education') ?>"
                },


                email: {
                    required: "Please Enter <?= lang('email') ?>",
                    remote  : "<?= lang('email') ?> Already Exist"
                },
                blood_group: {
                    required: "Please Enter <?= lang('blood_group') ?>"
                },
                marital_status_id: {
                    required: "Please Enter <?= lang('marital_status') ?>"
                },
                gender_id: {
                    required: "Please Enter <?= lang('gender_id') ?>"
                },
                date_of_birth: {
                    required: "Please Enter <?= lang('date_of_birth') ?>"
                },
                state_id: {
                    required: "Please Enter <?= lang('member_state') ?>"
                },
                city_id: {
                    required: "Please Enter <?= lang('member_city') ?>"
                },
                member_pincode: {
                    required: "Please Enter <?= lang('member_pincode') ?>",
                    maxlength:"It allows only 6 digits"
                },
                'member_address[]': {
                    required: "Please Enter <?= lang('member_address') ?>"
                },
                aadhar_card_no: {
//                    required: "Please Enter <?//= lang('aadhar_card_no') ?>//",
                    remote  : "<?= lang('aadhar_card_no') ?> Already Exist"
                },
                "filename[]":{
                    extension: "Please choose image with extension <?= FILE_UPLOAD_TYPE_MSG ?>",
                    filesize: "File size is more than  expected size (2MB) "
                },
                native_id:{
                    required: "Please Enter <?= lang('native_location') ?>"
                }
            },
            submitHandler: function (e) {

                $(e).ajaxSubmit({
                    url: '<?php echo site_url("Member/save");?>',
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
                                window.location.href = '<?php echo site_url('Member');?>';
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


        function selectSamajValue(Id = '', samajName = '',selectFor='#samaj_id'){
            if (Id != 0) {
                if ($.isArray(Id)) {
                    var Result = {};
                    // noinspection JSAnnotator
                    Id.forEach((Id, i) => Result[Id] = samajName[i]);

                    $.each(Result, function (key, val) {
                        var newOption = new Option(val, key, true, true);
                        $(selectFor).append(newOption);
                    });

                    $(selectFor).append(newOption).trigger('refresh');

                } else {

                    var newOption = new Option(samajName, Id, true, true);
                    $(selectFor).append(newOption).trigger('refresh');
                }
            }
        }


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


        $("#date_of_birth").datepicker({
//            dateFormat: "<?//= DATE_FORMATE ?>//",
            dateFormat: 'dd-mm-yy',
            todayBtn:  "linked",
            autoclose: true,
            minDate: '-100y',
            maxDate: '-18y',
            todayHighlight: true,
            changeMonth: true,
            changeYear: true,
            onSelect: function (value, ui) {
                if ($(this).valid()) {
                    $(this).removeClass('invalid').addClass('success');
                }
                // var id = $(this).attr('id');
                // $("input[name="+id+"]").val($(this).val());

//                var today = new Date();
//                var age = today.getFullYear() - ui.selectedYear;
//                $('#age').val(age);
            }


        });

        $('#marital_status_id').change(function () {
            var maritalStatus = $(this).val();
            var marriageDate = $('.hideMarriageDate');
            if(maritalStatus == 1) {

                marriageDate.show();
            }
            if(maritalStatus == 2) {
                $('#marriage_date').val('00-00-0000');
                marriageDate.find('select').val("").trigger('change.select2');
                marriageDate.hide();
            }
        });


        $("#marriage_date").datepicker({
            dateFormat: 'dd-mm-yy',
            todayBtn:  "linked",
            autoclose: true,
            minDate: '-100y',
            maxDate: '-18y',
            todayHighlight: true,
            changeMonth: true,
            changeYear: true,
            onSelect: function (value, ui) {
                if ($(this).valid()) {
                    $(this).removeClass('invalid').addClass('success');
                }
            }
        });

        $("input[type='radio']").change(function(){
            var radioValue = $(this).val();
            var familyHead = $('.hideFamilyHeadInfo');
            if(radioValue != 'yes'){
                $('.hideFamilyHeadInfo').show();
            }
            else{
                familyHead.hide();
            }
        });


        <?php if((isset($getMemberData['education_name']) && !empty($getMemberData['education_name']))){ ?>
            <?php foreach ($getMemberData['education_name'] as $getMemberDataKey => $getMemberDataValue){ ?>
                var option = new Option("<?= $getMemberDataValue['education_name']; ?>", "<?= $getMemberDataValue['education_id']; ?>", true, true);
                $('#education_id').append(option).trigger('change');
            <?php } ?>
        <?php } ?>

        <?php if((isset($getMemberData['gender_name']) && !empty($getMemberData['gender_name']))){ ?>
            var option = new Option("<?= $getMemberData['gender_name']; ?>", "<?= $getMemberData['gender_id']; ?>", true, true);
            $('#gender_id').append(option).trigger('change');
        <?php } ?>

        <?php if((isset($getMemberData['native_id']) && !empty($getMemberData['native_id']))){ ?>
            var option = new Option("<?= $getMemberData['native_location']; ?>", "<?= $getMemberData['native_id']; ?>", true, true);
            $('#native_id').append(option).trigger('change');
        <?php } ?>

        <?php if((isset($getMemberData['marital_status']) && !empty($getMemberData['marital_status']))){ ?>
            var option = new Option("<?= $getMemberData['marital_status']; ?>", "<?= $getMemberData['marital_status_id']; ?>", true, true);
            $('#marital_status_id').append(option).trigger('change');
        <?php } ?>

        <?php if((isset($getMemberData['relationship_name']) && !empty($getMemberData['relationship_name']))){ ?>
            var option = new Option("<?= $getMemberData['relationship_name']; ?>", "<?= $getMemberData['relationship_master_id']; ?>", true, true);
            $('#relationship_master_id').append(option).trigger('change');
        <?php } ?>


    });

    var mobiles_index = <?= isset($memberMobiles) ? count($memberMobiles) : 1;?>;
    function AddMobileRow(){
        //remove = mobiles_index;
        mobiles_index ++;
        iner_mobiles_index = mobiles_index;
        iner_mobile_type_index = mobiles_index;

        emailHtml = "<tr id='member_mobile_" + iner_mobiles_index + "'>" +

            "<td>"+
            "<input type='tel'  class='form-control numberInit' placeholder='Mobile Number' id='mobile" + iner_mobiles_index + "' name='member_mobile["+iner_mobiles_index+"][mobile]'>"+
            "</td>"+
            "<td>"+
            "<input type='text' placeholder='Mobile Number Type'  class='form-control' id='type" + iner_mobile_type_index + "' name='member_mobile_type["+iner_mobile_type_index+"][type]'>"+
            "</td>"+

            "<td>" +
            "<a href='javascript:void(0);' data-popup='custom-tooltip' data-original-title='<?= lang('delete')?>' title='<?= lang('delete')?>' class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord' onclick='deleteMobileRow("+iner_mobiles_index+")'><i class='icon-trash'></i></a>" +
            "</td>"+
            "</tr>";

        $('table#mobile_rows tbody').append(emailHtml);



        addValidation("input","#mobile"+iner_mobiles_index+"",{
            required: true,
            number: true,
            minlength:10,
            maxlength:10
        });
        addValidation("input","#type"+iner_mobile_type_index+"",{
            required: true,
            lettersonly:true
        });

    }

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
    }, 'Please enter a valid birth date');


    function deleteMobileRow(index,rowId) {

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
                    url: "<?php echo site_url('Member/rowMobileDelete ');?>",
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
                                $('tr#member_mobile_' + index).slideUp().hide().remove();
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

    function ImageLoad() {
        var memberId = $('#member_id').val();
        $.ajax({
            type: "post",
            url: "<?php echo site_url('Member/imageLoad');?>",
            dataType: "json",
            async: false,
            data: {member_id: memberId},
            beforeSend: function (formData, jqForm, options) {
//                var dialog = bootbox.dialog({
//                    message: 'Please have patience, images are loading',
//                });
            },
            complete: function () {
                // bootbox.hideAll();
            },
            success: function (resObj) {
                $('#imageListing').html(resObj);
            }
        });
    }

    function bioDataLoad() {
        var memberId = $('#member_id').val();
        $.ajax({
            type: "post",
            url: "<?php echo site_url('Member/memberBiodataLoad');?>",
            dataType: "json",
            async: false,
            data: {member_id: memberId},
            beforeSend: function (formData, jqForm, options) {

            },
            complete: function () {
                // bootbox.hideAll();
            },
            success: function (resObj) {
                $('#bioDataListing').html(resObj);
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
                    type: "POST",
                    url: "<?php echo site_url('Member/imageDelete');?>",
                    dataType: "json",
                    //async: false,
                    data: {imageId: imageId, imageUrl: imageUrl},
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
                                //ImageLoad();
                            });
                        }
                    }


                });
            });
    }

    function deleteBioData(bioDataId, bioDataUrl) {
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
                    url: "<?php echo site_url('Member/bioDataDelete');?>",
                    dataType: "json",
                    //async: false,
                    data: {bioDataId: bioDataId, bioDataUrl: bioDataUrl},
                    success: function (data) {
                        if (data['success']) {
                            swal({
                                title: "<?= ucwords(lang('success'))?>",
                                text: data['msg'],
                                type: "<?= lang('success')?>",
                                confirmButtonColor: "<?= BTN_SUCCESS; ?>"
                            }, function () {
                                bioDataLoad();
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

    function FileKeyGen() {
        $(".file-styled-primary").uniform({
            fileButtonClass: 'action btn bg-blue'
        });
    }

</script>
<?php if (isset($select2)) { ?>
    <?= $select2 ?>
<?php } ?>
