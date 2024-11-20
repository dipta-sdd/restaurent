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

// $.ajax({
//     url: "/api/cccc",
//     type: "get",
//     success: function (response) {
//         console.log(response);
//     },
//     error: function (xhr) {
//         console.error("Registration failed", xhr.responseJSON);
//         // Handle errors, e.g., display validation errors to the user
//     },
// });
function labelErrors(selector, e) {
    $(selector).each(function () {
        // let name = $(this).attr('name');
        if (e[$(this).attr("name")]) {
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
        }
    });
}
