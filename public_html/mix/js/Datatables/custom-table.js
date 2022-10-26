export function customAjaxTable(url, params) {
   return axios.get(url, { params })
        .then((response) => {
            const datas = response.data;
            const all = datas?.all?.data ?? datas?.all ?? [];

            const columns = datas.columns;
            let tbody = "";

            if (all.length > 0) {
                for (const data of all) {
                    let row = "<tr>";
                    columns.forEach(col => {
                        row += `<td>${data[col["data"]] ?? ''}</td>`;
                    });
                    row += "</tr>";

                    tbody += row;
                }
                $("#table-container").attr("style", "height:490px");
            } else {
                $("#table-container").removeAttr("style");
                tbody = `<tr>
                     <td  colspan="${columns.length}">Aucune donnée disponible</td>
                    </tr>`;
            }

            $("#fetchRow").html(tbody);
        })
        .catch((error) => {
            console.log(error);
        })
}