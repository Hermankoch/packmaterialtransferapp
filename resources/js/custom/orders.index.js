if (window.addEventListener) {
    window.addEventListener("load", dataTable, false);
} else if (window.attachEvent) {
    window.attachEvent("onload", dataTable);
}

function dataTable() {
    let table = $('#table_id').DataTable({
        data: tickets,
        columnDefs: [
            {className: "text-center", "targets": [0]}
        ],
        columns: [
            {data: 'id'},
        ]
    });
}
