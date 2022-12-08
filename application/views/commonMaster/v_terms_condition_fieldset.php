
<!--  Terms and Conditions Details -->
<fieldset class="content-group">
    <legend class="text-bold"> Terms and Conditions  </legend>

    <div class="form-group">

        <div class="row">
            <div class="col-md-6">

                <div class="form-group">
                    <label><?= lang('terms_condition_index') ?></label>
                    <select data-placeholder="Select <?= lang('terms_condition_index') ?>" name="terms_condition_id"
                            id="terms_condition_id" class="select">
                        <option value=""></option>
                        <?= CreateOptions("html", "tbl_terms_conditions", array('terms_condition_id', 'title'), isset($termsConditionDetails['terms_condition_id']) ? $termsConditionDetails['terms_condition_id'] : '','',array('is_active'=>1)); ?>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Description -->
                <div class="form-group">
                    <label><?= lang('term_details') ?></label>
                    <textarea name="term_details" id="term_details" class="ckeditor" rows="2" cols="2">
                                      <?= (isset($termsConditionDetails['term_details']) && ($termsConditionDetails['term_details'] != '')) ? $termsConditionDetails['term_details'] : ''; ?>
                                    </textarea>
                    <label id="term_details-error" class="validation-error-label" for="term_details"></label>

                </div>
            </div>
        </div>
    </div>
</fieldset>
<!-- End Terms and Conditions Details -->


<script>
    $(document).on('change', '#terms_condition_id', function() {
        var  terms_condition_id = $('#terms_condition_id').val();
        $.ajax({
            url: "<?php echo site_url('Quotation/getTermsConditionById');?>",
            type: 'POST',
            data: {termsConditionId: terms_condition_id},
            dataType: 'json',
            success: function (data) {
                if (data) {
                    CKEDITOR.instances['term_details'].setData(data['description']);
                } else {
                    CKEDITOR.instances['term_details'].setData('');
                }

            }
        });
    });
</script>