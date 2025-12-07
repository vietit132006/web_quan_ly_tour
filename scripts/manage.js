
const startDateInput = document.getElementById('start_date');
const endDateInput = document.getElementById('end_date');
const totalDaysInput = document.getElementById('total_days');
const displayDays = document.getElementById('so_ngay');
const displayNights = document.getElementById('so_dem');

function calculateTotalDays() {
    const start = new Date(startDateInput.value);
    const end = new Date(endDateInput.value);

    if (start && end && end >= start) {
        const diff = (end - start) / (1000 * 60 * 60 * 24) + 1;
        const days = Math.round(diff);

        totalDaysInput.value = days;
        displayDays.innerText = days;
        displayNights.innerText = days - 1;
    } else {
        totalDaysInput.value = '';
        displayDays.innerText = 0;
        displayNights.innerText = 0;
    }
}

startDateInput.addEventListener('change', calculateTotalDays);
endDateInput.addEventListener('change', calculateTotalDays);

document.getElementById('tourForm').addEventListener('submit', function (e) {

    const tour = document.getElementById('tour_id').value.trim();
    const guide = document.getElementById('guide_id').value.trim();
    const guests = Number(document.getElementById('number_guests').value);
    const departureTime = document.getElementById('departure_time').value;
    const startDate = startDateInput.value;
    const endDate = endDateInput.value;

    if (tour === '') {
        alert("Vui lòng chọn Tour!");
        e.preventDefault();
        return;
    }

    if (guide === '') {
        alert("Vui lòng chọn Hướng dẫn viên!");
        e.preventDefault();
        return;
    }

    if (!startDate || !endDate) {
        alert("Vui lòng chọn ngày bắt đầu và kết thúc!");
        e.preventDefault();
        return;
    }

    if (new Date(endDate) < new Date(startDate)) {
        alert("Ngày kết thúc phải sau ngày bắt đầu!");
        e.preventDefault();
        return;
    }

    if (isNaN(guests) || guests < 1) {
        alert("Số khách phải >= 1!");
        e.preventDefault();
        return;
    }

    const serviceChecked = document.querySelector('input[name="services[]"]:checked');
    if (!serviceChecked) {
        alert("Vui lòng chọn ít nhất một dịch vụ!");
        e.preventDefault();
        return;
    }

    if (!departureTime) {
        alert("Vui lòng chọn giờ khởi hành!");
        e.preventDefault();
        return;
    }
});