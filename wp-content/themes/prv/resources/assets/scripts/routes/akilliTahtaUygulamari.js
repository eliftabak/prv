
import Stepper from  'bs-stepper'

export default {
  init() {

    var stepperForm;
    var stepperFormEl = document.querySelector('#stepperForm')
    stepperForm = new Stepper(stepperFormEl);
    var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'))
    var btnPreviousList = [].slice.call(document.querySelectorAll('.btn-previous-form'))
    var stepperPanList = [].slice.call(stepperFormEl.querySelectorAll('.bs-stepper-pane'))
    var inputMailForm = document.getElementById('inputMailForm')
    var inputPasswordForm = document.getElementById('inputPasswordForm')
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

      if ((stepperPan.getAttribute('id') === 'test-form-1' && !inputMailForm.value.length)
      || (stepperPan.getAttribute('id') === 'test-form-2' && !inputPasswordForm.value.length)) {
        event.preventDefault()
        form.classList.add('was-validated')
      }
    })

    //imagePreview handler

    $(function() {
        $(document).on('change','.uploadFile', function()
        {
            var uploadFile = $(this);
            console.log(uploadFile);
            // eslint-disable-next-line no-extra-boolean-cast
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file

                reader.onloadend = function(){ // set image data as background of div
                  //alert(uploadFile.closest('.upimage').find('.imagePreview').length);
                  uploadFile.closest('.imgUp').find('.imagePreview').css('background-image', 'url('+this.result+')');
                }
            }

        });
    });


  },
  finalize() {

  },
};
