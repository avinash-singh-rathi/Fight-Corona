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
  await getSubDistricts();
  var subdistrict = $('#subdistrictme').val();
  $('.subdistrict-select option[value="'+subdistrict+'"]').prop('selected', true);
  await getCities();
  var city = $('#cityme').val();
  $('.city-select option[value="'+city+'"]').prop('selected', true);
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

function getSubDistricts(){
  return new Promise(resolve => {
    var district_id=$('#district_id').val();
    var $select = $('#subdistrict_id');
    $select.find('option').remove();
    if(district_id != null || district_id != undefined || district_id != ''){
      $.get('/country/state/district/subdistricts', {district_id:district_id}, function (data, textStatus, jqXHR) {
        $select.append('<option value="">Select Sub District</option>');
        $.each(data.data,function(key, value)
        {
            $select.append('<option value=' + value.id + '>' + value.name + '</option>');
        });
        resolve('resolved');
      });
    }else{
      $('#subdistrict_id').val('');
      resolve('resolved');
    }
  });
}


function getCities(){
  return new Promise(resolve => {
    var subdistrict_id=$('#subdistrict_id').val();
    var $select = $('#city_id');
    $select.find('option').remove();
    if(subdistrict_id != null || subdistrict_id != undefined || subdistrict_id != ''){
      $.get('/country/state/district/subdistrict/cities', {subdistrict_id:subdistrict_id}, function (data, textStatus, jqXHR) {
        $select.append('<option value="">Select City</option>');
        $.each(data.data,function(key, value)
        {
            $select.append('<option value=' + value.id + '>' + value.name + '</option>');
        });
        resolve('resolved');
      });
    }else{
      $('#city_id').val('');
      resolve('resolved');
    }
  });
}
