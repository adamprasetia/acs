$(document).ready(function(){
  $.ajax({
    url:base_url+'index.php/individual/query_builder',
    type:'post',
    dataType:'json',
    success:function(str){
      $('#builder').queryBuilder({  
        filters:str
      });  
    }
  });

  $('.parse-sql').on('click', function() {
    var res = $('#builder').queryBuilder('getSQL', $(this).data('stmt'), false);
    $('#result').removeClass('hide')
    .find('pre').html(
      res.sql + (res.params ? '\n\n' + JSON.stringify(res.params, undefined, 2) : '')
    );
    var query = res.sql + (res.params ? '\n\n' + JSON.stringify(res.params, undefined, 2) : '');
    $('#get-data').attr('href',base_url+'index.php/individual?query='+fixedEncodeURIComponent(query));
    //console.log(res.sql + (res.params ? '\n\n' + JSON.stringify(res.params, undefined, 2) : ''));
    $.ajax({
      url:base_url+'index.php/individual/query_builder_calculate?query='+encodeURI(query),
      type:'post',
      success:function(str){
        console.log(str);
        $('#query-result-label').html(' Query Result = '+str+' Rows');
      }
    });
  });

  function fixedEncodeURIComponent (str) {
    return encodeURIComponent(str).replace(/[!'()*]/g, escape);
  }  
});