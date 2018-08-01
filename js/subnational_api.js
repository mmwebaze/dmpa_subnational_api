(function ($) {
  'use strict';
  Drupal.behaviors.dmpa_subnational_api = {
    attach: function (context, settings) {

      $('#edit-field-country').on('change', function() {
        $.ajax({
          url: '/subnationals/' + $('#edit-field-country').val(),
          type: 'GET',
          data: {
            format: 'json'
          },
          success: function (response) {

            $('#edit-field-4-6-0-subform-field-sub-national-level').empty();
            $.each(response, function(key, value) {
              $('#edit-field-4-6-0-subform-field-sub-national-level').append(new Option(value, key));
            });
          },
          error: function () {
            $('#errors').text("There was an error processing your request. Please try again.");
          }
        });
      });
    }
  };
}(jQuery));