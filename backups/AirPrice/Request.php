<?php

$config = require(__DIR__.'/../config.php');

header('Content-Type:text/xml;charset=utf-8');

$client = new SoapClient(__DIR__.'/../travelport/air_v34_0/Air.wsdl', [
    'login' => $config['username'], 'password' => $config['password'], 'trace' => true
]);

$start = "<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\"></soapenv:Envelope>";

$xml = new SimpleXMLElement($start, 0, false, "http://schemas.xmlsoap.org/soap/envelope/", false);

$header = $xml->addChild('Header');
$body = $xml->addChild('Body');

$airPriceReq = $body->addChild('AirPriceReq', '', 'http://www.travelport.com/schema/air_v33_0');
$airPriceReq->addAttribute('TargetBranch', $config['branch']);

$billingPointOfSaleInfo = $airPriceReq->addChild('BillingPointOfSaleInfo', '', 'http://www.travelport.com/schema/common_v33_0');
$billingPointOfSaleInfo->addAttribute('OriginApplication', 'UAPI');

$airItinerary = $airPriceReq->addChild('AirItinerary');

$airSegment = $airItinerary->addChild('AirSegment');
// Status of this segment.
$airSegment->addAttribute('Status', 'false');

$airSegment->addAttribute('Key', 'tYt+8gbgQvmlV5qsFcfpwQ==');
$airSegment->addAttribute('AvailabilitySource', 'S');

// The type of availability from which the segment is sold. Possible Values
// (List): G - General S - Flight Specific L - Carrier Specific/Direct Access M - Manual Sell F - Fare Shop/Optimal Shop Q - Flight Specific Fare Quote unbooked R - Redemption Availability used to complete the sell.
// Supported Providers: 1G,1V.
$airSegment->addAttribute('AvailabilityDisplayType', 'Fare Shop/Optimal Shop');
$airSegment->addAttribute('Group', 0);
$airSegment->addAttribute('Carrier', 'SU');
$airSegment->addAttribute('FlightNumber', '261');
$airSegment->addAttribute('Origin', 'NRT');
$airSegment->addAttribute('Destination', 'SVO');
$airSegment->addAttribute('DepartureTime', '2015-12-15T13:10:00.000+09:00');
$airSegment->addAttribute('ArrivalTime', '2015-12-15T17:35:00.000+03:00');
$airSegment->addAttribute('FlightTime', '625');
// The distance traveled. Units are specified in the parent response element.
$airSegment->addAttribute('Distance', '4664');
$airSegment->addAttribute('ProviderCode', '1G');
$airSegment->addAttribute('ClassOfService', 'T');

// Indicates if carrier has link (carrier specific) display option.
//$airSegment->addAttribute('LinkAvailability', 'false');

// Indicates if carrier has Inside (polled)Availability option.
//$airSegment->addAttribute('PolledAvailabilityOption', '...');

$airSegment = $airItinerary->addChild('AirSegment');
$airSegment->addAttribute('Key', 'XtWYDxZhS/KwD5ijl9vK5w==');
$airSegment->addAttribute('AvailabilitySource', 'S');
$airSegment->addAttribute('AvailabilityDisplayType', 'Fare Shop/Optimal Shop');
$airSegment->addAttribute('Group', 0);
$airSegment->addAttribute('Carrier', 'SU');
$airSegment->addAttribute('FlightNumber', '2134');
$airSegment->addAttribute('Origin', 'SVO');
$airSegment->addAttribute('Destination', 'IST');
$airSegment->addAttribute('DepartureTime', '2015-12-15T21:45:00.000+03:00');
$airSegment->addAttribute('ArrivalTime', '2015-12-16T00:30:00.000+02:00');
$airSegment->addAttribute('FlightTime', '225');
$airSegment->addAttribute('Distance', '1089');
$airSegment->addAttribute('ProviderCode', '1G');
$airSegment->addAttribute('ClassOfService', 'T');

$airPriceModifiers = $airPriceReq->addChild('AirPricingModifiers');
$airPriceModifiers->addAttribute('InventoryRequestType', 'DirectAccess');

$brandModifiers = $airPriceModifiers->addChild('BrandModifiers');
$brandModifiers->addAttribute('ModifierType', 'FareFamilyDisplay'); // FareFamilyDisplay , BasicDetailOnly

$searchPassenger = $airPriceReq->addChild('SearchPassenger', '', 'http://www.travelport.com/schema/common_v33_0');
$searchPassenger->addAttribute('Code', 'ADT');
$searchPassenger->addAttribute('Age', '40');
//$searchPassenger->addAttribute('BookingTravelerRef', ''); // Only multiple passenger

$searchPassenger = $airPriceReq->addChild('SearchPassenger', '', 'http://www.travelport.com/schema/common_v33_0');
$searchPassenger->addAttribute('Code', 'ADT');
$searchPassenger->addAttribute('Age', '40');

$searchPassenger = $airPriceReq->addChild('SearchPassenger', '', 'http://www.travelport.com/schema/common_v33_0');
$searchPassenger->addAttribute('Code', 'CNN');
$searchPassenger->addAttribute('Age', '10');

$airPricingCommand = $airPriceReq->addChild('AirPricingCommand');

// Specifies modifiers that a particular segment should be priced in.
// If this is used, then there must be one for each AirSegment in the AirItinerary.
$airSegmentPricingModifiers = $airPricingCommand->addChild('AirSegmentPricingModifiers');
$airSegmentPricingModifiers->addAttribute('AirSegmentRef', 'tYt+8gbgQvmlV5qsFcfpwQ==');
// The fare basis code to be used for pricing.
$airSegmentPricingModifiers->addAttribute('FareBasisCode', 'TPXOW');

$permittedBookingCodes = $airSegmentPricingModifiers->addChild('PermittedBookingCodes');

// The Booking Code (Class of Service) for a segment
$bookingCode = $permittedBookingCodes->addChild('BookingCode');
$bookingCode->addAttribute('Code', 'T');

// === Twice

// Specifies modifiers that a particular segment should be priced in.
// If this is used, then there must be one for each AirSegment in the AirItinerary.
$airSegmentPricingModifiers = $airPricingCommand->addChild('AirSegmentPricingModifiers');
$airSegmentPricingModifiers->addAttribute('AirSegmentRef', 'XtWYDxZhS/KwD5ijl9vK5w==');
// The fare basis code to be used for pricing.
$airSegmentPricingModifiers->addAttribute('FareBasisCode', 'TPXOW');

$permittedBookingCodes = $airSegmentPricingModifiers->addChild('PermittedBookingCodes');

// The Booking Code (Class of Service) for a segment
$bookingCode = $permittedBookingCodes->addChild('BookingCode');
$bookingCode->addAttribute('Code', 'T');

$formOfPayment = $airPriceReq->addChild('FormOfPayment', '', 'http://www.travelport.com/schema/common_v33_0');
$formOfPayment->addAttribute('Credit');

$airService = "https://emea.universal-api.pp.travelport.com/B2BGateway/connect/uAPI/AirService";

echo $xml->asXML();

//$request = $client->__doRequest($xml->asXML(), $airService, null, null);

//echo $request;
