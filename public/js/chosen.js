(function($, window, undefined)
{
  $(document).ready(function()
  {
      var config = {
          '.chosen-select': { width: '100%'},
          '.chosen-select-deselect': {allow_single_deselect: true}
      };

      for (var selector in config) {
          $(selector).chosen(config[selector]);
      }
  });
}(jQuery, window));