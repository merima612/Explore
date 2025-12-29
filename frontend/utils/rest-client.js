let RestClient = {
    get: function (url, callback, error_callback) {
        $.ajax({
            url: Constants.PROJECT_BASE_URL + url,
            type: "GET",
            beforeSend: function (xhr) {
                
                xhr.setRequestHeader(
                    "Authorization",
                    localStorage.getItem("user_token")
                );
            },
            success: function (response) {
                if (callback) callback(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (error_callback) error_callback(jqXHR);
            },
        });
    },
    request: function (url, method, data, callback, error_callback) {
        $.ajax({
            url: Constants.PROJECT_BASE_URL + url,
            type: method,
            beforeSend: function (xhr) {
                xhr.setRequestHeader(
                    "Authorization",
                    localStorage.getItem("user_token")
                );
            },
            
            contentType: "application/json", 
            data: JSON.stringify(data),
        })
        .done(function (response, status, jqXHR) {
            if (callback) callback(response);
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            if (error_callback) {
                error_callback(jqXHR);
            } else {
                
                let msg = (jqXHR.responseJSON && jqXHR.responseJSON.message) ? jqXHR.responseJSON.message : "Došlo je do greške.";
                toastr.error(msg);
            }
        });
    },
    post: function (url, data, callback, error_callback) {
        RestClient.request(url, "POST", data, callback, error_callback);
    },
    delete: function (url, data, callback, error_callback) {
        RestClient.request(url, "DELETE", data, callback, error_callback);
    },
    patch: function (url, data, callback, error_callback) {
        RestClient.request(url, "PATCH", data, callback, error_callback);
    },
    put: function (url, data, callback, error_callback) {
        RestClient.request(url, "PUT", data, callback, error_callback);
    },
};