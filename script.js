function adminSignUp() {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "success") {
        window.location = "adminSignin.php";
      } else {
        swal({
          title: "error",
          text: "Pleasr signup first and log as admin!",
          icon: "error",
        });
      }
    }
  };

  request.open("GET", "adminSignUp.php", true);
  request.send();
}

function remove() {

  var card = document.getElementpyId("card");

  card.classList.toggle("d-block");
}
  


function changeView() {
  var signUpBox = document.getElementById("signUpBox");
  var signInBox = document.getElementById("signInBox");

  signUpBox.classList.toggle("d-none");
  signInBox.classList.toggle("d-none");
}

function signUp() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var email = document.getElementById("email");
  var password = document.getElementById("password");
  var mobile = document.getElementById("mobile");

  var gender = 0;

  if (document.getElementById("m").checked) {
    gender = 1;
  } else if (document.getElementById("f").checked) {
    gender = 2;
  }

  var form = new FormData();
  form.append("f", fname.value);
  form.append("l", lname.value);
  form.append("e", email.value);
  form.append("p", password.value);
  form.append("m", mobile.value);
  form.append("g", gender);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      if (response == "success") {
        document.getElementById("msg").innerHTML = "Registration Successfull";
        document.getElementById("msg").className = "alert alert-success";
        //document.getElementById("msgdiv").className = "d-block";
        msgdiv.classList.toggle("d-none");

        setTimeout(() => {
          msgdiv.classList.toggle("d-none");
        }, 2000);
      } else {
        document.getElementById("msg").innerHTML = response;
        document.getElementById("msgdiv").className = "d-block";

        setTimeout(() => {
          msgdiv.classList.toggle("d-none");
        }, 2000);
      }
    }
  };

  request.open("POST", "signupProcess.php", true);
  request.send(form);
}

function signIn() {
  var email = document.getElementById("email2");
  var password = document.getElementById("password2");
  var rememberme = document.getElementById("rememberme");

  var form = new FormData();
  form.append("e", email.value);
  form.append("p", password.value);
  form.append("r", rememberme.checked);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      if (response == "success") {
        setTimeout(() => {
          msgdiv1.classList.toggle("d-none");
        }, 2000);

        window.location = "home.php";
      } else {
        document.getElementById("msg1").innerHTML = response;
        document.getElementById("msgdiv1").className = "d-block";

        setTimeout(() => {
          msgdiv1.classList.toggle("d-none");
        }, 2000);
      }
    }
  };

  request.open("POST", "signInProcess.php", true);
  request.send(form);
}

var forgotPasswordModal;

function forgotPassword() {

  var email = document.getElementById("email2");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var text = request.responseText;

      if (text == "Success") {
        
        alert("Verification Code has sent successfully,Plese check your email");         

        var modal = document.getElementById("fpModal");
        forgotPasswordModal = new bootstrap.Modal(modal);
        forgotPasswordModal.show();
      } else {
        document.getElementById("msg1").innerHTML = text;
        document.getElementById("msgdiv1").className = "d-block";
      }
    }
  };

  request.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
  request.send();
}

function showPassword1() {
  var textfield = document.getElementById("np");
  var button = document.getElementById("npb");

  if (textfield.type == "password") {
    textfield.type = "text";
    button.innerHTML = "Hide";
  } else {
    textfield.type = "password";
    button.innerHTML = "show";
  }
}

function showPassword2() {
  var textfield = document.getElementById("rnp");
  var button = document.getElementById("rnpb");

  if (textfield.type == "password") {
    textfield.type = "text";
    button.innerHTML = "Hide";
  } else {
    textfield.type = "password";
    button.innerHTML = "show";
  }
}

function showPassword3() {
  var textfield = document.getElementById("ppw");
  var button = document.getElementById("ppb");

  if (textfield.type == "password") {
    textfield.type = "text";
  } else {
    textfield.type = "password";
  }
}

function resetPassword() {
  var email = document.getElementById("email2");
  var newPassword = document.getElementById("np");
  var retypePassword = document.getElementById("rnp");
  var verification = document.getElementById("vcode");

  var form = new FormData();
  form.append("e", email.value);
  form.append("n", newPassword.value);
  form.append("r", retypePassword.value);
  form.append("v", verification.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "success") {
        
        alert(response);
      }
    }
  };

  request.open("POST", "resetPasswordProcess.php", true);
  request.send(form);
}

function signout() {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "success") {
        window.location.reload();
      }
    }
  };

  request.open("GET", "signOutProcess.php", true);
  request.send();
}

