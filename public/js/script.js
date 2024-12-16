function labelErrors(selector, e, error_class = "small.text-danger") {
    $(selector).each(function () {
        if (e[$(this).attr("name")]) {
            $(this).addClass("is-invalid");
            $(this).next(error_class).text(e[$(this).attr("name")]);
        } else {
            $(this).removeClass("is-invalid");
            $(this).next(error_class).text();
        }
    });
}

function collectData(selector) {
    let data = {};
    $(selector).each(function () {
        data[$(this).attr("name")] = $(this).val();
    });
    return data;
}
function loadData(selector, data) {
    $(selector).each(function () {
        $(this).val(data[$(this).attr("name")]);
    });
}

function myDateFormat(date) {
    const formatter = new Intl.DateTimeFormat("en-GB", {
        day: "numeric",
        month: "short",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit",
        hour12: false,
        timeZone: "UTC", // Force UTC time
    });

    return formatter.format(new Date(date));
}
function showToast(message, color = "success") {}
