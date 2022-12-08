<div class="panel panel-flat border-left-lg border-left-slate">
    <div class="panel-heading ">
        <h5 class="panel-title"><?= lang('monk_location_heading') ?><a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
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
            'id' => 'monkLocationDetails',
            'method' => 'post',
            'class' => 'form-horizontal'
        );
        echo form_open_multipart('', $form_id);
        $monkLocationId = (isset($monkLocationData['monk_location_id']) && ($monkLocationData['monk_location_id'] != '')) ? $monkLocationData['monk_location_id'] : '';
        $latitude = (isset($monkLocationData['latitude']) && ($monkLocationData['latitude'] != '')) ? $monkLocationData['latitude'] : '';
        $longitude = (isset($monkLocationData['longitude']) && ($monkLocationData['longitude'] != '')) ? $monkLocationData['longitude'] : '';
        ?>
        <input type="hidden" name="monk_location_id" id="monk_location_id"
               value="<?= (isset($monkLocationData['monk_location_id']) && ($monkLocationData['monk_location_id'] != '')) ?
                   $monkLocationData['monk_location_id'] : '' ?>">
            <div class="tab-content">

                <!--Monk-->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('monk_name') ?><span class="text-danger"> * </span></label>
                    <div class="col-lg-9">
                        <select name="monk_id" id="monk_id" class="form-control" data-placeholder="Select <?= lang('monk_name') ?> ">
                            <option value=""></option>
                        </select>
                    </div>
                </div>

                <!-- Location Name -->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('location_name') ?><span class="text-danger"> * </span></label>
                    <div class="col-lg-9">
                        <input type="text" name="location_name" value="<?= (isset($monkLocationData['location_name']) && ($monkLocationData['location_name'] != '')) ? $monkLocationData['location_name'] : ''; ?>" id="location_name" class="form-control"
                             placeholder="Enter <?= lang('location_name') ?>">
                    </div>
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('address') ?><span class="text-danger"> * </span></label>
                    <div class="col-lg-9">
                        <textarea name="address" placeholder="Enter <?= lang('address')?>" id="address" class="form-control" rows="3" cols="3"><?php echo (isset($monkLocationData['address']) && ($monkLocationData['address'] != '')) ? $monkLocationData['address'] :""; ?></textarea>
                        <label id="short_description-error" class="validation-error-label" for="short_description"></label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"></label>
                    <div class="col-lg-9">
                        <div class="map-wrapper" style="height: 250px"></div>
                        </div>
                </div>

                <!-- google address -->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('google_address') ?><span class="text-danger"> * </span></label>
                    <div class="col-lg-9">
                        <input type="text" name="google_address" value="<?= (isset($monkLocationData['google_address']) && ($monkLocationData['google_address'] != '')) ? $monkLocationData['google_address'] : ''; ?>" id="google_address" class="form-control"
                             placeholder="Enter <?= lang('google_address') ?>">
                    </div>
                </div>

                <!-- latitude -->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('latitude') ?><span class="text-danger"> * </span></label>
                    <div class="col-lg-9">
                        <input type="number" name="latitude" value="<?= (isset($monkLocationData['latitude']) && ($monkLocationData['latitude'] != '')) ? $monkLocationData['latitude'] : ''; ?>" id="latitude" class="form-control"
                                placeholder="Enter <?= lang('latitude') ?>" readonly>
                    </div>
                </div>

                <!-- longitude -->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('longitude') ?><span class="text-danger"> * </span></label>
                    <div class="col-lg-9">
                        <input type="number" name="longitude" value="<?= (isset($monkLocationData['longitude']) && ($monkLocationData['longitude'] != '')) ? $monkLocationData['longitude'] : ''; ?>" id="longitude" class="form-control"
                             placeholder="Enter <?= lang('longitude') ?>" readonly>
                    </div>
                </div>

                <!-- Contact Person -->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('contact_person') ?><span class="text-danger"> * </span></label>
                    <div class="col-lg-9">
                        <input type="text" name="contact_person" value="<?= (isset($monkLocationData['contact_person']) && ($monkLocationData['contact_person'] != '')) ? $monkLocationData['contact_person'] : ''; ?>" id="contact_person" class="form-control"
                            placeholder="Enter <?= lang('contact_person') ?>">
                    </div>
                </div>

                <!-- Contact Person Mobile-->
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('contact_person_mobile') ?><span class="text-danger"> * </span></label>
                    <div class="col-lg-9">
                        <input type="tel" maxlength="10" name="contact_person_mobile" value="<?= (isset($monkLocationData['contact_person_mobile']) && ($monkLocationData['contact_person_mobile'] != '')) ? $monkLocationData['contact_person_mobile'] : ''; ?>" id="contact_person_mobile" class="form-control"
                            placeholder="Enter <?= lang('contact_person_mobile') ?>">
                    </div>
                </div>

                <!-- create button -->
                <div class="text-right">
                    <button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
                            onclick="window.location.href='<?php echo site_url('MonkLocation'); ?>'"><?= lang('cancel_btn') ?> <i class="icon-cross2 position-right"></i> </button>

                    <button type="submit"
                            class="btn btn-xs border-blue text-blue btn-flat btn-ladda btn-ladda-progress submit" data-spinner-color="#03A9F4" data-style="fade"><span class="ladda-label"><?= lang('submit_btn') ?></span>
                        <i id="icon-hide" class="icon-arrow-right8 position-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCuHX1kolcnapKN-MAW_hhgOLPXEbHVKQA&libraries=places"></script>

