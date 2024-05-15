<!DOCTYPE html>
<html>

<?php
    session_start();
?>

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <meta name="description" content="Merkezi Hekim Randevu Sistemi (MHRS)">
    <meta name="keywords"
          content="MHRS, Randevu Al, MHRS Randevu, Hastane Randevu, Hekim Randevu, Randevu, Aile Hekimi Randevu, Aile Hekimi, Diş Randevu, Aile Diş Hekimi, Aile Diş Hekimi Randevu, Doktor Randevu, Diş Doktoru Randevu, T.C. Sağlık Bakanlığı, sağlık bakanlığı ">
    <link rel="shortcut icon" href="https://www.mhrs.gov.tr/img/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="stylesheet" href="css/cssmap-turkey/cssmap-turkey.css">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>


    

    <link
            href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
            rel="stylesheet"/>
    <link rel="stylesheet" href="css/style.css"/>

    <script src="openlayers/OpenLayers.js"></script> 
    <title>Koç University Merkezi Randevu Sistemi (KUMHRS)</title>
</head>


<style>
    .wrapper {
        width: 100%;
    }

    .panel-body {
        padding: 32px;
        text-align: justify;
    }

    .panel-heading {
        padding: 0;
        border: 0;
    }

    .panel-heading:hover {
        background-color: #dff0ef;
    }

    .panel-title > a,
    .panel-title > a:active {
        display: block;
        padding: 15px;
        color: #47b6b0;
        font-size: 16px;
        font-weight: bold;
        letter-spacing: 1px;
        word-spacing: 3px;
        text-decoration: none;
    }

    .panel-heading a:before {
        float: right;
        transition: all 0.5s;
    }

    .panel-heading.active a:before {
        -webkit-transform: rotate(180deg);
        -moz-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    .panel-group .panel + .panel {
        margin-top: 12px;
    }

    #mapid {
        height: 350px;
    }

</style>


<body>



<a href="" data-toggle="modal" data-target="#duyuruModalAsi">
    <button type="button" class="duyuruButton" id="asiPopUpButon" style="display: none;"></button>
</a>

<a href="" data-toggle="modal" data-target="#aydinlatmaMetniModal">
    <button type="button" class="duyuruButton" id="aydinlatmaMetniPopUpButon" style="display: none;"></button>
</a>

<div class="container-fluid">
    <div class="row">
        <!-- Fixed navbar -->

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="row">
                <div class="container-fluid" id="barContainer">
                    <div class="navbar-header" style="display: -webkit-inline-box;">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#navbar"
                                aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="https://www.saglik.gov.tr/" target="_blank">
                            <div class="topLeftLogo"><img src="img/sbLogoKırmızı.png" class="sbLogo" alt=""/></div>
                        </a>
                        <div class="mhrsYatayLogo">
                            <a href="index.html"><img src="img/svg/mhrsLogo.svg" alt=""></a>

                        </div>
                        <div class="mhrsLogo">
                            <a href="index.html"><img src="img/MHRS_Logo_1.png" alt=""></a>

                        </div>
                        <div class="mhrsLogo">
                            <a target="_blank" class="randevuLink">
                                <button type="button" class="topRandevual"> Randevu Al</button>
                            </a>
                        </div>

                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right" style=" padding: 16px;">
                            <a href="AppointmentPages/appointment.php" class="btn btn-info">
                                <h4>Randevu Al</h4>
                            </a>

                            <a href="pat_appoint.php" class="btn btn-danger p-4">
                                <h4>Randevu Görüntüle</h4>
                            </a>
                            <a href="pat_presc.php" class="btn btn-danger">
                                <h4>Reçetelerim</h4>
                            </a>

                            <?php if($_SESSION['is_doctor']):?>
                            <a href="doc_presc.php" class="btn btn-success">
                                <h4>Yazdığım Reçeteler</h4>
                            </a>

                            <a href="doc_appoint.php" class="btn btn-success">
                                <h4>Bana Olan Randevular</h4>
                            </a>
                            <?php endif; ?>

                            <a href="end_sessionController.php" class="btn btn-danger">
                                <h4>Exit</h4>
                            </a>
                           

                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>

        </nav>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                                aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel"> İl Sağlık Kurumları </h4>
                    </div>
                    <div class="modal-body" style="clear: both">
                        <div id="mapPanel" class="ui-panel ui-widget ui-widget-content ui-corner-all mapPanel"
                             data-widget="widget_mapPanel">
                            <div id="mapPanel_content" class="ui-panel-content ui-widget-content">

                                <div class="row">
                                    <div class="col-sm-12 col-md-1 col-lg-1"></div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div id="mapid"></div>
                                    </div>
                                    <div class="col-sm-12 col-md-1 col-lg-1"></div>

                                </div>
                                <div class="kurum" style="margin-top: 20px;">
                                    <div class="kurumHeader">
                                        <h5>Kurum</h5>
                                    </div>
                                    <div class="kurumBody" id="kurumContainer">
                                        <div class="containerBg" style="height: auto;">
                                            <div class="container" style="width: 100%;padding: 0;overflow-y: scroll;">
                                                <div class="mainContainer"
                                                     style="margin-top: 0;padding: 0;height: auto;">
                                                    <div class="wrapper center-block">
                                                        <div class="panel-group" id="accordion1" role="tablist"
                                                             aria-multiselectable="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="clear: both;"></div>
        </div>


        <div class="containerBg" style="height: auto;">
            <div class="container" style="width: 100%;padding: 0;overflow-y: scroll;">
                <div class="mainContainer" style="margin-top: 0;padding: 0;height: auto;">
                    <div class="wrapper center-block">
                        <div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
</div>
</div>
</div>
</div>
</div>

<div class="mobilRandevuAlButton">Randevu Al</div>

