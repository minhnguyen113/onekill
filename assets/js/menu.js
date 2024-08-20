

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

    let currentWeek = 0;

    // Thiết lập ngôn ngữ là tiếng Việt cho moment.js
    moment.locale('vi');

    // Hàm cập nhật lịch học cho tuần mới
    function updateSchedule() {
        const table = document.querySelector("table");

        // Lấy ngày hiện tại
        const today = moment();

        // Cập nhật các ô tiêu đề với tên ngày, tháng và năm tương ứng
        for (let i = 1; i <= 7; i++) {
            const day = moment().add(currentWeek, 'weeks').startOf('week').add(i - 1, 'days');
            table.rows[0].cells[i].textContent = day.format('dddd, DD/MM/YYYY');

            // Tô đậm ngày hiện tại
            if (day.isSame(today, 'day')) {
                table.rows[0].cells[i].classList.add('current-day');
            } else {
                table.rows[0].cells[i].classList.remove('current-day');
            }
        }



        // Tính toán khoản thời gian của tuần
        const startDate = moment().add(currentWeek, 'weeks').startOf('week');
        const endDate = moment(startDate).add(6, 'days');

        // Hiển thị khoản thời gian của tuần
        const weekRange = document.getElementById("weekRange");
        weekRange.textContent = `Tuần từ ${startDate.format('DD/MM/YYYY')} đến ${endDate.format('DD/MM/YYYY')}`;
    }

    // Gắn sự kiện click cho nút "Tuần Mới"
    const nextWeekButton = document.getElementById("nextWeekButton");
    nextWeekButton.addEventListener("click", function () {
        currentWeek++;
        updateSchedule();
    });

    // Gắn sự kiện click cho nút "Lùi Tuần"
    const previousWeekButton = document.getElementById("previousWeekButton");
    previousWeekButton.addEventListener("click", function () {
        currentWeek--;
        updateSchedule();
    });

    // Gắn sự kiện click cho nút "Lấy Ngày Hiện Tại"
    const currentDateButton = document.getElementById("currentDateButton");
    currentDateButton.addEventListener("click", function () {
        currentWeek = 0;
        updateSchedule();
    });

    // Gắn sự kiện change cho thẻ input:date
    const selectedDateInput = document.getElementById("selectedDate");
    selectedDateInput.addEventListener("change", function () {
        const selectedDate = moment(selectedDateInput.value);
        const today = moment();
        currentWeek = selectedDate.diff(today, 'weeks');
        updateSchedule();
    });

    // Cập nhật lịch học ban đầu
    updateSchedule();

    
