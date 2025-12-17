 $("#myForm").submit(function (e) {
   const email = $("#email").val();
   if (!email.includes("@")) {
     alert("Invalid email!");
     e.preventDefault();
   }
 });
 $("#myForm").validate({
   rules: {
     email: {
       required: true,
       email: true
     },
     password: {
       required: true,
       minlength: 8
     }
   },
   messages: {
     email: "Please enter a valid email address",
     password: "Minimum 8 characters"
   }
 });
$("#myForm").submit(function (e) {
   e.preventDefault();
    if (!$(this).valid()) {
     return; // Stop if form is invalid
   }
    $.blockUI({ message: '<h1>Processing...</h1>' });
    $.ajax({
     url: "/submit-form",
     method: "POST",
     data: $(this).serialize(),
     success: function (response) {
       alert("Form submitted successfully!");
     },
     error: function () {
       alert("Error submitting form.");
     },
     complete: function () {
       $.unblockUI();
     }
   });
 });