function showPassword3() {
  var textfield = document.getElementById("ppw");
  var button = document.getElementById("ppb");

  if (textfield.type == "password") {
    textfield.type = "text";
  } else {
    textfield.type = "password";
  }
}

function changeProfileImg() {
  var img = document.getElementById("profileimage");

  img.onchange = function () {
    var file = this.files[0];
    var url = window.URL.createObjectURL(file);

    document.getElementById("img").src = url;
  };
}

function updateProfile() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("mobile");
  var line1 = document.getElementById("line1");
  var line2 = document.getElementById("line2");
  var province = document.getElementById("province");
  var district = document.getElementById("district");
  var city = document.getElementById("city");
  var pcode = document.getElementById("pcode");
  var image = document.getElementById("profileimage");

  var form = new FormData();

  form.append("f", fname.value);
  form.append("l", lname.value);
  form.append("m", mobile.value);
  form.append("l1", line1.value);
  form.append("l2", line2.value);
  form.append("p", province.value);
  form.append("d", district.value);
  form.append("c", city.value);
  form.append("pc", pcode.value);
  form.append("i", image.files[0]);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      if (response == "Updated" || response == "Saved") {

        swal({
          title: "Updated",
          
          icon: "success",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location.reload();
          } 
        });

        // window.location.reload();

      } else if (response == "You have not selected any image.") {
               
        swal({
          title: "Updated",
          text: "You have not selected any image",
          icon: "success",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location.reload();
          } 
        });
        // alert("");
        
      } else {
        swal({
          title: "error",
          text: response ,
          icon: "error",
         
        })
      }
    }
  };

  request.open("POST", "updateProfileProcess.php", true);
  request.send(form);
}

function addProduct() {
  var category = document.getElementById("category");
  var title = document.getElementById("title");
  var condition = 0;

  if (document.getElementById("b").checked) {
    condition = 1;
  } else if (document.getElementById("u").checked) {
    condition = 2;
  }

  var clr = document.getElementById("clr");
  var qty = document.getElementById("qty");
  var cost = document.getElementById("cost");
  var dwc = document.getElementById("dwc");
  var doc = document.getElementById("doc");
  var desc = document.getElementById("desc");
  var image = document.getElementById("imageuploader");

  var form = new FormData();
  form.append("ca", category.value);
  form.append("t", title.value);
  form.append("con", condition);
  form.append("clr", clr.value);
  form.append("q", qty.value);
  form.append("co", cost.value);
  form.append("dwc", dwc.value);
  form.append("doc", doc.value);
  form.append("de", desc.value);

  var file_count = image.files.length;

  for (var x = 0; x < file_count; x++) {
    form.append("image" + x, image.files[x]);
  }

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      if (response == "success") {
        document.getElementById("msg").className = "alert alert-success";
        document.getElementById("msgdiv").className = "d-block";

        swal({
          title: "Product Saved Successfully",
         
          icon: "success",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location.reload();
          } 
        });

        // alert("Product Saved Successfully.");
        // window.location.reload();
      } else {
        swal({

          title: response,         
          icon: "info",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location.reload();
          } 
        });
        // document.getElementById("msg").innerHTML = response;
        // document.getElementById("msgdiv").className = "d-block";
      }
    }
  };

  request.open("POST", "addProductProcess.php", true);
  request.send(form);
}

function changeProductImage() {
  var image = document.getElementById("imageuploader");

  image.onchange = function () {
    var file_count = image.files.length;

    if (file_count <= 3) {
      for (var x = 0; x < file_count; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);

        document.getElementById("i" + x).src = url;
      }
    } else {
      alert(
        file_count +
          " files. You are proceed to upload only 3 or less than 3 files."
      );
    }
  };
}

function changeStatus(id) {
  var product_id = id;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var response = request.responseText;
      if (response == "deactivated" || response == "activated") {
        window.location.reload();
      } else {

        // swal({
        //   title: "error",
        //   text: response,
        //   icon: "error",
        // });
        
        alert(response);
      }
    }
  };

  request.open("GET", "changeStatusProcess.php?id=" + product_id, true);
  request.send();
}

