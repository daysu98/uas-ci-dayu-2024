let timer;
let remainingTime;

// Fungsi untuk memulai Pomodoro Timer
function startTimer(duration, display) {
    clearInterval(timer); // Pastikan tidak ada timer yang berjalan
    remainingTime = duration * 60; // Konversi menit ke detik

    timer = setInterval(() => {
        const minutes = Math.floor(remainingTime / 60);
        const seconds = remainingTime % 60;

        // Tampilkan waktu yang tersisa
        display.textContent = `${minutes}:${seconds < 10 ? "0" + seconds : seconds}`;

        if (--remainingTime < 0) {
            clearInterval(timer);
            alert("Waktu habis!");
        }
    }, 1000);
}

// Fungsi untuk mereset Pomodoro Timer
function resetTimer(display) {
    clearInterval(timer);
    display.textContent = "00:00"; // Atur waktu kembali ke default
    alert("Timer direset.");
}

// Fungsi untuk menghentikan Timer
function stopTimer() {
    clearInterval(timer);
    alert("Timer dihentikan.");
}
