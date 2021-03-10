function check_all(){
  $('input[class="item_checkbox"]:checkbox').each(function(){

if($('input[class="check_all"]:checkbox:checked').length == 0){

  $(this).prop('checked', false);

}else{

  $(this).prop('checked', true);
  
}

  });
}


function delete_all(){

    $(document).on('click', '.del_all', function(){
        $('#form_delete').submit();
    });
    
  
}

$(document).on('click', '.delBtn', function(){
  var items_checked = $('input[class="item_checkbox"]:checkbox').filter(':checked').length;

  if(items_checked > 0){

      $('.full_delete').removeClass('hidden');
      $('.delete_count').text(items_checked);
      $('.empty_delete').addClass('hidden');

  }else{
      $('.full_delete').addClass('hidden');
      $('.empty_delete').removeClass('hidden');

  }

      $('#multiDelete').modal('show');
});