<div class="panel panel-flat border-left-lg border-left-slate">
	<div class="panel-heading ">
		<h5 class="panel-title"><?= lang('gallery_heading') ?><a class="heading-elements-toggle"><i
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
				'id' => 'galleryDetails',
				'method' => 'post',
				'class' => 'form-horizontal',
		);
		echo form_open_multipart('', $form_id);
		$galleryId = (isset($getGalleryData['gallery_id']) && ($getGalleryData['gallery_id'] != '')) ? $getGalleryData['gallery_id'] : ''; ?>
		<input type="hidden" name="gallery_id" value="<?= $galleryId ?>" id="business_id">

		<div class="tabbable">
			<div class="tab-content">

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('gallery_name') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="text" name="gallery_name"
							   value="<?= (isset($getGalleryData['gallery_name']) && ($getGalleryData['gallery_name'] != '')) ? $getGalleryData['gallery_name'] : ''; ?>"
							   id="gallery_name" class="form-control" placeholder="Enter <?= lang('gallery_name') ?>">
					</div>
				</div>


				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('description') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<textarea name="description" id="description" placeholder="Enter Only 255 Character"
								  class="form-control" rows="5"
								  cols="5"><?php echo (isset($getGalleryData['description']) && ($getGalleryData['description'] != '')) ? $getGalleryData['description'] : ''; ?></textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('filename') ?></label>
					<div class="col-lg-9">
						<input type="file" accept="image/*" name="filename" id="filename" class="file-styled-primary" multiple>
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"></label>
					<div class="col-lg-9">
						<div class="form-group" id="imageListing">

						</div>
					</div>
				</div>

			</div>
		</div>
		<!-- create reset button-->
		<div class="text-right">
			<button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
					onclick="window.location.href='<?php echo site_url('Gallery'); ?>'"><?= lang('cancel_btn') ?> <i
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
		var validator = $("#galleryDetails").validate({
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
				gallery_name:{
					required: true,
					lettersonly:true,
				},
				description:{
					required: true
				},
				filename: {
					required: true
				}
			},
			messages: {
				gallery_name:{
					required: "Please Enter <?= lang('gallery_name') ?>",
				},
				description:{
					required: "Please Enter <?= lang('description') ?>"
				},
				filename:{
					required: "Please Select <?= lang('filename') ?>"
				}
			},
			submitHandler: function (e) {
				$(e).ajaxSubmit({
					url: '<?php echo site_url("Gallery/save");?>',
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
								window.location.href = '<?php echo site_url('Gallery');?>';
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

		function ImageLoad() {
			var galleryId = $('#gallery_id').val();
			$.ajax({
				type: "post",
				url: "<?php echo site_url('Gallery/imageLoad');?>",
				dataType: "json",
				async: false,
				data: {gallery_id: galleryId},
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
							url: "<?php echo site_url('Gallery/imageDelete');?>",
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


	});


</script>
