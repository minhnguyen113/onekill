
  var manvInput = document.getElementById("manv");
  var usernameInput = document.getElementById("username");

  manvInput.addEventListener("input", function() {
    usernameInput.value = manvInput.value;
  });


  usernameInput.addEventListener("input", function() {
    manvInput.value = usernameInput.value;
  });


  ///add Thực đơn và add món vào thực đơn trang vAddMenu

 