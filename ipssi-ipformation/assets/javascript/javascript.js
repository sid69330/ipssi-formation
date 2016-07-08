function ContactType(contact)
{
	if(contact == 2)
	{
		document.getElementById('societe').disabled = true;
		document.getElementById('fonction').disabled = true;
	}
	else
	{
		document.getElementById('societe').disabled = false;
		document.getElementById('fonction').disabled = false;
	}
}

function initialize() 
{
	var myOptions = {
		center: new google.maps.LatLng(48.3990184,2.687389),
		zoom: 5,
		mapTypeId: google.maps.MapTypeId.SATELITTE
	};
	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	//Lyon
	var myLatlng=new google.maps.LatLng(45.7705073,4.86322389999998);
	var marker1 = new google.maps.Marker({
		position: myLatlng,
		map: map,
		title:"IP-Formation Paris",
		draggable:true,
		animation: google.maps.Animation.DROP
	});
	
	marker1.info = new google.maps.InfoWindow({
		content: '<img src="/assets/images/logo.jpg" height="30px"> IP-Fromation Lyon'
	});
	
	google.maps.event.addListener(marker1, 'click', function(){
		marker1.info.open(map, marker1);
	});
	
	//Paris
	var myLatlng=new google.maps.LatLng(48.848664,2.388705200000004);
	var marker2 = new google.maps.Marker({
		position: myLatlng,
		map: map,
		title:"IP-Formation Paris",
		draggable:true,
		animation: google.maps.Animation.DROP
	});
	
	marker2.info = new google.maps.InfoWindow({
		content: '<img src="/assets/images/logo.jpg" height="30px"> IP-Fromation Paris'
	});
	
	google.maps.event.addListener(marker2, 'click', function(){
		marker2.info.open(map, marker2);
	});
	
	//Brest
	var myLatlng=new google.maps.LatLng(48.3989182,-4.488992499999995);
	var marker3 = new google.maps.Marker({
		position: myLatlng,
		map: map,
		title:"IP-Formation Brest",
		draggable:true,
		animation: google.maps.Animation.DROP
	});

	marker3.info = new google.maps.InfoWindow({
		content: '<img src="/assets/images/logo.jpg" height="30px">  IP-Fromation Brest'
	});
	
	google.maps.event.addListener(marker3, 'click', function(){
		marker3.info.open(map, marker3);
	});
}