<div id="schedule-store">
    <x-list-table-min>
        <x-slot name="template">
            <script class="template-list" type="text/x-custom-template">
                <tr data-url="panel" data-toggle="">
                    <td>
                        @can('store-schedule-delete')
                            <button class="btn btn-danger btn-mt" ondblclick="DeleteStoreScheduleButton(this);"">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        @endCan
                    </td>
                    <td>#_day_#</td>
                    <td>#_start_time_#</td>
                    <td>#_end_time_#</td>
                </tr>
            </script>
        </x-slot>
    </x-list-table-min>
</div>
