/* eslint-disable no-unused-vars */

import Stepper from 'bs-stepper'
import {
  isEmail,
  isName,
  getUserIdentySize,
  isCitySelected,
  isDistrictSelected,
  isSchoolSelected,
  isSubjectSelected,
  isPhone,
  isCellPhone,
} from '../util/helpers';

export default {
  init() {


    $('#user-city').attr('required', 'true');
    $('#user-district').attr('required', 'true');
    $('#user-school').attr('required', 'true');
    $('#user-subject').attr('required', 'true');



    if ($('#stepperFormAkilliRegister').length) {

      (function () {
        var registerStepperForm;
        var registerFrom = document.querySelector('#stepperFormAkilliRegister')
        registerStepperForm = new Stepper(registerFrom);
        var btnNextList = [].slice.call(registerFrom.querySelectorAll('.btn-next-form'))
        var btnPreviousList = [].slice.call(registerFrom.querySelectorAll('.btn-previous-form'))
        var stepperPanList = [].slice.call(registerFrom.querySelectorAll('.bs-stepper-pane'))

        //User First Panel Inputs
        var inputUserMail = registerFrom.querySelector('#user-email')
        var inputUserFirstName = registerFrom.querySelector('#user-first-name')
        var inputUserLastName = registerFrom.querySelector('#user-last-name')
        var inputPasswordForm = registerFrom.querySelector('#user-password')
        var inputPasswordRepeat = registerFrom.querySelector('#user-password-repeat')

        //User Second Panel Inputs
        var inputUserCity = registerFrom.querySelector('#user-city')
        var inputUserDistrict = registerFrom.querySelector('#user-district')
        var inputUserSchool = registerFrom.querySelector('#user-school')
        var inputUserSubject = registerFrom.querySelector('#user-subject')
        var inputUserPhone = registerFrom.querySelector('#user-phone')

        var form = registerFrom.querySelector('.bs-stepper-content form')

        btnNextList.forEach(function (btn) {
          btn.addEventListener('click', function () {
            registerStepperForm.next();
          })
        })

        btnPreviousList.forEach(function (btn) {
          btn.addEventListener('click', function () {
            registerStepperForm.previous();
          })
        })

        registerFrom.addEventListener('show.bs-stepper', function (event) {
          form.classList.remove('was-validated')
          var nextStep = event.detail.indexStep
          var currentStep = nextStep

          if (currentStep > 0) {
            currentStep--
          }

          var stepperPan = stepperPanList[currentStep]

          if (
            (stepperPan.getAttribute('id') === 'test-form-1' && (!inputUserMail.value.length || !isEmail(inputUserMail.value)))
            || (stepperPan.getAttribute('id') === 'test-form-1' && (!inputUserFirstName.value.length || !isName(inputUserFirstName.value)))
            || (stepperPan.getAttribute('id') === 'test-form-1' && (!inputUserLastName.value.length || !isName(inputUserLastName.value)))
            || (stepperPan.getAttribute('id') === 'test-form-1' && !inputPasswordForm.value.length)
            || (stepperPan.getAttribute('id') === 'test-form-1' && !inputPasswordRepeat.value.length)
            || (stepperPan.getAttribute('id') === 'test-form-1' && (!(getUserIdentySize() > 0)))

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

      })();

    }



    if ($('#stepperFormAkilliBecomeTeacher').length) {

      (function () {

        var becomeTeacherStepperForm;
        var becomeTeacherForm = document.querySelector('#stepperFormAkilliBecomeTeacher')
        becomeTeacherStepperForm = new Stepper(becomeTeacherForm);
        var btnNextList = [].slice.call(becomeTeacherForm.querySelectorAll('.btn-next-form'))
        var btnPreviousList = [].slice.call(becomeTeacherForm.querySelectorAll('.btn-previous-form'))
        var stepperPanList = [].slice.call(becomeTeacherForm.querySelectorAll('.bs-stepper-pane'))

        //User First Panel Inputs
        var inputUserMail = becomeTeacherForm.querySelector('#user-email')
        var inputUserFirstName = becomeTeacherForm.querySelector('#user-first-name')
        var inputUserLastName = becomeTeacherForm.querySelector('#user-last-name')
        var inputPasswordForm = becomeTeacherForm.querySelector('#user-password')
        var inputPasswordRepeat = becomeTeacherForm.querySelector('#user-password-repeat')

        //User Second Panel Inputs
        var inputUserCity = becomeTeacherForm.querySelector('#user-city')
        var inputUserDistrict = becomeTeacherForm.querySelector('#user-district')
        var inputUserSchool = becomeTeacherForm.querySelector('#user-school')
        var inputUserSubject = becomeTeacherForm.querySelector('#user-subject')
        var inputUserPhone = becomeTeacherForm.querySelector('#user-phone')

        var form = becomeTeacherForm.querySelector('.bs-stepper-content form')

        btnNextList.forEach(function (btn) {
          btn.addEventListener('click', function () {
            becomeTeacherStepperForm.next();
          })
        })

        btnPreviousList.forEach(function (btn) {
          btn.addEventListener('click', function () {
            becomeTeacherStepperForm.previous();
          })
        })

        becomeTeacherForm.addEventListener('show.bs-stepper', function (event) {
          form.classList.remove('was-validated')
          var nextStep = event.detail.indexStep
          var currentStep = nextStep

          if (currentStep > 0) {
            currentStep--
          }

          var stepperPan = stepperPanList[currentStep]

          if ((stepperPan.getAttribute('id') === 'test-form-1' && (!(getUserIdentySize() > 0)))

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

      })();

    }
    //imagePreview handler
    $('.uploadFile').on('change', function () {
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

  },
  finalize() {
  },
};
