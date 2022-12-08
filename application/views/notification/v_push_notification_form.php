<?php

if (isset($get_data) && $get_data != '') {
    $notification_id = (isset($get_data['notification_id']) && $get_data['notification_id'] != '') ? $get_data['notification_id'] : '';
    $notification_title = (isset($get_data['notification_title']) && $get_data['notification_title'] != '') ? $get_data['notification_title'] : '';
    $description = (isset($get_data['description']) && $get_data['description'] != '') ? $get_data['description'] : '';
    $notification_logo = (isset($get_data['push_notification_logo']) && $get_data['push_notification_logo'] != '') ? $get_data['push_notification_logo'] : '';
    $send_to = (isset($get_data['send_to']) && $get_data['send_to'] != '') ? $get_data['send_to'] : '';
    $category_id = (isset($get_data['category_id']) && $get_data['category_id'] != '') ? $get_data['category_id'] : '';
    $is_active = (isset($get_data['is_active']) && $get_data['is_active'] != '') ? $get_data['is_active'] : 0;
    $send_type = (isset($get_data['send_type']) && $get_data['send_type'] != '') ? $get_data['send_type'] : '';
    $notification_date = (isset($get_data['notification_date']) && $get_data['notification_date'] != '') ? YMDToDMY($get_data['notification_date'],false) : '';
    $notification_time = (isset($get_data['notification_time']) && $get_data['notification_time'] != '') ? $get_data['notification_time'] : '';
    $noti_time=null;
    if(isset($get_data['notification_time']) && $get_data['notification_time'] != ''){
        $noti_time=explode(":",$notification_time);
        $notification_time=$noti_time[0].":".$noti_time[1];
    }

}

if (isset($sendToEnumValues) && count($sendToEnumValues) > 0) {
    $sendToOption = '';
    foreach ($sendToEnumValues as $key => $sendToEnumValue) {
        $selected = '';
        if ($sendToEnumValue == $send_to) {
            $selected = "selected";
        }
        $sendToOption .= '<option value=' . $sendToEnumValue . ' data-default = 1 ' . $selected . '>' . $sendToEnumValue . '</option >';
    }
}
?>

