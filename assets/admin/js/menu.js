var dateInput = document.getElementById("date");
var submitBtn = document.getElementById("submitBtn");
dateInput.addEventListener("change", function() {
    submitBtn.click();
});


function validateCheckbox() {
        var checkboxes = document.getElementsByName("monan[]");
        var checkedCount = 0;

        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                checkedCount++;
            }
        }

        if (checkedCount === 0) {
            alert("Vui lòng chọn ít nhất một món ăn!");
            return false;
        }
    }

    