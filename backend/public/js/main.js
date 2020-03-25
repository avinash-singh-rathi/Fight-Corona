function ConfirmDelete()
{
  var x = confirm("Are you sure you want to delete?");
  if (x)
    return true;
  else
    return false;
}

$(document).ready(function(){
  loadPreviousState();
});

async function loadPreviousState(){
  await getStates();
  var state=$('#stateme').val();
  $('.state-select option[value="'+state+'"]').prop('selected', true);
  await getDistricts();
  var district = $('#districtme').val();
  $('.district-select option[value="'+district+'"]').prop('selected', true);
}

function getStates(){
  return new Promise(resolve => {
    var country_id=$('#country_id').val();
    var $select = $('#state_id');
    $select.find('option').remove();
    if(country_id != null || country_id != undefined || country_id != ''){
      $.get('/country/states', {country_id:country_id}, function (data, textStatus, jqXHR) {
        console.log(data);
        $select.append('<option value="">Select State</option>');
        $.each(data.data,function(key, value)
        {
            $select.append('<option value=' + value.id + '>' + value.name + '</option>');
        });
        resolve('resolved');
      });
    }else{
      $('#state_id').val('');
      resolve('resolved');
    }
  });
}

function getDistricts(){
  return new Promise(resolve => {
    var state_id=$('#state_id').val();
    var $select = $('#district_id');
    $select.find('option').remove();
    if(state_id != null || state_id != undefined || state_id != ''){
      $.get('/country/state/districts', {state_id:state_id}, function (data, textStatus, jqXHR) {
        $select.append('<option value="">Select District</option>');
        $.each(data.data,function(key, value)
        {
            $select.append('<option value=' + value.id + '>' + value.name + '</option>');
        });
        resolve('resolved');
      });
    }else{
      $('#district_id').val('');
      resolve('resolved');
    }
  });
}
