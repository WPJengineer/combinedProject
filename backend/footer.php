<footer class="bg-light text-center p-6">
    <div class="copyright">&copy; 2025 TeamWear. All Rights Reserved.</div>
    <div>
        <button onclick="getLocalWeather();">click me</button>
    </div>
    <script>
        function getLocation() {
            const apiKey = 'zpka_0c52a288c0d7420b9a9acf1bc51cf5d0_8a04fb91';
            const options = {method: 'GET', headers: {Authorization: 'Bearer ' + apiKey}};
            fetch('https://dataservice.accuweather.com/locations/v1/cities/search?q=maó', options)
                .then(response => response.json())
                .then(response => console.log(response))
                .catch(err => console.error(err));
        }

        function getLocalWeather() {
            const options = {method: 'GET', headers: {Authorization: 'Bearer ' + apiKey}};
            fetch('https://dataservice.accuweather.com/currentconditions/v1/305482', options)
                .then(response => response.json())
                .then(response => console.log(response))
                .catch(err => console.error(err));
        }
        
    </script>
</footer>
<script src="/student014/shop/js/backendScript.js"></script>
</body>
</html>