<div class="col-md-12 col-lg-12 col-sm-12">
    <div class="row">
        <div class="sliderButton">

            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators" id="mainCarousel">
                    <!--  <li data-target="#myCarousel" data-slide-to="0" class="active s-shadow"></li>-->
                    <li data-target="#myCarousel" data-slide-to="1" class="active s-shadow"></li>
                    <li data-target="#myCarousel" data-slide-to="2" class="s-shadow"></li>
                    <li data-target="#myCarousel" data-slide-to="3" class="s-shadow"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active slider-filter"><img src="https://www.mhrs.gov.tr/img/banner.png" alt="New York"/>
                        <div class="carousel-caption"><a>
                            <h3><strong>Türkiye'de En Çok Aranan Numara <br/>
                                Yine 182</strong><br/>
                            </h3>
                            <p> Bilgi Teknolojileri ve İletişim Kurumu verilerine göre 2021 yılında olduğu gibi
                                2022 yılının ilk çeyreğinde de 182 Türkiye'de en çok aranan numara oldu. </p>
                        </a></div>
                    </div>

                    <div class="item slider-filter"><img src="https://www.mhrs.gov.tr/img/neyimvar.jpg" alt="Chicago"/>
                        <div class="carousel-caption"><a>
                            <h3><strong>NeyimVar? Devreye Alındı <br/>
                            </strong>
                            </h3>
                            <p> Sağlık Bakanlığının yeni uygulaması “NeyimVar?” a şikâyetlerinizi girerek en uygun olası
                                tanıları öğrenebilir ve önerilen polikliniklere Merkezi Hekim Randevu Sistemi üzerinden
                                randevu alabilirsiniz.</p>
                        </a></div>
                    </div>
                    <div class="item slider-filter"><img src="https://www.mhrs.gov.tr/img/neyimvar2.jpg"
                                                         alt="Neyim Var Hakkında"/>
                        <div class="carousel-caption"><a>
                            <h3><strong>NeyimVar? Hakkında <br/>
                            </strong>
                            </h3>
                            <p> NeyimVar? Sistemi, vatandaşların şikayetlerine göre doğru polikliniğe yönlendirilmesini
                                amaçlayan web ve mobil tabanlı bir uygulamadır.
                                Sistemin sorduğu sorulara verdiğiniz cevaplar ile varsa e-Nabız’dan alınan sağlık
                                verileriniz kullanılarak olası tanı ve poliklinik önerilerine erişmenizi sağlar. Sizi,
                                ilgili polikliniklere MHRS'den randevu almaya yönlendirir. </p>
                        </a></div>
                    </div>
                </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev"> <img src="https://www.mhrs.gov.tr/img/svg/arrowLedt.svg"
                                                                                            class="arrowLeft" alt="">
                    <span class="sr-only">Previous</span> </a> <a class="right carousel-control"
                                                                  href="#myCarousel" data-slide="next"> <img
                    src="https://www.mhrs.gov.tr/img/svg/arrowRight.svg" class="arrowRight" alt=""> <span
                    class="sr-only">Next</span> </a>
            </div>
            <div style="clear: both;"></div>
        </div>
        <div style="clear: both;"></div>
    </div>
    <div style="clear: both;"></div>
</div>
<div style="clear: both;"></div>
</div>
</div>
<div class="socialMediaItems">
    <div class="socialItem">
        <a href="https://twitter.com/tired_studentx" target="_blank"
           class="twitter"> <img src="https://www.mhrs.gov.tr/img/svg/twitterYeni.svg" alt="">
        </a>
        <a href="https://www.facebook.com/MerkeziHekimRandevuSistemi/" target="_blank"
           class="facebook"> <img src="https://www.mhrs.gov.tr/img/svg/facebookYeni.svg" alt="">
        </a>
        <a href="https://www.instagram.com/mhrs_182/" target="_blank"
           class="instagram"> <img src="https://www.mhrs.gov.tr/img/svg/instagramYeni.svg" alt="">
        </a>
    </div>
    <div>
        <table class="randevuSayiImg" id="RandevuSayisiGecmisi">
            <tr>
                <td style="text-align: left; padding-left: 45px">
                    <b>TARİH</b>
                </td>
                <td style="padding-right: 150px;">
                    <b>ALINAN RANDEVU SAYISI</b>
                </td>
            </tr>
        </table>
    </div>
    <div class="aydinlatmaMetni">
        <h5 onclick="aydinlatmaMetniPopUpGoster()"> Aydınlatma Metni</h5>
        <img onclick="aydinlatmaMetniPopUpGoster()" src="https://www.mhrs.gov.tr/img/svg/aydinlatma-metni.svg" class="info" alt=""/>
    </div>


</div>

