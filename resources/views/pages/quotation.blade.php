@extends('template.template')
@section('content')
<div>
    <form method="POST" id="quotation-form" class="max-w-lg mx-auto">
        <div class="mb-5">
            <label for="age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Enter the ages</label>
            <input type="age" id="age" name="age" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ages should be comma separated (Ex:28,35)" required />
            <span id="age_error_message" class="text-red-900 text-sm errorMessage"></span>
        </div>
        <div class="mb-5">
            <label for="age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a currency</label>
            <select required id="countries" name="currency_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Choose a currency</option>
                @foreach($currencyCodes as $key => $currency)
                <option value="{{$key}}">{{$currency}}</option>
                @endforeach
            </select>
            <span id="age_error_message" class="text-red-900 text-sm errorMessage"></span>
        </div>
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Duration</label>
            <div id="date-range-picker" date-rangepicker class="flex items-center">
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input id="datepicker-range-start" datepicker-min-date="{{date('m/d/Y')}}" datepicker-max-date="{{date('m/d/Y',strtotime('+1 year'))}}" name="start_date" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select the start date" required>
                </div>
                <span class="mx-4 text-gray-500">to</span>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input id="datepicker-range-end" datepicker-min-date="{{date('m/d/Y')}}" datepicker-max-date="{{date('m/d/Y',strtotime('+1 year'))}}" name="end_date" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select the end date">
                </div>
            </div>

            <span id="start_date_error_message" class="text-red-900 text-sm errorMessage"></span>
            <span id="end_date_error_message" class="text-red-900 text-sm errorMessage"></span>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Get Quotation</button>
    </form>
</div>

<div id="quotation-alert" class="hidden p-4 mt-6 border border-gray-300 rounded-lg bg-gray-50 dark:border-gray-600 dark:bg-gray-800" role="alert">
  <div class="flex items-center">
    <svg class="flex-shrink-0 w-4 h-4 me-2 dark:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">Your Quotation is ready!</h3>
  </div>
  <div class="mt-2 mb-4 text-sm text-gray-800 dark:text-gray-300">
    <h2>Referance: #<span id="refCode"></span></h2>
    Your estimated quotation value is <span id="estimatedAmount"></span>. Please keep your referance code for your future referance.
  </div>
  <div class="flex">
    <button type="button" class="text-gray-800 bg-transparent border border-gray-700 hover:bg-gray-800 hover:text-white focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:ring-gray-800 dark:text-gray-300 dark:hover:text-white" onclick="return closeMessage()" aria-label="Close">
      Dismiss
    </button>
  </div>
</div>
@endsection

@section('additional-scripts')
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
<script type="text/javascript">
    $("#quotation-form").on('submit', function() {
        $('.errorMessage').empty();
        $.ajax({
            url: "{{url('/api/quotation')}}",
            type: "post",
            data: $("#quotation-form").serialize(),
            success: function(data) {
                $('#refCode').text(data.data.quotation_id);
                $('#estimatedAmount').text(data.data.currency_id+' '+data.data.total);
                $('#quotation-alert').removeClass('hidden');
                $('#quotation-alert').show();
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

    function closeMessage() {
        $('#quotation-alert').hide();
    }

    document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('age');

        input.addEventListener('input', (event) => {
            const value = event.target.value;
            // Filtering the numbers and comma
            const sanitizedValue = value.replace(/[^0-9,]/g, '');
            const endsWithComma = sanitizedValue.endsWith(',');
            const numbers = sanitizedValue.split(',')
                .map(num => num.trim()) // Remove extra spaces
                .filter(num => {
                    const number = parseInt(num, 10);
                    return !isNaN(number) && number >= 18 && number <= 70;
                });

            console.log();
            if(endsWithComma) {
                event.target.value = numbers.join(',')+',';
            }

        });
    });
</script>
@endsection