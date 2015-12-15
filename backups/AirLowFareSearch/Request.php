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

$lowFareSearchReq = $body->addChild('LowFareSearchReq', null, 'http://www.travelport.com/schema/air_v33_0');

// Used for Emulation - If authorised will execute the request as if the
// agent's parent branch is the TargetBranch specified.
$lowFareSearchReq->addAttribute('TargetBranch', $config['branch']);

// When set to “true”, Upsell information will be returned in the shop response.
// Provider supported : 1G, 1V, 1P, 1J
$lowFareSearchReq->addAttribute('ReturnUpsellFare', 'false');

// Provider: 1G,1V,1P,1J,ACH-Indicates whether the response will contain
// Solution result (AirPricingSolution) or Non Solution Result (AirPricingPoints).
// The default value is false. This attribute cannot be combined with
// EnablePointToPointSearch, EnablePointToPointAlternates and MaxNumberOfExpertSolutions.
$lowFareSearchReq->addAttribute('SolutionResult', 'true');

$billingPointOfSaleInfo = $lowFareSearchReq->addChild('BillingPointOfSaleInfo', null, $config['namespace']);
$billingPointOfSaleInfo->addAttribute('OriginApplication', 'uAPI');

$searchAirLeg = $lowFareSearchReq->addChild('SearchAirLeg');

$searchOrigin = $searchAirLeg->addChild('SearchOrigin');
$cityOrAirport = $searchOrigin->addChild('CityOrAirport', null, $config['namespace']);
$cityOrAirport->addAttribute('Code', 'TYO');
$cityOrAirport->addAttribute('PreferCity', 'true');

$searchDestination = $searchAirLeg->addChild('SearchDestination');
$cityOrAirport = $searchDestination->addChild('CityOrAirport', null, $config['namespace']);
$cityOrAirport->addAttribute('Code', 'IST');
$cityOrAirport->addAttribute('PreferCity', 'true');

$searchDepTime = $searchAirLeg->addChild('SearchDepTime');
$searchDepTime->addAttribute('PreferredTime', '2015-12-18');

$airSearchModifiers = $lowFareSearchReq->addChild('AirSearchModifiers');
$preferredProviders = $airSearchModifiers->addChild('PreferredProviders');
$provider = $preferredProviders->addChild('Provider', null, $config['namespace']);
$provider->addAttribute('Code', '1G');

$searchPassenger = $lowFareSearchReq->addChild('SearchPassenger', null, $config['namespace']);
$searchPassenger->addAttribute('Code', 'ADT');
$searchPassenger->addAttribute('Age', 40);
$searchPassenger->addAttribute('DOB', '1975-12-11');

$airPricingModifiers = $lowFareSearchReq->addChild('AirPricingModifiers');
// Set Currency
$airPricingModifiers->addAttribute('CurrencyType', 'TRY');
// Request a search based on whether only E-ticketable fares are required.
$airPricingModifiers->addAttribute('ETicketability', 'Yes'); // Yes , No , Required , Ticketless
//$airPricingModifiers->addAttribute('OneWayShop', 'true'); // User Required

$airService = "https://emea.universal-api.pp.travelport.com/B2BGateway/connect/uAPI/AirService";

//echo $xml->asXML();

$request = $client->__doRequest($xml->asXML(), $airService, null, null);

echo $request;
