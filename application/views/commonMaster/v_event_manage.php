<div class="panel panel-flat border-left-lg border-left-slate">
    <div class="panel-heading ">
        <h5 class="panel-title"><?= lang('event_heading') ?><a class="heading-elements-toggle"><i
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
            'id' => 'eventDetails',
            'method' => 'post',
            'class' => 'form-horizontal'
        );
        echo form_open_multipart('', $form_id);
        $eventId = (isset($getEventData['event_id']) && ($getEventData['event_id'] != '')) ? $getEventData['event_id'] : '';
        $latitude = (isset($getEventData['lat']) && ($getEventData['lat'] != '')) ? $getEventData['lat'] : '';
        $longitude = (isset($getEventData['lng']) && ($getEventData['lng'] != '')) ? $getEventData['lng'] : '';
        ?>
        <input type="hidden" name="event_id" value="<?= $eventId; ?>" id="event_id">
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
                    <input type="hidden" name="event_description_id[]"
                           value="<?= (isset($getEventDescription[$languageData['language_id']]['event_description_id']) && ($getEventDescription[$languageData['language_id']]['event_description_id'] != '')) ? $getEventDescription[$languageData['language_id']]['event_description_id'] : ''; ?>" id="">

                    <?php if($languageData['is_default'] == 1) { ?>

                        <!--Samaj-->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('samaj') ?><span class="text-danger"> * </span></label>
                            <div class="col-lg-9">
                                <select name="samaj_id" id="samaj_id" class="form-control"
                                        data-placeholder="Select <?= lang('samaj') ?> ">
                                    <option value=""></option>
<!--                                        --><?//= CreateOptions("html", "tbl_samaj_description", array("samaj_id","samaj_name"), (isset($getEventData['samaj_id']) && ($getEventData['samaj_id'] != '')) ? $getEventData['samaj_id'] : '','null',array('samaj_id' => $getEventData['samaj_id'], 'language_id' => $getDefaultLanguage['language_id'])); ?>
                                </select>
                            </div>
                        </div>

                    <?php } ?>

                    <!-- Event Name -->
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('event_name') ?><span class="text-danger"> * </span></label>
                        <div class="col-lg-9">
                            <input type="text" name="event_name[]" value="<?= (isset($getEventDescription[$languageData['language_id']]['event_name']) && ($getEventDescription[$languageData['language_id']]['event_name'] != '')) ? $getEventDescription[$languageData['language_id']]['event_name'] : ''; ?>" id="event_name_<?= $languageData['language_id']; ?>" class="form-control"
                                   placeholder="Enter <?= lang('event_name') ?>" id="event_name_<?= $languageData['language_id']; ?>" >
                        </div>
                    </div>
                    <!-- Short description -->

                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('short_description') ?><span class="text-danger"> * </span></label>
                        <div class="col-lg-9">
                            <textarea name="short_description[]" id="short_description_<?= $languageData['language_id']; ?>" placeholder="Enter Only 255 Character" class="form-control" rows="5" cols="5"><?php echo (isset($getEventDescription[$languageData['language_id']]['short_description']) && ($getEventDescription[$languageData['language_id']]['short_description'] != '')) ? $getEventDescription[$languageData['language_id']]['short_description'] :""; ?></textarea>
                            <label id="short_description-error" class="validation-error-label" for="short_description"></label>
                        </div>
                    </div>


                    <!-- Long description -->
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('long_description') ?><span class="text-danger"> * </span></label>
                        <div class="col-lg-9">
                            <textarea name="long_description[]" id="long_description_<?= $languageData['language_id']; ?>" class="ckeditor" rows="2" cols="2">
                                 <?php
                                 echo (isset($getEventDescription[$languageData['language_id']]['long_description']) &&
                                     !empty($getEventDescription[$languageData['language_id']]['long_description']))
                                     ? $getEventDescription[$languageData['language_id']]['long_description']
                                     : "";
                                 ?>
                            </textarea>
                            <label id="long_description-error" class="validation-error-label" for="long_description"></label>
                        </div>
                    </div>

                    <!-- Location General-->
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('location_general') ?><span class="text-danger"> * </span></label>
                        <div class="col-lg-9">
                            <textarea name="location_general[]" id="location_general_<?= $languageData['language_id']; ?>" class="form-control" rows="2" cols="2"><?php echo (isset($getEventDescription[$languageData['language_id']]['location_general']) && ($getEventDescription[$languageData['language_id']]['location_general'] != '')) ? $getEventDescription[$languageData['language_id']]['location_general'] :""; ?></textarea>
                            <label id="location_general-error" class="validation-error-label" for="location_general"></label>
                        </div>
                    </div>

                    <?php if($languageData['is_default'] == 1) { ?>

                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('start_date') ?><span class="text-danger"> * </span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="start_date"
                                       name="start_date" value="<?= (isset($getEventData['start_date'])) ? $getEventData['start_date'] : date(PHP_DATE_FORMATE); ?>"
                                       placeholder="Select a <?= lang('start_date') ?>" readonly>
                            </div>
                        </div>

                        <!-- Start Time -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('start_time') ?><span class="text-danger"> * </span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control dtTimePicker" id="start_time"
                                       name="start_time" value="<?= (isset($getEventData['start_time'])) ? $getEventData['start_time'] : date(PHP_TIME_FORMATE); ?>"
                                       placeholder="Select a <?= lang('start_time') ?>" readonly>
                            </div>
                        </div>

                        <!-- End Date -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('end_date') ?><span class="text-danger"> * </span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="end_date"
                                       name="end_date" value="<?= (isset($getEventData['end_date'])) ? $getEventData['end_date'] : date(PHP_DATE_FORMATE); ?>"
                                       placeholder="Select a <?= lang('end_date') ?>" readonly>
                            </div>
                        </div>

                        <!-- End Time -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('end_time') ?><span class="text-danger"> * </span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control dtTimePicker" id="end_time"
                                       name="end_time" value="<?= (isset($getEventData['end_time'])) ? $getEventData['end_time'] : date(PHP_TIME_FORMATE); ?>"
                                       placeholder="Select a <?= lang('end_time') ?>" readonly>
                            </div>
                        </div>


                        <!-- filename -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('filename') ?><span class="text-danger"> * </span></label>
                            <div class="col-lg-9">
                                <input type="file" accept="image/*" name="filename[]" id="filename" class="file-styled-primary" multiple>
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
                            <label class="col-lg-3 control-label"></label>
                            <div class="col-lg-9">
                                <div class="map-wrapper" style="height: 250px"></div>
                            </div>
                        </div>
                        <!-- location -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('location') ?><span class="text-danger"> * </span></label>
                            <div class="col-lg-9">
                                <input type="text" name="location_geo" value="<?= (isset($getEventData['location_geo']) && ($getEventData['location_geo'] != '')) ? $getEventData['location_geo'] : ''; ?>" id="location_geo" class="form-control"
                                       placeholder="Enter <?= lang('location') ?>">
                            </div>
                        </div>
                        <!-- latitude -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('lat') ?><span class="text-danger"> * </span></label>
                            <div class="col-lg-9">
                                <input type="text" name="lat" value="<?= (isset($getEventData['lat']) && ($getEventData['lat'] != '')) ? $getEventData['lat'] : ''; ?>" id="lat" class="form-control"
                                       placeholder="Enter <?= lang('lat') ?>" readonly>
                            </div>
                        </div>

                        <!-- longitude -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('lng') ?><span class="text-danger"> * </span></label>
                            <div class="col-lg-9">
                                <input type="text" name="lng" value="<?= (isset($getEventData['lng']) && ($getEventData['lng'] != '')) ? $getEventData['lng'] : ''; ?>" id="lng" class="form-control"
                                       placeholder="Enter <?= lang('lng') ?>" readonly>
                            </div>
                        </div>
                        <!-- is required-->
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('rsvp_required') ?></label>
                            <div class="col-lg-9">
                                <div class="checkbox checkbox-switchery switchery-xs">
                                    <label>
                                        <input type="checkbox" name="is_required" <?php if(isset($getEventData['is_required']) && $getEventData['is_required'] == 1) {  echo "checked"; } else { echo ''; } ?> id="is_required" class="switchery"   >
                                    </label>
                                </div>
                            </div>
                        </div>
						<?php if(!isset($getEventData['event_id']) && empty($getEventData['event_id'])) {?>
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
                <?php } ?>
            </div>
        </div>

        <!-- create reset button-->
        <div class="text-right">
            <button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
                    onclick="window.location.href='<?php echo site_url('Event'); ?>'"><?= lang('cancel_btn') ?> <i class="icon-cross2 position-right"></i> </button>

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

<!--image edit time image load and display-->
<script>


    function ImageLoad() {
        var eventId = $('#event_id').val();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Event/imageLoad');?>",
            dataType: "json",
            async: false,
            data: {eventId: eventId}, //change here
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
    var laddaSubmitBtn = Ladda.create(document.querySelector('.submit'));

    $(document).ready(function () {
        // Full featured editor
//        CKEDITOR.replace( 'long_description', {
//            height: '400px',
//            extraPlugins: 'forms'
//        });

        Select2Init();
        $("#samaj_id").select2({
            ajax: {
                url: "<?= site_url('Samaj/getSamajDD') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    var eventId = $('#event_id').val();
                    return {
                        filter_param: params.term || '', // search term
                        page: params.page || 1,
                        event_id : eventId
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

        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param)
        });
        // Initialize
        var validator = $("#eventDetails").validate({
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
                samaj_id : {
                    required  : true
                },
               'event_name[]': {
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
                "filename[]": {
                    extension: "<?= FILE_UPLOAD_TYPE ?>",
                    filesize: "<?= MAX_IMAGE_SIZE_LIMIT ?>"
               },
                start_date: {
                    required:  true,
                    validDate: true
                },
                end_date: {
                    required: true,
                    validDate: true
                },
                start_time: {
                    required: true,

                },
                end_time: {
                    required: true,
                },
                location_geo: {
                    required: true,
                },
                'location_general[]': {
                    required: true,
                },
                lat: {
                    required: true,
                },
                lng: {
                    required: true,
                },
            },
            messages: {
                samaj_id :{
                    required: "Please select <?= lang('samaj') ?>",

                },
                'event_name[]': {
                    required: "Please Enter <?= lang('event_name') ?>",
                    remote  : "<?= lang('event_name') ?> Already Exist",
                },

                'short_description[]': {
                    required: "Please Enter <?= lang('short_description') ?>",
                    maxlength: "Please Enter 255 character only"
                },

                'long_description[]': {
                    required: "Please Enter <?= lang('long_description') ?>",
                },
                "filename[]":{
                    extension: "Please choose image with extension <?= FILE_UPLOAD_TYPE_MSG ?>",
                    filesize: "File size is more than  expected size (2MB) "

                },
                start_date: {
                    required: "Please Enter <?= lang('start_date') ?>",
                },
                end_date: {
                    required: "Please Enter <?= lang('end_date') ?>",
                },
                start_time: {
                    required: "Please Enter <?= lang('start_time') ?>",
                },
                end_time: {
                    required: "Please Enter <?= lang('end_time') ?>",
                },
                location_geo: {
                    required: "Please Enter <?= lang('location') ?>",
                },

                'location_general[]': {
                    required: "Please Enter <?= lang('location_general') ?>",
                },
                lat: {
                    required: "Please Enter <?= lang('lat') ?>",
                },
                lng: {
                    required: "Please Enter <?= lang('lng') ?>",
                },
            },
            submitHandler: function (e) {
               // $('textarea.ckeditor').each(function () {
//                    var $textarea = $(this);
//                    $textarea.val(CKEDITOR.instances[$textarea.attr('name')].getData());
//                });

                $(e).ajaxSubmit({
                    url: '<?php echo site_url("Event/save");?>',
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
                                window.location.href = '<?php echo site_url('Event');?>';
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
        ImageLoad();
        FileValidate();
        FileKeyGen();
        TimePickerInit();
        $("#start_date").datepicker({
            dateFormat: "<?= DATE_FORMATE ?>",
            todayBtn:  "linked",
            autoclose: true,
            todayHighlight: true,
            onSelect: function(selected) {

                $("#end_date").datepicker("option", "minDate", selected)
                if ($(this).valid()) {
                    $(this).removeClass('invalid').addClass('success');
                }
//                else
//                {
//                    var endTime = endDate.getTime() + $('#start_date').parseValToNumber();
//                    var startTime = startDate.getTime() + $('#end_date').parseValToNumber();
//                    return endTime > startTime;
//                }

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
                //$("#start_date").datepicker("option", "maxDate", selected)
                if ($(this).valid()) {
                    $(this).removeClass('invalid').addClass('success');
                }
                var id = $(this).attr('id');
                $("input[name="+id+"]").val($(this).val());
            }
        });
        $("#location_geo").geocomplete({
                map: ".map-wrapper",
                details: "form",
                types: ["geocode", "establishment"],
                location: <?php if ($eventId ) {
                echo "[" . $latitude . "," . $longitude . "]";
            } else {
                echo "[19.0759837,72.87765590000004]";
            }
            ?>,
                markerOptions: {
                    draggable: true,
                },
            }
        );

        $("#location_geo").bind("geocode:dragged", function (event, latLng) {

            var map = $("#location_geo").geocomplete("map");
            map.panTo(latLng);

            var geocoder = new google.maps.Geocoder();

            geocoder.geocode({'latLng': latLng}, function (results, status) {

                if (status == google.maps.GeocoderStatus.OK) {
                    $('#location_geo').val(results[0]['formatted_address']);
                }


                $('#lat').val(latLng.lat());
                $('#lng').val(latLng.lng());
            });
        });


        $("#location_geo").focusout(function () {
            $('#lat').val('');
            $('#lng').val('');
            $("#location_geo").trigger("geocode");
        });


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
        }, 'Please enter a valid date');


        <?php if((isset($getEventData['samaj_name']) && !empty($getEventData['samaj_name']))){
        $samajName = $getEventData['samaj_name']; ?>
        var option = new Option("<?= $getEventData['samaj_name']; ?>", "<?= $getEventData['samaj_id']; ?>", true, true);
        $('#samaj_id').append(option).trigger('change');
        <?php } ?>
    });

</script>
