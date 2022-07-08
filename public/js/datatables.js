$(document).ready(function () {
    $("#myTable").DataTable({
        "scrollX": true,
        "language": {
            "search": "",
            "searchPlaceholder": "Search...",
            "decimal": ",",
            "thousands": ".",
            "emptyTable": "Not made a reservation yet"
        },
    });
});
