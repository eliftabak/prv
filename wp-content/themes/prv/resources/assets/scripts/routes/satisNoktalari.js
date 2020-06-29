/* eslint-disable no-undef */
import { generateMap } from '../util/satisNoktalariMaps';

export default {
  init() {


    // ÖRNEK DATA
    //  const dataList = [{
    //  'dealerName': 'Elif Kitabevi',
    //  'dealerShopPhone': '02161082238',
    //  'dealerMobilePhone': '05531082238',
    //  'dealerAdress': 'Doğu Mah. Namık Kemal Cad. 17/A Pendik / İSTANBUL',
    //  'dealerLat': 40.879511,
    //  'dealerLong': 29.234516,
    //  'images': ['https://image.shutterstock.com/image-photo/white-transparent-leaf-on-mirror-260nw-1029171697.jpg',
    //    'https://miro.medium.com/max/1200/1*mk1-6aYaf_Bes1E3Imhc0A.jpeg',
    //    'https://www.w3schools.com/w3images/lights.jpg',
    //    'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg',
    //    'https://miro.medium.com/max/1200/1*mk1-6aYaf_Bes1E3Imhc0A.jpeg',
    //    'https://www.w3schools.com/w3images/lights.jpg',
    //  ],
    //},
    //];

    let data = php_vars.data;
    const districtPath = php_vars.district_path;
    const siteName = php_vars.site_name;


    data = data.map((obj) => {
      return ({
        'dealerName': obj.title,
        'dealerShopPhone': obj.shop_phone[0],
        'dealerMobilePhone': obj.cell_phone[0],
        'dealerAdress': obj.adress[0],
        'dealerLat': Number(obj.lat[0]),
        'dealerLong': Number(obj.long[0]),
        'images': Object.values(obj.pictures),
      })
    });

    generateMap(data, districtPath,siteName);

  },
  finalize() {
  },
};
