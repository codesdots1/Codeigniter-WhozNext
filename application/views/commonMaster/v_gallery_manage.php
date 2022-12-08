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
		<input type="hidden" name="gallery_id" value="<?= $galleryId ?>" id="gallery_id">

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
					<label class="col-lg-3 control-label"><?= lang('filename') ?></label>
					<div class="col-lg-9">
						<input type="file" accept="image/*" name="filename[]" id="filename" class="file-styled-primary" multiple>
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
					<label class="col-lg-3 control-label"><?= lang('gallery_name') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<textarea name="gallery_name" id="gallery_name" placeholder="Enter Only 255 Character"
								  class="form-control" rows="5"
								  cols="5"><?php echo (isset($getGalleryData['gallery_name']) && ($getGalleryData['gallery_name'] != '')) ? $getGalleryData['gallery_name'] : ''; ?></textarea>
					</div>
				</div>

				<div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('staff_data') ?><span class="text-danger"> * </span></label>
                    <div class="col-lg-9">
                        <select name="staff_id" id="staff_id" class="form-control" data-placeholder="Select <?= lang('staff_data') ?> ">
                            <option value=""></option>
                        </select>
                    </div>
                </div>

				<div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('service_data') ?><span class="text-danger"> * </span></label>
                    <div class="col-lg-9">
                        <select name="service_id" id="service_id" class="form-control" data-placeholder="Select <?= lang('service_data') ?> ">
                            <option value=""></option>
                        </select>
                    </div>
                </div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('product_name') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="text" name="product_name"
							   value="<?= (isset($getGalleryData['product_name']) && ($getGalleryData['product_name'] != '')) ? $getGalleryData['product_name'] : ''; ?>"
							   id="product_name" class="form-control" placeholder="Enter <?= lang('product_name') ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('make_image') ?></label>
					<div class="col-lg-9">
						<div class="checkbox checkbox-switchery switchery-xs">
							<label>
								<input type="checkbox"
									   name="status" <?php if (isset($getGalleryData['status']) && $getGalleryData['status'] == 1) {
									echo 'checked="checked"';
								} else if(isset($getGalleryData['status']) && $getGalleryData['status'] == 0) {
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
				},
				business_id:{
					required: true
				},
				service_id:{
					required: true
				},
				staff_id: {
					required: true
				},
				product_name: {
					required: true
				},
				// filename: {
				// 	required: true
				// },
			},
			messages: {
				gallery_name:{
					required: "Please Enter <?= lang('gallery_name') ?>",
				},
				business_id:{
					required: "Please Select <?= lang('business_name') ?>"
				},
				service_id:{
					required: "Please Select <?= lang('service_data') ?>"
				},
				staff_id:{
					required: "Please Select <?= lang('staff_data') ?>"
				},
				product_name:{
					required: "Please Enter <?= lang('product_name') ?>"
				},
				// filename:{
				// 	required: "Please Select <?= lang('filename') ?>"
				// }
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

		<?php if((isset($getGalleryData['service_name']) && !empty($getGalleryData['service_name']))){ ?>
		var option = new Option("<?= $getGalleryData['service_name']; ?>", "<?= $getGalleryData['service_id']; ?>", true, true);
		$('#service_id').append(option).trigger('change');
		<?php } ?>

		<?php if((isset($getGalleryData['staff_name']) && !empty($getGalleryData['staff_name']))){ ?>
		var option = new Option("<?= $getGalleryData['staff_name']; ?>", "<?= $getGalleryData['staff_id']; ?>", true, true);
		$('#staff_id').append(option).trigger('change');
		<?php } ?>

		<?php if((isset($getGalleryData['business_name']) && !empty($getGalleryData['business_name']))){ ?>
		var option = new Option("<?= $getGalleryData['business_name']; ?>", "<?= $getGalleryData['business_id']; ?>", true, true);
		$('#business_id').append(option).trigger('change');
		<?php } ?>

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
</script>
<?php if (isset($select2)) { ?>
	<?= $select2 ?>
<?php } ?>
