/* Campaign */
var campaign = $.ajax({
  url:base_url+"index.php/campaign/get_list",
  dataType: 'json',
  async: false,
  success:function(str){
    return str;
  }
}).responseText;

$('#builder').queryBuilder({
    filters: [
      {
        id: 'campaign_id',
        label: 'Campaign',
        type: 'integer',
        input: 'select',
        placeholder: 'Select campaign',
        values: JSON.parse(campaign),
        operators: ['equal', 'not_equal', 'is_null', 'is_not_null']
      },
    ]
});
$('.parse-sql').on('click', function() {
  var res = $('#builder').queryBuilder('getSQL', $(this).data('stmt'), false);
  $('#result').removeClass('hide')
    .find('pre').html(
      res.sql + (res.params ? '\n\n' + JSON.stringify(res.params, undefined, 2) : '')
    );
});
