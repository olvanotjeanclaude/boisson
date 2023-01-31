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
    const prevLink = datas?.all?.prev_page_url ?? null;
    const nextLink = datas?.all?.next_page_url ?? null;

    if (links) {
        const linkBtns = links.map(link =>
        (`<li class="page-item ${link.active ? 'active' : ''}">
             <button class="page-link" data-url="${link.url}">${link.label}</button>
          </li>`
        ))

        const prevBtn = prevLink?.url ? `
            <li class="page-item">
                <button class="page-link" data-url="${prevLink.url}" aria-label="Previous">
                    <span aria-hidden="true">« </span>
                    <span class="sr-only">Previous</span>
                </button>
            </li>
        `: "";

        const nextBtn = nextLink?.url ? `
            <li class="page-item">
              <button class="page-link" data-url="${nextLink.url}" aria-label="Next">
                <span aria-hidden="true"> »</span>
                <span class="sr-only">Next</span>
             </button>
            </li>
        `: "";

        const pagination = `
        <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                   ${prevBtn}                          

                   ${linkBtns}

                   ${nextBtn}
                </ul>
        </nav>`;

        if($("#pagination").length){
        }
        $("#paginationContainer").html(pagination);

    }
}