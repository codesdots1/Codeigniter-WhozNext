<?php
$CI =& get_instance();
$eventId = $CI->input->get('event_id');

if(isset($filterModel) && $filterModel != '') {
    echo $filterModel;
}

?>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('event_wise_member_index_heading') ?></h5>
        <div class="heading-elements">
            <button type="button" data-popup='custom-tooltip' data-original-title="<?= lang('export_event') ?>" title="<?= lang('export_event') ?>"
                    class="btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded pull-right" aria-expanded="false"
            onclick="eventDataExport(<?= $eventId ?>);"><i class="icon-file-excel"></i></button>
        </div>
    </div>

    <div class="table-responsive">
        <table id="eventDataTable" class="table " cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><?= lang('event_member_number') ?></th>
                <th><?= lang('event_member_name') ?></th>
                <th><?= lang('event_member_mobile') ?></th>
                <th><?= lang('event_member_response') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>


<script>
    $(document).ready(function () {
        dt_DataTable = $('#eventDataTable').DataTable({
            dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Event/getEventMemberDataListing'); ?>",
                "type": "post",
                "data": function (d) {
                    var params = {};
                    params["<?= $this->security->get_csrf_token_name(); ?>"] = "<?= $this->security->get_csrf_hash() ?>";
                    params["event_id"] = "<?= $eventId; ?>";
                    var filterData = $("#advanceFilter").serializeArray();
                    $.each(filterData, function (i, val) {
                        var name = val.name;
                        if (typeof params[name] == 'undefined') {
                            params[name] = val.value;
                        } else if($.isArray(params[name])){
                            params[name].push(val.value);
                        } else {
                            params[name] = [params[name]];
                            params[name].push(val.value);
                        }
                    });
                    return $.extend({}, d,params);
                }
            },
            "fnServerParams": function (aoData) { //send other data to server side
                var params = {};
                var filterData = $("#advanceFilter").serializeArray();
                $.each(filterData, function (i, val) {
                    var name = val.name;
                    if (typeof params[name] == 'undefined') {
                        params[name] = [];
                    }
                    params[name].push(val.value);
                });
                aoData.filterParams = params;
                server_params = aoData;
            },
            "iDisplayLength": "<?= PERPAGE_DISPLAY ?>",
            "order": [[1, "ASC"]],
            "stripeClasses": [ 'alpha-slate', 'even-row' ],
            "columns": [
                {"data": "member_number"},
                {"data": "member_name"},
                {"data": "mobile"},
                {"data": "is_interested",
                    "render":function (data, type, row) {
                        var html = '';
                        var isInterested = row['is_interested'];
                        if(isInterested == 0){
                            html += 'No';
                        } else if (isInterested == 1){
                            html += 'Yes';
                        } else {
                            html += ' ';
                        }
                        return html;
                    }
                }
            ],
            fnDrawCallback: function (oSettings) {
                CustomToolTip();
                ScrollToTop();
            }
        });
    });

    function eventDataExport(eventId) {
        var postData = dt_DataTable.ajax.params();
        $.ajax({
            type: "post",
            url: "<?= site_url("Event/exportEventMemberData")?>",
            dataType: "html",
            data : { event_id : eventId, data : postData},
            success:function(download_url_from_server){
                document.location = download_url_from_server;
            }
        });
    }
</script>
