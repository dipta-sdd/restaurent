function labelErrors(selector, e, error_class = "small.text-danger") {
    $(selector).each(function () {
        if (e[$(this).attr("name")]) {
            $(this).addClass("is-invalid");
            $(this).next(error_class).html(e[$(this).attr("name")]);
        } else {
            $(this).removeClass("is-invalid");
            $(this).next(error_class).html();
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

function getCookie(name) {
    let nameEQ = name + "=";
    let ca = document.cookie.split(";");
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === " ") c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0)
            return c.substring(nameEQ.length, c.length);
    }
    return null;
}
function showToast(
    message,
    color = "primary",
    autohide = true,
    timeout = 5000
) {
    $("#toast-container").append(`
    <div class="toast align-items-center text-bg-${color} border-0 "
        role="alert"
        aria-live="assertive"
        data-bs-animation="true"
        data-bs-autohide="${autohide}"
        aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button
                type="button"
                class="btn-close btn-close-white me-2 m-auto"
                data-bs-dismiss="toast"
                aria-label="Close" 
            ></button>
        </div>
    </div>
    `);
    if (autohide) {
        var newToast = $(".toast:last");

        newToast.show(1000);
        setTimeout(function () {
            newToast.hide(1000);
        }, timeout);
    }
}
$(document).on("click", ".toast button.btn-close", function (e) {
    e.preventDefault();
    $(this).closest(".toast").hide(1000);
});
