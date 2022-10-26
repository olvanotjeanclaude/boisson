$(document).ready(function() {
    $(document).on("click", ".edit-category", function() {
        const url = $(this).data("url");
        const modalId = $(this).data("modalID");

        if (url) {
            axios.get(url)
                .then((response) => {
                    $("#ajax-response").html(response.data);
                    $("#editCategory").modal("show");
                })
                .catch((response) => {
                    console.log(response);
                    alert("error occured");
                })
        }
    })
})