<div class="col-lg-12 col-md-12 col-sm-12 duyuru pb-4">
    <div class="duyuruContainer">
        <h3 class="duyuruText">Duyurular</h3>
        <div class="col-lg-4 col-md-3 col-sm-12 "><a href="" data-toggle="modal" data-target="#duyuruModal1">
            <button type="button" class="duyuruButton"> Sağlık Bakanlığına bağlı tüm sağlık kurum ve kuruluşlarına
                muayene randevu hizmeti sunan Merkezi Hekim Randevu Sistemi (MHRS), gelişmiş teknolojiler ışığında
                yenilenmeye ve hizmet kalitesini artırmaya devam ediyor.
            </button>
        </a></div>
        <!--  <div class="col-lg-4 col-md-4 col-sm-12"><a href="" data-toggle="modal" data-target="#duyuruModal2">
              <button type="button" class="duyuruButton"> Tüm Türkiye'ye hizmet veren Merkezi Hekim Randevu Sistemi
                  (MHRS), şimdi sesinize daha güçlü kulak vermek için hizmet ağını büyüterek Alo182'nin 10. lokasyonunu
                  Başbakan Binali YILDIRIM'ın katılımıyla Erzincan'da açtı.
              </button>
          </a></div>-->
        <div class="col-lg-4 col-md-4 col-sm-12"><a href="" data-toggle="modal" data-target="#duyuruModal3">
            <button type="button" class="duyuruButton"> T.C. Sağlık Bakanlığı, Sağlık Bilgi Sistemleri Genel Müdürlüğü
                tarafından Merkezi Hekim Randevu Sistemi (MHRS) yönergesinde sistemin teknik alt yapısı ve işleyişine
                dair bazı düzenlemeler yapılan yönergeyi onayladı.
            </button>
        </a></div>
        <div class="col-lg-4 col-md-3 col-sm-12 "><a href="" data-toggle="modal" data-target="#duyuruModal4">
            <button type="button" class="duyuruButton"> İhtiyaçları önceliğimiz olan 65 yaş üstü, kanser hastası,
                kimsesiz, riskli gebe ve engelli
                vatandaşlarımız için MHRS'de randevu önceliği uygulaması başlatıldı.
            </button>
        </a></div>
        <div class="col-lg-4 col-md-4 col-sm-12"><a href="" data-toggle="modal" data-target="#duyuruModal5">
            <button type="button" class="duyuruButton"> e-Devlet şifresi olan vatandaşlarımız, MHRS üyeliği bulunmasa
                bile mhrs.gov.tr adresinden e-Devlet girişiyle de MHRS'nin sunduğu hizmetlerden yararlanabilmektedir.
            </button>
        </a></div>
        <div class="col-lg-4 col-md-4 col-sm-12"><a href="" data-toggle="modal" data-target="#duyuruModal6">
            <button type="button" class="duyuruButton"> Daha önce EMEA (Avrupa, Orta Asya ve Afrika) bölgesinin "Best
                Outsourcing Partnership" (En İyi Dış Kaynak Ortaklığı) kategorisinde 2017 yılı birincisi olan MHRS,
                şimdi de kıtalararası dünya birinciliğini elde etti.
            </button>
        </a></div>
        <div class="col-lg-4 col-md-3 col-sm-12 "><a href="" data-toggle="modal" data-target="#duyuruModal7">
            <button type="button" class="duyuruButton"> Sağlık Bakanlığına bağlı hastanelerin semt polikliniklerine MHRS
                üzerinden randevu oluşturabilme uygulaması Türkiye genelinde hizmete girdi. Vatandaşlar, bundan böyle
                MHRS üzerinden semt polikliniklerini ayrı bir kurum gibi görüntüleyip randevu alabilecek.
            </button>
        </a></div>
        <!--<div class="col-lg-4 col-md-4 col-sm-12"> <a href="" data-toggle="modal"  data-target="#duyuruModal8">
            <button type="button" class="duyuruButton"> Merkezi Hekim Randevu Sistemi (MHRS ) sağlık kurulu randevularını bünyesine alarak hizmet yelpazesini genişletti.</button>
          </a> </div>-->
    </div>
</div>


<div class="modal fade" id="duyuruModalSokak" tabindex="-1" role="dialog" aria-labelledby="duyuruModalLabelSokak"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="duyuruModalLabel1">KISITLAMALAR SÜRECİNDE COVİD-19 AŞI RANDEVULARI
                    HAKKINDA</h4>
            </div>
            <div style="width: 90%;padding: 5%;">Değerli vatandaşlarımız,<br><br>
                Covid-19 aşı randevunuzu sokağa çıkma kısıtlaması olan bir güne aldıysanız aşağıdaki belgelerden
                herhangi birini gerektiğinde güvenlik görevlilerine ibraz etmek için yanınızda bulundurarak aşınızı
                yaptıracağınız sağlık kuruluşuna gidebilirsiniz:<br><br>
                -MHRS mobil ve web sitesindeki "Randevularım" sekmesinde bulunan ilgili randevu kartı.<br>
                -Randevu bilgilerinizin bulunduğu sayfanın PDF olarak alabileceğiniz çıktısı.<br>
                -Randevu bilgilerinin bulunduğu sayfanın cihazınıza kaydedilmiş ekran görüntüsü.<br>
                -Randevu bilgilendirme seçeneklerinde SMS veya mail ile bilgilendirme tercihiniz aktif ise size
                gönderilen randevu bilgilendirme mesajı.
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>
</div>


<div class="modal fade" id="duyuruModal1" tabindex="-1" role="dialog" aria-labelledby="duyuruModalLabel1"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="duyuruModalLabel2">MHRS'DE CEPTEN RANDEVU HATIRLATMA DÖNEMİ</h4>
            </div>
            <div style="width: 90%;padding: 5%;">Sağlık Bakanlığına bağlı tüm sağlık kurum ve kuruluşlarına muayene
                randevu hizmeti sunan Merkezi Hekim Randevu Sistemi (MHRS), gelişmiş teknolojiler ışığında yenilenmeye
                ve hizmet kalitesini artırmaya devam ediyor.
                <br><br>
                2010 yılından bu yana tüm Türkiye’ye kesintisiz hizmet veren MHRS, randevulara artan talebe karşılık
                yeni bir uygulamayı daha hayata geçirdi. MHRS’de yoğunlaşan talebe cevap vermek, randevuları
                hatırlatarak MHRS kolaylığından yararlanma oranını yükseltmek ve gerekli durumda iptalini
                gerçekleştirerek muayene saatlerini tekrar randevuya açmak için randevu tarihinden 1 gün önce
                vatandaşlara tercihine göre SMS ve sesli arama ile randevu hatırlatma/iptal servislerini hayata geçirdi.
                Böylece, gidemeyeceği muayene randevularının iptalini gerçekleştiren vatandaşlar diğer vatandaşların
                MHRS’ den faydalanmasına katkı sağlayacak.
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>
</div>


