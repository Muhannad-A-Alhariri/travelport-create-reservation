<?php

header('Content-Type: text/xml; charset=utf-8');

$config = require(__DIR__.'/../config.php');

// Soap Client
// Authentication with Basic authentication
$client = new SoapClient(__DIR__.'/../travelport/air_v34_0/Air.wsdl', [
    'login' => $config['username'], 'password' => $config['password']
]);

$xml = new SimpleXMLElement("<soapenv:Envelope xmlns:soapenv='http://schemas.xmlsoap.org/soap/envelope/'></soapenv:Envelope>");

$header = $xml->addChild('Header');

$body = $xml->addChild('Body');

$lowFareSearchReq = $body->addChild('LowFareSearchReq', '', $config['namespace']['air']);
$lowFareSearchReq->addAttribute('TraceId', 'trace');
$lowFareSearchReq->addAttribute('SolutionResult', 'true');
$lowFareSearchReq->addAttribute('TargetBranch', $config['branch']);

$billingPointOfSaleInfo = $lowFareSearchReq->addChild('BillingPointOfSaleInfo', '', 'http://www.travelport.com/schema/common_v33_0');
$billingPointOfSaleInfo->addAttribute('OriginApplication', 'UAPI');

// === SearchAirLeg
$searchAirLeg = $lowFareSearchReq->addChild('SearchAirLeg');

$searchOrigin = $searchAirLeg->addChild('SearchOrigin');

$cityOrAirport = $searchOrigin->addChild('CityOrAirport', '', $config['namespace']['com']);
$cityOrAirport->addAttribute('Code', 'TYO');
$cityOrAirport->addAttribute('PreferCity', 'true');

$searchDestination = $searchAirLeg->addChild('SearchDestination');

$cityOrAirport = $searchDestination->addChild('CityOrAirport', '', $config['namespace']['com']);
$cityOrAirport->addAttribute('Code', 'IST');
$cityOrAirport->addAttribute('PreferCity', 'true');

$searchDepTime = $searchAirLeg->addChild('SearchDepTime');
$searchDepTime->addAttribute('PreferredTime', '2015-12-23');

$airLegModifiers = $searchAirLeg->addChild('AirLegModifiers');

$preferredCabins = $airLegModifiers->addChild('PreferredCabins');

$cabinClass = $preferredCabins->addChild('CabinClass', '', $config['namespace']['com']);
$cabinClass->addAttribute('Type', 'Economy');
// SearchAirLeg ====

// === SearchAirLeg
$searchAirLeg = $lowFareSearchReq->addChild('SearchAirLeg');

$searchOrigin = $searchAirLeg->addChild('SearchOrigin');

$cityOrAirport = $searchOrigin->addChild('CityOrAirport', '', $config['namespace']['com']);
$cityOrAirport->addAttribute('Code', 'IST');
$cityOrAirport->addAttribute('PreferCity', 'true');

$searchDestination = $searchAirLeg->addChild('SearchDestination');

$cityOrAirport = $searchDestination->addChild('CityOrAirport', '', $config['namespace']['com']);
$cityOrAirport->addAttribute('Code', 'TYO');
$cityOrAirport->addAttribute('PreferCity', 'true');

$searchDepTime = $searchAirLeg->addChild('SearchDepTime');
$searchDepTime->addAttribute('PreferredTime', '2015-12-26');

$airLegModifiers = $searchAirLeg->addChild('AirLegModifiers');

$preferredCabins = $airLegModifiers->addChild('PreferredCabins');

$cabinClass = $preferredCabins->addChild('CabinClass', '', $config['namespace']['com']);
$cabinClass->addAttribute('Type', 'Economy');
// SearchAirLeg ====

// AirSearchModifiers ===
$airSearchModifiers = $lowFareSearchReq->addChild('AirSearchModifiers');
$airSearchModifiers->addAttribute('MaxJourneyTime', 13);

$preferredProviders = $airSearchModifiers->addChild('PreferredProviders');

$provider = $preferredProviders->addChild('Provider', '', $config['namespace']['com']);
$provider->addAttribute('Code', '1G');

$flightType = $airSearchModifiers->addChild('FlightType');
$flightType->addAttribute('NonStopDirects', 'true');
// === AirSearchModifiers

// Search Passengers ===
$searchPassenger = $lowFareSearchReq->addChild('SearchPassenger', '', $config['namespace']['com']);
$searchPassenger->addAttribute('Code', 'ADT');
$searchPassenger->addAttribute('Age', '40');
$searchPassenger->addAttribute('DOB', '1975-12-14');

$searchPassenger = $lowFareSearchReq->addChild('SearchPassenger', '', $config['namespace']['com']);
$searchPassenger->addAttribute('Code', 'ADT');
$searchPassenger->addAttribute('Age', '40');
$searchPassenger->addAttribute('DOB', '1975-12-14');

// === Search Passengers

// AirPricingModifiers ====
$airPriceModifiers = $lowFareSearchReq->addChild('AirPricingModifiers');
$airPriceModifiers->addAttribute('CurrencyType', 'TRY');
$airPriceModifiers->addAttribute('ETicketability', 'Yes');

// === AirPricingModifiers

//echo $xml->asXml();

$request = $client->__doRequest($xml->asXML(), $config['endpoint'], null, null);

echo $request;
