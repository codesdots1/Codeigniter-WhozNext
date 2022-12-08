<div class="panel panel-flat border-left-lg border-left-slate">
	<div class="panel-heading ">
		<h5 class="panel-title"><?= lang('booking_heading') ?><a class="heading-elements-toggle"><i
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
			'id' => 'bookingDetails',
			'method' => 'post',
			'class' => 'form-horizontal',
		);
		echo form_open_multipart('', $form_id);
		$bookingId = (isset($getBookingData['booking_id']) && ($getBookingData['booking_id'] != '')) ? $getBookingData['booking_id'] : ''; ?>
		<input type="hidden" name="booking_id" value="<?= $bookingId ?>" id="booking_id">

		<div class="tabbable">
			<div class="tab-content">

			<div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('business_name') ?><span class="text-danger"> * </span></label>
                    <div class="col-lg-9">
                        <select name="business_id" id="business_id" class="form-control" data-placeholder="Select <?= lang('business_name') ?> ">
                            <option value=""></option>
                        </select>
                    </div>
                </div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('profile') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="file" accept="image/*" name="filename" id="filename" class="file-styled-primary">
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
					<label class="col-lg-3 control-label"><?= lang('client_name') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="text" name="client_name"
							   value="<?= (isset($getBookingData['client_name']) && ($getBookingData['client_name'] != '')) ? $getBookingData['client_name'] : ''; ?>"
							   id="client_name" class="form-control" placeholder="Enter <?= lang('client_name') ?>">
					</div>
				</div>
				
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('service_info') ?><span class="text-danger"> * </span></label>
                    <div class="col-lg-9">
                        <select name="service_id" id="service_id" class="form-control" data-placeholder="Select <?= lang('service_info') ?> ">
                            <option value=""></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('booking_date') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="text" class="form-control dtTimePicker" id="booking_date" name="booking_date"
							   value="<?= (isset($getBookingData['booking_date']) && ($getBookingData['booking_date'] != '')) ? $getBookingData['booking_date'] : ''; ?>"
							   placeholder="Select a <?= lang('booking_date') ?>" readonly>
					</div>
				</div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('staff_info') ?><span class="text-danger"> * </span></label>
                    <div class="col-lg-9">
                        <select name="staff_id" id="staff_id" class="form-control" data-placeholder="Select <?= lang('staff_info') ?> ">
                            <option value=""></option>
                        </select>
                    </div>
                </div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('is_active') ?></label>
					<div class="col-lg-9">
						<div class="checkbox checkbox-switchery switchery-xs">
							<label>
								<input type="checkbox"
									   name="status" <?php if (isset($getBookingData['status']) && $getBookingData['status'] == 1) {
									echo 'checked="checked"';
								} else if(isset($getBookingData['status']) && $getBookingData['status'] == 0) {
									echo '';
								} else{
									echo 'checked="checked"';
								}?> id="status" class="switchery">
							</label>
						</div>
					</div>
				</div>

			</div>
		</div>
		<!-- create reset button-->
		<div class="text-right">
			<button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
					onclick="window.location.href='<?php echo site_url('Bookings'); ?>'"><?= lang('cancel_btn') ?> <i
					class="icon-cross2 position-right"></i></button>

			<button type="submit" class="btn btn-xs border-blue text-blue btn-flat btn-ladda btn-ladda-progress submit"
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
		numberInit();
		Select2Init();
		SwitcheryKeyGen();
		FileKeyGen();
		ImageLoad();
        staffDD('','#staff_id');
		serviceStaffDD('','#service_id');
		businessDD('','#business_id');


		// Initialize
		jQuery.validator.addMethod("lettersonly", function (value, element) {
			return this.optional(element) || /^[a-z ]+$/i.test(value);
		}, "Only Letters are allowed");
		jQuery.validator.addMethod("AlfaNumericOnly", function (value, element) {
			return this.optional(element) || /^[a-z0-9 ]+$/i.test(value);
		}, "Only Letters and Numbers are allowed");
		jQuery.validator.addMethod("PlusNumericOnly", function (value, element) {
			return this.optional(element) || /^[0-9\+ ]+$/i.test(value);
		}, "Only Plus sign and Numbers are allowed");
		var validator = $("#bookingDetails").validate({
			ignore: 'input[type=hidden], .select2-search__field, :hidden', // ignore hidden fields
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
					} else {
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
				} else {
					error.insertAfter(element);
				}
			},
			validClass: "validation-valid-label",
			success: function (label) {
				label.addClass("validation-valid-label").text("Success.")
			},
			rules: {
				client_name:{
					required: true,
					lettersonly:true,
				},
				service_id:{
					required: true,
				},
				business_id:{
					required: true,
				},
				booking_date:{
					required: true,
					validDate: true
				},
				staff_id:{
					required: true
				},
			},
			messages: {
				client_name:{
					required: "Please Enter <?= lang('client_name') ?>",
				},
				service_id:{
					required: "Please Select <?= lang('service_info') ?>"
				},
				business_id:{
					required: "Please Select <?= lang('business_name') ?>"
				},
				booking_date:{
					required: "Please Enter <?= lang('booking_date') ?>"
				},
				staff_id:{
					required: "Please Enter <?= lang('staff_info') ?>"
				},
			},
			submitHandler: function (e) {
				$(e).ajaxSubmit({
					url: '<?php echo site_url("Bookings/save");?>',
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
								window.location.href = '<?php echo site_url('Bookings');?>';
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

        $("#booking_date").datepicker({
			dateFormat: 'dd-mm-yy',
            todayBtn:  "linked",
            autoclose: true,
            minDate: '-200y',
            //maxDate: '-18y',
            todayHighlight: true,
            changeMonth: true,
            changeYear: true,
			onSelect: function (value, ui) {
				if ($(this).valid()) {
					$(this).removeClass('invalid').addClass('success');
				}
			}


		});

        <?php if((isset($getBookingData['service_name']) && !empty($getBookingData['service_name']))){ ?>
		var option = new Option("<?= $getBookingData['service_name']; ?>", "<?= $getBookingData['service_id']; ?>", true, true);
		$('#service_id').append(option).trigger('change');
		<?php } ?>

		<?php if((isset($getBookingData['staff_name']) && !empty($getBookingData['staff_name']))){ ?>
		var option = new Option("<?= $getBookingData['staff_name']; ?>", "<?= $getBookingData['staff_id']; ?>", true, true);
		$('#staff_id').append(option).trigger('change');
		<?php } ?>

		<?php if((isset($getBookingData['business_name']) && !empty($getBookingData['business_name']))){ ?>
		var option = new Option("<?= $getBookingData['business_name']; ?>", "<?= $getBookingData['business_id']; ?>", true, true);
		$('#business_id').append(option).trigger('change');
		<?php } ?>

		

	});

    function ImageLoad() {
		var bookingId = $('#booking_id').val();
		$.ajax({
			type: "post",
			url: "<?php echo site_url('Bookings/imageLoad');?>",
			dataType: "json",
			async: false,
			data: {booking_id: bookingId},
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
				type: "POST",
				url: "<?php echo site_url('Bookings/imageDelete');?>",
				dataType: "json",
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


</script>
<?php if (isset($select2)) { ?>
	<?= $select2 ?>
<?php } ?>