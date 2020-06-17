export const isEmail = (email) => {
  var expr = /^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$/;
  return expr.test(email);
}

export const isPhone = (phone) =>{
  var expr = /^(0([0-9])(\d{9}))$/;
  return expr.test(phone);
}

export const isName = (name) =>{
  var expr = /^[A-Za-zğüşıöçĞÜŞİÖÇ]{2,}$/;
  return expr.test(name);
}


export const isValidCompanyName = (companyname) =>{
  var expr = /(.{10,})/;
  return expr.test(companyname);
}

export const isVergiDaire = (vergidaire) =>{
  var expr = /(^[A-Za-zğüşıöçĞÜŞİÖÇ]{2,})(.{0,}?)([A-Za-zğüşıöçĞÜŞİÖÇ]{2,})(.{0,}?)([A-Za-zğüşıöçĞÜŞİÖÇ]{2,}$)/;
  return expr.test(vergidaire);
}

export const isVergiNum = (verginum) =>{
  var expr = /^([0-9])(\d{9})$/;
  return expr.test(verginum);
}

export const isCitySelected = (html) =>{
  var expr = /^((?!İl\sseçiniz\.\.\.).)*$/;
  const el = $(html);
  const value = el.find('option:selected').text();
  return expr.test(value);
}

export const isDistrictSelected = (html) =>{
  var expr = /^((?!İlçe\sseçiniz\.\.\.).)*$/;
  const el = $(html);
  const value = el.find('option:selected').text();
  return expr.test(value);
}

export const isAdress = (adress) =>{
  var expr = /(.{15,})/;
  return expr.test(adress);
}


export const isNum = (adress) =>{
  var expr = /(\d{1,})/;
  return expr.test(adress);
}



