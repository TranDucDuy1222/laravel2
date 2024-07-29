
        /*thêm biến event để lưu khi người dùng quên nhập ô nào đó thì không bị mất thông tin*/
        // checkform
function check(event) {
    var hoten = document.getElementById('inputName').value;
    var sdt = document.getElementById('sdt').value;
    var tinh = document.getElementById('inputCity').value;
    var huyen = document.getElementById('inputDistrict').value;
    var diachi = document.getElementById('inputAddress').value;
    if (hoten == '') {
        alert('Please enter your correct full name!');
        event.preventDefault();
        return;
    }
    if(!isNaN(hoten)){
      alert('Full name must not contain a number, please re-enter full name!');
        event.preventDefault();
        return;
        /*/\d/.test(hoten) không được nhập số*/
    }
    if(/[!@#$%^&*(),;.?":{}|<>''"*+\-_/]/.test(hoten)){
    alert('Full name cannot contain special characters, please re-enter full name!');
    event.preventDefault();
    return;
}
    if(sdt =='' ){
      alert('Please enter your correct phone number!');
      event.preventDefault();
      return;
    }
    if(isNaN(sdt)){
      /*isnan là chữ*/
      alert('The phone number does not contain letters, please re-enter the phone number!');
      event.preventDefault();
      return;
    }
    if(sdt.length < 9 || sdt.length > 11){
      alert('Please enter your correct phone number!');
      event.preventDefault();
      return;
    }
    if(tinh==''){
      alert('Please select your province or city!');
      event.preventDefault();
      return;
    }
    if(huyen==''){
      alert('Please select your District!');
      event.preventDefault();
      return;
    }
    if(diachi==''){
        alert('Please select your Address!')
        event.preventDefault();
        return;
    }
    return false;
}
// <!-- xóa sản phẩm khi đặt hàng thành công  -->
// function clearCart() {
//     var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             if (this.responseText === "success") {
//                 // Xóa các hàng (items) khỏi bảng
//                 var cartTable = document.getElementById('cart');
//                 cartTable.querySelector('tbody').innerHTML = '';
//                 alert("You have successfully purchased, please check your order.");
                
//                 // Cập nhật tổng tiền thành 0
//                 var totalAmountElement = document.querySelector('.btn-tongtien');
//                 totalAmountElement.textContent = "Total Amount: $0";
                
//             } else {
//                 alert("Payment failed, you don't have the product!");
//             }
//         }
//     };
//     xhttp.open("GET", "controller/user/clear_cart.php", true);
//     xhttp.send();
// }

// 
    function handlePurchase() {
        // Perform AJAX request to update order information
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Handle the response if needed
                console.log(this.responseText);
            }
        };

        // Replace 'your_backend_script.php' with the actual backend script that handles the purchase
        xhttp.open("POST", "your_backend_script.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Additional data you may need to send to the server (e.g., product details)
        var productData = {
            masp: 'your_product_id',
            tensp: 'your_product_name',
            soluong: 'your_product_quantity',
            anhsp: 'your_product_image',
            gia: 'your_product_price'
        };

        // Convert productData to a URL-encoded string
        var params = Object.keys(productData).map(function(key) {
            return encodeURIComponent(key) + '=' + encodeURIComponent(productData[key]);
        }).join('&');

        // Send the request
        xhttp.send(params);
    }
    // xóa sp
    function deleteItem(masp) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText === "success") {
                    var row = document.querySelector('[data-masp="'+masp+'"]');
                    var subtotal = parseFloat(row.querySelector('[data-th="Subtotal"]').textContent.substring(1));
                    
                    var totalAmountElement = document.querySelector('.btn.btn-dark');
                    var totalAmount = parseFloat(totalAmountElement.textContent.substring(14));
                    
                    totalAmount -= subtotal;
                    totalAmountElement.textContent = "Total Amount: $" + totalAmount.toFixed(2);
                    
                    row.parentNode.removeChild(row);
                    
                    // hàm thì để reload lại trang
                    location.reload();
                } else {
                    alert("Error deleting item.");
                }
            }
        };
        xhttp.open("GET", "controller/user/deletethanhtoan.php?masp=" + masp, true);
        xhttp.send();
    }
// cập nhật số lượng 
    function updateQuantity(inputElement, masp) {
        var newQuantity = parseInt(inputElement.value);
        var row = inputElement.parentNode.parentNode;
        var price = parseFloat(row.querySelector('[data-th="Price"]').textContent.substring(1));
        var newTotal = newQuantity * price;
    
        if (newQuantity <= 0) {
            var confirmed = confirm('The product purchase quantity is invalid, do you want to delete the product?');
            if (confirmed) {
                deleteItem(masp);
            } else {
                inputElement.value = 1;
                newQuantity = 1;
            }
        }
    
        // Update the total in the row
        row.querySelector('[data-th="Subtotal"]').textContent = "$" + newTotal.toFixed(2);
    
        // Update the session data
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText === "success") {
                    // Update the session data on the server
                    location.reload(); // Tải lại trang
                } else {
                    // alert("Error updating quantity.");
                }
            }
        };
        xhttp.open("GET", "controller/user/ttsoluong.php?masp=" + masp + "&soluong=" + newQuantity, true);
        xhttp.send();
    }