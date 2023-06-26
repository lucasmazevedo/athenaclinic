<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="flex h-screen">
        <div class="bg-gray-950 grid h-screen w-3/4 place-items-center">
            <div class="flex w-10/12 flex-col items-center justify-center text-center">
                <div id="c1" class="text-9xl text-white">AN-0001</div>
                <div id="s1" class="text-6xl text-yellow-400">Guichê 02</div>
            </div>
        </div>

        <div class="bg-red-950 grid w-1/4 pt-2">
            <div class="bg-gray-950 h-10 w-full p-1 text-center align-middle text-2xl font-semibold text-white">
                ÚLTIMAS CHAMADAS
            </div>
            <div class="flex flex-col text-center">
                <div class="text-4xl text-white">Lucas Martins de Azevedo</div>
                <div class="text-4xl text-yellow-500">Consultório 01</div>
            </div>

            <div class="flex flex-col text-center">
                <div class="text-4xl text-white">JOAO DE DEUS FERREIRA</div>
                <div class="text-4xl text-yellow-500">Sala Tomografia</div>
            </div>

            <div class="flex flex-col text-center">
                <div class="text-4xl text-white">AP-0010</div>
                <div class="text-4xl text-yellow-500">Guichê 05</div>
            </div>

            <div class="flex flex-col text-center">
                <div class="text-4xl text-white">BEATRYZ MARIA BAYMA TERTO</div>
                <div class="text-4xl text-yellow-500">Consultório 05</div>
            </div>

            <div class="h-20 w-full bg-white p-3 text-center align-middle font-semibold text-white">
                <span id="lbData" class="text-black"></span><br>
                <span id="lbHora" class="text-4xl text-black"> </span>

            </div>
        </div>
    </div>
    <audio id="called_sound">
        <source src="{{ global_asset('/assets/audio/sound1.mp3') }}" type="audio/mpeg">
    </audio>
    <script type="module">
        var data_label = document.getElementById("lbData");
        var hora_label = document.getElementById("lbHora");

        function refreshTime() {
            var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', timeZone: "America/Sao_Paulo" };
            var timeString = new Date().toLocaleTimeString("pt-BR", {timeZone: "America/Sao_Paulo"});
            var dateString = new Date().toLocaleDateString("pt-BR", options);
            var formattedString = dateString.replace(", ", " - ");
            hora_label.innerHTML = timeString;
            data_label.innerHTML = dateString;
        }

        setInterval(refreshTime, 1000);

        var audio = document.getElementById("called_sound");
        var speaks = [{"name": "Clarinha", "lang": "pt-BR"}]
        const msg = new SpeechSynthesisUtterance();
        msg.volume = 1; //define o volume do áudio (de 0 a 1)
        msg.rate = 1; // define a velocidade do áudio (0.1 a 1)
        msg.pitch = 1; // define o tom em que o áudio é falado ( de 0 a 2)
        Echo.channel('public')
            .listen('PublicEvent', (e) => {
                audio.play();
                audio.onended = function() {
                    console.log('terminou notificação...');
                    msg.text = "Sra. Beatryz Maria Bayma Terto, dirija-se ao Consultório 10";
                    const voice = speaks[0];
                    voice.voiceURI = voice.name;
                    msg.lang = voice.lang;
                    speechSynthesis.speak(msg);
                };
                document.getElementById('c1').textContent = e.message[0];
                document.getElementById('s1').textContent = e.message[1];
            });
    </script>
</body>

</html>
