(function($) {
  'use strict';

  var form = $("#example-form");
  form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onFinished: function(event, currentIndex) {
      alert("Submitted!");
    }
  });

  var assetregister = $("#formInputAssetRegister").children("div");
  assetregister.steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onFinished: function(event, currentIndex) {
      var url,new_data,form;
      var myform = $('#formInputAssetRegister');
      
      //turn off disabled
      var disabled = myform.find(':input:disabled').removeAttr('disabled');
      
      url =  'asset_register';                                   //For routing
      new_data = new FormData($('#formInputAssetRegister')[0]); // Data Form
      form = 'AssetRegister';                                  //Reset Trigger and Close Modal

      //turn on disabled
      disabled.attr('disabled','disabled');
      
      // General form insert_data(url,data,form)
      asset_register(url,new_data,form);
      // assetregister.steps('reset');
    }
  });


  var uassetregister = $("#formUpdateAssetRegister");
  uassetregister.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onFinished: function(event, currentIndex) {
      var url,update,form,data;
      var myform = $('#formUpdateAssetRegister');
      
      //turn off disabled
      var disabled = myform.find(':input:disabled').removeAttr('disabled');
      
      url =  'asset_register';                                 //For routing
      update = new FormData($('#formUpdateAssetRegister')[0]); // Data Form
      form = 'AssetRegister';                                  //Reset Trigger and Close Modal

      //turn on disabled
      disabled.attr('disabled','disabled');

      // General form insert_data(url,data,form)
      uasset_register(url,update,form);
    }
  });

  var validationForm = $("#example-validation-form");
  validationForm.val({
    errorPlacement: function errorPlacement(error, element) {
      element.before(error);
    },
    rules: {
      confirm: {
        equalTo: "#password"
      }
    }
  });
  validationForm.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function(event, currentIndex, newIndex) {
      validationForm.val({
        ignore: [":disabled", ":hidden"]
      })
      return validationForm.val();
    },
    onFinishing: function(event, currentIndex) {
      validationForm.val({
        ignore: [':disabled']
      })
      return validationForm.val();
    },
    onFinished: function(event, currentIndex) {
      alert("Submitted!");
    }
  });

  var verticalForm = $("#example-vertical-wizard");
  verticalForm.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    stepsOrientation: "vertical",
    onFinished: function(event, currentIndex) {
      alert("Submitted!");
    }
  });

})(jQuery);