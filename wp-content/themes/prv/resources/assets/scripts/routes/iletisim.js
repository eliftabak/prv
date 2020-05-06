export default {
  init() {

    $('#form-submit-contact').click(function(e) {

      // Fetch form to apply custom Bootstrap validation
      var form = $('#contactForm')

      if (form[0].checkValidity() === false) {
        e.preventDefault()
        e.stopPropagation()
      }

      form.addClass('was-validated');
      // Perform ajax submit here...

  });

  },
};
