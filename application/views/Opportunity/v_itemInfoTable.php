<?php
$html = '';
if(isset($getItemData) && !empty($getItemData)){
    foreach ($getItemData as $key => $value){
        $index = $key + 1;
        if($key == 0){
            $button ='<a data-popup="custom-tooltip" title="'.lang('add_item').'" onclick="AddItemRow()" '.
                'class="btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>';
        }else{
            $button ='<a data-popup="custom-tooltip" title="'.lang('delete_item').'" '.
                'class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded DeleteValueRow"><i class="icon-trash"></i></a>';
        }
        $html .='<tr>'.
            '<td>'.
            '<input type="hidden"  id="id_'.$index.'" name="id[]" value="'.$value['common_item_id'].'">'.
            '<select data-placeholder="Select Your '.lang('item_code').'" name="item_code[]" id="item_code_'.$index.'"  class="item_DD">'.
                    '<option value=""></option>'.
            '</select>'.
            '</td>'.
            '<td>'.
            '<input type="tel" class="item_quantity form-control numberInit" name="item_quantity[]" value="'.$value['quantity'].'" id="item_quantity_'.$index.'"  placeholder=" Please Enter'.lang('item_quantity').'">'.
            '</td>'.
            '<td>'.
            '<input type="text" class="form-control" name="item_name[]" value="'.$value['name'].'" id="item_name_'.$index.'" placeholder="'. lang('item_name').'" >'.
            '</td>'.
            '<td>'.
            $button.
            '</td>'.
            '</tr>';

    }
}

?>

<div class="table-responsive">

    <table id="itemTable" class="table" cellspacing="0" width="100%">
        <thead>

        <tr>
            <th><?= lang('item_code') ?></th>
            <th><?= lang('item_quantity') ?></th>
            <th><?= lang('item_name') ?></th>
<!--            <th>--><?//= lang('item_amount') ?><!--</th>-->
            <th><?= lang('action') ?></th>
        </tr>

        </thead>
        <tbody>
        <tr>
            <td>
                <input type="hidden"  id="id_0" name="id[]" value="">
                <select data-placeholder="Select Your <?= lang('item_code') ?>" name="item_code[]"id="item_code"  class="item_DD">
                    <option value=""></option>
                </select>
            </td>
            <td>
                <input type="tel" class="item_quantity form-control numberInit" name="item_quantity[]" id="item_quantity"  placeholder="Please Enter <?= lang('item_quantity') ?>">
            </td >
            <td>
                <input type="text" class="form-control" name="item_name[]" id="item_name" placeholder="Please Enter <?= lang('item_name') ?>" >
            </td>
            <td>
                <a data-popup='custom-tooltip' title="<?= lang('add_item') ?>" onclick="AddItemRow()" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded ">
                    <i class="icon-plus3"></i>
                </a>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<script>
    function numberInit() {
        $(".item_quantity").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    }

    function itemSelect2Init(){
        //Ajax send item code
        $(".item_DD").select2({

            ajax: {
                url: "<?= site_url('Item/getItem') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '', // search term
                        item_id: "<?= isset($getQuotationData['lead_id']) ? $getQuotationData['lead_id'] : ''; ?>",
                        page: params.page || 1
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.result,
                        pagination: {
                            more: (data.page * 10) < data.totalRows

                        }
                    };
                },
                //cache: true
            },

            escapeMarkup: function (markup) {
                return markup;
            },

        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });
    }


    $(document).ready( function() {

        <?php if(isset($getItemData) && !empty($getItemData) && $html != ''){ ?>
        $('table#itemTable tbody').html('<?= $html ?>');
        <?php } ?>

        itemSelect2Init();
        numberInit();

        <?php if((isset($getItemData) && !empty($getItemData))){
        foreach ($getItemData as $key => $value){
            ?>
        var option = new Option("<?= $value['item_code']; ?>",
            "<?= $value['item_id']; ?>", true, true);
        $('#itemTable tbody').find("tr:eq(<?= $key; ?>) select").append(option).trigger('change.select2');
        <?php } } ?>


    });
    var index = <?php echo (isset($getItemData) && !empty($getItemData)) ? count($getItemData) : 0; ?>;
    function AddItemRow(){
        index = index + 1;
        var html = "<tr>"+
            "<td>"+
            "<input type='hidden' name='id[]' id='id_"+index+"' />"+
            "<select data-placeholder='Select Your <?= lang('item_code') ?>' name='item_code[]' id='item_code_"+index+"' class='item_DD getItemCode'>"+
            "<option value=''></option>"+
            "</select>"+
            "</td>"+
            "<td>"+
            "<input type='tel' class='item_quantity form-control numberInit' name='item_quantity[]'  id='item_quantity_"+index+"' placeholder='Please Enter <?= lang('item_quantity') ?>'>"+
            "</td>"+
            "<td><input type='text' class='form-control' name='item_name[]' id='item_name_"+index+"' placeholder='<?= lang('item_name') ?>' ></td>"+
            "<td><a data-popup='custom-tooltip' title='<?= lang('delete_item') ?>' class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded DeleteValueRow'><i class='icon-trash'></i></a></td>"+
            "</tr>";

        $('table#itemTable tbody').append(html);
        itemSelect2Init();
        numberInit();

    }

    $(document).on('click', '.DeleteValueRow', function() {
        var trField = $(this).closest('tr');

        var id = $(this).closest('tr').find("input[type=hidden]").val();

        if(id != '') {
            swal({
                title: "<?= ucwords(lang('delete')); ?>",
                text: "<?= lang('delete_warning'); ?>",
                type: "<?= lang('warning'); ?>",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonColor: "<?= BTN_DELETE_WARNING; ?>",
                showLoaderOnConfirm: true

            }, function () {

                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url($this->uri->segment(1).'/deleteRow');?>",
                    dataType: "json",
                    data: {row_id: id},
                    success: function (resObj) {
                        if (resObj.success) {
                            swal({
                                title: "<?= ucwords(lang('success'))?>",
                                text: resObj.msg,
                                type: "<?= lang('success')?>",
                                confirmButtonColor: "<?= BTN_SUCCESS; ?>",
                            }, function () {
                                $(trField).remove();
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

            });
        } else{
            $(trField).remove();
        }
    });

    $(document).on('change', '.item_DD', function() {
        var row = $(this);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Item/getItemName');?>",
            dataType: "json",
            data: {itemId: row.val()},
            success: function (data) {
                row.parents("tr").find("td:eq(2) input").val(data['item_name']);
            }
        });
    });


    $(document).on('keyup', '.item_quantity', function() {
       var item_quantity  = $(this).val();
       var item_name      = $(this).closest("tr").find("td:eq(2) input").val();

       if($.isNumeric(item_name) && $.isNumeric(item_quantity) ){
           var result = item_quantity * item_name;
       }else{
           var result = $(this).closest("tr").find("td:eq(3) input").val();
       }
       $(this).parents("tr").find("td:eq(3) input").val(result);
    });
</script>