function sort1(x) {
  var search = document.getElementById("s");
  var time = "0";

  if (document.getElementById("n").checked) {
    time = "1";
  } else if (document.getElementById("o").checked) {
    time = "2";
  }

  var qty = "0";

  if (document.getElementById("h").checked) {
    time = "1";
  } else if (document.getElementById("l").checked) {
    time = "2";
  }

  var condition = "0";

  if (document.getElementById("b").checked) {
    time = "1";
  } else if (document.getElementById("u").checked) {
    time = "2";
  }

  var form = new FormData();
  form.append("s", search.value);
  form.append("t", time);
  form.append("q", qty);
  form.append("c", condition);
  form.append("page", x);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      document.getElementById("sort").innerHTML = response;
    }
  };

  request.open("POST", "sortProcess.php", true);
  request.send(form);
}

function clearSort() {
  window.location.reload();
}

function sendId(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      // alert(response);
      if ((response = "Success")) {
        window.location = "updateProduct.php";
      } else {
        alert(response);
      }
    }
  };

  request.open("GET", "sendIdProcess.php?id=" + id, true);
  request.send();
}

function updateProduct() {
  var title = document.getElementById("t");
  var doc = document.getElementById("doc");
  var description = document.getElementById("d");
  var qty = document.getElementById("q");
  var dwc = document.getElementById("dwc");
  var images = document.getElementById("imageuploader");

  var form = new FormData();
  form.append("t", title.value);
  form.append("q", qty.value);
  form.append("dwc", dwc.value);
  form.append("doc", doc.value);
  form.append("d", description.value);

  var file_count = images.files.length;

  for (var x = 0; x < file_count; x++) {
    form.append("i" + x, images.files[x]);
  }

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      swal(response);


      // alert(response);
    }
  };

  request.open("POST", "updateProductProcess.php", true);
  request.send(form);

}

function basicSearch(x) {
  var txt = document.getElementById("bst");
  var select = document.getElementById("bss");

  var form = new FormData();
  form.append("t", txt.value);
  form.append("s", select.value);
  form.append("page", x);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      document.getElementById("basicSearchResult").innerHTML = response;
    }
  };

  request.open("POST", "basicSearchProcess.php", true);
  request.send(form);
}

function advancedSearch(x) {
  var txt = document.getElementById("t");
  var category = document.getElementById("c1");
  var condition = document.getElementById("c2");
  var color = document.getElementById("c3");
  var from = document.getElementById("pf");
  var to = document.getElementById("pt");
  var sort = document.getElementById("s");

  var form = new FormData();
  form.append("t", txt.value);
  form.append("cat", category.value);
  form.append("con", condition.value);
  form.append("col", color.value);
  form.append("pf", from.value);
  form.append("pt", to.value);
  form.append("s", sort.value);
  form.append("page", x);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var response = request.responseText;
      document.getElementById("view_area").innerHTML = response;
      
    }
  };

  request.open("POST", "advancedSearchProcess.php", true);
  request.send(form);
}

function loadMainImg(id) {
  var sample_img = document.getElementById("productImg" + id).src;
  var main_img = document.getElementById("mainImg");

  main_img.style.backgroundImage = "url(" + sample_img + ")";
}

function check_value(qty) {
  var input = document.getElementById("qty_input");

  if (input.value <= 0) {
    alert("Quantity must be 01 or more.");
    input.value = 1;
  } else if (input.value > qty) {
    alert("Insufficient Quantity.");
    input.value = qty;
  }
}

function qty_inc(qty) {
  var input = document.getElementById("qty_input");

  if (input.value < qty) {
    var newValue = parseInt(input.value) + 1;
    input.value = newValue;
  } else {
    document.getElementById("msgdiv2").className = "d-block";
    setTimeout(() => {
      msgdiv2.classList.toggle("d-none");
    }, 2000);

    // alert("Maximum quantity has achieved.");
    input.value = qty;
  }
}

function qty_dec() {
  var input = document.getElementById("qty_input");

  if (input.value > 1) {
    var newValue = parseInt(input.value) - 1;
    input.value = newValue;
  } else {
    document.getElementById("msgdiv1").className = "d-block";
    setTimeout(() => {
      msgdiv1.classList.toggle("d-none");
    }, 2000);

    // alert("Minimum quantity has achieved.");
    input.value = 1;
  }
}

function addToWatchlist(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      if (response == "added") {
        document.getElementById("heart" + id).style.className = "text-danger";
        window.location.reload();
      } else if (response == "d") {
        document.getElementById("heart" + id).style.className = "text-dark";
        window.location.reload();
      } else {
        alert(response);
      }
    }
  };

  request.open("GET", "addToWatchlistProcess.php?id=" + id, true);
  request.send();
}

