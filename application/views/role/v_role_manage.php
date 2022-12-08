<div class="panel panel-flat border-left-lg border-left-slate">
	<div class="panel-heading ">
		<h5 class="panel-title"><?= lang('role_heading') ?><a class="heading-elements-toggle"><i class="icon-more"></i></a>
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
			'id'		=> 'roleDetails',
			'method'	=> 'post',
			'class'		=> 'form-horizontal'
		);
		echo form_open_multipart('', $form_id);
		$roleId = (isset($getRoleData['role_id']) && ($getRoleData['role_id'] != '')) ? $getRoleData['role_id'] : '';
		?>
		<input type="hidden" name="role_id" value="<?= $roleId ?>" id="role_id">

		<div class="tabbable">
			<div class="tab-content">

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('title') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="text" name="title" id="title" class="form-control"
							   value="<?= (isset($getRoleData['title']) && ($getRoleData['title'] != '')) ? $getRoleData['title'] : ''; ?>"
							   placeholder="Enter <?= lang('title') ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('role') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="text" name="role" id="role" class="form-control"
							   value="<?= (isset($getRoleData['role']) && ($getRoleData['role'] != '')) ? $getRoleData['role'] : ''; ?>"
							   placeholder="Enter <?= lang('role') ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('description') ?></label>
					<div class="col-lg-9">
						<textarea name="description" id="description" placeholder="Enter Only 255 Character" class="form-control" rows="5" cols="5"><?php echo (isset($getRoleData['description']) && ($getRoleData['description'] != '')) ? $getRoleData['description'] : ''; ?></textarea>
						<label id="description-error" class="validation-error-label" for="description"></label>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- create reset button-->
	<div class="text-right">
		<button type="button" class="btn btn-xs border-slate text-slate btn-flat cancel"
				onclick="window.location.href='<?php echo site_url('Role'); ?>'"><?= lang('cancel_btn') ?> <i class="icon-cross2 position-right"></i> </button>

		<button type="submit"
				class="btn btn-xs border-blue text-blue btn-flat btn-ladda btn-ladda-progress submit"
				data-spinner-color="#03A9F4" data-style="fade"><span
				class="ladda-label"><?= lang('submit_btn') ?></span>
			<i id="icon-hide" class="icon-arrow-right8 position-right"></i>
		</button> <br/><br/>
	</div>
	<?php echo form_close(); ?>
</div>
<script>
	var laddaSubmitBtn = Ladda.create(document.querySelector('.submit'));

	$(document).ready(function () {
		// Full featured editor
//        CKEDITOR.replace( 'long_description', {
//            height: '400px',
//            extraPlugins: 'forms'
//        });
		numberInit();
		Select2Init();
		SwitcheryKeyGen();
		FileKeyGen();

		// Initialize
		jQuery.validator.addMethod("lettersonly", function(value, element) {
			return this.optional(element) || /^[a-z ]+$/i.test(value);
		}, "Only Letters are allowed");
		var validator = $("#roleDetails").validate({
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
				title: {
					required: true,
				},
				role: {
					required: true,
				}
			},
			messages: {
				title: {
					required: "Please Enter <?= lang('title') ?>",
				},
				role: {
					required: "Please Enter <?= lang('role') ?>",
				}
			},submitHandler: function (e) {
				$(e).ajaxSubmit({
					url: '<?php echo site_url("Role/save");?>',
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
								window.location.href = '<?php echo site_url('Role');?>';
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

	});
</script>
