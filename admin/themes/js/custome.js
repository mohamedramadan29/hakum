/** @format */

$(document).ready(function () {
  $(".customer_menu").click(function () {
    $(".child_menu").slideToggle();
  });

  $(".mynavitem").click(function () {
    $("this").hide();
  });
  /*  HIDE BUTTON WHEN CLICK  */

  // START CONFIRM MESSAGE
  $(".confirm").click(function () {
    return confirm(" هل تريد حذف هذا العنصر ");
  });

  $(".btn_image").click(function () {
    $(".image_info").css("top", "0px");
  });

  $(".add_new_rental_accident").click(function () {
    $(".add_rental_accident").css("top", "100px");
    $(".overflow").css("display", "block");
  });
  $(".closebtn").click(function () {
    $(".add_rental_accident").css("top", "-900px");
    $(".overflow").css("display", "none");
  });

  $(".add_new_payment_accident").click(function () {
    $(".add_payment_accident").css("top", "100px");
    $(".overflow").css("display", "block");
  });
  $(".closebtn").click(function () {
    $(".add_payment_accident").css("top", "-900px");
    $(".overflow").css("display", "none");
  });
  ////// show payment customer
  $(".show_payment_customer").click(function () {
    $(".show_new_payment_customer").css("top", "100px");
    $(".overflow").css("display", "block");
  });
  $(".closebtn").click(function () {
    $(".show_new_payment_customer").css("top", "-900px");
    $(".overflow").css("display", "none");
  });

  ////// show infraction
  $(".show_payment_customer2").click(function () {
    $(".show_new_payment_customer2").css("top", "100px");
    $(".overflow").css("display", "block");
  });
  $(".closebtn").click(function () {
    $(".show_new_payment_customer2").css("top", "-900px");
    $(".overflow").css("display", "none");
  });

  ////// show Accident
  $(".show_payment_customer3").click(function () {
    $(".show_new_payment_customer3").css("top", "100px");
    $(".overflow").css("display", "block");
  });
  $(".closebtn").click(function () {
    $(".show_new_payment_customer3").css("top", "-900px");
    $(".overflow").css("display", "none");
  });

  $(".savebutton").click(function () {
    $(".image_info").css("top", "-600px");
  });
  $(".printbtn").click(function () {
    var mode = "iframe";
    var close = mode == "popup";
    var options = { mode: mode, popClose: close };
    $(".print_content").printArea(options);
  });
  $(".new_select").select2();
  // loader
  var loader = function () {
    setTimeout(function () {
      if ($("#ftco-loader").length > 0) {
        $("#ftco-loader").removeClass("show");
      }
    }, 1);
  };
  loader();

  var dev = $("#logo").dropify({});
  dev = dev.data("dropify");
  var dev2 = $("#logo2").dropify({});
  dev2 = dev2.data("dropify");
  var dev3 = $("#logo3").dropify({});
  dev3 = dev3.data("dropify");
  var dev4 = $("#logo4").dropify({});
  dev4 = dev4.data("dropify");
  var dev5 = $(".logo2").dropify({});
  dev5 = dev5.data("dropify");
  var dev = $("#logo").dropify({});
  dev.on("dropify.beforeClear", function (event, element) {
    //alert($(element).attr("data-table"));
    var data_table = $("#logo").attr("data_table");
    var col_pk = $("#logo").attr("col_pk");
    var col_val = $("#logo").attr("col_val");

    var img_column = $("#logo").attr("name");
    var data_value = $("#logo").attr("data_value");

    delete_image(data_table, col_pk, col_val, img_column, data_value);
  });

  var dev2 = $("#logo2").dropify({});
  dev2.on("dropify.beforeClear", function (event, element) {
    //alert($(element).attr("data-table"));
    var data_table = $("#logo2").attr("data_table");
    var col_pk = $("#logo2").attr("col_pk");
    var col_val = $("#logo2").attr("col_val");

    var img_column = $("#logo2").attr("name");
    var data_value = $("#logo2").attr("data_value");

    delete_image(data_table, col_pk, col_val, img_column, data_value);
  });
  var dev3 = $("#logo3").dropify({});
  dev3.on("dropify.beforeClear", function (event, element) {
    //alert($(element).attr("data-table"));
    var data_table = $("#logo3").attr("data_table");
    var col_pk = $("#logo3").attr("col_pk");
    var col_val = $("#logo3").attr("col_val");

    var img_column = $("#logo3").attr("name");
    var data_value = $("#logo3").attr("data_value");

    delete_image(data_table, col_pk, col_val, img_column, data_value);
  });
  var dev4 = $("#logo4").dropify({});
  dev4.on("dropify.beforeClear", function (event, element) {
    //alert($(element).attr("data-table"));
    var data_table = $("#logo4").attr("data_table");
    var col_pk = $("#logo4").attr("col_pk");
    var col_val = $("#logo4").attr("col_val");

    var img_column = $("#logo4").attr("name");
    var data_value = $("#logo4").attr("data_value");

    delete_image(data_table, col_pk, col_val, img_column, data_value);
  });


  // START NEW WEB SITE EDUCTION

  // START WHATSAPP
  if (window.location.href.indexOf("dir=whatsapp") != -1) {
    $("#lnk-whatsapp").addClass("active menu-is-opening menu-open");
    if (window.location.href.indexOf("add") != -1) {
      $("#lnk-add-whatsapp").addClass("active-tab");
    } else {
      $("#lnk-rep-whatsapp").addClass("active-tab");
    }
  }

  // END WHATSAPP
  // START COUNTRY
  if (window.location.href.indexOf("dir=country") != -1) {
    $("#lnk-country").addClass("active menu-is-opening menu-open");
    if (window.location.href.indexOf("add") != -1) {
      $("#lnk-add-country").addClass("active-tab");
    } else {
      $("#lnk-rep-country").addClass("active-tab");
    }
  }

  // END COUNTRY

  // END WHATSAPP
  // START COUNTRY
  if (window.location.href.indexOf("dir=coashes") != -1) {
    $("#lnk-coash").addClass("active menu-is-opening menu-open");
    if (window.location.href.indexOf("add") != -1) {
      $("#lnk-add-coash").addClass("active-tab");
    } else {
      $("#lnk-rep-coash").addClass("active-tab");
    }
  }
  // START BATCHES
  if (window.location.href.indexOf("dir=batches") != -1) {
    $("#lnk-batches").addClass("active menu-is-opening menu-open");
    if (window.location.href.indexOf("add") != -1) {
      $("#lnk-rep-batch").addClass("active-tab");
    } else {
      $("#lnk-rep-coash").addClass("active-tab");
    }
  }
  // START REVIEW
  if (window.location.href.indexOf("dir=review") != -1) {
    $("#lnk-review").addClass("active menu-is-opening menu-open");
    if (window.location.href.indexOf("add") != -1) {
      $("#lnk-rep-review").addClass("active-tab");
    } else {
      $("#lnk-rep-review2").addClass("active-tab");
    }
  }
  // END courses

  // START CUSTOMER
  if (window.location.href.indexOf("dir=customer") != -1) {
    $("#lnk-customer").addClass("active menu-is-opening menu-open");
    if (window.location.href.indexOf("add") != -1) {
      $("#lnk-add-customer").addClass("active-tab");
    } else {
      $("#lnk-rep-customer").addClass("active-tab");
    }
  }

  // END CUSTOMER

  // START DEGREEE
  if (window.location.href.indexOf("dir=degree") != -1) {
    $("#lnk-degree").addClass("active menu-is-opening menu-open");
    if (window.location.href.indexOf("add") != -1) {
      $("#lnk-add-degree").addClass("active-tab");
    } else {
      $("#lnk-rep-degree").addClass("active-tab");
    }
  }

  // END DEGRESS

  // START NEWS
  if (window.location.href.indexOf("dir=news") != -1) {
    $("#lnk-news").addClass("active menu-is-opening menu-open");
    if (window.location.href.indexOf("add") != -1) {
      $("#lnk-add-news").addClass("active-tab");
    } else {
      $("#lnk-rep-news").addClass("active-tab");
    }
  }

  // END NEWS

  // START SPECIALIST
  if (window.location.href.indexOf("dir=specialist") != -1) {
    $("#lnk-specialist").addClass("active menu-is-opening menu-open");
    if (window.location.href.indexOf("add") != -1) {
      $("#lnk-add-specialist").addClass("active-tab");
    } else {
      $("#lnk-rep-specialist").addClass("active-tab");
    }
  }

  // END SPECIALIST

  // START university
  if (window.location.href.indexOf("dir=university") != -1) {
    $("#lnk-university").addClass("active menu-is-opening menu-open");
    if (window.location.href.indexOf("add") != -1) {
      $("#lnk-add-university").addClass("active-tab");
    } else {
      $("#lnk-rep-university").addClass("active-tab");
    }
  }

  // END university

  // START university
  if (window.location.href.indexOf("dir=users") != -1) {
    $("#lnk-users").addClass("active menu-is-opening menu-open");
    if (window.location.href.indexOf("add") != -1) {
      $("#lnk-add-users").addClass("active-tab");
    } else {
      $("#lnk-rep-users").addClass("active-tab");
    }
  }

  // END university
  // START CONTACT
  if (window.location.href.indexOf("dir=contact") != -1) {
    $("#lnk-contact").addClass("active menu-is-opening menu-open");
    if (window.location.href.indexOf("add") != -1) {
      $("#lnk-add-contact").addClass("active-tab");
    } else {
      $("#lnk-rep-contact").addClass("active-tab");
    }
  }

  // END CONTACT
  // START EXAM
  if (window.location.href.indexOf("dir=exam") != -1) {
    $("#lnk-exam").addClass("active menu-is-opening menu-open");
    if (window.location.href.indexOf("add") != -1) {
      $("#lnk-add-exam").addClass("active-tab");
    } else {
      $("#lnk-rep-exam").addClass("active-tab");
    }
  }

  // END EXAM

  // END NEW WEBSITE EDUCATION

  $(function () {
    $(".rateyo")
      .rateYo()
      .on("rateyo.change", function (e, data) {
        var rating = data.rating;
        $(this)
          .parent()
          .find(".score")
          .text("score :" + $(this).attr("data-rateyo-score"));
        $(this)
          .parent()
          .find(".result")
          .text("rating :" + rating);
        $(this).parent().find("input[name=rating]").val(rating); //add rating value to input field
      });
  });
  $(".country").select2({
    dropdownParent: $("#staticBackdrop")
  });
  $(".new_select").select2({
    dropdownParent: $(".modal")
  });

  $('select:not(.normal)').each(function () {
    $(this).select2({
      dropdownParent: $(this).parent()
    });
  });

  $('#tableone').DataTable({
    "order": [[ 0, "desc" ]],
    language: {

      "search": "ابحث:",
      "emptyTable": " لا يوجد بيانات ",
      "infoEmpty": " لا يوجد بيانات ",
      "infoFiltered": " لا يوجد بيانات ",
      "paginate": {
        "first": "الأول",
        "previous": "السابق",
        "next": "التالي",
        "last": "الأخير"
      },
      "searchBuilder": {
        "add": "اضافة شرط",
        "clearAll": "ازالة الكل",
        "condition": "الشرط",
        "data": "المعلومة",
        "logicAnd": "و",
        "logicOr": "أو",
        "value": "القيمة",
        "conditions": {
          "date": {
            "after": "بعد",
            "before": "قبل",
            "between": "بين",
            "empty": "فارغ",
            "equals": "تساوي",
            "notBetween": "ليست بين",
            "notEmpty": "ليست فارغة",
            "not": "ليست "
          },
          "number": {
            "between": "بين",
            "empty": "فارغة",
            "equals": "تساوي",
            "gt": "أكبر من",
            "lt": "أقل من",
            "not": "ليست",
            "notBetween": "ليست بين",
            "notEmpty": "ليست فارغة",
            "gte": "أكبر أو تساوي",
            "lte": "أقل أو تساوي"
          },
          "string": {
            "not": "ليست",
            "notEmpty": "ليست فارغة",
            "startsWith": " تبدأ بـ ",
            "contains": "تحتوي",
            "empty": "فارغة",
            "endsWith": "تنتهي ب",
            "equals": "تساوي",
            "notContains": "لا تحتوي",
            "notStartsWith": "لا تبدأ بـ",
            "notEndsWith": "لا تنتهي بـ"
          },
          "array": {
            "equals": "تساوي",
            "empty": "فارغة",
            "contains": "تحتوي",
            "not": "ليست",
            "notEmpty": "ليست فارغة",
            "without": "بدون"
          }
        },
        "button": {
          "0": "فلاتر البحث",
          "_": "فلاتر البحث (%d)"
        },
        "deleteTitle": "حذف فلاتر",
        "leftTitle": "محاذاة يسار",
        "rightTitle": "محاذاة يمين",
        "title": {
          "0": "البحث المتقدم",
          "_": "البحث المتقدم (فعال)"
        }
      },
      "searchPanes": {
        "clearMessage": "ازالة الكل",
        "collapse": {
          "0": "بحث",
          "_": "بحث (%d)"
        },
        "count": "عدد",
        "countFiltered": "عدد المفلتر",
        "loadMessage": "جارِ التحميل ...",
        "title": "الفلاتر النشطة",
        "showMessage": "إظهار الجميع",
        "collapseMessage": "إخفاء الجميع",
        "emptyPanes": "لا يوجد مربع بحث"
      },
      "infoThousands": ",",
      "datetime": {
        "previous": "السابق",
        "next": "التالي",
        "hours": "الساعة",
        "minutes": "الدقيقة",
        "seconds": "الثانية",
        "unknown": "-",
        "amPm": [
          "صباحا",
          "مساءا"
        ],
        "weekdays": [
          "الأحد",
          "الإثنين",
          "الثلاثاء",
          "الأربعاء",
          "الخميس",
          "الجمعة",
          "السبت"
        ],
        "months": [
          "يناير",
          "فبراير",
          "مارس",
          "أبريل",
          "مايو",
          "يونيو",
          "يوليو",
          "أغسطس",
          "سبتمبر",
          "أكتوبر",
          "نوفمبر",
          "ديسمبر"
        ]
      },

      "decimal": ",",
      "infoFiltered": "(مرشحة من مجموع _MAX_ مُدخل)",
      "searchPlaceholder": "ابحث"
    },
    select: true,
    dom: 'Bfrtip',
    buttons: [
      //'excel','print'
    ],

  });


});