<!--<div class="modal fade" id="duyuruModal2" tabindex="-1" role="dialog" aria-labelledby="duyuruModalLabel2"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="duyuruModalLabel2">ERZİNCAN LOKASYONU AÇILDI</h4>
            </div>
            <div style="width: 90%;padding: 5%;">Tüm Türkiye'ye hizmet veren Merkezi Hekim Randevu Sistemi (MHRS), şimdi
                sesinize daha güçlü kulak vermek için hizmet ağını büyüterek Alo182'nin 10. lokasyonunu Başbakan Binali
                YILDIRIM’ın katılımıyla Erzincan'da açtı.
                <br><br>
                MHRS gelişen bilişim teknolojileriyle yenilenmeye, yeni lokasyonlar ile büyümeye ve hizmet kalitesini
                geliştirmeye devam ediyor. Sağlık Bakanlığına bağlı tüm sağlık kurum ve kuruluşlarına üç ayrı kanaldan
                muayene randevusu veren MHRS, Türkiye’nin en büyük kamu çağrı merkezine sahip projesidir. Türkiye’nin
                her noktasına 7/24 hizmet veren Alo182 çağrı merkezi vatandaşlara en iyi hizmeti verebilmek için
                Erzincan’da açtığı yeni lokasyonuyla çağrı merkezi sayısını 10’a yükseltti. Erzincan’da açılan bu yeni
                lokasyon vatandaşların MHRS’den daha etkin faydalanmasına katkı sağlayacak.
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>
</div>-->


<div class="modal fade" id="duyuruModal3" tabindex="-1" role="dialog" aria-labelledby="duyuruModalLabel3"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="duyuruModalLabel3">MHRS Çalışma Usul ve Esasları Hakkında Yönerge
                    Yayınlandı</h4>
            </div>
            <div style="width: 90%;padding: 5%;">T.C. Sağlık Bakanlığı, Sağlık Bilgi Sistemleri Genel Müdürlüğü
                tarafından Merkezi Hekim Randevu Sistemi (MHRS) yönergesinde sistemin teknik alt yapısı ve işleyişine
                dair bazı düzenlemeler yapılan yönergeyi onayladı.
                <br><br>

                Vatandaşların, Sağlık Bakanlığına bağlı sağlık kuruluşlarından hizmet almasını kolaylaştırmak maksadıyla
                yapılan güncelleme, 2016 yılı itibari ile hayata geçti.
                <br><br>

                İlgili yönerge için <a href="https://dosyasb.saglik.gov.tr/Eklenti/15602,mhrs-yonerge-yenipdf.pdf?0"
                                       target="_blank">tıklayınız</a></div>
        </div>
    </div>
    <div style="clear: both;"></div>
</div>


<div class="modal fade" id="duyuruModal4" tabindex="-1" role="dialog" aria-labelledby="duyuruModalLabel4"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="duyuruModalLabel4">ÖNCELİKLİ HASTALAR UYGULAMASI</h4>
            </div>
            <div style="width: 90%;padding: 5%;">İhtiyaçları önceliğimiz olan 65 yaş üstü, kanser hastası, kimsesiz,
                riskli gebe ve engelli
                vatandaşlarımız için MHRS'de randevu önceliği uygulaması başlatıldı.
                <br><br>
                Hekimlerimizin günlük belli kontenjanları otomatik olarak bu vatandaşlarımıza ayrılmaktadır. Sağlık
                Bakanlığı kayıtlarında "öncelikli" kaydı bulunan vatandaşlarımız kendilerine ayrılmış olan kontenjandan
                faydalanarak randevu alabilmektedirler.
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>
</div>


<div class="modal fade" id="duyuruModal5" tabindex="-1" role="dialog" aria-labelledby="duyuruModalLabel5"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="duyuruModalLabel5">MHRS e-DEVLET BULUŞMASI</h4>
            </div>
            <div style="width: 90%;padding: 5%;">e-Devlet şifresi olan vatandaşlarımız, MHRS üyeliği bulunmasa bile
                mhrs.gov.tr adresinden e-Devlet girişiyle de MHRS'nin sunduğu hizmetlerden yararlanabilmektedir.
                <br><br>

                Ana sayfada bulunan "Randevu Al" butonu tıklandıktan sonra açılan sayfada "e-Devlet ile Giriş"
                seçilerek, kullanıcı bilgileri doldurulup, sisteme kolayca giriş sağlanacaktır. e-Devlet üzerinden
                mhrs.gov.tr'ye giriş yapan vatandaşlar; randevu oluşturma, iptal etme, geçmiş randevularını görüntüleme
                gibi bütün hizmetlere kolayca erişebilecektir
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>
</div>


<div class="modal fade" id="duyuruModal6" tabindex="-1" role="dialog" aria-labelledby="duyuruModalLabel6"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="duyuruModalLabel6">MHRS'DEN GURURLANDIRAN ÖDÜL</h4>
            </div>
            <div style="width: 90%;padding: 5%;">Daha önce EMEA (Avrupa, Orta Asya ve Afrika) bölgesinin “Best
                Outsourcing Partnership” (En İyi Dış Kaynak Ortaklığı) kategorisinde 2017 yılı birincisi olan MHRS,
                şimdi de kıtalararası dünya birinciliğini elde etti.
                <br><br>
                Türkiye'nin öz kaynakları ile hayat bulan ve hastanelere tek merkezden randevu alma imkanı sunan MHRS,
                uluslararası büyük bir ödül daha kazandı. Dünyada, ülkesindeki tüm hastaneleri merkezi randevu
                sisteminde buluşturan ilk ve tek sistem olan MHRS, tescillenen başarısı ile bizleri bir kez daha
                gururlandırdı.
                <br><br>
                Londra'da düzenlenen, Avrupa, Amerika, Orta Asya ve Afrika'dan birçok temsilcinin yarıştığı ve Çağrı
                merkezi sektörünün en saygın yarışmalarından olan Contact Center World Awards'a "Best Outsourcing
                Partnership" (En İyi Dış Kaynak Ortaklığı) kategorisinde katılan MHRS, dünyanın en iyi çağrı
                merkezlerini geride bırakarak 2017 yılı dünya birincisi oldu.
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>
</div>


