$(document).ready(function() {
    $("#checkStock").submit(function(e) {
        e.preventDefault();

        const url = $(this).attr("action");
        const article_reference = $("#article_reference").val();
        const date = $("#date").val();
        const real_quantity = $("#real_quantity").val();
        const data = new FormData(this)

        if (url && article_reference && date && real_quantity) {
            axios.post(url, data)
                .then(function(response) {
                    const data = response.data;
                    // console.log(data)
                    let html = "<ul class='list-unstyled'>";
                    if (data.messages.length) {
                        data.messages.forEach(function(message) {
                            html += `<li>${message}</li>`;
                        })
                    }
                    html += "</ul>";
                    $("#stockModal .modal-body").html(html);
                    $("#stockModal #adjustStock").html(data.submitAjustmentBtn)
                    $("#stockModal").modal("show");
                })
                .catch(function(res) {
                    console.log(res)
                })
        }
    })
})