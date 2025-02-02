document.addEventListener('DOMContentLoaded', (event) => {
    const video = document.getElementById('videoElement');
    const startButton = document.getElementById('startButton');
    const captureButton = document.getElementById('captureButton');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');
    let stream;

    // contoh jarak jauh -8.419694597045757, 114.16887585473388
    //-7.549237190962741, 110.78619347302973

    const referenceLatitude = -7.549237190962741; // Ganti dengan nilai sesuai kebutuhan
    const referenceLongitude = 114.2510778596516; // Ganti dengan nilai sesuai kebutuhan
    const radius = 500; // Radius dalam meter
    // Elemen untuk menampilkan pesan
    const notificationElement = document.getElementById('notification');
    async function startCamera() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({ video: true });
            video.srcObject = stream;
        } catch (error) {
            console.error('Error accessing camera:', error);
        }
    }

    function capturePhoto() {
        const tracks = stream.getTracks();
        tracks.forEach(track => track.stop());

        video.style.display = 'none';
        canvas.style.display = 'block';

        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const photoURL = canvas.toDataURL('image/png');

        // Ambil tanggal dan jam saat ini 
        const currentDate = new Date();
        const formattedDate = currentDate.toISOString().slice(0, 10); // Format tanggal YYYY-MM-DD
        const formattedTime = currentDate.toTimeString().slice(0, 8); // Format jam HH:MM:SS

        // Ambil informasi lokasi geografis
        if ('geolocation' in navigator) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // Tampilkan latitude dan longitude di elemen input (jika diinginkan)
                    document.getElementById('latitude').value = latitude;
                    document.getElementById('longitude').value = longitude;

                    // Periksa jarak dari titik referensi
                    const distance = calculateDistance(referenceLatitude, referenceLongitude, latitude, longitude);

                    if (distance <= radius) {
                        // Kirim data dan foto ke server
                        sendDataToServer(photoURL, formattedDate, formattedTime, latitude, longitude);
                    } else {
                        // Tampilkan pesan di halaman HTML
                        showNotification('Jarak melebihi batas yang diizinkan.');
                    }
                },
                (error) => {
                    console.error('Error getting geolocation:', error);
                    showNotification('Gagal mendapatkan lokasi.');
                    sendDataToServer(photoURL, formattedDate, formattedTime, null, null);
                }
            );
        } else {
            console.error('Geolocation is not supported.');
            showNotification('Geolocation tidak didukung.');
            sendDataToServer(photoURL, formattedDate, formattedTime, null, null);
        }
    }

    function sendDataToServer(photoDataURL, currentDate, currentTime, latitude, longitude) {
        const xhr = new XMLHttpRequest();
        const formData = new FormData();

        const backendURL = 'save_data.php';

        formData.append('tanggal', currentDate);
        formData.append('jam_masuk', currentTime);
        formData.append('latitude_masuk', latitude);
        formData.append('longitude_masuk', longitude);
        formData.append('foto_base64', photoDataURL.split(',')[1]);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
            }
        };

        xhr.open('POST', backendURL, true);
        xhr.send(formData);
    }

    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371e3; // Radius bumi dalam meter
        const φ1 = toRadians(lat1);
        const φ2 = toRadians(lat2);
        const Δφ = toRadians(lat2 - lat1);
        const Δλ = toRadians(lon2 - lon1);

        const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
            Math.cos(φ1) * Math.cos(φ2) *
            Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        const distance = R * c;
        return distance;
    }

    function toRadians(degrees) {
        return degrees * Math.PI / 180;
    }

    function showNotification(message) {
        // Tampilkan pesan di elemen HTML
        notificationElement.innerHTML = message;

    }
    startButton.addEventListener('click', () => {
        startCamera();
    });

    captureButton.addEventListener('click', () => {
        capturePhoto();
    });
});