function removeFromWatchlist(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var response = request.responseText;
      if (response == "success") {
        window.location.reload();
      } else {
        swal({
          title:response,
          icon: "warning",
          
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location.reload();
          } 
        });
        // alert(response);
      }
    }
  };

  request.open("GET", "removeWatchlistProcess.php?id=" + id, true);
  request.send();
}

function addToCart(id) {

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      swal({
          title: "success",
          text: response,
          icon: "success",
        });
    }
  };

  request.open("GET", "addToCartProcess.php?id=" + id, true);
  request.send();
}

function changeQTY(id) {
  var qty = document.getElementById("qty_num").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "Updated") {
        window.location.reload();
      } else {
        alert(response);
      }
    }
  };

  request.open(
    "GET",
    "cartQtyUpdateProcess.php?qty=" + qty + "&id=" + id,
    true
  );
  request.send();
}

function deleteFromCart(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "Removed") {

        swal({
          title: "Product removed from Cart",
          icon: "warning",
          
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location.reload();
          } 
        });       

          // alert("Product removed from Cart.");        
        // window.location.reload();

      } else {

        swal({
          title: "error",
          text: response,
          icon: "error",
        });
        // alert(response);
      }
    }
  };

  request.open("GET", "deleteFromCartProcess.php?id=" + id, true);
  request.send();
}

function changeQTY(id) {
  var qty = document.getElementById("qty_num").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "Updated") {
        window.location.reload();
      } else {
        alert(response);
      }
    }
  };

  request.open(
    "GET",
    "cartQtyUpdateProcess.php?qty=" + qty + "&id=" + id,
    true
  );
  request.send();
}

function payNow(id) {

  var qty = document.getElementById("qty_input").value; 

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      var obj = JSON.parse(response);

      var mail = obj["umail"];
      var amount = obj["amount"];

      if (response == 1) {

        swal({
          title: "Please Login",
          
          icon: "error",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location = "index.php";
          } 
        });
        // alert("Please Login.");
        // window.location = "index.php";
    } else if (response == 2) {

      swal({
        title: "Please update your profile.",
        
        icon: "error",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = "userProfile.php";
        } 
      });

        // alert("Please update your profile.");
        // window.location = "userProfile.php";
      } else {
        // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
          console.log("Payment completed. OrderID:" + orderId);

          // alert("Payment completed. OrderID:" + orderId);
          saveInvoice(orderId, id, mail, amount, qty);
        };

        // Payment window closed
        payhere.onDismissed = function onDismissed() {
          // Note: Prompt user to pay again or show an error page
          console.log("Payment dismissed");
        };

        // Error occurred
        payhere.onError = function onError(error) {
          // Note: show an error page
          console.log("Error:" + error);
        };

        // Put the payment variables here
        var payment = {
          sandbox: true,
          merchant_id: obj["mid"], // Replace your Merchant ID
          return_url: "http://localhost/glee/singleProductView.php?id" + id, // Important
          cancel_url: "http://localhost/glee/singleProductView.php?id" + id, // Important
          notify_url: "http://sample.com/notify",
          order_id: obj["id"],
          items: obj["item"],
          amount: amount + ".00",
          currency: "LKR",
          hash: obj["hash"], // *Replace with generated hash retrieved from backend
          first_name: obj["fname"],
          last_name: obj["lname"],
          email: mail,
          phone: obj["mobile"],
          address: obj["address"],
          city: obj["city"],
          country: "Sri Lanka",
          delivery_address: obj["address"],
          delivery_city: obj["city"],
          delivery_country: "Sri Lanka",
          custom_1: "",
          custom_2: "",
        };

        // Show the payhere.js popup, when "PayHere Pay" is clicked
        // document.getElementById('payhere-payment').onclick = function (e) {
        payhere.startPayment(payment);
        // };
      }
    }
  };

  request.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
  request.send();
}

function saveInvoice(orderId, id, mail, amount, qty) {
  var form = new FormData();
  form.append("o", orderId);
  form.append("i", id);
  form.append("m", mail);
  form.append("a", amount);
  form.append("q", qty);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      if (response == "success") {
        window.location = "invoice.php?id=" + orderId;
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "saveInvoiceProcess.php", true);
  request.send(form);
}

function printInvoice() {
  var restorePage = document.body.innerHTML;
  var page = document.getElementById("page").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = restorePage;
}


function printProductReport() {
  var restorePage = document.body.innerHTML;
  var page = document.getElementById("page").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = restorePage;
}

