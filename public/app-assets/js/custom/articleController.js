$(document).ready(function() {
    $("#article_type").change(async function() {
        const articleType = $(this).val();
        if (articleType) {
            const response = await axios.get(`/api/get-articles/${articleType}`, {
                    articleType
                })
                .then(response => {
                    let options = "<option value=''>Choisir</option>";
                    const data = response.data;
                    if (data.length) {
                        data.forEach(option => {
                            options +=
                                `<option value='${option.reference}'>
                                    ${option.reference}-${option.designation}
                                </option>`;
                        });
                    }

                    $("#article_reference").html(options);
                })
                .catch(error => {
                    console.log(error);
                    return error;
                });
        } else {
            $("#article_reference").html("<option value=''>Choisir</option>");
            alert("Selectionnez le type d'article")
        }
    })
});