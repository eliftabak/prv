/* eslint-disable no-unused-vars */
/* eslint-disable no-undef */

import { drawGallery } from '../util/satisNoktalariPhotoGallery';

export const markerContentGenerator = (dealerInfo) => {
  const telPrefix = '+90';
  const { dealerName, dealerShopPhone, dealerMobilePhone, dealerAdress, dealerLat, dealerLong } = dealerInfo;
  return `
  <div class="marker-window">
  <h5 class="marker-window__title">${dealerName}</h5>
  <ul class="marker-window__list">
  <li><strong>Mağaza Tel :</strong> <a href="tel:${telPrefix}${dealerShopPhone}">${dealerShopPhone}</a></li>
  <li><strong>Cep Tel :</strong>  <a href="tel:${telPrefix}${dealerMobilePhone}">${dealerMobilePhone}</a></li>
  <li><strong>Adres :</strong> ${dealerAdress}</li>
  <li><a class="text-info" href="https://www.google.com/maps/dir/Current+Location/${dealerLat},${dealerLong}" target="_blank">Yol Tarifi</a></li>
  </ul>
  <div>`
}

export const dataGenerator = (dataList) => {

  const data = [];

  dataList.forEach(obj => {

    data.push([markerContentGenerator(obj), obj.dealerLat, obj.dealerLong, [...obj.images]]);

  });
  return data

}

export const generateMap = (listData, districtPath, lat = 39.0156232, long = 35.3641027) => {

  var geocoder = new google.maps.Geocoder();

  const $dealerCity = $('#dealer-city');
  const $dealerDistrict = $('#dealer-district');
  const data = dataGenerator(listData);

  var map = new google.maps.Map(document.getElementById('bayi-map'), {
    zoom: 5.8,
    center: new google.maps.LatLng(lat, long),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
  });

  var infowindow = new google.maps.InfoWindow();

  var marker, i;
  for (i = 0; i < data.length; i++) {
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(data[i][1], data[i][2]),
      map: map,
      title: 'Bayi',
      icon: 'http://cdn.com/my-custom-icon.png',
    });

    google.maps.event.addListener(marker, 'click', (function (marker, i) {
      return function () {
        infowindow.setContent(data[i][0]);
        infowindow.open(map, marker);
        drawGallery(data[i][3]);
      }
    })(marker, i));
  }

  function resetDistrict() {

    $dealerDistrict.find('option').remove();

  }

  function getDistrictById(id) {
    const url = `${districtPath}?city=${id}`;
    $.getJSON(url, function (data) {
      let index = 0;
      let districts = data.map(function (el) {
        if (index === 0) {
          index += 1;
          return `<option value="" selected="selected">İlçe seçiniz...</option>
                  <option value="${el.district_id}" selected="selected">${el.name}</option>`
        } else {
          return `<option value="${el.district_id}">${el.name}</option>`
        }
      })
      districts = districts.join('');
      resetDistrict();
      $dealerDistrict.append(districts);
    });
  }

  $dealerCity.change(function () {

    const cityName = $(this).find('option:selected').text();
    const cityId = $(this).find('option:selected').val();
    getDistrictById(cityId);

    geocoder.geocode({ 'address': cityName + 'Türkiye' }, function (results, status) {
      if (status === 'OK') {
        map.setCenter(results[0].geometry.location);
        map.setZoom(10);
      } else {
        console.error('Geocode was not successful for the following reason: ' + status);
      }
    });

  })

  $dealerDistrict.change(function () {

    const cityName = $dealerCity.find('option:selected').text();

    const districtName = $(this).find('option:selected').text();

    geocoder.geocode({ 'address': cityName + districtName + 'Türkiye' }, function (results, status) {
      if (status === 'OK') {
        map.setCenter(results[0].geometry.location);
        map.setZoom(12);
      } else {
        console.error('Geocode was not successful for the following reason: ' + status);
      }
    });

  })
}
