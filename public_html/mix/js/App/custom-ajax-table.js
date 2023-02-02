import { customAjaxTable } from "../Datatables/custom-table.js";

$(document).ready(function () {
    const src = $(".ajaxTable").data("src");
    let start_date = $("#start_date").val();
    let end_date = $("#end_date").val();
    let search = $("#search").val();

    if ($("#filterForm").length) {
        customAjaxTable(src);
    }

    $("#filterForm").submit(async function (e) {
        e.preventDefault();
        start_date = $("#start_date").val();
        end_date = $("#end_date").val();
        search = $("#search").val();

        if (src) {
            await customAjaxTable(src, {
                between: [start_date, end_date],
                search
            });
        }
    })

    $(".search-action").click(function () {
        let url = $(this).data("url");

        if (url) {
            url = new URL(url);
            url.searchParams.set("start_date", start_date);
            url.searchParams.set("end_date", end_date);
            url.searchParams.set("search", search);

            $(this).attr("href", url);

            window.open(url);
        }
    });


    $(document).on("click", ".page-link", async function () {
        const url = $(this).data("url");

        if(url){
            await customAjaxTable(url, {
                between: [start_date, end_date],
                search
            });
        }
       
    })
})