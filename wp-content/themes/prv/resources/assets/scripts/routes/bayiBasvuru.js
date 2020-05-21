/* eslint-disable no-unused-vars */

import Stepper from  'bs-stepper'
import {isEmail} from '../util/helpers';

export default {
  init() {

    var stepperForm;
    var stepperFormEl = document.querySelector('#stepperFormBayi')
    stepperForm = new Stepper(stepperFormEl);
    var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'))
    var btnPreviousList = [].slice.call(document.querySelectorAll('.btn-previous-form'))
    var stepperPanList = [].slice.call(stepperFormEl.querySelectorAll('.bs-stepper-pane'))
    var inputMailForm = document.getElementById('user-email')
    var inputUserDisplayName = document.getElementById('user-display-name')
    var inputUserFirstName = document.getElementById('user-first-name')
    var inputUserLastName = document.getElementById('user-last-name')
    var inputPasswordForm = document.getElementById('user-password')
    var inputPasswordRepeat = document.getElementById('user-password-repeat')
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

  },
  finalize() {

  },
};
