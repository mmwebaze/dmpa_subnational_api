(function ($) {
  'use strict';
  Drupal.behaviors.dmpa_subnational_api = {
    attach: function (context, settings) {
      var Subnational = Subnational || {};
      var countryDropdownId = '#edit-field-country';

      $(countryDropdownId).on('change', function () {
        var countrySelected = $(countryDropdownId).val();

        Subnational.loadSubnationalLevels(countrySelected);

        $.ajax({
          url: '/subnationals/' + countrySelected,
          type: 'GET',
          data: {
            format: 'json'
          },
          success: function (response) {
            $('#edit-field-4-6-0-subform-field-sub-national-level').empty();
            $('#edit-field-trainings-0-subform-field-sub-national-level').empty();
            $.each(response, function (key, value) {
              $('#edit-field-4-6-0-subform-field-sub-national-level').append(new Option(value, key));
              $('#edit-field-trainings-0-subform-field-sub-national-level').append(new Option(value, key));
            });
          },
          error: function () {
            $('#errors').text("There was an error processing your request. Please try again.");
          }
        });
      });

      Subnational.loadSubnationalLevels = function(countrySelected) {
        $('select.form-select').each(function(index, value) {

          if (index === 0){
            return;
          }

          var naam = 'field_trainings['+index+'][subform][field_sub_national_level]';
          var dr = $("[name='"+naam+"']").attr('id');

          if (dr !== undefined){
            $('#'+dr).append($('<option value="foo">'+index+'</option>'));
            $.ajax({
              url: '/subnationals/' + countrySelected,
              type: 'GET',
              data: {
                format: 'json'
              },
              success: function (response) {
                $('#'+dr).empty();
                $.each(response, function (key, value) {
                  $('#'+dr).append(new Option(value, key));
                });
              },
              error: function () {
                $('#errors').text("There was an error processing your request. Please try again.");
              }
            });
          }
        });
      };
      Subnational.loadSubnationalLevels($('#edit-field-country').val());
    }
  };
}(jQuery));