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
							alert("Hata! Kay�tlar �ekilemedi.");
					}
				);	
			}	
		});
	</script>
<script type="text/javascript">
	$(function() {
	
		$( ".tarih" ).datepicker({
			dateFormat: "yy-mm-dd",//tarih format� yy=y�l mm=ay dd=g�n
			appendText: "(y�l-ay-g�n)",//inputun sonuna bu yaz�y� yazar.
			autoSize: true,//inputu otomatik boyutland�r�r
			changeMonth: true,//ay� elle se�meyi aktif eder
			changeYear: true,//y�l� elee se�ime izin verir
			dayNames:[ "pazar", "pazartesi", "sal�", "�ar�amba", "per�embe", "cuma", "cumartesi" ],//g�nlerin ad�
			dayNamesMin: [ "pa", "pzt", "sa", "�ar", "per", "cum", "cmt" ],//k�saltmalar
			defaultDate: +5,//takvim a��l�nca se�ili olan� bu g�nden 10 g�n sonra olsun dedik
			/*isRTL: true//takvimi ters �evirir garip bi �zellik :D*/
			maxDate: "+2y+1m +2w",//ileri g�re bilme zaman�n� 2 y�l 1 ay 2 hafta yapt�k
			minDate: "-1y-1m -2w",//geriyi g�re bilme alan�n� 1 y�l 1 ay 2 hafta yapt�k.bunu istedi�iniz gibi ayarlaya bilirsiniz
			monthNamesShort: [ "Ocak", "�ubat", "Mart", "Nisan", "May�s", "Haziran", "Temmuz", "A�ustos", "Eyl�l", "Ekim", "Kas�m", "Aral�k" ],//ay se�im alan�n d�zenledik
			nextText: "ileri",//ileri butonun t�rk�ele�tirdik
			prevText: "geri",//buda geri butonu i�in
			showAnim: "drop",//takvim a��l�m animasyonu alta t�m animasyon isimleri yazd�m 
			/*fold-blind-bounce-clip-drop-explode-fade-highlight-puff-pulsate-scale-shake-slide-size-transfer*/
			//showOn: "both",//inputun yan�na ... butonu koyuyor
		});
		
	});
</script>
</head>
<body ng-app="myApp" ng-controller="myControl">
<div id="container">
<form name="myForm" ng-submit="eylem()">
	<span class="tarihSpan">Ba�lang�� tarihi se�in:</span><input ng-model="tarih1" type="text"  class="tarih" id="tarih1" />
	<span class="tarihSpan">Biti� tarihi se�in:</span><input type="text" ng-model="tarih2"  class="tarih" id="tarih2" />
	<button type="submit">G�nder</button>
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