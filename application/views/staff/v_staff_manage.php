<div class="panel panel-flat border-left-lg border-left-slate">
	<div class="panel-heading ">
		<h5 class="panel-title"><?= lang('staff_heading') ?><a class="heading-elements-toggle"><i
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
			'id' => 'staffDetails',
			'method' => 'post',
			'class' => 'form-horizontal',
		);
		echo form_open_multipart('', $form_id);
		$staffId = (isset($getStaffData['staff_id']) && ($getStaffData['staff_id'] != '')) ? $getStaffData['staff_id'] : ''; ?>
		<input type="hidden" name="staff_id" value="<?= $staffId ?>" id="staff_id">

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
					<label class="col-lg-3 control-label"><?= lang('first_name') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="text" name="first_name"
							   value="<?= (isset($getStaffData['first_name']) && ($getStaffData['first_name'] != '')) ? $getStaffData['first_name'] : ''; ?>"
							   id="first_name" class="form-control" placeholder="Enter <?= lang('first_name') ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('last_name') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="text" name="last_name"
							   value="<?= (isset($getStaffData['last_name']) && ($getStaffData['last_name'] != '')) ? $getStaffData['last_name'] : ''; ?>"
							   id="last_name" class="form-control" placeholder="Enter <?= lang('last_name') ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('position') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="text" name="position"
							   value="<?= (isset($getStaffData['position']) && ($getStaffData['position'] != '')) ? $getStaffData['position'] : ''; ?>"
							   id="position" class="form-control" placeholder="Enter <?= lang('position') ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('contact_no') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="tel" name="contact_no" maxlength="10"
							   value="<?= (isset($getStaffData['contact_no']) && ($getStaffData['contact_no'] != '')) ? $getStaffData['contact_no'] : ''; ?>"
							   id="contact_no" class="form-control" placeholder="Enter <?= lang('contact_no') ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('biography') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<textarea name="biography" id="biography" placeholder="Enter Only 255 Character"
								  class="form-control" rows="5"
								  cols="5"><?php echo (isset($getStaffData['biography']) && ($getStaffData['biography'] != '')) ? $getStaffData['biography'] : ''; ?></textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('gallery') ?></label>
					<div class="col-lg-9">
						<input type="file" accept="image/*" name="galleryname[]" id="galleryname" class="file-styled-primary" multiple>
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"></label>
					<div class="col-lg-9">
						<div class="form-group" id="galleryListing">

						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('booking') ?></label>
					<div class="col-lg-9">
						<div class="checkbox checkbox-switchery switchery-xs">
							<label>
								<input type="checkbox"
									   name="status" <?php if (isset($getStaffData['status']) && $getStaffData['status'] == 1) {
									echo 'checked="checked"';
								} else if(isset($getStaffData['status']) && $getStaffData['status'] == 0) {
									echo '';
								} else{
									echo 'checked="checked"';
								}?> id="status" class="switchery">
							</label>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('is_active') ?></label>
					<div class="col-lg-9">
						<div class="checkbox checkbox-switchery switchery-xs">
							<label>
								<input type="checkbox"
									   name="is_active" <?php if (isset($getStaffData['is_active']) && $getStaffData['is_active'] == 1) {
									echo 'checked="checked"';
								} else if(isset($getStaffData['is_active']) && $getStaffData['is_active'] == 0) {
									echo '';
								} else{
									echo 'checked="checked"';
								}?> id="is_active" class="switchery">
							</label>
						</div>
					</div>
				</div>

			</div>
		</div>
		<!-- create reset button-->
		<div class="text-right">
			<button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
					onclick="window.location.href='<?php echo site_url('Staff'); ?>'"><?= lang('cancel_btn') ?> <i
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
		GalleryLoad();
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
		var validator = $("#staffDetails").validate({
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
				first_name:{
					required: true,
					lettersonly:true,
				},
				last_name:{
					required: true,
					lettersonly:true,
				},
				position:{
					required: true,
				},
				biography:{
					required: true
				},
				contact_no:{
					required: true,
					maxlength: 10,
					PlusNumericOnly: true
				},
				business_id:{
					required: true,
				},
				// filename: {
				// 	required: true
				// }
			},
			messages: {
				first_name:{
					required: "Please Enter <?= lang('first_name') ?>",
				},
				last_name:{
					required: "Please Enter <?= lang('last_name') ?>"
				},
				position:{
					required: "Please Enter <?= lang('position') ?>"
				},
				biography:{
					required: "Please Enter <?= lang('biography') ?>"
				},
				business_id:{
					required: "Please Select <?= lang('business_name') ?>"
				},
				contact_no:{
					required: "Please Enter <?= lang('contact_no') ?>",
					maxlength: "Please Enter Atleast 10 Digits",
				},
				// filename:{
				// 	required: "Please Select <?= lang('profile') ?>"
				// }
			},
			submitHandler: function (e) {
				$(e).ajaxSubmit({
					url: '<?php echo site_url("Staff/save");?>',
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
								window.location.href = '<?php echo site_url('Staff');?>';
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

		<?php if((isset($getStaffData['business_name']) && !empty($getStaffData['business_name']))){ ?>
		var option = new Option("<?= $getStaffData['business_name']; ?>", "<?= $getStaffData['business_id']; ?>", true, true);
		$('#business_id').append(option).trigger('change');
		<?php } ?>
	});

	function ImageLoad() {
			var staffId = $('#staff_id').val();
			$.ajax({
				type: "post",
				url: "<?php echo site_url('Staff/imageLoad');?>",
				dataType: "json",
				async: false,
				data: {staff_id: staffId},
				beforeSend: function (formData, jqForm, options) {
               	// var dialog = bootbox.dialog({
                   // message: 'Please have patience, images are loading',
               	// });
				},
				complete: function () {
				},
				success: function (resObj) {
					$('#imageListing').html(resObj);
				}
			});
		}

		function GalleryLoad() {
			var staffId = $('#staff_id').val();
			$.ajax({
				type: "post",
				url: "<?php echo site_url('Staff/galleryLoad');?>",
				dataType: "json",
				async: false,
				data: {staff_id: staffId},
				beforeSend: function (formData, jqForm, options) {
               	// var dialog = bootbox.dialog({
                   // message: 'Please have patience, images are loading',
               	// });
				},
				complete: function () {
				},
				success: function (resObj) {
					$('#galleryListing').html(resObj);
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
					url: "<?php echo site_url('Staff/imageDelete');?>",
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

		function deleteGallery(imageId, imageUrl) {
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
					url: "<?php echo site_url('Staff/galleryDelete');?>",
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
								GalleryLoad();
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
<?php if (isset($select2)) { ?>
	<?= $select2 ?>
<?php } ?>