var AuthService = {
  register: function (data) {
    return RestClient.post("auth/register", data);
  }
};
