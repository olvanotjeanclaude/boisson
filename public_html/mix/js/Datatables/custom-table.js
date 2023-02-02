export function customAjaxTable(url, params) {
    return axios.get(url, { params })
        .then((response) => {
            const datas = response.data;
            const all = datas?.all?.data ?? datas?.all ?? [];

            setTableBody(all, datas.columns);

            setPagination(datas);
        })
        .catch((error) => {
            console.log(error);
        })
}

export function setTableBody(allData, columns) {
    let tbody = "";

    if (allData.length > 0 && columns?.length) {
        for (const data of allData) {
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
}

export function setPagination(datas) {
    const links = datas?.all?.links ?? [];

    if (links) {
        const linkBtns = links.map((link,index) =>{
         let label =link.label;

         if(index==0){
            label= "Précedent";
         }

         if(index==links.length-1){
            label="Suivant";
         }
       
         return `<li class="page-item ${link.active ? 'active' : ''}">
         <button class="page-link" data-url="${link.url}">${label}</button>
      </li>`;

        }).join("")

        const pagination = `
        <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                   ${linkBtns}
                </ul>
        </nav>`;

        if ($("#pagination").length) {
        }
        $("#paginationContainer").html(pagination);

    }
}