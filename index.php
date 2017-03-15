<html>
<head>
<title>Angular | hackathon.getir</title>
<script type="text/javascript" src="js/jquery-1.9.0.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.0.custom.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.2/angular.min.js"></script>
<link rel="stylesheet" href="css/demos.css" />
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/jquery-ui-1.10.0.custom.min.css" />
<script>
		var myApp = angular.module("myApp",[]);
		myApp.controller("myControl",function($scope,$http){
		
			$scope.eylem=function(e){
				$scope.data={"startDate":$scope.tarih1,"endDate":$scope.tarih2};
				$http.post("https://getir-bitaksi-hackathon.herokuapp.com/getRecords",$scope.data).then(
					function(response){
						if(response.data.msg === "Success")
							$scope.cevaplar = response.data.records;
						else
							alert("Hata! Kayýtlar çekilemedi.");
					}
				);	
			}	
		});
	</script>
<script type="text/javascript">
	$(function() {
	
		$( ".tarih" ).datepicker({
			dateFormat: "yy-mm-dd",//tarih formatý yy=yýl mm=ay dd=gün
			appendText: "(yýl-ay-gün)",//inputun sonuna bu yazýyý yazar.
			autoSize: true,//inputu otomatik boyutlandýrýr
			changeMonth: true,//ayý elle seçmeyi aktif eder
			changeYear: true,//yýlý elee seçime izin verir
			dayNames:[ "pazar", "pazartesi", "salý", "çarþamba", "perþembe", "cuma", "cumartesi" ],//günlerin adý
			dayNamesMin: [ "pa", "pzt", "sa", "çar", "per", "cum", "cmt" ],//kýsaltmalar
			defaultDate: +5,//takvim açýlýnca seçili olaný bu günden 10 gün sonra olsun dedik
			/*isRTL: true//takvimi ters çevirir garip bi özellik :D*/
			maxDate: "+2y+1m +2w",//ileri göre bilme zamanýný 2 yýl 1 ay 2 hafta yaptýk
			minDate: "-1y-1m -2w",//geriyi göre bilme alanýný 1 yýl 1 ay 2 hafta yaptýk.bunu istediðiniz gibi ayarlaya bilirsiniz
			monthNamesShort: [ "Ocak", "Þubat", "Mart", "Nisan", "Mayýs", "Haziran", "Temmuz", "Aðustos", "Eylül", "Ekim", "Kasým", "Aralýk" ],//ay seçim alanýn düzenledik
			nextText: "ileri",//ileri butonun türkçeleþtirdik
			prevText: "geri",//buda geri butonu için
			showAnim: "drop",//takvim açýlým animasyonu alta tüm animasyon isimleri yazdým 
			/*fold-blind-bounce-clip-drop-explode-fade-highlight-puff-pulsate-scale-shake-slide-size-transfer*/
			//showOn: "both",//inputun yanýna ... butonu koyuyor
		});
		
	});
</script>
</head>
<body ng-app="myApp" ng-controller="myControl">
<div id="container">
<form name="myForm" ng-submit="eylem()">
	<span class="tarihSpan">Baþlangýç tarihi seçin:</span><input ng-model="tarih1" type="text"  class="tarih" id="tarih1" />
	<span class="tarihSpan">Bitiþ tarihi seçin:</span><input type="text" ng-model="tarih2"  class="tarih" id="tarih2" />
	<button type="submit">Gönder</button>
</form>
</div>

<table class="table">
  <tr ng-repeat="cevap in cevaplar">
    <td>{{ cevap.key }}</td>
    <td>{{ cevap.value }}</td>
    <td>{{ cevap.createdAt }}</td>
  </tr>
</table>
</body>