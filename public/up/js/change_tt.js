// Lấy tất cả các button có id là 'select_tt'
var buttons = document.querySelectorAll('#select_tt');

// Duyệt qua từng button
for (var i = 0; i < buttons.length; i++) {
    // Thêm sự kiện click cho mỗi button
    buttons[i].addEventListener('click', function() {
        // Khi button được click, lấy giá trị của button
        var value = this.value;

        // Tìm thẻ input có name là 'update_tt_order' và gán giá trị của button cho nó
        document.querySelector('input[name="update_tt_order"]').value = value;
    });
}
