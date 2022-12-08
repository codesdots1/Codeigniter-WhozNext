<div class="panel panel-flat border-left-lg border-left-slate">
	<div class="panel-heading ">
		<h5 class="panel-title"><?= lang('student_heading') ?><a class="heading-elements-toggle"><i class="icon-more"></i></a>
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
		$employeeAttandanceId = (isset($getEmployeeData['student_attendance_id']) && ($getEmployeeData['student_attendance_id'] != '')) ? $getEmployeeData['student_attendance_id'] : ''; ?>
		<input type="hidden" name="student_attendance_id" value="<?= $employeeAttandanceId ?>" id="student_attendance_id">

		<div class="tabbable">
			<div class="tab-content">


				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('name') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
                    <select name="student_id" id="student_id" class="form-control" data-placeholder="Select <?= lang('name') ?> ">
							<option value=""></option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('login') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
                    <input type="text" class="form-control dtTimePicker" id="login_time"
							   name="login_time" value="<?= (isset($getEmployeeData['login_time'])) ? $getEmployeeData['login_time'] : date(PHP_TIME_FORMATE); ?>"
							   placeholder="Select a <?= lang('login_time') ?>" readonly>
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('logout') ?><span class="text-danger"> * </span></label>
					<?php
							if(isset($getEmployeeData['logout_time']) && $getEmployeeData['logout_time'] == "00:00:00")
							{
								$getEmployeeData['logout_time'] = $getEmployeeData['logout_time'];
							}
						?>
					<div class="col-lg-9">
						<input type="text" class="form-control dtTimePicker" id="logout_time"
							   name="logout_time" value="<?= (isset($getEmployeeData['logout_time'])) ? $getEmployeeData['logout_time'] : date(PHP_TIME_FORMATE); ?>"
							   placeholder="Select a <?= lang('logout') ?>" readonly>
					</div>
				</div>

				
				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('date') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="text" class="form-control dtTimePicker" id="attendance_date" name="attendance_date"
							   value="<?= (isset($getEmployeeData['attendance_date']) && ($getEmployeeData['attendance_date'] != '')) ? $getEmployeeData['attendance_date'] : ''; ?>"
							   placeholder="Select a <?= lang('attendance_date') ?>" readonly>
					</div>
				</div>

			</div>
		</div>
		<!-- create reset button-->
		<div class="text-right">
			<button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
					onclick="window.location.href='<?php echo site_url('Employee'); ?>'"><?= lang('cancel_btn') ?> <i class="icon-cross2 position-right"></i> </button>

			<button type="submit" class="btn btn-xs border-blue text-blue btn-flat btn-ladda btn-ladda-progress submit"
					data-spinner-color="#03A9F4" data-style="fade"><span class="ladda-label"><?= lang('submit_btn') ?></span>
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
        TimePickerInit();
		studentDD('','#student_id');



		// Initialize
		jQuery.validator.addMethod("lettersonly", function(value, element) {
			return this.optional(element) || /^[a-z ]+$/i.test(value);
		}, "Only Letters are allowed");
        var currentDate = $('#attendance_date').val();
		$('#attendance_active_date').val(currentDate);

		jQuery.validator.addMethod('greater', function (value, element, param) {
			//return this.optional(element) || parseInt(value) > parseInt($(param).val());
			return this.optional(element) || (parseInt(value.split(':')[0], 10) > parseInt($(param).val().split(':')[0], 10) ||
				parseInt(value.split(':')[1], 10) > parseInt($(param).val().split(':')[1], 10) ||
				parseInt(value.split(':')[2], 10) > parseInt($(param).val().split(':')[2], 10));
		}, 'Invalid value');
		jQuery.validator.addMethod("AlfaNumericOnly", function(value, element) {
			return this.optional(element) || /^[a-z0-9 ]+$/i.test(value);
		}, "Only Letters and Numbers are allowed");
		jQuery.validator.addMethod("PlusNumericOnly", function(value, element) {
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
				student_id: {
					required: true,
				},
				login_time: {
					required: true,
				},
				logout_time: {
					required: true,
					greater: '#login_time'
				},
				attendance_date: {
					required: true,
				},
			},
			messages: {
				student_id: {
					required: "Please Enter <?= lang('name') ?>",
				},
				login_time: {
					required: "Please Select <?= lang('login') ?>",
				},
				logout_time: {
					required: "Please Select <?= lang('logou') ?>",
					greater: "Please select <?= lang('logout') ?> greated than <?= lang('login') ?>",
				},
				attendance_date: {
					required: "Please Select <?= lang('date') ?>",
				},
			},
			submitHandler: function (e) {
				$(e).ajaxSubmit({
					url: '<?php echo site_url("EmployeeAttendance/save");?>',
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
								window.location.href = '<?php echo site_url('EmployeeAttendance');?>';
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

		$("#attendance_date").datepicker({
			dateFormat: 'dd-mm-yy',
			todayBtn:  "linked",
			autoclose: true,
			todayHighlight: true,
			changeMonth: true,
			changeYear: true,
			onSelect: function (value, ui) {
				if ($(this).valid()) {
					$(this).removeClass('invalid').addClass('success');
				}
				var attendanceDate = $(this).val();
				$('#attendance_active_date').val(attendanceDate);
			}
		});

        $("#logout_time").change(function(){
			calculateTime();
		});
		function calculateTime(){
			var hours = parseInt($("#logout_time").val().split(':')[0], 10) - parseInt($("#login_time").val().split(':')[0], 10);

			var mins2 = parseInt($("#logout_time").val().split(':')[1], 10),
				mins1 =  parseInt($("#login_time").val().split(':')[1], 10)
			if(mins2 >= mins1) {
				minutes = mins2 - mins1;
			}
			else {
				minutes = (mins2 + 60) - mins1;
				hours--;
			}


			var sec2 = parseInt($("#logout_time").val().split(':')[2], 10),
				sec1 =  parseInt($("#login_time").val().split(':')[2], 10)
			if(sec2 >= sec1) {
				seconds = sec2 - sec1;
			}
			else {
				seconds = (sec2 + 60) - sec1;
				minutes--;
			}

			hours = ('0' + hours).slice(-2);
			minutes = ('0' + minutes).slice(-2);
			seconds = ('0' + seconds).slice(-2);
		}
	

		<?php if((isset($getEmployeeData['emp_name']) && !empty($getEmployeeData['emp_name']))){ ?>
		var option = new Option("<?= $getEmployeeData['emp_name']; ?>", "<?= $getEmployeeData['student_id']; ?>", true, true);
		$('#student_id').append(option).trigger('change');
		<?php } ?>

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
	}, 'Please enter a valid birth date');

</script>

</style>
<?php if (isset($select2)) { ?>
	<?= $select2 ?>
<?php } ?>
