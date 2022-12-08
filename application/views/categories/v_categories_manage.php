<div class="panel panel-flat border-left-lg border-left-slate">
	<div class="panel-heading ">
		<h5 class="panel-title"><?= lang('category_form') ?><a class="heading-elements-toggle"><i
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
			'id' => 'categoriesDetails',
			'method' => 'post',
			'class' => 'form-horizontal',
		);
		echo form_open_multipart('', $form_id);
		$categoriesId = (isset($getCategoriesData['categories_id']) && ($getCategoriesData['categories_id'] != '')) ? $getCategoriesData['categories_id'] : ''; ?>
		<input type="hidden" name="categories_id" value="<?= $categoriesId ?>" id="categories_id">

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
					<label class="col-lg-3 control-label"><?= lang('categories_name') ?><span class="text-danger"> * </span></label>
					<div class="col-lg-9">
						<input type="text" name="categories_name"
							   value="<?= (isset($getCategoriesData['categories_name']) && ($getCategoriesData['categories_name'] != '')) ? $getCategoriesData['categories_name'] : ''; ?>"
							   id="categories_name" class="form-control" placeholder="Enter <?= lang('categories_name') ?>">
					</div>
				</div>
				

				<div class="form-group">
					<label class="col-lg-3 control-label"><?= lang('is_active') ?></label>
					<div class="col-lg-9">
						<div class="checkbox checkbox-switchery switchery-xs">
							<label>
								<input type="checkbox"
									   name="is_active" <?php if (isset($getCategoriesData['is_active']) && $getCategoriesData['is_active'] == 1) {
									echo 'checked="checked"';
								} else if(isset($getCategoriesData['is_active']) && $getCategoriesData['is_active'] == 0) {
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
					onclick="window.location.href='<?php echo site_url('Categories'); ?>'"><?= lang('cancel_btn') ?> <i
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
		var validator = $("#categoriesDetails").validate({
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
				categories_name:{
					required: true,
					lettersonly:true,
				},
				business_id:{
					required: true,
				},
			},
			messages: {
				categories_name:{
					required: "Please Enter <?= lang('categories_name') ?>",
				},
				business_id:{
					required: "Please Select <?= lang('business_name') ?>"
				}
			},
			submitHandler: function (e) {
				$(e).ajaxSubmit({
					url: '<?php echo site_url("Categories/save");?>',
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
								window.location.href = '<?php echo site_url('Categories');?>';
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

        <?php if((isset($getCategoriesData['business_name']) && !empty($getCategoriesData['business_name']))){ ?>
		var option = new Option("<?= $getCategoriesData['business_name']; ?>", "<?= $getCategoriesData['business_id']; ?>", true, true);
		$('#business_id').append(option).trigger('change');
		<?php } ?>
	});
</script>
<?php if (isset($select2)) { ?>
	<?= $select2 ?>
<?php } ?>