    // Google translate start
    function googleTranslateElementInit() {
          new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
        }
        // Google translate End
        // SideBar start
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
        // SideBar End

  // DataTable Start
  $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
            'print'
        ],
        stripeClasses: []
    } );
} );
  // DataTable End
// preloder Start
  function onReady(callback) {
    var intervalID = window.setInterval(checkReady, 500);
    function checkReady() {
        if (document.getElementsByTagName('body')[0] !== undefined) {
            window.clearInterval(intervalID);
            callback.call(this);
        }
    }
}

function show(id, value) {
    document.getElementById(id).style.display = value ? 'block' : 'none';
}

onReady(function () {
    show('page', true);
    show('loading', false);
});
// preloder End

$(function($) {
 let url = window.location.href;
  $('#sidebar ul .s-item a').each(function() {
   if (this.href === url) {
    // Only For Menu
   $(this).closest('#sidebar ul .s-item').addClass('active');
   // For Dropdown Menu
   $(this).parent('.s-item').addClass("active");
  }
 });
});

(function ($) {
  'use strict';

  $('#tm_download_btn').on('click', function () {
    var downloadSection = $('#tm_download_section');
    var cWidth = downloadSection.width();
    var cHeight = downloadSection.height();
    var topLeftMargin = 0;
    var pdfWidth = cWidth + topLeftMargin * 2;
    var pdfHeight = pdfWidth * 1.5 + topLeftMargin * 2;
    var canvasImageWidth = cWidth;
    var canvasImageHeight = cHeight;
    var totalPDFPages = Math.ceil(cHeight / pdfHeight) - 1;

    html2canvas(downloadSection[0], { allowTaint: true }).then(function (
      canvas
    ) {
      canvas.getContext('2d');
      var imgData = canvas.toDataURL('image/png', 1.0);
      var pdf = new jsPDF('p', 'pt', [pdfWidth, pdfHeight]);
      pdf.addImage(
        imgData,
        'PNG',
        topLeftMargin,
        topLeftMargin,
        canvasImageWidth,
        canvasImageHeight
      );
      for (var i = 1; i <= totalPDFPages; i++) {
        pdf.addPage(pdfWidth, pdfHeight);
        pdf.addImage(
          imgData,
          'PNG',
          topLeftMargin,
          -(pdfHeight * i) + topLeftMargin * 0,
          canvasImageWidth,
          canvasImageHeight
        );
      }
      pdf.save('download.pdf');
    });
  });

})(jQuery);


//file validations
function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}

// function ValidateEmail(mail) 
// {
//  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(myForm.emailAddr.value))
//   {
//     return (true)
//   }
//     alert("You have entered an invalid email address!")
//     return (false)
// }

//update profile form validations
function validateprofile() {
     jQuery.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
  }, "Please enter alphabet characters only");

  $('#profile_form').validate({
    rules: {
       afname: {
        lettersonly:true
      },
      alname: {
        lettersonly:true
      },
      aemail:{
        email: true
     },
     amobile:{
        digits: true,
        minlength: 10,
        maxlength: 10
     }
    },
    messages: {
      afname:   {
            lettersonly:'Only letters are allowed'
        },
      alname:   {
            lettersonly:'Only letters are allowed'
        },
      aemail: {
            email: 'Please enter valid email id'
        },
     amobile: {
            digits: 'Please enter valid mobile number'
        }
    }
  
  });
};


//Category form validation
function submitcat() {
     jQuery.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
  }, "Please enter alphabet characters only");

  $('#category_form').validate({
    rules: {
        catename: {
        required: true,
        lettersonly:true
      },
      photo: {
        required: true
      }
    },
    messages: {
       catename: {
            required: 'Please enter the category',
            lettersonly:'Only letters are allowed'
        },
        photo: {
            required: 'Please select image'
             }
  }
  });
};

//Ingredient form validation
function validateproduct() {
     jQuery.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
  }, "Please enter alphabet characters only");

  $('#product_form').validate({
    rules: {
        pname: {
        required: true,
        lettersonly:true
      },
      cate: {
        required: true
       
      },
      pprize: {
        required: true,
        number: true
     
      }
    },
    messages: {
        pname: {
            required: 'Please enter the  name',
            lettersonly:'Only letters are allowed'
        },
        cate: {
            required: 'Please select category'
         },
        pprize: {
            required: 'Please enter the prize'
          
        }

    }
  
  });
};

//Purchase Order form validation
function validateorder() {
     jQuery.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
  }, "Please enter alphabet characters only");

  $('#order_form').validate({
    rules: {
         invoice_no:{
         required: true,
         digits: true
      },
        sup:{
         required: true
      },
       item:{
         required: true,
          lettersonly:true
      },
      prize: {
        required: true,
        number: true
      },
      quantity: {
        required: true,
        digits: true
      },
      amount: {
        required: true,
        number: true
      },
      total_amt: {
        required: true,
        digits: true
      },
      pdate: {
        required: true
      }
    },
    messages: {
        invoice_no: {
            required: 'Please enter the invoice number',
            digits: 'Only numbers are allowed'
        },
         sup: {
            required: 'Please select the supplier'
        },
        item: {
            required: 'Please select the item',
             lettersonly:'Only letters are allowed'
        },
        prize: {
            required: 'Please enter the prize'
        },
        quantity: {
            required: 'Please enter the quantity',
            digits: 'Only numbers are allowed'
        },
         amount: {
            required: 'Please enter the amount'
            
        },
        total_amt: {
            required: 'Please enter the total amount',
            digits: 'Only numbers are allowed'
        },
        odate: {
            required: 'Please select the date'
        }

    }
  
  });
};


