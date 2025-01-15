function previewImage() {
    var inputFile = document.getElementById('customFile');
    var imagePreview = document.getElementById('imagePreview');

    // Kiểm tra xem người dùng đã chọn file hay chưa
    if (inputFile.files && inputFile.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        // Hiển thị ảnh trong thẻ img
        imagePreview.src = e.target.result;
        imagePreview.style.display = 'block';
      };

      // Đọc dữ liệu của file hình ảnh
      reader.readAsDataURL(inputFile.files[0]);
    }
  }


  function previewImage() {
    var inputFile = document.getElementById('customFile');
    var profileImage = document.getElementById('profileImage');
    var imagePreview = document.getElementById('imagePreview');

    // Kiểm tra xem người dùng đã chọn file hay chưa
    if (inputFile.files && inputFile.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        // Hiển thị ảnh preview và ẩn thẻ <img> chứa ảnh profile
        imagePreview.src = e.target.result;
        imagePreview.style.display = 'block';
        profileImage.style.display = 'none';
      };

      // Đọc dữ liệu của file hình ảnh
      reader.readAsDataURL(inputFile.files[0]);
    }
  }


  // Lưu trạng thái active vào localStorage khi tab được chọn
document.addEventListener('DOMContentLoaded', function () {
    var tabs = document.querySelectorAll('.nav-link');
    
    tabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
        localStorage.setItem('activeTab', tab.getAttribute('data-bs-target'));
      });
    });
    
    // Lấy trạng thái active từ localStorage và kích hoạt tab tương ứng
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
      var tab = document.querySelector('[data-bs-target="' + activeTab + '"]');
      if (tab) {
        tab.click();
      }
    }
  });