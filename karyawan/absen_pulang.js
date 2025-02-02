document.addEventListener('DOMContentLoaded', (event) => {
    const video = document.getElementById('videoElement');
    const startButton = document.getElementById('startButton');
    const captureButton = document.getElementById('captureButton');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');
    let stream;

    //-7.549237190962741, 110.78619347302973
    const referenceLatitude = -7.549237190962741; // Ganti dengan nilai sesuai kebutuhan
    const referenceLongitude = 110.78619347302973; // Ganti dengan nilai sesuai kebutuhan
    const radius = 500; // Radius dalam meter

    async function startCamera() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({ video: true });
            video.srcObject = stream;
        } catch (error) {
            console.error('Error accessing camera:', error);
        }
    }

    function getLocation(callback) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                position => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    console.log('Latitude:', latitude);
                    console.log('Longitude:', longitude);
                    callback(latitude, longitude);
                },
                showError
            );
        } else {
            console.error('Geolocation is not supported by this browser.');
        }
    }

    function showError(error) {
        console.error('Error getting geolocation:', error.message);
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

    function capturePhoto(absenId, latitude, longitude) {
        const distance = calculateDistance(referenceLatitude, referenceLongitude, latitude, longitude);

        if (distance <= radius) {
            const tracks = stream.getTracks();
            tracks.forEach(track => track.stop());

            video.style.display = 'none';
            canvas.style.display = 'block';

            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const photoURL = canvas.toDataURL('image/png');

            // Ambil waktu server dengan mengirimkan permintaan ke server
            fetch('get_server_time.php')
                .then(response => response.json())
                .then(serverTime => {
                    const data = {
                        absenId: absenId,
                        jamKeluar: serverTime.serverTime,
                        latitudePulang: latitude,
                        longitudePulang: longitude,
                        fotoSelfiePulang: photoURL
                    };

                    sendDataToServer(data);

                    // Tampilkan pesan "Data tersimpan" di elemen dengan id 'notification2'
                    const notification2Element = document.getElementById('notification2');
                    if (notification2Element) {
                        notification2Element.innerHTML = 'Data tersimpan';
                    }
                })
                .catch(error => console.error('Error fetching server time:', error));
        } else {
            console.log('Jarak melebihi batas yang diizinkan.');

            // Tampilkan pesan di elemen HTML
            const notificationElement = document.getElementById('notification');
            if (notificationElement) {
                notificationElement.innerHTML = 'Jarak melebihi batas yang diizinkan.';
            }
        }
    }



    function sendDataToServer(data) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'pulang.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                console.log('Raw server response:', xhr.responseText);

                const response = JSON.parse(xhr.responseText);

                // Periksa status respons
                if (response.status === 'success') {
                    console.log('Server response:', response.message);

                    // Tampilkan data yang baru disimpan di elemen dengan id 'result'
                    const resultElement = document.getElementById('result');
                    if (resultElement) {
                        resultElement.innerHTML = 'New Data: ' + JSON.stringify(response.data);
                    }
                } else {
                    console.error('Server error:', response.message);
                }
            } else {
                console.error('Server error:', xhr.statusText);
            }
        };

        xhr.onerror = function() {
            console.error('Network error');
        };

        xhr.send(JSON.stringify(data));
    }

    startButton.addEventListener('click', () => {
        getLocation((latitude, longitude) => {
            startCamera();
            captureButton.addEventListener('click', () => {
                const absenId = document.getElementById('absenIdInput').value;

                // Panggil fungsi capturePhoto untuk menampilkan pesan "Data tersimpan"
                capturePhoto(absenId, latitude, longitude);


            });
        });
    });
});