//Sale Order form validation
function validatesaleorder() {
     jQuery.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
  }, "Please enter alphabet characters only");

  $('#saleorder_form').validate({
    rules: {
    product:{
         required: true
      },
      prize: {
        required: true,
        number: true
      },
    sale_quantity: {
        required: true,
        digits: true
      },
      amount: {
        required: true,
        number: true
      },
      idate:{
        required:true
      },
      cust:{
        required:true
      }
    },
    messages: {

       product: {
            required: 'Please select the item'
            
        },
        prize: {
            required: 'Please enter the prize'
        },
        sale_quantity: {
            required: 'Please enter the quantity',
            digits: 'Only numbers are allowed'
        },
         amount: {
            required: 'Please enter the amount'
            
        },
         idate: {
            required: 'Please enter the amount'
            
        },
         cust: {
            required: 'Please enter the amount'
            
        }

    }
  
  });
};


// Stock entry form validations
function submitstock() {
     jQuery.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
  }, "Please enter alphabet characters only");

  $('#stock_form').validate({
    rules: {
        iname: {
        required: true,
        lettersonly:true
      },
      sup:{
         required: true
      },
      psize:{
         required: true,
         digits: true
      },
       cate:{
         required: true
      },
     quantity: {
        required: true,
        digits: true
      },
      prize: {
        required: true,
        number: true
      },
      date: {
        required: true
      },
     ptype: {
        required: true,
        
      },
      brand: {
        required: true,
       
      },
      flavour: {
        required: true
      }
    },
    messages: {
        iname: {
            required: 'Please enter the item name',
            lettersonly:'Only letters are allowed'
        },
        sup:{
         required: 'Please select the supplier name'
      },
      psize: {
            required: 'Please enter the pack size',
            digits: 'Please enter only digits'
        },
      cate:{
         required: 'Please select the item type'
      },
        quantity: {
            required: 'Please enter the quantity',
            digits: 'Please enter only digits'
        },
        prize: {
            required: 'Please enter the stock prize'
        },
        date: {
            required: 'Please select date'
        },
        ptype: {
            required: 'Please enter the quantity'
            
        },
        brand: {
            required: 'Please select stock prize'
        },
        flavour: {
            required: 'Please select flavour'
        }


    }
  
  });
};

//Supplier entry form validations
function validatesuplier() {
     jQuery.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
  }, "Please enter alphabet characters only");
  $('#supplier_form').validate({
    rules: {
        fname: {
        required: true,
        lettersonly:true
      },
      lname: {
        required: true,
        lettersonly:true
      },
      email: {
        required: true,
        email: true
      },
     mobile: {
        required: true,
        digits: true,
        minlength: 10,
        maxlength: 10
      },
      address: {
        required: true,
       
      },
      state: {
        required: true,
       
      },
      sup_city: {
        required: true,
       
      },
      
    },
    messages: {
        fname: {
            required: 'Please enter your First Name',
            lettersonly:'Only letters are allowed'
        },
        lname: {
            required: 'Please enter your Last Name',
            lettersonly:'Only letters are allowed'
        },
        email: {
            required: 'Please enter your email id',
            email: 'Please enter valid email id'
        },
        mobile: {
            required: 'Please enter your mobile number',
            digits: 'Please enter valid mobile number'
        },
         address: {
            required: 'Please enter your address'
           
        },
         state: {
            required: 'Please select your state'
           
        },
        sup_city: {
            required: 'Please select your city'
           
        },

    }
  
  });
};

//Customer entry form validations
function submitcust() {
     jQuery.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
  }, "Please enter alphabet characters only");
  $('#customer_form').validate({
    rules: {
        fname: {
        required: true,
        lettersonly:true
      },
      lname: {
        required: true,
        lettersonly:true
      },
      email: {
        required: true
      },
      mobile: {
        required: true,
        minlength: 10,
        maxlength: 10,
        digits:true
      },
      address: {
        required: true
      },
      cdate: {
        required: true
      },
      state: {
        required: true
      },
      cust_city: {
        required: true
      }
     
    },
    messages: {
        fname: {
            required: 'Please enter your First Name',
            lettersonly:'Only letters are allowed'
        },
        lname: {
            required: 'Please enter your Last Name',
            lettersonly:'Only letters are allowed'
        },
        email: {
            required: 'Please enter valid email id'
        },
        mobile: {
            required: 'Please enter valid mobile number',
            digits: 'Please enter only number'
        },
         address: {
            required: 'Please enter address'
        },
         cdate: {
            required: 'Please enter date of birth'
        },
         state: {
            required: 'Please enter state'
        },
         cust_city: {
            required: 'Please enter city'
        }
    }
  
  });
};

//Payment form validation
function validatepayment() {
     jQuery.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
  }, "Please enter alphabet characters only");

  $('#payment_form').validate({
    rules: {
        ino: {
        required: true,
        digits: true
      },
      cust: {
        required: true
      },
      pmethod: {
        required: true
      },
     precieved:{
            required: true,
            number: true
        },
      pdate: {
        required: true
      }
    },
    messages: {
        ino: {
            required: 'Please enter the invoice number',
            digits: 'Only numbers are allowed'
        },
        cust: {
            required: 'Please select the customer'
        },
        pmethod: {
            required: 'Please select the payment method'
        },
        precieved: {
             required: 'Please enter the received amount'
        },
        pdate: {
            required: 'Please select the date'
        }
    }
  
  });
};


