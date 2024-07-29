window.onload = function() {
    var radios = document.getElementsByName('select_address');
    for(var i = 0; i < radios.length; i++) {
        radios[i].addEventListener('change', function() {
            // .setAttribute('value', this.value); setAttribute thay đổi giá trị khi sự kiện change được chạy và truyền giá trị value mà hàm change nhận vào id add_address
            document.getElementById('add_address').setAttribute('value', this.value);
            console.log('Radio button with value ' + this.value + ' is selected.');
        });
    }
}
function updatePay() {
    var paymentMethod = document.getElementById('paymentMethod');
    var selectedOptionText = paymentMethod.options[paymentMethod.selectedIndex].innerText;
    document.getElementById('phuongthuc').setAttribute('value', selectedOptionText);
    //console.log('Selected option text: ' + selectedOptionText);
}

document.querySelector('#myForm').addEventListener('submit', function(e) {
    var add_address = document.querySelector('#add_address').value;
    if (!add_address) {
        e.preventDefault();
        document.querySelector('#error-message').textContent = 'Vui lòng chọn địa chỉ giao hàng.';
    }
});

var baseUrl = "<?=Base_url?>/admin/order_admin/";
console.log(baseUrl);
function select_trangthai(){
    var select_tt = document.getElementById('select_ttt');
    var selectedOptionValue = select_tt.options[select_tt.selectedIndex].value;
    var newUrl = baseUrl + selectedOptionValue;
    window.location.href = newUrl;
}

