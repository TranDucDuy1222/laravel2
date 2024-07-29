

// <!-- cập nhật số lượng -->

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
        xhttp.open("GET", "" + masp + "&soluong=" + newQuantity, true);
        xhttp.send();
    }