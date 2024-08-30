onclick="payNow(<?php echo $pid; ?>);"

<a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>' class="col-12 btn btn-warning fw-semibold">Buy Now</a>




swal({
title: "Are you sure?",
text: "Once deleted, you will not be able to recover this imaginary file!",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((willDelete) => {
if (willDelete) {
swal("Poof! Your imaginary file has been deleted!", {
icon: "success",
});
} else {
swal("Your imaginary file is safe!");
}
});

swal({
title: "Are you sure?",
text: "Once deleted, you will not be able to recover this imaginary file!",
icon: "warning",

});


swal({
title: "Product removed from Cart",
icon: "warning",

})
.then((willDelete) => {
if (willDelete) {
window.location.reload();
}
});

swal({
title: "success",
text: response,
icon: "success",
});



