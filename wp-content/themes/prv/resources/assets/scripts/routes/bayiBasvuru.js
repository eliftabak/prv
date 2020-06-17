/* eslint-disable no-unused-vars */

import Stepper from 'bs-stepper'
import {
  isEmail,
  isPhone,
  isName,
  isVergiDaire,
  isVergiNum,
  isAdress,
  isValidCompanyName,
  isCitySelected,
  isDistrictSelected,
  isNum,
} from '../util/helpers';

export default {
  init() {

    $('#company-city').attr('required', 'true');
    $('#company-district').attr('required', 'true');
    $('#dealer-city').attr('required', 'true');
    $('#dealer-district').attr('required', 'true');

    var stepperForm;
    var stepperFormEl = document.querySelector('#stepperFormBayi')
    stepperForm = new Stepper(stepperFormEl);
    var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'))
    var btnPreviousList = [].slice.call(document.querySelectorAll('.btn-previous-form'))
    var stepperPanList = [].slice.call(stepperFormEl.querySelectorAll('.bs-stepper-pane'))

    //Personel Inputs
    var inputPersonelEmail = document.getElementById('personel-email')
    var inputPersonelFirstname = document.getElementById('personel-first-name')
    var inputPersonelLastName = document.getElementById('personel-last-name')
    var inputPersonelPhone = document.getElementById('personel-phone')

    //Company Inputs
    var inputCompanyName = document.getElementById('company-name')
    var inputCompanyPhone = document.getElementById('company-phone')
    var inputCompanyTaxOffice = document.getElementById('company-tax-office')
    var inputCompanyTaxNumber = document.getElementById('company-tax-number')
    var inputCompanyCity = document.getElementById('company-city')
    var inputCompanyDistrict = document.getElementById('company-district')
    var inputCompanyAdress = document.getElementById('company-adress')

    //Dealer Inputs
    var inputDealerCity = document.getElementById('dealer-city')
    var inputDealerDistrict = document.getElementById('dealer-district')
    var inputDealerWorkStyle = document.getElementById('dealer-work-style')
    var inputDealerProductCategory = document.getElementById('dealer-product-category')
    var inputDealerPublishing = document.getElementById('dealer-publishing')
    var inputDealerFieldPersonel = document.getElementById('dealer-field-personel')
    var inputDealerHistory = document.getElementById('dealer-history')


    var form = stepperFormEl.querySelector('.bs-stepper-content form')

    btnNextList.forEach(function (btn) {
      btn.addEventListener('click', function () {
        stepperForm.next();
      })
    })

    btnPreviousList.forEach(function (btn) {
      btn.addEventListener('click', function () {
        stepperForm.previous();
      })
    })


    stepperFormEl.addEventListener('show.bs-stepper', function (event) {
      form.classList.remove('was-validated')
      var nextStep = event.detail.indexStep
      var currentStep = nextStep

      if (currentStep > 0) {
        currentStep--
      }

      var stepperPan = stepperPanList[currentStep]

      if ((stepperPan.getAttribute('id') === 'test-form-1' && (!inputPersonelEmail.value.length || !isEmail(inputPersonelEmail.value)))
        || (stepperPan.getAttribute('id') === 'test-form-1' && (!inputPersonelFirstname.value.length || !isName(inputPersonelFirstname.value)))
        || (stepperPan.getAttribute('id') === 'test-form-1' && (!inputPersonelLastName.value.length || !isName(inputPersonelLastName.value)))
        || (stepperPan.getAttribute('id') === 'test-form-1' && (!inputPersonelPhone.value.length || !isPhone(inputPersonelPhone.value)))

        || (stepperPan.getAttribute('id') === 'test-form-2' && (!inputCompanyName.value.length || !isValidCompanyName(inputCompanyName.value)))
        || (stepperPan.getAttribute('id') === 'test-form-2' && (!inputCompanyPhone.value.length || !isPhone(inputCompanyPhone.value)))
        || (stepperPan.getAttribute('id') === 'test-form-2' && (!inputCompanyTaxOffice.value.length || !isVergiDaire(inputCompanyTaxOffice.value)))
        || (stepperPan.getAttribute('id') === 'test-form-2' && (!inputCompanyTaxNumber.value.length || !isVergiNum(inputCompanyTaxNumber.value)))
        || (stepperPan.getAttribute('id') === 'test-form-2' && (!inputCompanyCity.value.length || !isCitySelected(inputCompanyCity)))
        || (stepperPan.getAttribute('id') === 'test-form-2' && (!inputCompanyDistrict.value.length || !isDistrictSelected(inputCompanyCity)))
        || (stepperPan.getAttribute('id') === 'test-form-2' && (!inputCompanyAdress.value.length || !isAdress(inputCompanyAdress.value)))

        || (stepperPan.getAttribute('id') === 'test-form-3' && (!inputDealerCity.value.length || !isCitySelected(inputDealerCity)))
        || (stepperPan.getAttribute('id') === 'test-form-3' && (!inputDealerDistrict.value.length || !isDistrictSelected(inputDealerDistrict)))
        || (stepperPan.getAttribute('id') === 'test-form-3' && (!inputDealerWorkStyle.value.length || !isAdress(inputDealerWorkStyle.value)))
        || (stepperPan.getAttribute('id') === 'test-form-3' && (!inputDealerPublishing.value.length || !isAdress(inputDealerPublishing.value)))
        || (stepperPan.getAttribute('id') === 'test-form-3' && (!inputDealerFieldPersonel.value.length || !isNum(inputDealerFieldPersonel.value)))
        || (stepperPan.getAttribute('id') === 'test-form-3' && (!inputDealerHistory.value.length || !isAdress(inputDealerHistory.value)))) {

          event.preventDefault()
        form.classList.add('was-validated')
      }
    })



  },
  finalize() {

  },
};
