function getAuthenticatedUser() {
  return localStorage.getItem('user');
}

function isAuthenticated() {
  return (localStorage.getItem('user') ? true : false);
}

function logout(obj) {
  console.log(obj.href);
  $.ajax({
    url: obj.href,
    type: "post",
    headers: { "Authorization": 'Bearer' + localStorage.getItem('auth_token') },
    success: function (data) {
      localStorage.removeItem('user');
      localStorage.removeItem('auth_token');
      document.cookie = "auth_token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
      console.log('Success');
      window.location.href = '/';
    },
    error: function (data) {
      console.log(data);
      console.log('Error');
    }
  });
  return false;
}