<div class="row">
    <div class="col-md-12">
        <form id="push_notification_form" name="push_notification_form" method="post" enctype="multipart/form-data"
              autocomplete="off" class="form-horizontal">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Add Push Notification
                    </h3>
                </div>

                <div class="panel-body">
                    <input type="hidden" name="notification_id" id="notification_id" value="<?= $notification_id ?>">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                           id="<?= $this->security->get_csrf_token_name() ?>"
                           value="<?= $this->security->get_csrf_hash() ?>">

                    <!-- samaj -->
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('samaj') ?><span class="text-danger"> * </span></label>
                        <div class="col-lg-9">
                            <select data-placeholder="Select <?= lang('samaj') ?>" name="samaj_id"
                                    id="samaj_id" >
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Notification Title</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Enter Notification Title"
                                   name="notification_title" id="notification_title"
                                   value="<?= $notification_title ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Send To</label>
                        <div class="col-lg-9">
                            <select class="form-control" id="send_to" name="send_to">
                                <option value=""></option>
                                <?php echo $sendToOption; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Image</label>
                        <div class="col-lg-9">
                            <?php if (isset($notification_logo)) {
                               // $push_notification_logo_img = base_url();
                                $push_notification_logo_img = base_url().$this->config->item('notification_image');
                                if ($notification_logo != '' || $notification_logo != null ) {
                                    $push_notification_logo_img .= $notification_logo;
                                    echo '<img width="100" height="100" src="'.$push_notification_logo_img.'">';
                                }
                                ?>

                            <?php } ?>

                            <input type="file" class="file-styled-primary" name="push_notification_logo"
                                   id="push_notification_logo" class="push_notification_logo">
                                <span class='help-block'><?= IMAGE_UPLOAD_MESSAGE ?></span>
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Description</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" rows="3" name="description"
                                      id="description"><?= $description ?></textarea>
                            <label id="description-error" class="validation-error-label" for="description"></label>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-3 control-label">Send Notification</label>
                        <div class="col-lg-9">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="send_type" value="Send_Now" class="styled" <?php if($send_type!='Schedule') { echo 'checked="checked"'; }?> >
                                    Send Now
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input type="radio" name="send_type" value="Schedule" class="styled" <?php if($send_type=='Schedule') { echo 'checked="checked"'; }?>>
                                    Schedule
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="dt_notification">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Notification Date</label>
                            <div class="col-lg-9">
                                <input type="text" name="notification_date" id="notification_date"
                                       class="form-control pickadate-accessibility" placeholder="Notification Date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Notification Time</label>
                            <div class="col-lg-9">
                                <input type="text" id="notification_time" name="notification_time"
                                       class="form-control pickatime-intervals" placeholder="Notification Time">
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="button" class="btn btn-xs border-slate text-slate btn-flat" data-dismiss="modal"
                                onclick="window.location.href='<?php echo site_url('PushNotification'); ?>'">Cancel
                        </button>
                        <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#scheduleModal">
                            Schedule
                        </button>-->
                        <button type="submit" class="btn btn-xs border-blue text-blue btn-flat btn-ladda btn-ladda-progress">Send</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

    <script>
        $(document).ready(function () {
            FileKeyGen();




        <?php if($send_type != 'Schedule') { ?>
            $('#dt_notification').hide();
            <?php } ?>

            $("input[type='radio']").click(function(){
                var radioValue = $(this).val();
                if(radioValue == 'Schedule'){
                    $('#dt_notification').show();
                }else{
                    $('#dt_notification').hide();
                }
            });

            $('#notification_time').pickatime({
                format: 'HH:i',
                interval: 15,

            });

            var picker = $('#notification_time').pickatime().pickatime('picker');
            var dt_curr_date = new Date();
            var dt_curr_hour = dt_curr_date.getHours();
            var dt_curr_min = dt_curr_date.getMinutes();
            dt_curr_min = (Math.floor(dt_curr_min / 15) * 15) % 60;
            picker.set('disable', [{from: [0, 0], to: [dt_curr_hour, dt_curr_min]}]);

            $('.pickadate-accessibility').pickadate({
                labelMonthNext: 'Go to the next month',
                labelMonthPrev: 'Go to the previous month',
                labelMonthSelect: 'Pick a month from the dropdown',
                labelYearSelect: 'Pick a year from the dropdown',
                selectMonths: true,
                selectYears: true,
                format: 'dd-mm-yyyy',
                min: dt_curr_date,
                onSet: function (context) {
                    var curr_date = new Date();
                    var curr_hour = curr_date.getHours();
                    var curr_min = curr_date.getMinutes();
                    curr_min = (Math.floor(curr_min / 15) * 15) % 60;
                    var selectedDate = new Date(context.select);
                    if (curr_date.getTime() > selectedDate.getTime()) {
                        picker.set('disable', [{from: [0, 0], to: [curr_hour, curr_min]}]);
                    }
                    else {
                        picker.set('enable', true)
                    }

                }
            });

            <?php if($send_type == 'Schedule') { ?>
                var picker_date = $('#notification_date').pickadate('picker');
                picker_date.set('select',"<?php echo $notification_date; ?>");
                picker.set('select', (<?= $noti_time[0] ?> * 60 + <?= $noti_time[1] ?>));
                if(new Date().getTime() > new Date(picker_date.get('select','yyyy/mm/dd')).getTime()){
                picker.set('disable', [{from: [0, 0], to: [dt_curr_hour, dt_curr_min]}]);
                }
            <?php } ?>



            //$('#description').ckeditor();
            $('#category_id').select2({
                placeholder: "Select Category",
            });
            $('#send_to').select2({
                placeholder: "Select Send To",
            });
        });
        function FileKeyGen() {
            $(".file-styled-primary").uniform({
                fileButtonClass: 'action btn bg-blue'
            });
        }

    </script>

    <script>

        $(document).ready(function () {

            Select2Init();
            samajDD('','#samaj_id');

            $.validator.addMethod('filesize', function (value, element, param) {
                return this.optional(element) || (element.files[0].size <= param)
            });
            var validator = $("#push_notification_form").validate({
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
                ignore: ":hidden",
                rules: {
                    notification_title: {
                        required: true
                    },
                   push_notification_logo: {
                        extension:"<?php echo FILE_UPLOAD_TYPE ?>",
                        filesize:2048000
//
                    },
                    category_id: {required: true},
                    send_to: {
                        required: true
                    },
                    description: {
                        required: true
                    },
                    notification_date: {
                        required: "#notification_date:visible"
                    },
                    notification_time: {
                        required: "#notification_time:visible"
                    }
                },
                messages: {
                    notification_title: {
                        required: "Please enter Notification Title"
                    },
                    push_notification_logo: {
                        extension:"Please Enter File in extension as follows <?php echo FILE_UPLOAD_TYPE ?>",
                        filesize :"Image size is more than expected size"
                    },
                    category_id: {required: 'Please Select Category'},
                    send_to: {
                        required: "Please select on which you want to send "
                    },
                    description: {
                        required: "Please Enter Description."
                    },
                    notification_date: {
                        required: "Please Enter Date for scheduling Notification"
                    },
                    notification_time: {
                        required: "Please Enter Time for scheduling Notification"
                    }
                },
                submitHandler: function (e) {
                    $(e).ajaxSubmit({
                        url: '<?php echo site_url() . "/PushNotification/save";?>',
                        type: 'post',
                        beforeSubmit: function (formData, jqForm, options) {
                            //$(e).find('button').hide();
                            $('#loader').show();
                        },
                        complete: function () {
                            $('#loader').hide();
                            //(e).find('button').show();
                        },
                        dataType: 'json',
                        clearForm: false,
                        success: function (resObj, statusText) {
                            if (resObj.success) {
                                $('#pushNotificationModal').modal('hide');
                                swal({title: "Success", text: resObj.msg, type: "success",confirmButtonColor: "<?= BTN_SUCCESS; ?>"}, function () {
                                    window.location = '<?php echo site_url() . "PushNotification/";?>';
                                });
                            } else {
                                swal({title: "Error", text: resObj.msg, type: "error",confirmButtonColor: "red"});
                            }
                        }
                    });
                }
            });

            <?php if((isset($get_data['samaj_name']) && !empty($get_data['samaj_name']))){
            $samajName = $get_data['samaj_name']; ?>
            var option = new Option("<?= $get_data['samaj_name']; ?>", "<?= $get_data['samaj_id']; ?>", true, true);
            $('#samaj_id').append(option).trigger('change');
            <?php } ?>
        });

    </script>
<?php if(isset($select2)){ ?>
    <?= $select2 ?>
<?php } ?>