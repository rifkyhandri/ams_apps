(function($) {
  'use strict';

  // if ($(".js-example-basic-single").length) {
  //   $(".js-example-basic-single").select2();
  // }
  $("#regdepreciation").select2({
      tags: true,
      width: '19rem',
      dropdownParent: $("#formInputAssetRegister")
  });

  $("#regtagging").select2({
    tags: true,
    width: '19rem',
    dropdownParent: $("#formInputAssetRegister")
  });

 $("#Updateregdepreciation").select2({
    tags: true,
    width: '19rem',
    dropdownParent: $("#formUpdateAssetRegister")
  });

  $("#Updateregtagging").select2({
    tags: true,
    width: '19rem',
    dropdownParent: $("#formUpdateAssetRegister")
  });
  // if ($(".js-example-basic-single").length) {
  //   $(".js-example-basic-single").select2();
  // }

  if ($(".js-example-basic-multiple").length) {
    $(".js-example-basic-multiple").select2();
  }
})(jQuery);