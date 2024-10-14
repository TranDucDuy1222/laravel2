document.getElementById('myForm').addEventListener('submit', function(event) {
    var size = document.getElementById('size').value;
    let alert = document.getElementById('alert');
    if (!size) {
        alert.innerHTML = "Bạn hãy chọn lại size";
        event.preventDefault(); // Ngăn chặn việc submit form
    }
});
document.querySelectorAll('.color button').forEach(function(button) {
    button.addEventListener('click', function() {
        document.getElementById('color').value = this.textContent;
        console.log('Color button clicked: ' + this.textContent);
    });
});

document.querySelectorAll('.size button').forEach(function(button) {
    button.addEventListener('click', function() {
        document.getElementById('size').value = this.textContent;
        console.log('Size button clicked: ' + this.textContent);
    });
});

// ĐỔi màu button tên color
document.querySelectorAll('.color button').forEach(function(button) {
    button.addEventListener('click', function() {
        // Đặt màu của tất cả các button về màu ban đầu
        document.querySelectorAll('.color button').forEach(function(otherButton) {
            otherButton.style.backgroundColor = '';
        });

        // Thay đổi màu của button đã được nhấp
        this.style.backgroundColor = this.className;
    });
});

// Đổi màu button bằng tên id
// document.querySelectorAll('.size button').forEach(function(button) {
//     button.addEventListener('click', function() {
//         // Đặt màu của tất cả các button về màu ban đầu
//         document.querySelectorAll('.size button').forEach(function(otherButton) {
//             otherButton.style.backgroundColor = '';
//         });

//         // Thay đổi màu của button đã được nhấp
//         this.style.backgroundColor = this.id;
//     });
// });


