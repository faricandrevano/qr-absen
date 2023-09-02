<!DOCTYPE html>
<html>
<head>
    <title>BISMILLAH</title>
</head>
<body>

    <center style="margin-top: 11%">
        <div id="qr-reader" style="width:400px"></div>
        <div id="qr-reader-results"></div>
    </center>

<script src="html5-qrcode.min.js"></script>
<!-- <script src="./jsQR.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script>
    $(document).ready(function(){
        function docReady(fn) {
            // see if DOM is already available
            if (document.readyState === "complete"
                || document.readyState === "interactive") {
                // call on next available tick
                setTimeout(fn, 1);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }

        docReady(function () {
            var resultContainer = document.getElementById('qr-reader-results');
            var lastResult, countResults = 0;
            function onScanSuccess(decodedText, decodedResult) {
                if (decodedText !== lastResult) {
                    ++countResults;
                    lastResult = decodedText;
                    var timer;
                    if (lastResult == "telsabsen"){
                        if(navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(function(position) {
                                // var positionInfo = "Your current position is (" + "Latitude: " + position.coords.latitude + ", " + "Longitude: " + position.coords.longitude + ")";
                                // document.getElementById("result").innerHTML = positionInfo;
                                $.ajax({
                                    type: "POST",
                                    url: "sw-mod/proses.php",
                                    data: "&nama=" + "<?= $_COOKIE["cook_login"] ?>"
                                });
                            });
                        }
                        swal({title: 'Alert',text:'SCAN BERHASIL! <?= $_COOKIE["cook_login"]?>', timer:4000, icon:'success',willClose: ()=> {
                            clearTimeout(time);
                        }});
                        timer = setTimeout(() => {
                            window.location.href = './';
                        }, 4000);
                    } else {

                        swal({title: 'Alert',text:'SCAN GAGAL!?', timer:4000, icon:'error',willClose: ()=> {
                            clearTimeout(time);
                        }});
                        timer = setTimeout(() => {
                            window.location.href = './';
                        }, 4000);
                    }
                }
            }

            var html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", { fps: 10, qrbox: 260 });
            html5QrcodeScanner.render(onScanSuccess);
        });

    });

</script>

</body>
</html>