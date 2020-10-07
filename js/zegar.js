/**
 * 
 */
var mojZegar = setInterval(tikTak, 500);

function tikTak() {
	var dzisiaj = new Date();

	var rok = dzisiaj.getFullYear();

	var miesiac = dzisiaj.getMonth() + 1;
	if (miesiac < 10)
		miesiac = "0" + miesiac;

	var dzien = dzisiaj.getDate();
	if (dzien < 10)
		dzien = "0" + dzien;

	var godzina = dzisiaj.getHours();
	if (godzina < 10)
		godzina = "0" + godzina;

	var minuta = dzisiaj.getMinutes();
	if (minuta < 10)
		minuta = "0" + minuta;

	var sekunda = dzisiaj.getSeconds();
	if (sekunda < 10)
		sekunda = "0" + sekunda;

	document.getElementById("data").innerHTML = rok + " - " + miesiac + " - "
			+ dzien;
	document.getElementById("czas").innerHTML = godzina + " : " + minuta
			+ " : " + sekunda;
}
