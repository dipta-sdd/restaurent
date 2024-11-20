// $.ajax({
//     url: "/api/login",
//     type: "POST",
//     data: {
//         email: "admin@email.com",
//         password: "admin1234",
//     },
//     xhrFields: {
//         withCredentials: true,
//     },
//     headers: {
//         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//     },

//     success: function (response) {
//         console.log(response);

//         // Optionally redirect the user or display a success message
//     },
//     error: function (xhr) {
//         console.error("Registration failed", xhr.responseJSON);
//         // Handle errors, e.g., display validation errors to the user
//     },
// });

// on click #login

$("#login").click(function (e) {
    e.preventDefault();
    $.ajax({
        url: "/api/login",
        type: "POST",
        data: {
            email: $("#email").val(),
            password: $("#password").val(),
        },
        xhrFields: {
            withCredentials: true,
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        success: function (response) {
            console.log(response);
            localStorage.setItem("apiToken", response.token);
            // Optionally redirect the user or display a success message
            window.location.href = "/";
        },
        error: function (xhr) {
            console.error("Registration failed", xhr.responseJSON);
            // Handle errors, e.g., display validation errors to the user
        },
    });
});
