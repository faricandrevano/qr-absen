<?php if(empty($connection)){
	header('location:./404');
} else {

// if(isset($_SESSION['user'])){
if(isset($_COOKIE['cook_login'])){
// if(isset($_SESSION['user']) || isset($_COOKIE['cook_login'])){
echo'
<div class="appBottomMenu">
        <a href="./" class="item">
            <div class="col">
                <ion-icon name="home-outline"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>

        
        <a href="./profile" class="item">
            <div class="col">
                <ion-icon name="person-outline"></ion-icon>
                <strong>Profil</strong>
            </div>
        </a>
    </div>
<!-- * App Bottom Menu -->';
}
ob_end_flush();
echo'
<footer class="text-muted text-center" style="display:none">
   <p>© 2021 - '.$year.' '.$site_name.' - Design By: <span id="credits"><a class="credits_a" href="https://s-widodo.com" target="_blank">S-widodo.com</a></span></p>
</footer>
<!-- ///////////// Js Files ////////////////////  -->
<script src="sw-mod/html5-qrcode.min.js"></script>
<script>
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
        var resultContainer = document.getElementById("qr-reader-results");
        var lastResult, countResults = 0;
        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                // console.log(`Scan result ${decodedText}`, decodedResult);
                if (lastResult == "<?= $row["konten"] ?>")
                {
                    alert("SCAN BERHASIL: " + "<?= $row["konten"] ?>");
                }
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>
<!-- Jquery -->
<script src="'.$base_url.'sw-mod/sw-assets/js/lib/jquery-3.4.1.min.js"></script>
<!-- Bootstrap-->
<script src="'.$base_url.'sw-mod/sw-assets/js/lib/popper.min.js"></script>
<script src="'.$base_url.'sw-mod/sw-assets/js/lib/bootstrap.min.js"></script>
<!-- Ionicons -->
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
<script src="https://kit.fontawesome.com/0ccb04165b.js" crossorigin="anonymous"></script>
<!-- Base Js File -->
<script src="'.$base_url.'sw-mod/sw-assets/js/base.js"></script>
<script src="'.$base_url.'sw-mod/sw-assets/js/sweetalert.min.js"></script>
<script src="'.$base_url.'sw-mod/sw-assets/js/webcamjs/webcam.min.js"></script>';
if($mod =='history' OR $mod=='cuty' ){
echo'
<script src="'.$base_url.'sw-mod/sw-assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="'.$base_url.'sw-mod/sw-assets/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="'.$base_url.'sw-mod/sw-assets/js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="'.$base_url.'sw-mod/sw-assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
<script>
    $(".datepicker").datepicker({
        format: "dd-mm-yyyy",
        "autoclose": true
    }); 
    
</script>';
}
echo'
<script src="'.$base_url.'/sw-mod/sw-assets/js/sw-script.js"></script>';
if ($mod =='absent'){?>
<script type="text/javascript">
    var result;
    $(document).ready(function getLocation() {
        result = document.getElementById("latitude");
       // 
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        } else {
            swal({title: 'Oops!', text:'Maaf, browser Anda tidak mendukung geolokasi HTML5.', icon: 'error', timer: 3000,});
        }
    });
    
    // Define callback function for successful attempt
    function successCallback(position) {
       result.innerHTML =""+ position.coords.latitude + ","+position.coords.longitude + "";
    }

    // Define callback function for failed attempt
    function errorCallback(error) {
        if(error.code == 1) {
            swal({title: 'Oops!', text:'Anda telah memutuskan untuk tidak membagikan posisi Anda, tetapi tidak apa-apa. Kami tidak akan meminta Anda lagi.', icon: 'error', timer: 3000,});
        } else if(error.code == 2) {
            swal({title: 'Oops!', text:'Jaringan tidak aktif atau layanan penentuan posisi tidak dapat dijangkau.', icon: 'error', timer: 3000,});
        } else if(error.code == 3) {
            swal({title: 'Oops!', text:'Waktu percobaan habis sebelum bisa mendapatkan data lokasi.', icon: 'error', timer: 3000,});
        } else {
            swal({title: 'Oops!', text:'Waktu percobaan habis sebelum bisa mendapatkan data lokasi.', icon: 'error', timer: 3000,});
        }
    }
</script>
<?php 
// ========== Cek untuk deteksi Device Mobile===================//
if($mobile =='true'){?>
<script type="text/javascript">
    var result;
    $(document).ready(function getLocation() {
        result = document.getElementById("latitude");
       // 
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        } else {
            swal({title: 'Oops!', text:'Maaf, browser Anda tidak mendukung geolokasi HTML5.', icon: 'error', timer: 3000,});
        }
    });
    
    // Define callback function for successful attempt
    function successCallback(position) {
       result.innerHTML =""+ position.coords.latitude + ","+position.coords.longitude + "";
    }

    // Define callback function for failed attempt
    function errorCallback(error) {
        if(error.code == 1) {
            swal({title: 'Oops!', text:'Anda telah memutuskan untuk tidak membagikan posisi Anda, tetapi tidak apa-apa. Kami tidak akan meminta Anda lagi.', icon: 'error', timer: 3000,});
        } else if(error.code == 2) {
            swal({title: 'Oops!', text:'Jaringan tidak aktif atau layanan penentuan posisi tidak dapat dijangkau.', icon: 'error', timer: 3000,});
        } else {
            swal({title: 'Oops!', text:'Waktu percobaan habis sebelum bisa mendapatkan data lokasi.', icon: 'error', timer: 3000,});
        }
    }

    $(document).on('change','#webcam',function(){
        var file_data = $('#webcam').prop('files')[0];  
        var image_name = file_data.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        var latitude = $('.latitude').html();
        $('.progress').show();

        if(jQuery.inArray(image_extension,['gif','jpg','jpeg']) == -1){
          swal({title: 'Oops!', text: 'File yang di unggah tidak sesuai dengan format, File harus jpg, jpeg, gif.!', icon: 'error', timer: 2000,});
        }

        var form_data = new FormData();
        form_data.append("webcam",file_data);
        $.ajax({
            xhr : function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e){
                    if(e.lengthComputable){
                        console.log('Bytes Loaded : ' + e.loaded);
                        console.log('Total Size : ' + e.total);
                        console.log('Persen : ' + (e.loaded / e.total));
                        var percent = Math.round((e.loaded / e.total) * 100);
                        $('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                    }
                });
                return xhr;
            },
          url:'./sw-proses?action=absent&latitude='+latitude+'',
          method:'POST',
          data:form_data,
          contentType:false,
          cache:false,
          processData:false,
          success:function(data){
                var results = data.split("/");
                $results = results[0];
                $results2 = results[1];
                if($results =='success'){
                    swal({title: 'Berhasil!', text:$results2, icon: 'success', timer: 3500,});
                    setTimeout("location.href = './';",3600);
                    $('.progress').delay(500).fadeOut('slow');
                } else {
                    swal({title: 'Oops!', text: data, icon: 'error', timer: 3500,});
                    $('.progress').delay(500).fadeOut('slow');
                }
          }
        });
});
</script>

