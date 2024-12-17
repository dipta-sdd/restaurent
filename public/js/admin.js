$(document).ready(function () {
    let theme = localStorage.getItem("theme");
    if (theme) {
        document.body.dataset.bsTheme = theme;
        $(".bd-mode-toggle .dropdown-item").removeClass("active");
        $(
            ".bd-mode-toggle .dropdown-item[data-bs-theme-value='" +
                theme +
                "']"
        ).addClass("active");

        $(".bd-mode-toggle .dropdown-toggle i").addClass("d-none");
        $(".bd-mode-toggle .dropdown-toggle i." + theme).removeClass("d-none");
    }

    // active side bar
    let pathname = window.location.pathname;
    let path = pathname.split("/").pop();
    path = "/" + path;
    // console.log(path);
    $("#sidebarMenu li a").each(function () {
        if ($(this).attr("href") == path) {
            // $(this).parent().parent().collapse("show");
            $(this).parent().addClass("active");
            $(".collapse").collapse("hide");
            $(this).parent().parent().parent().collapse("show");
        }
    });
});
$(document).on("click", ".bd-mode-toggle .dropdown-item", function (event) {
    event.preventDefault();
    document.body.dataset.bsTheme = event.target.dataset.bsThemeValue;
    let val = event.target.getAttribute("data-bs-theme-value");
    $(".bd-mode-toggle .dropdown-item").removeClass("active");
    $(event.target).addClass("active");
    localStorage.setItem("theme", val);
    $(".bd-mode-toggle .dropdown-toggle i").addClass("d-none");
    $(".bd-mode-toggle .dropdown-toggle i." + val).removeClass("d-none");
});

function labelErrors(selector, e) {
    $(selector).each(function () {
        if (e[$(this).attr("name")]) {
            $(this).addClass("is-invalid");
            $(this).next("small.text-danger").text(e[$(this).attr("name")]);
        } else {
            $(this).removeClass("is-invalid");
            $(this).next("small.text-danger").text();
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