// var m;
// function addFeedback(id) {
//   var feedbackModal = document.getElementById("feedbackmodal" + id);
//   m = new bootstrap.Modal(feedbackModal);
//   m.show();
// }

function saveFeedback(id) {
  var type;

  if (document.getElementById("type1").checked) {
    type = 1;
  } else if (document.getElementById("type2").checked) {
    type = 2;
  } else if (document.getElementById("type3").checked) {
    type = 3;
  }

  var feedback = document.getElementById("feed");

  var form = new FormData();
  form.append("pid", id);
  form.append("t", type);
  form.append("f", feedback.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "success") {
        alert("Feedback saved.");
        m.hide();
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "saveFeedbackProcess.php", true);
  request.send(form);
}

function send_msg() {
  var recever_mail = "0";

  var r2 = document.getElementById("select_user");

  if (r2 == 0) {
    var r1 = document.getElementById("rmail");
    recever_mail = r1.innerHTML;
  } else {
    recever_mail = r2.value;
  }

  var msg_txt = document.getElementById("msg_txt");
  var select_user = document.getElementById("select_user");

  var form = new FormData();
  form.append("rm", recever_mail);
  form.append("mt", msg_txt.value);
  form.append("su", select_user.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "success") {
        // swal({
        //   title: "success",
        //   text: "Message sent.",
        //   icon: "success",
        // })
        // .then((willDelete) => {
        // if (willDelete) {
        //   window.location.reload();
        // }
        // });
        
        alert("Message sent.");
        window.location.reload();
      } else {
        // swal({
        //   title: "error",
        //   text: response,
        //   icon: "error",
        //   });
        
        alert(response);
      }
    }
  };

  request.open("POST", "sendMsgProcess.php", true);
  request.send(form);
}

function viewMessage(email) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      document.getElementById("chat_box").innerHTML = response;
      // alert (response);
    }
  };

  request.open("GET", "viewMsgProcess.php?e=" + email, true);
  request.send();
}

var av;
function adminVerification() {
  var email = document.getElementById("e");

  var form = new FormData();
  form.append("e", email.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "Success") {
        
        swal({
          title: "success",
          text: "Please take a look at your email to find the VERIFICATION CODE",
          icon: "success",
        });
          
        
        // alert(

        //   "Please take a look at your email to find the VERIFICATION CODE."
        // );
        var adminVerificationModal =
          document.getElementById("verificationModal");
        av = new bootstrap.Modal(adminVerificationModal);
        av.show();
      } else {
        // alert(response);
        swal({
          title: "error",
          text: response,
          icon: "error",
          });
          
      }
    }
  };

  request.open("POST", "adminVerificationProcess.php", true);
  request.send(form);
}

function verify() {
  var code = document.getElementById("vcode");

  var form = new FormData();
  form.append("c", code.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "success") {
        av.hide();
        window.location = "adminPanel.php";
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "verificationProcess.php", true);
  request.send(form);
}

function blockUser(email) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      swal({
        title:response ,
        text: "success",
        icon: "success",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
      window.location.reload();

        } 
      });

    
      // alert(response);
      // window.location.reload();
    }
  };

  request.open("GET", "userBlockProcess.php?email=" + email, true);
  request.send();
}

var mm;

function viewMsgModal(email) {
  var m = document.getElementById("userMsgModal" + email);
  mm = new bootstrap.Modal(m);
  mm.show();
}

var pm;

function viewProductModal(id) {
  var m = document.getElementById("viewProductModal" + id);
  pm = new bootstrap.Modal(m);
  pm.show();
}

function blockProduct(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      swal({
        title:response ,
        text: "success",
        icon: "success",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
      window.location.reload();

        } 
      });
      // alert(response);
      // window.location.reload();
    }
  };

  request.open("GET", "productBlockProcess.php?id=" + id, true);
  request.send();
}

function addNewCategory() {
  var category = document.getElementById("cat");

  var f = new FormData();

  f.append("c", category.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      // alert(response);

      if (response == "Success") {
        swal({
          title: "Success Update",
          text: "success",
          icon: "success",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
        window.location.reload();

          } 
        });

        // alert("Success Update");
      } else {

        swal({
          title: "update Fail",
          text: "error",
          icon: "error",
          });
        // alert("update Fail");
      }
    }
  };

  request.open("POST", "categoryRegisterProcess.php", true);
  request.send(f);
}

