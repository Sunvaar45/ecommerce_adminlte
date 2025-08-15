function addRowToTable(tableId, buttonId, fields) {
    let lastIndex = document.querySelectorAll(`#${tableId} tbody tr`).length;
    document.getElementById(buttonId).addEventListener('click', function () {
        const tableBody = document.getElementById(tableId).getElementsByTagName('tbody')[0];
        const row = tableBody.insertRow();
        let html = '';
        fields.forEach(field => {
            html += '<td>' + field.replace(/__INDEX__/g, lastIndex) + '</td>';
        });
        row.innerHTML = html;
        lastIndex++;
    });
}