<script>
    var laddaSubmitBtn = Ladda.create(document.querySelector('.submit'));

    $(document).ready(function () {
        Select2Init();
        monkDD('','#monk_id');

        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param)
        });
        // Initialize
        var validator = $("#monkLocationDetails").validate({
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
                monk_id : {
                    required  : true
                },
                location_name: {
                    required: true
                },
                address: {
                    required: true,
                    maxlength: 255
                },
                contact_person : {
                    required: true
                },
                contact_person_mobile : {
                    required: true,
                    digits: true,
                    maxlength: 10
                },
                google_address: {
                    required: true
                },
                latitude: {
                    required: true,
                    number: true
                },
                longitude: {
                    required: true,
                    number: true
                }
            },
            messages: {
                monk_id :{
                    required: "Please select <?= lang('monk_name') ?>"
                },
                location_name: {
                    required: "Please Enter <?= lang('location_name') ?>",
                    remote  : "<?= lang('location_name') ?> Already Exist"
                },
                address: {
                    required: "Please Enter <?= lang('address') ?>",
                    maxlength: "Please Enter Only 255 Character"
                },
                contact_person: {
                    required: "Please Enter <?= lang('contact_person') ?>"
                },
                contact_person_mobile: {
                    required: "Please Enter <?= lang('contact_person_mobile') ?>",
                    digits: "Please Enter Only Digits",
                    maxlength: "Please Enter Only 10 Digits"
                },
                google_address: {
                    required: "Please Enter <?= lang('google_address') ?>"
                },
                latitude: {
                    required: "Please Enter <?= lang('latitude') ?>",
                    number: "Please Enter Only Number"
                },
                longitude: {
                    required: "Please Enter <?= lang('longitude') ?>",
                    number: "Please Enter Only Number"
                }
            },
            submitHandler: function (e) {
                $(e).ajaxSubmit({
                    url: '<?php echo site_url("MonkLocation/save");?>',
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
                                window.location.href = '<?php echo site_url('MonkLocation');?>';
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

        $("#google_address").geocomplete({
            map: ".map-wrapper",
            details: "form",
            types: ["geocode", "establishment"],
            location: <?php if ($monkLocationId ) {
                echo "[" . $latitude . "," . $longitude . "]";
            } else {
                echo "[19.0759837,72.87765590000004]";
            }?>,
            markerOptions: {
                draggable: true
            }
        });

        $("#google_address").bind("geocode:dragged", function (event, latLng) {
            var map = $("#google_address").geocomplete("map");
            map.panTo(latLng);

            var geocoder = new google.maps.Geocoder();

            geocoder.geocode({'latLng': latLng}, function (results, status) {

                if (status == google.maps.GeocoderStatus.OK) {
                    $('#google_address').val(results[0]['formatted_address']);
                }

                $('#latitude').val(latLng.lat());
                $('#longitude').val(latLng.lng());
            });
        });

        $("#google_address").focusout(function () {
            $('#latitude').val('');
            $('#latitude').val('');
            $("#google_address").trigger("geocode");
        });
        <?php if((isset($monkLocationData['monk_name']) && !empty($monkLocationData['monk_name']))){
        $monkName = $monkLocationData['monk_name']; ?>
        var option = new Option("<?= $monkLocationData['monk_name']; ?>", "<?= $monkLocationData['monk_id']; ?>", true, true);
        $('#monk_id').append(option).trigger('change');
        <?php } ?>
    });

</script>
<?php if (isset($select2)) { ?>
    <?= $select2 ?>
<?php } ?>