function searchInvoice() {
  var txt = document.getElementById("searchtxt").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      document.getElementById("viewArea").innerHTML = response;
    }
  };

  request.open("GET", "searchInvoiceProcess.php?id=" + txt, true);
  request.send();
}

function findsellings() {
  var from = document.getElementById("from").value;
  var to = document.getElementById("to").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      document.getElementById("viewArea").innerHTML = response;
    }
  };

  request.open("GET", "findSellingsProcess.php?f=" + from + "&t=" + to, true);
  request.send();
}

function changeInvoiceStatus(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "success") {
        window.location.reload();
      } else {
        alert(response);
      }
    }
  };

  request.open("GET", "changeInvoiceStatusProcess.php?id=" + id, true);
  request.send();
}

function loadChart() {
  var ctx = document.getElementById("myChart");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      // alert(response);
      var data = JSON.parse(response);

      new Chart(ctx, {
        
        type: "pie",
        data: {
          labels:data.labels,
          datasets: [
            {
              label: "# of Votes",
              data: data.data,
              borderWidth: 1,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    }
  };

  request.open("POST", "loadChartProcess.php", true);
  request.send();
}

// function checkOut() {P

//   var form = new FormData();

//   form.append("cart",true);
  
//   var request = new XMLHttpRequest();

//   request.onreadystatechange = function () {
//     if ((request.status == 200) & (request.readyState == 4)) {
//       // alert(response);
      
//       var payment = JSON.parse(response);
//       doCheckout(Payment,"checkout.php");
//     }
//   };
//     request.open("POST", "checkoutProcess.php", true);
//   request.send(form);
  
// }

function checkOut() {  
  
  var total = document.getElementById("total").textContent;

  // alert(total);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {

    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

           var obj = JSON.parse(response);

      var mail = obj["umail"];
      var total = obj["total"];

      if (response == 1) {
        swal({
          title: "error",
          text: "Please Login",
          icon: "error",
        
        });
        
      } else if (response == 2) {

        swal({
          title: "error",
          text: "Please update your profile.",
          icon: "error",
        })
        .then((willDelete) => {
        if (willDelete) {
          window.location = "userProfile.php";
        }
        });

        // alert("Please update your profile.");
        // window.location = "userProfile.php";

      } else {
        // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
          console.log("Payment completed. OrderID:" + orderId);

          // alert("Payment completed. OrderID:" + orderId);
          // saveInvoiceCheckout(orderId, id, mail, total, qty);
        };

        // Payment window closed
        payhere.onDismissed = function onDismissed() {
          // Note: Prompt user to pay again or show an error page
          console.log("Payment dismissed");
        };

        // Error occurred
        payhere.onError = function onError(error) {
          // Note: show an error page
          console.log("Error:" + error);
        };

        // Put the payment variables here
        var payment = {
          sandbox: true,
          merchant_id: obj["mid"], // Replace your Merchant ID
          return_url: "http://localhost/glee/cart.php", // Important
          cancel_url: "http://localhost/glee/cart.php", // Important
          notify_url: "http://sample.com/notify",
          order_id: obj["id"],
          items: obj["item"],
          amount: total + ".00",
          currency: "LKR",
          hash: obj["hash"], // *Replace with generated hash retrieved from backend
          first_name: obj["fname"],
          last_name: obj["lname"],
          email: mail,
          phone: obj["mobile"],
          address: obj["address"],
          city: obj["city"],
          country: "Sri Lanka",
          delivery_address: obj["address"],
          delivery_city: obj["city"],
          delivery_country: "Sri Lanka",
          custom_1: "",
          custom_2: "",
        };

        // Show the payhere.js popup, when "PayHere Pay" is clicked
        // document.getElementById('payhere-payment').onclick = function (e) {
        payhere.startPayment(payment);
        // };
      }
    }
  };

  request.open("GET", "checkoutProcess.php?total="+total, true);
  request.send();
}

// function saveInvoiceCheckout(orderId, id, mail, amount, qty) {

//   var form = new FormData();

//   form.append("o", orderId);
//   form.append("i", id);
//   form.append("m", mail);
//   form.append("a", amount);
//   form.append("q", qty);

//   var request = new XMLHttpRequest();

//   request.onreadystatechange = function () {
//     if ((request.status == 200) & (request.readyState == 4)) {
//       var response = request.responseText;

//       if (response == "success") {
//         window.location = "invoice.php?id=" + orderId;
//       } else {
//         alert(response);
//       }
//     }
//   };

//   request.open("POST", "saveInvoiceProcess.php", true);
//   request.send(form);
// }