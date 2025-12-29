// services/rest-client.js
var RestClient = {
    request: function(url, method, data = null) {
        const token = localStorage.getItem("user_token");
        const headers = {
            'Content-Type': 'application/json'
        };
        
        if (token) {
            headers['Authorization'] = 'Bearer ' + token;
        }
        
        return new Promise((resolve, reject) => {
            $.ajax({
                url: Constants.PROJECT_BASE_URL + url,
                type: method,
                headers: headers,
                data: data ? JSON.stringify(data) : null,
                contentType: 'application/json',
                dataType: 'json',
                success: function(response) {
                    resolve(response);
                },
                error: function(xhr, status, error) {
                    reject({ xhr, status, error });
                }
            });
        });
    },
    
    get: function(url) {
        return this.request(url, 'GET');
    },
    
    post: function(url, data) {
        return this.request(url, 'POST', data);
    },
    
    put: function(url, data) {
        return this.request(url, 'PUT', data);
    },
    
    delete: function(url) {
        return this.request(url, 'DELETE');
    }
};