<div class="modal fade" id="duyuruModal7" tabindex="-1" role="dialog" aria-labelledby="duyuruModalLabel7"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="duyuruModalLabel7">SEMT POLİKLİNİKLERİNE RANDEVU VERİLMEYE BAŞLANDI</h4>
            </div>
            <div style="width: 90%;padding: 5%;">Sağlık Bakanlığına bağlı hastanelerin semt polikliniklerine MHRS
                üzerinden randevu oluşturabilme uygulaması Türkiye genelinde hizmete girdi. Vatandaşlar, bundan böyle
                MHRS üzerinden semt polikliniklerini ayrı bir kurum gibi görüntüleyip randevu alabilecek.
                <br><br>
                Semt polikliniklerine ayrı birer kurum
                gibi MHRS üzerinden randevu oluşturabilme uygulaması tüm Türkiye'de hizmete girdi. Vatandaşların
                ALO182’ye alternatif olarak aynı bilgilere erişerek muayene randevusu alabildiği mhrs.gov.tr ve MHRS
                Mobil uygulamasında yapılan güncelleme ile semt poliklinikleri artık bağlı olduğu ana hastanenin altında
                ayrı ayrı listelenecek.
                <br><br>
                Uygulama ile Sağlık bakanlığına bağlı hastanelerin çeşitli lokasyonlarında bulunan alt polikliniklerine
                dair bilgiler görüntülenebilecek. Bu sayede vatandaşların en yakın hizmet noktasını seçerek randevu
                alabilmesi ve alt polikliniklere ana hastanenin ismi ile randevu verildiğinde yaşanan karışıklıkların
                giderilmesi amaçlanıyor.
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>
</div>


<div class="modal fade" id="duyuruModal8" tabindex="-1" role="dialog" aria-labelledby="duyuruModalLabel8"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="duyuruModalLabel8">MHRS'DEN YENİ BİR HİZMET: SAĞLIK KURULU</h4>
            </div>
            <div style="width: 90%;padding: 5%;">Merkezi Hekim Randevu Sistemi (MHRS ) sağlık kurulu randevularını
                bünyesine alarak hizmet yelpazesini genişletti.
                <br><br>
                Sağlık raporları alım sürecinde yaşanan zaman kaybının önüne geçmek ve vatandaşlarımızın bu hizmetten
                kolayca faydalanmasını sağlamak için sağlık kurulu kayıt randevusu Aralık 2017’den itibaren MHRS
                üzerinden verilmeye başladı. Bundan böyle, hasta kayıt ve ilgili branşlardaki rapor işlemlerinin
                başlatılması için öncelikle hastanelerde bulunan sağlık kurulu kliniğine randevu alınabilecek.
                <br><br>
                Yeni düzenleme ile sağlık kuruluna girmek isteyen vatandaşlar, randevularını MHRS’den alarak belirlenen
                tarihte hastanenin sağlık kurulu birimi sekreteryasına başvurarak işlemlerini gerçekleştirebilecektir.
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>
</div>


<!--<div class="modal fade" id="duyuruModalAsi" tabindex="-1" role="dialog" aria-labelledby="duyuruModalLabelAsi"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="duyuruModalLabelAsi">COVİD-19 AŞI RANDEVULARI HAKKINDA</h4>
            </div>
            <div style="width: 90%;padding: 5%;">

                Saygıdeğer Vatandaşımız, <br>
                Aşılama için önceliği bulunan gruplar sırasıyla Ulusal Basın ve Medya organları ile kamuoyuna
                duyurulacak ve bu duyurudan sonra randevu verilecektir.

            </div>
        </div>
        <div style="clear: both;"></div>
    </div>
</div>-->

