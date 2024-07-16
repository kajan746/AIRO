@extends('template.template')
@section('content')
<div>
  <form method="POST" id="registration-form" class="max-w-sm mx-auto">
    @csrf
    <div class="mb-5">
      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
      <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter your name" required />
      <span id="name_error_message" class="text-red-900 text-sm errorMessage"></span>
    </div>
    <div class="mb-5">
      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
      <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter your email address" required />
      <span id="email_error_message" class="text-red-900 text-sm errorMessage"></span>
    </div>
    <div class="mb-5">
      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
      <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter your password" required />
      <span id="password_error_message" class="text-red-900 text-sm errorMessage"></span>
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register</button>
  </form>
</div>
@endsection
@section('additional-scripts')
<script type="text/javascript">
  $("#registration-form").on('submit', function() {
    $('.errorMessage').empty();
    $.ajax({
      url: "{{url('/api/register')}}",
      type: "post",
      data: $("#registration-form").serialize(),
      success: function(data) {
        localStorage.setItem('auth_token', data.authorisation.token);
        document.cookie = "auth_token=" + data.authorisation.token;
        localStorage.setItem('user', data.user);
        window.location.href = '/';
      },
      error: function(data) {
        if (data.status === 422) {
          var errors = $.parseJSON(data.responseText);
          $.each(errors, function(key, val) {
            $("#" + key + "_error_message").text(val[0]);
          });
        }
      }
    });
    return false;
  })
</script>
@endsection