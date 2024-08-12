<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>RS Baiturrahim Jambi</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{ asset('img/bg.png') }}">

        <link href="{{ asset('template/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('template/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('template/assets/css/style.css') }}" rel="stylesheet" type="text/css">
           <!-- Alertify css -->
    <link href="{{ asset('template/assets/plugins/alertify/css/alertify.css') }}" rel="stylesheet" type="text/css">

    <!-- DataTables -->
    <link href="{{asset('template/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('template/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset('template/assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />


    </head>


    <body class="fixed-left">
        <div class="accountbg"></div>
        <div class="contaier">
            <div class="container-fluid">
                <div style="margin-top: 15px;">

                    <div class="card" >
                        <div class="card-body" >
                            <h5 class="card-title">
                                <a href="#" onclick="history.go(-1)" class="btn btn-primary btn-sm">
                                    <span class="ti-arrow-circle-left"></span>
                                </a>
                                 Registrasi Pegawai

                            </h5>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">NIK</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="number" data-parsley-type="number" placeholder="NIK"
                                                data-parsley-maxlength="18" data-parsley-minlength="6" name="nik" id="nik"
                                                 value="{{ old('nik') }}" required>
                                        </div>
                                        <div class="col-sm-5">
                                            <a href="javascript:void(0);" id="tombol-carinik" class="btn btn-primary" >Cari NIK</a>
                                        </div>
                                    </div>
                                    <div  id="form-datapegawai">
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-3">
                                                <input class="form-control" value="{{ old('gl_dpn') }}" type="text" name="gl_dpn" placeholder="Gelar Depan" id="gl_dpn">
                                            </div>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama Lengkap" id="nama" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control" type="text" name="gl_blk" value="{{ old('gl_blk') }}" placeholder="Gelar Belakang" id="gl_blk">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="text"
                                                    placeholder="Tempat Lahir" name="tmpt_lahir" id="tmpt_lahir" value="{{ old('tmpt_lahir') }}" required>
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="example-text-input" class="col-form-label" >Tanggal Lahir</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}" id="tgl_lahir" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 my-1 control-label">Jenis Kelamin</label>
                                            <div class="col-md-4">
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="l" name="jenis_kelamin" value='Laki-Laki' @if(old('jk')=='Laki-Laki') checked @endif
                                                            class="custom-control-input" required>
                                                        <label class="custom-control-label" for="Laki-Laki">Laki-Laki</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="p" name="jenis_kelamin" value='Perempuan' @if(old('jk')=='Perempuan') checked @endif
                                                            class="custom-control-input">
                                                        <label class="custom-control-label" for="Perempuan">Perempuan</label>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-sm-2">
                                            <label class="col-form-label">Nomor HP</label>

                                            </div>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="number" data-parsley-type="number" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" required>
                                            </div>
                                            {{-- <div class="col-md-6">
                                            </div> --}}

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <div class="form-group row">

                                                    <label class="col-sm-4 col-form-label">Pendidikan Terakhir</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control mb-3 custom-select"
                                                            style="width: 100%; height:35px;" name="pendidikan_terakhir" id="pendidikan_terakhir" required>
                                                            <option value="">-- Pilih Pendidikan --</option>
                                                            <option @if(old('pendidikan_terakhir')=='S3') selected @endif value="S3">S3</option>
                                                            <option @if(old('pendidikan_terakhir')=='S2') selected @endif value="S2">S2</option>
                                                            <option @if(old('pendidikan_terakhir')=='S1') selected @endif value="S1">S1</option>
                                                            <option @if(old('pendidikan_terakhir')=='DIPLOMA IV') selected @endif value="DIPLOMA IV">DIPLOMA IV</option>
                                                            <option @if(old('pendidikan_terakhir')=='DIPLOMA III') selected @endif value="DIPLOMA III">DIPLOMA III</option>
                                                            <option @if(old('pendidikan_terakhir')=='DIPLOMA II') selected @endif value="DIPLOMA II">DIPLOMA II</option>
                                                            <option @if(old('pendidikan_terakhir')=='DIPLOMA I') selected @endif value="DIPLOMA I">DIPLOMA I</option>
                                                            <option @if(old('pendidikan_terakhir')=='SLTA UMUM') selected @endif value="SLTA UMUM">SLTA</option>
                                                            <option @if(old('pendidikan_terakhir')=='SLTP UMUM') selected @endif value="SLTP UMUM">SLTP</option>
                                                            <option @if(old('pendidikan_terakhir')=='SD') selected @endif value="SD">SD</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Jurusan</label>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="text"
                                                    placeholder="Jurusan" name="jurusan" id="jurusan" value="{{ old('jurusan') }}" required>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Nomor SK CPNS</label>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="text"
                                                    placeholder="Nomor SK CPNS" name="no_sk_cpns" id="no_sk_cpns" value="{{ old('no_sk_cpns') }}" required>
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="example-text-input" class="col-form-label">TMT CPNS</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="date" name="tmt_cpns" id="tmt_cpns"  value="{{ old('tmt_cpns') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Gol Ruang</label>
                                            <div class="col-sm-4">
                                                <select class="select2 form-control mb-3 custom-select" name="gol_ruang" id="gol_ruang" required>
                                                    <option value="">-- Pilih Gol Ruang --</option>
                                                    <option @if(old('gol_ruang')=='Juru Muda (I/a)') selected @endif value="Juru Muda (I/a)">Juru Muda (I/a)</option>
                                                    <option @if(old('gol_ruang')=='Juru Muda Tingkat I (I/b)') selected @endif value="Juru Muda Tingkat I (I/b)">Juru Muda Tingkat I (I/b)</option>
                                                    <option @if(old('gol_ruang')=='Juru (I/c)') selected @endif value="Juru (I/c)">Juru (I/c)</option>
                                                    <option @if(old('gol_ruang')=='Juru Tingkat I (I/d)') selected @endif value="Juru Tingkat I (I/d)">Juru Tingkat I (I/d)</option>
                                                    <option @if(old('gol_ruang')=='Pengatur Muda (II/a)') selected @endif value="Pengatur Muda (II/a)">Pengatur Muda (II/a)</option>
                                                    <option @if(old('gol_ruang')=='Pengatur Muda Tk.I (II/b)') selected @endif value="Pengatur Muda Tk.I (II/b)">Pengatur Muda Tk.I (II/b)</option>
                                                    <option @if(old('gol_ruang')=='Pengatur (II/c)') selected @endif value="Pengatur (II/c)">Pengatur (II/c)</option>
                                                    <option @if(old('gol_ruang')=='Pengatur Tk.I (II/d)') selected @endif value="Pengatur Tk.I (II/d)">Pengatur Tk.I (II/d)</option>
                                                    <option @if(old('gol_ruang')=='Penata Muda (III/a)') selected @endif value="Penata Muda (III/a)">Penata Muda (III/a)</option>
                                                    <option @if(old('gol_ruang')=='Penata Muda Tk.I (III/b)') selected @endif value="Penata Muda Tk.I (III/b)">Penata Muda Tk.I (III/b)</option>
                                                    <option @if(old('gol_ruang')=='Penata (III/c)') selected @endif value="Penata (III/c)">Penata (III/c)</option>
                                                    <option @if(old('gol_ruang')=='Penata Tk.I (III/d)') selected @endif value="Penata Tk.I (III/d)">Penata Tk.I (III/d)</option>
                                                    <option @if(old('gol_ruang')=='Pembina (IV/a)') selected @endif value="Pembina (IV/a)">Pembina (IV/a)</option>
                                                    <option @if(old('gol_ruang')=='Pembina Tk.I (IV/b)') selected @endif value="Pembina Tk.I (IV/b)">Pembina Tk.I (IV/b)</option>
                                                    <option @if(old('gol_ruang')=='Pembina Utama Muda (IV/c)') selected @endif value="Pembina Utama Muda (IV/c)">Pembina Utama Muda (IV/c)</option>
                                                    <option @if(old('gol_ruang')=='Pembina Utama Madya (IV/d)') selected @endif value="Pembina Utama Madya (IV/d)">Pembina Utama Madya (IV/d)</option>
                                                    <option @if(old('gol_ruang')=='Pembina Utama (IV/e)') selected @endif value="Pembina Utama (IV/e)">Pembina Utama (IV/e)</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="example-text-input" class="col-form-label">TMT Gol Ruang</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="DATE" name="tmt_gol_ruang" id="tmt_gol_ruang" value="{{ old('tmt_gol_ruang') }}" required>
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Jabatan</label>
                                            <div class="col-sm-5">
                                                <textarea name="jabatan" id="jabatan" required class="form-control"
                                                    maxlength="225" rows="3"
                                                    placeholder="Jabatan diambil dari SK Jabatan Terakhir, Contoh Penulisan : Kepala Bidang Mutasi dan Promosi"></textarea>
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="example-text-input" class="col-form-label">TMT Jabatan</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control" type="date" name="tmt_jabatan" id="tmt_jabatan" value="{{ old('tmt_jabatan') }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-7 my-1 control-label">Apakah anda mempunyai Riwayat Hukuman Disiplin</label>
                                            <div class="col-md-4">
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="HukdisYa" name="hukdis" value='HukdisYa' @if(old('hukdis')=='Ya') checked @endif
                                                            class="custom-control-input hukdis" required>
                                                        <label class="custom-control-label" for="HukdisYa">Ya</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="HukdisTidak" name="hukdis" value='HukdisTidak' @if(old('hukdis')=='Tidak') checked @endif
                                                            class="custom-control-input hukdis">
                                                        <label class="custom-control-label" for="HukdisTidak">Tidak</label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group row" id="dhukdis" style="display: none;">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Jenis Hukuman</label>

                                            <div class="col-sm-4">
                                                <select class="form-control mb-3 custom-select"
                                                        style="width: 100%; height:35px;" name="jenis_hukuman" id="jenis_hukuman">
                                                        <option value="">-- Pilih Jenis Hukuman --</option>
                                                        <option @if(old('jenis_hukuman')=='Sedang') selected @endif id="psedang"value="Sedang">Sedang</option>
                                                        <option @if(old('jenis_hukuman')=='Berat') selected @endif id="pberat" value="Berat">Berat</option>
                                                    </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="example-text-input" class="col-form-label">Nomor SK Hukdis</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="text" name="no_sk_jenis_hukuman" value="{{ old('no_sk_jenis_hukuman') }}" id="no_sk_jenis_hukuman" placeholder="Nomor SK Jenis Hukuman">
                                            </div>

                                        </div>
                                        <div class="form-group row" id="tdhukdis" style="display: none;">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">TMT Berakhirnya Hukdis</label>

                                            <div class="col-sm-4">
                                                <input class="form-control" type="date" name="tmt_hukdis" value="{{ old('tmt_hukdis') }}" id="tmt_hukdis">
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label class="col-md-7 my-1 control-label">Apakah anda mempunyai Riwayat CLTN</label>
                                            <div class="col-md-4">
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="CltnYa" name="cltn" value='CltnYa' @if(old('cltn')=='Ya') checked @endif
                                                            class="custom-control-input cltn" required>
                                                        <label class="custom-control-label" for="CltnYa">Ya</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="CltnTidak" name="cltn" value='CltnTidak' @if(old('cltn')=='Tidak') checked @endif
                                                            class="custom-control-input cltn">
                                                        <label class="custom-control-label" for="CltnTidak">Tidak</label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group row" id="dcltn" style="display: none;">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Nomor SK CLTN</label>

                                            <div class="col-sm-4">
                                                <input class="form-control" type="text" name="no_sk_cltn" value="{{ old('no_sk_cltn') }}" id="no_sk_cltn">
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="example-text-input" class="col-form-label">TMT Berakhir CLTN</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="date" name="tmt_cltn" value="{{ old('tmt_cltn') }}" id="tmt_cltn"  >
                                            </div>

                                        </div>
                                        <div class="form-group row" id="nama_dokumen" style="display: none;">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Nama Dokumen</label>

                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" id="namefile" disabled  value="{{ old('filesatya') }}" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Upload Dokumen</label>
                                            <div class="col-sm-10">
                                                <input type="file" id="input-file-now" name="filesatya" class="filess dropify"
                                                    onchange="Filevalidation()" required />
                                                <small class="form-text text-muted" style="color: red;font-style:italic;">note : Seluruh berkas persyaratan dibuat dalam satu format pdf dan tidak lebih dari 1000kb / 1mb</small>

                                                <p id="size"></p>

                                            </div>
                                        </div>
                                    </div>
                                    <button onclick="return confirm('Apakah anda yakin dengan data ini?')" type="submit" id="tombol-simpan" class="btn btn-primary btn-block" onClick="formSubmit()" >Simpan</button>
                                        </form>

                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Begin page -->



        <!-- jQuery  -->
        <script src="{{ asset('template/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('template/assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('template/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('template/assets/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('template/assets/js/detect.js') }}"></script>
        <script src="{{ asset('template/assets/js/fastclick.js') }}"></script>
        <script src="{{ asset('template/assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('template/assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('template/assets/js/waves.js') }}"></script>
        <script src="{{ asset('template/assets/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('template/assets/js/jquery.scrollTo.min.js') }}"></script>

        <!-- Alertify js -->
        <script src="{{ asset('template/assets/plugins/alertify/js/alertify.js') }}"></script>
        <script src="{{ asset('template/assets/pages/alertify-init.js') }}"></script>


        <!-- Required datatable js -->
        <script src="{{asset('template/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('template/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
        <!-- Buttons examples -->
        <script src="{{asset('template/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('template/assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{asset('template/assets/plugins/datatables/jszip.min.js')}}"></script>
        <script src="{{asset('template/assets/plugins/datatables/pdfmake.min.js')}}"></script>
        <script src="{{asset('template/assets/plugins/datatables/vfs_fonts.js')}}"></script>
        <script src="{{asset('template/assets/plugins/datatables/buttons.html5.min.js')}}"></script>
        <script src="{{asset('template/assets/plugins/datatables/buttons.print.min.js')}}"></script>
        <script src="{{asset('template/assets/plugins/datatables/buttons.colVis.min.js')}}"></script>
        <!-- Responsive examples -->
        <script src="{{asset('template/assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('template/assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

        <!-- Datatable init js -->
        <script src="{{asset('template/assets/pages/datatables.init.js')}}"></script>

        <!-- App js -->
        <script src="{{ asset('template/assets/js/app.js') }}"></script>
        <script>



            @if (Session::has('berhasil'))

            alertify.success("{{ Session::get('berhasil') }}");
            @elseif(Session::has('gagal'))
            alertify.error("{{ Session::get('gagal') }}");

            @endif

            $(function(){
                $('#tombol-carinik').on('click',function(){
                    var dnik=$('#nik').val();
                    // alert(dnik);
                    $('#tombol-carinik').html('Mencari data...');


                    $.ajax({
                        type: "get",
                        url: "/caripegawai",
                        cache: false,
                        data:{
                            'dnik':dnik
                        },
                        success: function (data) {
                            alert(data);
                            if(data==0){

                                $('#tombol-carinik').attr("disabled");
                                alert('Data anda tidak di temukan didalam database, silahkan hubungin unit IT untuk mendaftarkan akun...');
                                $('#tombol-carinik').html('Cari NIK');
                                // $('#form-nilai').hide();
                                $('#user').val(" ").change();
                                $('#form-datapegawai').hide();



                            }else if(data==1){
                                alert('Anda sudah menilai data ini');
                                $('#tombol-carinip').html('Cari NIP');

                            }else{
                                // dd(data['nama_pegawai']);
                                alert('Silahkan mulai mengisi form, Data pribadi anda tidak akan di tampilkan saat penilaian');
                                $('#dbname').val(data['nama_pegawai']).change();
                                $('#tmpt_lahir').val(data['tempat_lahir_pegawai']).change();
                                $('#tgl_lahir').val(data['tanggal_lahir_pegawai']).change();
                                if (data['jk'] == 'L') {
                                    $("#l").prop('checked', true);
                                }
                                else if (data['jk'] == 'P') {
                                    $("#p").prop('checked', true);
                                }

                                $('#form-datapegawai').show();
                                $('#tombol-carinik').html('Cari NIK');
                            }

                        },
                    });

                });


            });
        </script>



    </body>
</html>