<div class="modal fade" id="aydinlatmaMetniModal" tabindex="-1" role="dialog" aria-labelledby="duyuruModalLabelAsi"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div style="background-color: #42505f;" class="modal-header">
                <h4 style="color: #FFFFFF;" class="modal-title" id="aydinlatmaMetniLabelAsi">T.C. SAĞLIK BAKANLIĞI MHRS
                    AYDINLATMA METNİ</h4>
            </div>
            <div style="width: 90%;padding: 5%;">

                <h5 class="titleBlack">Aydınlatma Metni</h5>
                <p style="text-align: justify;">
                    Bu Aydınlatma Metni, 6698 sayılı Kişisel Verilerin Korunması Kanunu’nun (“KVK Kanunu”) “Veri
                    Sorumlusunun Aydınlatma Yükümlülüğü” kenar başlıklı 10’uncu maddesi uyarınca ve KVK Kanunu
                    kapsamında veri sorumlusu olan T.C. Sağlık Bakanlığı (Bakanlık) tarafından, Merkezi Hekim Randevu
                    Sistemi (MHRS) kullanıcılarına, kullanıcılara ait kişisel veriler hususunda bilgilendirme yapmak
                    amacıyla hazırlanmıştır. KVK Kanunu uyarınca veri sorumlusu sıfatını haiz Bakanlığın merkez adresi
                    “Bilkent Yerleşkesi, Üniversiteler Mah. Dumlupınar Bulvarı 6001. Cad. No:9 Çankaya/Ankara
                    06800”dir.</p>
                <h5 class="titleBlack">Veri Sorumlusunun Kimliği</h5>
                <p style="text-align: justify;">
                    Bu sistemde işlenen kişisel verileriniz bakımından veri sorumlusu T.C. Sağlık Bakanlığı’dır.
                <h5 class="titleBlack">Kişisel Verilerin İşlenme Amaçları</h5>

                <p style="text-align: justify;">
                    Bu sistemde aşağıda yer alan kişisel verileriniz şu amaçlarla işlenebilmektedir.</p>

                <p style="text-align: justify; margin-left: 10px">
                    - Kimlik verisi: MHRS’de sizin ve varsa yetkili olduklarım sekmesinden görebileceğiniz 18 yaşından
                    küçük çocuklarınızın T.C. Kimlik Numarası, adı, soyadı, baba adı, anne adı doğum yeri, doğum tarihi,
                    yaş ve cinsiyet bilgileri kimliğinizin doğrulanması ve alabileceğiniz randevuların belirlenebilmesi
                    amacıyla işlenebilmektedir.</p>


                <p style="text-align: justify; margin-left: 10px">
                    - İletişim verisi: MHRS’de sizin ve varsa yetkili olduklarım sekmesinden görebileceğiniz 18 yaşından
                    küçük çocuklarınızın sabit telefon numarası, cep telefonu numarası veya e-Posta adresi bilgileri
                    üyelik aşamasında randevu hizmetlerinin sürdürülebilmesi için sizinle SMS yoluyla, canlı operatör,
                    robotik arama bilgilendirme yöntemleri ile iletişime geçilebilmesi ve MHRS Mobil veya web üyeliğiniz
                    yok ise çağrı merkezi tarafından almış olduğunuz randevu bilgilerinizin size iletilmesi, herhangi
                    bir randevu değişikliği olduğunda size bilgi ve hatırlatma yapılabilmesi amaçlarıyla
                    işlenebilmektedir. Almış olduğumuz telefon bilgileri üzerinden sizinle iletişime geçme yöntemimiz
                    için web veya mobil üyelikleriniz üzerinden kendi tercihinizi belirleme hakkına sahipsiniz.</p>

                <p style="text-align: justify; margin-left: 10px">
                    - Konum verisi: MHRS’de sizin ve varsa yetkili olduklarım sekmesinden görebileceğiniz 18 yaşından
                    küçük çocuklarınızın bulunduğunuz yerin konum bilgisi, akıllı mobil cihazınıza indirmiş olduğunuz
                    MHRS Mobil uygulamasının konum bilgisi tercihlerinden “sürekli” veya “sadece uygulamayı kullanırken”
                    seçenekleri ile belirleyeceğiniz şekilde, herhangi bir navigasyon aracı ile randevu aldığınız
                    hastanenin adresine kolayca ulaşabilmeniz için sadece anlık olarak kullanılmakta, kayıt altına
                    alınmamaktadır. Ne zaman kullanması gerektiğini tercih ederek belirleyebilirsiniz. Konum
                    servislerinizin kapalı olması halinde konum bilginiz MHRS tarafından işlenmemektedir.</p>


                <p style="text-align: justify; margin-left: 10px">
                    - Sağlık verisi: MHRS’ de sizin ve varsa yetkili olduklarım sekmesinden görebileceğiniz 18 yaşından
                    küçük çocuklarınızın almış veya iptal etmiş olduğunuz muayene randevu tarihi ve saati, randevu
                    alınan hastane/kurum/klinik/ hekim, özellikli hasta kodu, hasta randevu numarası, engel durumu,
                    almış veya iptal etmiş olduğunuz aşı tarihi ve saati, aşı randevu numarası bilgileriniz iş
                    sürekliliğinin sağlanması faaliyetlerinin yürütülmesi, aşı randevu süreçlerinin yürütülmesi,
                    vatandaş bildirim süreçlerinin (SMS,Push,e-Posta vb.) yürütülmesi amacıyla işlenebilmektedir. Aşı
                    hakkınızın olup olmadığı, kaçıncı doz aşı randevusu alabileceğiniz, evde aşı yaptırma hakkınızın
                    olup olmadığı, hangi tür aşıyı yaptırma hakkınızın olduğu bilgileriniz ise anlık olarak
                    kullanılmakta, kayıt altına alınmamaktadır.</p>
                <p style="text-align: justify; margin-left: 10px">
                    - Görsel ve işitsel veri: Ses kaydı kişisel veriniz çağrı merkezi üzerinden yapılan işlemlerde
                    alınmakta olup, randevu hizmeti alan ve veren kişilerin işlem güvenliğinin yürütülmesi amacıyla
                    işlenebilmektedir. </p>
                <p style="text-align: justify; margin-left: 10px">
                    - İşlem güvenliği verisi: MHRS’de kullanıcı adı ve parola bilgileri iş sürekliliğinin sağlanması
                    faaliyetlerinin yürütülmesi ve vatandaş üyelik işlemlerinin yürütülmesi amacıyla
                    işlenebilmektedir. </p>

                <h5 class="titleBlack">Kişisel Verilerin Aktarımı</h5>

                <p style="text-align: justify;">Merkezi Hekim Randevu Sistemi’ndeki kişisel verileriniz KVK Kanunu’nun
                    8’inci maddesi ile 28’inci maddesinin ilk fıkrasında yer alan muafiyet halleri saklı kalmak üzere,
                    hiçbir şekilde üçüncü taraflarla paylaşılmamaktadır.

                </p>

                <h5 class="titleBlack">Kişisel Veri Toplamanın Yöntemi ve Hukuki Sebebi</h5>

                <p style="text-align: justify;">Kişisel verileriniz tamamen otomatik yollarla (bu sistem aracılığı ile)
                    elde edilmekte olup kişisel verilerinizin işlenmesinin hukuki dayanağı, KVK Kanunu’nun 5’inci
                    maddesinin ikinci fıkrasının (ç) bendi uyarınca veri sorumlusunun hukuki yükümlülüğünü yerine
                    getirebilmesi için zorunlu olması ve (f) ilgili kişinin temel hak ve özgürlüklerine zarar vermemek
                    kaydıyla, veri sorumlusunun meşru menfaatleri için veri işlenmesinin zorunlu olması ile 6’ncı
                    maddesinin üçüncü fıkrası uyarınca; kamu sağlığının korunması, koruyucu hekimlik, tıbbî teşhis;
                    tedavi ve bakım hizmetlerinin yürütülmesi, sağlık hizmetleri ile finansmanının planlanması ve
                    yönetimi amacıyla, sır saklama yükümlülüğü altında bulunan kişiler veya yetkili kişiler veya yetkili
                    kurum ve kuruluşlar tarafından işlenmesi hukuki sebebine dayanarak işlenebilmektedir.

                </p>

                <h5 class="titleBlack">İlgili Kişilerin Hakları ve Veri Sorumlusuna Başvuru</h5>

                <p style="text-align: justify;">Merkezi Hekim Randevu Sistemi Kullanıcıları KVK Kanunu’nun 11’inci
                    maddesinde düzenlenen haklarını, KVK Kanunu’nun 13’üncü maddesi ve Veri Sorumlusuna Başvuru Usul ve
                    Esasları Hakkında Tebliğ hükümleri çerçevesinde Bakanlığa başvurmak suretiyle kullanabilir.
                </p>
                <p style="text-align: justify;">KVK Kanunu’nun 13’üncü maddesi uyarınca yapılacak yazılı başvurular
                    "T.C. Sağlık Bakanlığı, Üniversiteler Mahallesi, 6001. Cadde, No:9, Çankaya, Ankara" adresine;
                    Kayıtlı Elektronik Posta (KEP) ile yapılacak başvurular ise "sb@hs01.kep.tr" adresine
                    iletilmelidir.</p>

            </div>
            <div class="readModal">
                <button type="button" class="readButton" data-dismiss="modal" aria-label="Close">
                    Okudum
                </button>

            </div>
        </div>
        <div style="clear: both;"></div>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="row">
        <div class="mhrsUygulmasi">
            <div class="col-lg-3 col-md-3 col-sm-12 mhrsHizalama"><img src="https://www.mhrs.gov.tr/img/svg/time2.svg" alt=""/>
                <h4 class="mhrsUygulamatext">Hızlı Randevu</h4>
                <p> Mobil uygulama, Web ve Alo182 Randevu hattından istediğiniz hekime anında randevu alabilirsiniz.</p>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 mhrsHizalama"><img src="https://www.mhrs.gov.tr/img/svg/location2.svg" alt=""/>
                <h4 class="mhrsUygulamatext">En Yakın Hastane</h4>
                <p> Mobil Uygulama ve Web üzerinden konum bilgilerinizi paylaşarak size en yakın hastaneyi
                    bulabilirsiniz.</p>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 mhrsHizalama"><img src="https://www.mhrs.gov.tr/img/svg/steteskop2.svg" alt=""/>
                <h4 class="mhrsUygulamatext">İstediğiniz Doktor</h4>
                <p> MHRS üzerinde istediğiniz doktora randevu almak sizin elinizde. </p>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 mhrsHizalama">
                <a href="https://neyimvar.gov.tr/" target="_blank">
                    <img src="https://www.mhrs.gov.tr/img/svg/neyim_var_logo.svg" alt=""/>
                </a>
                <h4 class="mhrsUygulamatext">NeyimVar?</h4>
                <p> Şikayetinizi girip size özel tanı önerileri ve poliklinik randevusu alabilirsiniz. </p>
            </div>

        </div>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="row">
        <div class="e-nabiz">
            <div class="col-lg-4 col-lg-offset-2 col-md-4 col-md-offset-2">
                <div class="e-nabizText">
                    <h3> Artık Sağlık Kayıtlarınız <br/>
                        Hep Yanınızda </h3>
                    <p> e-Nabız kişisel sağlık bilgilerinizi yönetebileceğiniz, Türkiye'nin güvenilir kişisel sağlık
                        kaydı sistemidir.</p>
                    <a href="https://enabiz.gov.tr/" target="_blank">
                        <button type="button" class="e-nabizButton"><img src="https://www.mhrs.gov.tr/img/svg/e-nabiz.svg" alt=""/></button>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="row"><img src="https://www.mhrs.gov.tr/img/e-nabiz.jpg" class="e-nabizImg" alt=""/></div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 video">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-md-offset-2 col-sm-12"><a href="#" data-toggle="modal"
                                                                    data-target="#videoModal"
                                                                    data-theVideo="https://www.youtube.com/embed/qQfnkIlDScs">
            <div class="videoright"><img src="https://www.mhrs.gov.tr/img/video1.png" alt=""/>
                <h4><strong>Siz Yorulmayın<br/>Artık</strong>
                    e-Nabız Var ! </h4>
            </div>
        </a></div>
        <div class="col-lg-4 col-md-4 col-sm-12"><a href="#" data-toggle="modal" data-target="#videoModalone"
                                                    data-theVideo="https://www.youtube.com/embed/JZjyURDLnLM">
            <div class="videoright"><img src="https://www.mhrs.gov.tr/img/video2.png" alt=""/>
                <h4><strong>ALO 182</strong><br/>
                    Kamu Spotu </h4>
            </div>
        </a>
            <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <div>
                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/JZjyURDLnLM"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="videoModalone" tabindex="-1" role="dialog" aria-labelledby="videoModalone"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <div>
                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/qQfnkIlDScs"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 " style="padding: 0;">

    <div class="footerRed">
        <p> Soru ve sorunlarınız için
            <a href="mailto:mhrsyardim@saglik.gov.tr">
                <strong style="color: #fff;">mhrsyardim@saglik.gov.tr</strong>
            </a>
            adresimizi kullanarak bize ulaşabilirsiniz. </p>
    </div>