<?php }else{?>
<!-- SCRIPT ABSENSI DENGAN WEBCAME VIA PC -->
<script type="text/javascript">
    // start webcame
    Webcam.set({
        width: 590,height: 460,
        image_format: 'jpeg',
        jpeg_quality:80,
    });

    var cameras = new Array(); //create empty array to later insert available devices
    navigator.mediaDevices.enumerateDevices() // get the available devices found in the machine
    .then(function(devices) {
        devices.forEach(function(device) {
        var i = 0;
            if(device.kind=== "videoinput"){ //filter video devices only
                cameras[i]= device.deviceId; // save the camera id's in the camera array
                i++;
            }
        });
    })

    // Set Camera Depan =========
    Webcam.set('constraints',{
        width: 590,
        height: 460,
        image_format: 'jpeg',
        jpeg_quality:80,
        sourceId: cameras[0]
    });

    Webcam.attach('.webcam-capture');
    // preload shutter audio clip
    var shutter = new Audio();
    //shutter.autoplay = true;
    shutter.src = navigator.userAgent.match(/Firefox/) ? './sw-mod/sw-assets/js/webcamjs/shutter.ogg' : './sw-mod/sw-assets/js/webcamjs/shutter.mp3';
    function captureimage() {
    var latitude = $('.latitude').html();
        // play sound effect
        shutter.play();
        // take snapshot and get image data
        Webcam.snap( function(data_uri) {
            // display results in page
            Webcam.upload(data_uri, './sw-proses?action=absent&latitude='+latitude+'',
                function(code,text) {
                    $data       =''+text+'';
                    var results = $data.split("/");
                    $results = results[0];
                    $results2 = results[1];
                    if($results =='success'){
                        swal({title: 'Berhasil!', text:$results2, icon: 'success', timer: 3500,});
                        setTimeout("location.href = './';",3600);
                    }else{
                        swal({title: 'Oops!', text:text, icon: 'error', timer: 3500,});
                    }
            });    
        } );
    }
</script>
<?php }}?>
  <!-- </body></html> -->

  <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
  <script>

    $(document).ready(function() {

        $("#kelas").change(function() {
            var kelasnyaa = $(this).val();
            $.ajax({
                type: "POST",
                url: "nisnye.php",
                data: "kelasnyaa=" + kelasnyaa,
                success: function(data){
                    $("#nis").html(data);
                    $("#nama").html('<input type="text" name="nama" id="nama" class="form-control" value="" disabled>');
                }
            });
        });

        $("#nis").change(function(){
         
            var nisnye = $(this).val();
            $.ajax({
                type: "POST",
                url: "namanye.php",
                data: "nisnye=" + nisnye,
                success: function(data){
                    $("#nama").html(data);
                }
            });

        });

        document.getElementById("nama").innerHTML = '<input class="form-control" type="text" id="nama" name="nama" disabled>';

    });

  </script>

  <script>

    $(document).ready(function(){

        $("#tombol").click(function(){

            var tombol = $("#tombol");

            $.ajax({
                url: "vote.php",
                method: "POST",
                data: "tbl=" + tombol,
                success: function(data){
                    html(data);
                }
            })

        });

    });

  </script>

  </body>
</html>

<?php } ?>