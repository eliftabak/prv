
(function ($) {

  $(document).ready(function () {


    function resetCity() {

      $city.find("option").remove();

    }

    function resetDistrict() {

      $district.find("option").remove();

    }

    const state = {}

    const $city = $('#prv_dealer_shop_city');
    const $district = $('#prv_dealer_shop_district');

    const site_name =  php_vars.site_name;
    const city_path = php_vars.city_path;
    const district_path = php_vars.district_path;;




    function getAllCities() {
      const url = `${site_name}${city_path}`;
      $.getJSON(url, function (data) {
        let index = 0;
        let cities = data.map(function (el) {
          if (index === 0) {
            index += 1;
            return `<option value="" hidden selected="selected">İl seçiniz...</option>
                <option value="${el.city_id}" selected="selected">${el.name}</option>`
            state.cityId = el.city_id;
          } else {
            return `<option value="${el.city_id}">${el.name}</option>`
          }
        })
        cities = cities.join('');
        resetCity();
        $city.append(cities);
      });
    }


    //getAllCities();


    function getDistrictById() {
      const url = `${site_name}${district_path}?city=${state.cityId}`;
      console.log(url);
      $.getJSON(url, function (data) {
        let index = 0;
        let districts = data.map(function (el) {
          if (index === 0) {
            index += 1;
            return `<option value="" hidden selected="selected">İlçe seçiniz...</option>
                <option value="${el.district_id}" selected="selected">${el.name}</option>`
            state.districtId = el.district_id;
          } else {
            return `<option value="${el.district_id}">${el.name}</option>`
          }
        })
        districts = districts.join('');
        resetDistrict();
        $district.append(districts);
      });
    }

    $city.on('change', function () {

      const id = $(this).find("option").filter(':selected').val();

      state.cityId = id;

      getDistrictById();

    })



    $district.on('change', function () {

      const id = $(this).find("option").filter(':selected').val();

      state.districtId = id;

    })

  });

})(jQuery);