</div>
<div style="clear: both;"></div>
<div class="col-12 footerMenuText" style="background-color: #333; height: auto;padding: 1%;">
    <div class="col-lg-3 col-md-3 col-sm-12 ">
        <div class="col-12"><a href="hakkimizda.html">
            <h6 style="color: #848484">Hakkımızda</h6>
        </a></div>
        <div class="col-12"><a href="sss.html">
            <h6 style="color: #848484">Sıkça Sorulan Sorular</h6>
        </a></div>
        <div class="col-12"><a href="soru_gorus_oneri.html">
            <h6 style="color: #848484">Soru Görüş ve Önerileriniz</h6>
        </a></div>
        <div class="col-12"><a href="anket.html">
            <h6 style="color: #848484">Anket</h6>
        </a></div>
        <div class="col-12"><a href="yararli_baglantilar.html">
            <h6 style="color: #848484">Yararlı Bağlantılar</h6>
        </a></div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 text-center source">
        <img src="https://www.mhrs.gov.tr/img/siteSealImage.png" alt="">
        <div class="col-12">
            <h6 style="color: #848484;">&copy; 2021 Tüm Hakları Saklıdır</h6>
        </div>
    </div>
    <div style="clear: both;"></div>
</div>


<div class="scrollbar" id="style-10">
    <div class="force-overflow"></div>
