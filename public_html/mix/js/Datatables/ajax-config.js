import language from "./language.js";

export default {
    processing: true,
    serverSide: true,
    deferRender: true,
    dataSrc: "",
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tout"]],
    bPaginate: true,
    sPaginationType: "full_numbers",
    dom: 'lBfrtip',
    select: true,
    language:language,
    ordering:false
};