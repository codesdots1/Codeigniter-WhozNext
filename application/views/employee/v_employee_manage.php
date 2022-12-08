<div class="panel panel-flat border-left-lg border-left-slate">
	<div class="panel-heading ">
		<h5 class="panel-title"><?= lang('business_heading') ?><a class="heading-elements-toggle"><i
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
				'id' => 'employeeDetails',
				'method' => 'post',
				'class' => 'form-horizontal',
		);
		echo form_open_multipart('', $form_id);
		$employeeId = (isset($getEmployeeData['business_id']) && ($getEmployeeData['business_id'] != '')) ? $getEmployeeData['business_id'] : ''; ?>
		<input type="hidden" name="business_id" value="<?= $employeeId ?>" id="business_id">

		<div class="tabbable">
			<div class="tab-content">

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('business_name') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="text" name="business_name"
							   value="<?= (isset($getEmployeeData['business_name']) && ($getEmployeeData['business_name'] != '')) ? $getEmployeeData['business_name'] : ''; ?>"
							   id="business_name" class="form-control" placeholder="Enter <?= lang('business_name') ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('description') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<textarea name="description" id="description" placeholder="Enter Only 255 Character"
								  class="form-control" rows="5"
								  cols="5"><?php echo (isset($getEmployeeData['description']) && ($getEmployeeData['description'] != '')) ? $getEmployeeData['description'] : ''; ?></textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('business_address') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="text" name="address"
							   value="<?= (isset($getEmployeeData['address']) && ($getEmployeeData['address'] != '')) ? $getEmployeeData['address'] : ''; ?>"
							   id="address" class="form-control" placeholder="Enter <?= lang('business_address') ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('username') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="email" name="username"
							   value="<?= (isset($getEmployeeData['username']) && ($getEmployeeData['username'] != '')) ? $getEmployeeData['username'] : ''; ?>"
							   id="username" class="form-control" placeholder="Enter <?= lang('username') ?>">
					</div>
				</div>

				<?php if($employeeId == '') { ?>
				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('password') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="password" name="password"
							   value="<?= (isset($getEmployeeData['password']) && ($getEmployeeData['password'] != '')) ? $getEmployeeData['password'] : ''; ?>"
							   id="password" class="form-control" placeholder="Enter <?= lang('password') ?>">
					</div>
				</div>
				<?php } ?>

				<div class="form-group">
					<h3> <?= lang('business_contact') ?> </h3>
					<label class="col-lg-3 control-label"><?= lang('telephone') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="tel" name="telephone" maxlength="15"
							   value="<?= (isset($getEmployeeData['telephone']) && ($getEmployeeData['telephone'] != '')) ? $getEmployeeData['telephone'] : ''; ?>"
							   id="telephone" class="form-control" placeholder="Enter <?= lang('telephone') ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('mobile_no') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="tel" name="mobile_no" maxlength="10"
							   value="<?= (isset($getEmployeeData['mobile_no']) && ($getEmployeeData['mobile_no'] != '')) ? $getEmployeeData['mobile_no'] : ''; ?>"
							   id="mobile_no" class="form-control" placeholder="Enter <?= lang('mobile_no') ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('email') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="email" name="email"
							   value="<?= (isset($getEmployeeData['email']) && ($getEmployeeData['email'] != '')) ? $getEmployeeData['email'] : ''; ?>"
							   id="email" class="form-control" placeholder="Enter <?= lang('email') ?>">
					</div>
				</div>


				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('website') ?></label>
					<div class="col-lg-9">
						<input type="text" name="website"
							   value="<?= (isset($getEmployeeData['website']) && ($getEmployeeData['website'] != '')) ? $getEmployeeData['website'] : ''; ?>"
							   id="website" class="form-control" placeholder="Enter <?= lang('website') ?>">
					</div>
				</div>

				<div class="form-group">
				<h3><?= lang('social_media') ?></h3>
					<label class="col-lg-3 control-label"><?= lang('instagram') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="text" name="instagram_link"
							   value="<?= (isset($getEmployeeData['instagram_link']) && ($getEmployeeData['instagram_link'] != '')) ? $getEmployeeData['instagram_link'] : ''; ?>"
							   id="instagram_link" class="form-control" placeholder="Enter <?= lang('instagram') ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('facebook') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="text" name="facebook_link"
							   value="<?= (isset($getEmployeeData['facebook_link']) && ($getEmployeeData['facebook_link'] != '')) ? $getEmployeeData['facebook_link'] : ''; ?>"
							   id="facebook_link" class="form-control" placeholder="Enter <?= lang('facebook') ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('twitter') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="text" name="twitter_link"
							   value="<?= (isset($getEmployeeData['twitter_link']) && ($getEmployeeData['twitter_link'] != '')) ? $getEmployeeData['twitter_link'] : ''; ?>"
							   id="twitter_link" class="form-control" placeholder="Enter <?= lang('twitter') ?>">
					</div>
				</div>

				<div class="table-responsive m-t-15">
					<table class="table table-striped custom-table">
						<thead>
						<tr>
							<th> Normal Business Hours <span class="text-danger"> * </span></th>
							<th class="text-center">Monday</th>
							<th class="text-center">Tuesday</th>
							<th class="text-center">Wednesday</th>
							<th class="text-center">Thursday</th>
							<th class="text-center">Friday</th>
							<th class="text-center">Saturday</th>
							<th class="text-center">Sunday</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>Normal Business Hours</td>

							<?php
							$workName = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
							if(isset($getEmployeeData['business_id']) && ($getEmployeeData['business_id'] != '')){

								$daysName = explode(',',$getEmployeeData['days_name']);

								foreach ($workName as $key) {
									?>
									<td class="text-center">
										<input type="checkbox" name="days_name[]"  class="dt-checkbox styled"  value="<?php echo $key;?>" <?php if(in_array($key,$daysName)) {?> checked="checked" <?php }?>>
									</td>
									<?php
								}
							}else{

								foreach ($workName as $key) {
									?>
									<td class="text-center">
										<input type="checkbox" name="days_name[]" class="dt-checkbox styled" value="<?php echo $key;?>">
									</td>
									<?php
								}
							}
							?>

						</tr>
						</tbody>
					</table>
				</div>

				<div class="form-group">
					<h3><?= lang('booking') ?></h3>
				</div>
				
			<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('advance_booking') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-4">
						<input type="text" name="advance_booking"
							   value="<?= (isset($getEmployeeData['advance_booking']) && ($getEmployeeData['advance_booking'] != '')) ? $getEmployeeData['advance_booking'] : ''; ?>"
							   id="advance_booking" class="form-control" placeholder="Enter <?= lang('advance_booking') ?>">
					</div>
					<div class="col-lg-4">
						<select name="bookingMonthId" id="bookingMonthId" class="form-control dropdown" data-placeholder="Select <?= lang('booking_month') ?> ">
							<option value=""></option>
						</select>
					</div>	
				</div>
			

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('cancellation_policy') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
					<select name="cancellationPolicyId" id="cancellationPolicyId" class="form-control"placeholder="Select <?= lang('cancellation_policy') ?> ">
						<option value=""></option>
					</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('booking_intervals') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="text" class="form-control dtTimePicker" id="booking_intervals"
							   name="booking_intervals" value="<?= (isset($getEmployeeData['booking_intervals'])) ? date('H:i',strtotime($getEmployeeData['booking_intervals'])) : '' ?>"
							   placeholder="Select a <?= lang('booking_intervals') ?>" readonly>
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('booking_confirmation') ?></label>
					<div class="col-lg-9">
						<textarea name="booking_confirmation" id="booking_confirmation" placeholder="Enter Only 255 Character"
								  class="form-control" rows="5"
								  cols="5"><?php echo (isset($getEmployeeData['booking_confirmation']) && ($getEmployeeData['booking_confirmation'] != '')) ? $getEmployeeData['booking_confirmation'] : ''; ?></textarea>
					</div>
				</div>

			</div>
		</div>
		<!-- create reset button-->
		<div class="text-right">
			<button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
					onclick="window.location.href='<?php echo site_url('Employee'); ?>'"><?= lang('cancel_btn') ?> <i
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
		SwitcheryKeyGen();
		numberInit();
		SwitcheryKeyGen();
		TimePickerInit();
		getBookingMonthsDD('','#bookingMonthId');
		getCancellationPolicyDD('','#cancellationPolicyId');


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
		var validator = $("#employeeDetails").validate({
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
				business_name:{
					required: true,
					lettersonly:true,
				},
				description:{
					required: true,
				},
				address:{
					required: true,
				},
				username:{
					required: true,
				},
				password:{
					required: true,
				},
				telephone:{
					required: true,
					maxlength: 15,
					PlusNumericOnly: true
				},
				mobile_no:{
					required: true,
					maxlength: 10,
					PlusNumericOnly: true
				},
				email: {
					required: true
				},
				days_name: {
					required: true
				},
				booking_confirmation: {
                    required: true,
                },
                booking_intervals:{
					required: true
				}
			},
			messages: {
				business_name:{
					required: "Please Enter <?= lang('business_name') ?>",
				},
				description:{
					required: "Please Enter <?= lang('description') ?>"
				},
				address:{
					required: "Please Enter <?= lang('business_address') ?>"
				},
				email:{
					required: "Please Enter <?= lang('email') ?>"
				},
				username:{
					required: "Please Enter <?= lang('username') ?>"
				},
				password:{
					required: "Please Enter <?= lang('password') ?>"
				},
				telephone:{
					required: "Please Enter <?= lang('telephone') ?>",
					maxlength: "Please Enter Atleast 15 Digits",
				},
				mobile_no:{
					required: "Please Enter <?= lang('mobile_no') ?>",
					maxlength: "Please Enter Atleast 10 Digits",
				},
				email:{
					required: "Please Enter <?= lang('email') ?>"
				},
				booking_intervals:{
					required: "Please Select <?= lang('booking_intervals') ?>"
				},
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
						if (resObj.success) {
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

		<?php if((isset($getEmployeeData['bookingMonthId']) && !empty($getEmployeeData['bookingMonthId']))){ ?>
		var option = new Option("<?= $getEmployeeData['bookingMonthId']; ?>", "<?= $getEmployeeData['bookingMonthId']; ?>", true, true);
		$('#bookingMonthId').append(option).trigger('change');
		<?php } ?>

		<?php if((isset($getEmployeeData['cancellationPolicyId']) && !empty($getEmployeeData['cancellationPolicyId']))){ ?>
		var option = new Option("<?= $getEmployeeData['cancellationPolicyId']; ?>", "<?= $getEmployeeData['cancellationPolicyId']; ?>", true, true);
		$('#cancellationPolicyId').append(option).trigger('change');
		<?php } ?>

		<?php if((isset($getEmployeeData['bookingIntervalsId']) && !empty($getEmployeeData['bookingIntervalsId']))){ ?>
		var option = new Option("<?= $getEmployeeData['bookingIntervalsId']; ?>", "<?= $getEmployeeData['bookingIntervalsId']; ?>", true, true);
		$('#bookingIntervalsId').append(option).trigger('change');
		<?php } ?>

	});


</script>
<?php if (isset($select2)) { ?>
	<?= $select2 ?>
<?php } ?>