</div>
<button onclick="topFunction()" id="myBtn" title="Go to top"><img src="https://www.mhrs.gov.tr/img/svg/toTop.svg" alt=""></button>
<script src="https://www.mhrs.gov.tr/js/jQuery.js"></script>
<script src="https://www.mhrs.gov.tr/js/bootstrap.min.js"></script>
<script src="https://www.mhrs.gov.tr/js/scriptv3.js"></script>

<script>
    let count = 0;
    $('#RandevuSayisiGecmisi').hide();
    $.getJSON(baseUrl + "/api/vatandas/portal/anket/randevu-sayisi", (data) => {
        if (data.data != null) {
            data.data.data.forEach(element => {

                if (count == 0) {
                    $('#RandevuSayisiGecmisi').append(`<tr><td style="text-align: left; padding-left: 30px; height: 10%"><b>${element.randevuTarihi}</b></td><td style="text-align: center"><b>${element.randevuSayisi} (saat <b id="randevuSaati"></b>.00 itibariyle)</b></td></tr>`);
                } else {

                    $('#RandevuSayisiGecmisi').append(`<tr><td style="text-align: left; padding-left: 30px; height: 10%"><b>${element.randevuTarihi}</b></td><td style="text-align: center; padding-right: 145px"><b>${element.randevuSayisi}</b></td></tr>`);
                }
                count = count + 1;
            })
            $('#RandevuSayisiGecmisi').append('<tr><td style="padding-bottom: 30px; text-align: left"><i style="color: white ; "> Veriler Saatte Bir Güncellenmektedir.</i></td></tr>')
            const d = new Date();
            let hour = d.getHours();
            document.getElementById("randevuSaati").innerHTML = hour;
            if (data != null) {
                $('#RandevuSayisiGecmisi').show();
                document.getElementById('mainCarousel').style.display = 'none';
            }
        } else $('#RandevuSayisiGecmisi').hide();

    });

    var haritaYuklendimi = 0;
    var haritaModal = document.getElementById('myModal');
    var map;
    var fromProjection;
    var toProjection;
    var markers;
    var saglikBakanligiMarker;
    var konumMarker;
    var kurumMarker;

    haritaModal.addEventListener('webkitTransitionEnd', function (event) {
        if (haritaYuklendimi == 0) {
            map = new OpenLayers.Map("mapid");
            var mapnik = new OpenLayers.Layer.OSM();
            fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
            toProjection = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
            var position = new OpenLayers.LonLat(32.75308, 39.90249).transform(fromProjection, toProjection);
            var kurum1 = new OpenLayers.LonLat(32.7555428347573, 39.903361973821234).transform(fromProjection, toProjection);
            var zoom = 16;

            map.addLayer(mapnik);
            markers = new OpenLayers.Layer.Markers("Markers");
            map.addLayer(markers);

            saglikBakanligiMarker = new OpenLayers.Marker(position)
            markers.addMarker(saglikBakanligiMarker);
            /*var bounds = markers.getDataExtent();
            map.zoomToExtent(bounds);*/


            map.setCenter(position, zoom);

            haritaYuklendimi = 1;

            /*
                        $('#OpenLayers_Layer_Markers_20').children().each(function(idx, val){

                        var markerSolDeger=$(this).css("left");
                        var yeniSolDeger=parseFloat(markerSolDeger)-21;
                        var markerTopDeger=$(this).css("top");
                        var yeniTopDeger=parseFloat(markerTopDeger)-25;
                          $(this).css({
                            "width": "50px", //21PX
                            "height": "50px", //25PX
                            "top":yeniTopDeger+"px",
                            "left":yeniSolDeger+"px"
                        });
            })




            $("#OpenLayers_Layer_Markers_20").children()

                        $("#OpenLayers_Layer_Markers_20").find("img").css({
                            "width": "50px",
                            "height": "50px"
                        });
            */

        }
    }, false);


    $('#videoModal').on('hidden.bs.modal', function () {
        src = $('#videoModal iframe').attr('src');
        newSrc = src.slice(0, -11)
        $('#videoModal iframe').attr('src', newSrc);
    });

    $('#videoModalone').on('hidden.bs.modal', function () {
        src = $('#videoModalone iframe').attr('src');
        newSrc = src.slice(0, -11)
        $('#videoModalone iframe').attr('src', newSrc);
    });


    $(document).ready(function () {
        autoPlayYouTubeModal();

    });

    function asiPopUpGoster() {

        $("#asiPopUpButon").click();

    }

    function aydinlatmaMetniPopUpGoster() {

        $("#aydinlatmaMetniPopUpButon").click();

    }

</script>
</body>

</html>