/* eslint-disable no-unused-vars */

import Stepper from 'bs-stepper'
import { isEmail, isName, getUserIdentySize, isCitySelected, isDistrictSelected, isSchoolSelected, isSubjectSelected, isPhone, isCellPhone } from '../util/helpers';

export default {
  init() {

    $('#user-city').attr('required', 'true');
    $('#user-district').attr('required', 'true');
    $('#user-school').attr('required', 'true');
    $('#user-subject').attr('required', 'true');

    var stepperForm;
    var stepperFormEl = document.querySelector('#stepperFormAkilli')
    stepperForm = new Stepper(stepperFormEl);
    var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'))
    var btnPreviousList = [].slice.call(document.querySelectorAll('.btn-previous-form'))
    var stepperPanList = [].slice.call(stepperFormEl.querySelectorAll('.bs-stepper-pane'))

    //User First Panel Inputs
    var inputMailForm = document.getElementById('user-email')
    var inputUserFirstName = document.getElementById('user-first-name')
    var inputUserLastName = document.getElementById('user-last-name')
    var inputPasswordForm = document.getElementById('user-password')
    var inputPasswordRepeat = document.getElementById('user-password-repeat')

    //User Second Panel Inputs
    var inputUserCity = document.getElementById('user-city')
    var inputUserDistrict = document.getElementById('user-district')
    var inputUserSchool = document.getElementById('user-school')
    var inputUserSubject = document.getElementById('user-subject')
    var inputUserPhone = document.getElementById('user-phone')

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

      if (
        (stepperPan.getAttribute('id') === 'test-form-1' && (!inputMailForm.value.length || !isEmail(inputMailForm.value)))
        || (stepperPan.getAttribute('id') === 'test-form-1' && (!inputUserFirstName.value.length || !isName(inputUserFirstName.value)))
        || (stepperPan.getAttribute('id') === 'test-form-1' && (!inputUserLastName.value.length || !isName(inputUserLastName.value)))
        || (stepperPan.getAttribute('id') === 'test-form-1' && !inputPasswordForm.value.length)
        || (stepperPan.getAttribute('id') === 'test-form-1' && !inputPasswordRepeat.value.length)
        || (stepperPan.getAttribute('id') === 'test-form-1' && (!(getUserIdentySize() > 0 )))

        || (stepperPan.getAttribute('id') === 'test-form-2' && (!inputUserCity.value.length || !isCitySelected(inputUserCity)))
        || (stepperPan.getAttribute('id') === 'test-form-2' && (!inputUserDistrict.value.length || !isDistrictSelected(inputUserDistrict)))
        || (stepperPan.getAttribute('id') === 'test-form-2' && (!inputUserSchool.value.length || !isSchoolSelected(inputUserSchool)))
        || (stepperPan.getAttribute('id') === 'test-form-2' && (!inputUserSubject.value.length || !isSubjectSelected(inputUserSubject)))
        || (stepperPan.getAttribute('id') === 'test-form-2' && (!inputUserPhone.value.length || !isCellPhone(inputUserPhone.value)))

      ) {
        event.preventDefault()
        form.classList.add('was-validated')
      }
    })

    //imagePreview handler

    $(function () {

      $(document).on('change', '.uploadFile', function () {
        var uploadFile = $(this);
        //console.log(uploadFile);
        // eslint-disable-next-line no-extra-boolean-cast
        var files = !!this.files ? this.files : [];
        var fileSize = 3 * 1024 * 1024;
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test(files[0].type)) { // only image file

          if (files[0].size < fileSize) {
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function () { // set image data as background of div
              //alert(uploadFile.closest('.upimage').find('.imagePreview').length);
              uploadFile.closest('.imgUp').find('.imagePreview').css('background-image', 'url(' + this.result + ')');
            }
          } else {
            alert('Lütfen 3mb\'den küçük resim seçiniz.');
            return;

          }
          //console.log('getUserIdentySize', getUserIdentySize());
        }

      });


    });


  },
  finalize() {

  },
};
