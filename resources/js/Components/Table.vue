<script setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';

DataTable.use(DataTablesCore);

</script>
<template>
    <section class="bg-gray-100/20">
        <DataTable  class="display text-center ">
            <thead>
                    <slot name="table-head"></slot>
                </thead>
                <tbody>
                    <slot name="table-body"></slot>
            </tbody>
            <tbody>

            </tbody>
    </DataTable>
</section>
</template>
<style >
@import 'datatables.net-dt';
*{
    font-size: 14px;
}
select{
    width: 80px;
}
table{
    
    margin-top: 16px !important;
    margin-bottom: 16px !important;
}
th{
    background-color: white;
    text-align: center !important;
}
tr{
    
    border: 1px solid rgb(190, 190, 190) !important;
}
td{
    text-align: center !important;
}
.dt-layout-table{
    min-height: 350px;
}
</style>