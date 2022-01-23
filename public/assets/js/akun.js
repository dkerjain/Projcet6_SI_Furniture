

        $(document).ready(function() {

            // Tampilkan kota saat provinsi dipilih
            $('#akun').on('change', function () { 
                var id_akun = $('#akun').val();
               console.log('id_akun '+id_akun);
        
                    $.ajax({
                        type: 'GET',
                        url : '/get_akun/' +id_akun,
                        dataType: 'json',
                        success: function(data){
                            console.warn(data);
                            if(data[0].JENIS_AKUN == 0){
                                document.getElementById('jenis').value = "Pengeluaran"
                            }
                            else if(data[0].JENIS_AKUN == 1){
                                document.getElementById('jenis').value = "Pemasukan"
                            }
                           
                            console.log("ini jenis"+data[0].JENIS_AKUN);
                        }
                    });
            });
        });