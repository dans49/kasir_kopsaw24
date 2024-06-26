    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>
                    All Rights Reserved &copy; Copyright <?php echo date('Y');?> Aplikasi Kasir Berbasis Web KPRI Sawangan Bappelitbangda Kabupaten Tasikmalaya.  
                </span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Custom scripts for all pages-->
    <script src="sb-admin/js/sb-admin-2.min.js"></script>
    <script src="sb-admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="sb-admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="sb-admin/vendor/select2/js/select2.full.min.js"></script>
    <script src="sb-admin/vendor/chart.js/Chart.min.js"></script>
    <script type="text/javascript">
    //datatable
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable();
    });
    $('.select2get').select2()
   </script>
   <?php
        $sql=" select * from barang where stok <=3";
        $row = $config -> prepare($sql);
        $row -> execute();
        $q = $row -> fetch();
            if($q['stok'] == 3){	
            if($q['stok'] == 2){	
            if($q['stok'] == 1){	
    ?>
   <script type="text/javascript">
    //template
    $(document).ready(function() {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Peringatan !',
            // (string | mandatory) the text inside the notification
            text: 'stok barang ada yang tersisa kurang dari 3 silahkan pesan lagi !',
            // (string | optional) the image to display on the left
            image: 'assets/img/seru.png',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'

        });

        return false;
    });
   </script>
   <?php }}}?>
   <script type="application/javascript">
    //angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert-danger").fadeIn('slow');
        }, 500);
    });
    //angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
    setTimeout(function() {
        $(".alert-danger").fadeOut('slow');
    }, 5000);

    $(document).ready(function() {
        setTimeout(function() {
            $(".alert-success").fadeIn('slow');
        }, 500);
    });
    setTimeout(function() {
        $(".alert-success").fadeOut('slow');
    }, 5000);

    $(document).ready(function() {
        setTimeout(function() {
            $(".alert-warning").fadeIn('slow');
        }, 500);
    });
    setTimeout(function() {
        $(".alert-success").fadeOut('slow');
    }, 5000);
   </script>
   <script>
    $(".modal-create").hide();
    $(".bg-shadow").hide();
    $(".bg-shadow").hide();

    function clickModals() {
        $(".bg-shadow").fadeIn();
        $(".modal-create").fadeIn();
    }

    function cancelModals() {
        $('.modal-view').fadeIn();
        $(".modal-create").hide();
        $(".bg-shadow").hide();
    }

    window.onload = function () {
        var url = window.location.search
        if(url == "?page=jual" || url == "?page=jual&success=tambah-data" || url == '?page=restok') {
            $("body").toggleClass("sidebar-toggled");
            $(".sidebar").toggleClass("toggled");
        }

        if(url == "?page=laporan") {
            $('.sidebar #collapse3').collapse('show');
        }

        if(url == "?page=barang" || url == "?page=kategori" || url == "?page=satuan" || url == "?page=pelanggan" ||url == "?page=supplier") {
            $('.sidebar #collapseTwo ').collapse('show');
        }

        if(url == "?page=user") {
            $('.sidebar #pengaturan').collapse('show');
        }


    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
   </script>

   <script>
    $(document).ready(function(){
        var now = $("#yearnow").val()
        $.ajax({
            url: "fungsi/apis/apigetsumpenjualan.php?tahun="+now,
            method: "GET",
            dataType: 'json',
            success: function(response) {
                penjualanChart(response)
            }
        })

        $("#chartyear").on('change',function(){
            var thn = $("#chartyear").val()
            $.ajax({
                url: "fungsi/apis/apigetsumpenjualan.php?tahun="+thn,
                method: "GET",
                dataType: 'json',
                success: function(response) {
                    resetChart()
                    penjualanChart(response)
                }
            })
        })
    })

    function resetChart() {
        $('#penjualan-chart').remove();
        $('.chartjs-size-monitor').remove();
        $('.cp').append("<canvas id='penjualan-chart' style='min-height: 250px; height: 450px; max-height: 550px; max-width: 100%;'></canvas>");
    }

    function penjualanChart(getdata) {
        var areaChartData = {
          labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus','September','Oktober','November','Desember'],
          datasets: [
            {
              label               : 'Penjualan Barang',
              backgroundColor     : 'rgba(60,141,188,0.9)',
              borderColor         : 'rgba(60,141,188,0.8)',
              pointRadius          : false,
              pointColor          : '#3b8bba',
              pointStrokeColor    : 'rgba(60,141,188,1)',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data                : getdata
            }
          ]
        }
        
        var barChartCanvas = $('#penjualan-chart').get(0).getContext('2d')
        var barChartData = jQuery.extend(true, {}, areaChartData)
        var temp0 = areaChartData.datasets[0]
        barChartData.datasets[0] = temp0

        var barChartOptions = {
            responsive              : true,
            maintainAspectRatio     : false,
            datasetFill             : false,
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return "Rp. "+tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    }
                }
            },
        }

        var barChart = new Chart(barChartCanvas, {
          type: 'bar', 
          data: barChartData,
          options: barChartOptions
        })
    }
    </script>

   </body>

</html>