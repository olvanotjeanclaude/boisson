export default function exportColumns(columns) {
    let exportedColumns = columns;

    if (columns[columns.length - 1].name == "action") {
        exportedColumns = columns.slice(0, columns.length - 1);
    }

    exportedColumns = exportedColumns.map((col, index) => index);

    return exportedColumns;
}