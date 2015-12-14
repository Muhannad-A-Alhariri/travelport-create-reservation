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

$airCreateReservationReq = $body->addChild('AirCreateReservationReq', '', 'http://www.travelport.com/schema/universal_v33_0');
$airCreateReservationReq->addAttribute('TargetBranch', $config['branch']);
$airCreateReservationReq->addAttribute('ProvierCode', '1G');
$airCreateReservationReq->addAttribute('RetainReservation', 'Both');

$billingPointOfSaleInfo = $airCreateReservationReq->addChild('BillingPointOfSaleInfo', '', 'http://www.travelport.com/schema/common_v33_0');
$billingPointOfSaleInfo->addAttribute('OriginApplication', 'UAPI');

$bookingTraveler = $airCreateReservationReq->addChild('BookingTraveler', '', 'http://www.travelport.com/schema/common_v33_0');
$bookingTraveler->addAttribute('Key', 'TlMxSEFjNGJFQWZDUGNobA==');
$bookingTraveler->addAttribute('TravelerType', 'ADT');
$bookingTraveler->addAttribute('Age', '40');
$bookingTraveler->addAttribute('DOB', '1975-12-14');
$bookingTraveler->addAttribute('Gender', 'M');


// === First People
$bookingTravelerName = $bookingTraveler->addChild('BookingTravelerName', '', 'http://www.travelport.com/schema/common_v33_0');
$bookingTravelerName->addAttribute('Prefix', 'Mr');
$bookingTravelerName->addAttribute('First', 'John');
$bookingTravelerName->addAttribute('Last', 'Doe');

$deliveryInfo = $bookingTraveler->addChild('DeliveryInfo');

$shippingAddress = $deliveryInfo->addChild('ShippingAddress');
$shippingAddress->addAttribute('Key', 'TlMxSEFjNGJFQWZDUGNobA==');
$shippingAddress->addChild('Street', 'Via Augusta 59 5');
$shippingAddress->addChild('City', 'Madrid');
$shippingAddress->addChild('State', 'IA');
$shippingAddress->addChild('PostalCode', '50156');
$shippingAddress->addChild('Country', 'US');

$phoneNumber = $bookingTraveler->addChild('PhoneNumber');
$phoneNumber->addAttribute('Location', 'DEN');
$phoneNumber->addAttribute('CountryCode', '1');
$phoneNumber->addAttribute('AreaCode', '303');
$phoneNumber->addAttribute('Number', '123456789');

$email = $bookingTraveler->addChild('Email');
$email->addAttribute('EmailId', 'hello@example.com');

$address = $bookingTraveler->addChild('Address');
$address->addChild('AddressName', 'Foo');
$address->addChild('Street', 'Via Augusta 59 5');
$address->addChild('City', 'Madrid');
$address->addChild('State', 'IA');
$address->addChild('PostalCode', '50156');
$address->addChild('Country', 'US');

// ... Other peoples

// === First People end

//=== Form of Payment

$formOfPayment = $airCreateReservationReq->addChild('FormOfPayment', '', 'http://www.travelport.com/schema/common_v33_0');
$formOfPayment->addAttribute('Type', 'Credit');
$formOfPayment->addAttribute('Key', '1');

$creditCard = $formOfPayment->addChild('CreditCard');
$creditCard->addAttribute('Type', 'VI'); // The 2 letter credit/ debit card type.
$creditCard->addAttribute('Number', '4444333322221111');
$creditCard->addAttribute('ExpDate', '2015-12');
$creditCard->addAttribute('Name', 'John Smith');
$creditCard->addAttribute('CVV', '123');
$creditCard->addAttribute('Key', '1');

$billingAddress = $creditCard->addChild('BillingAddress');
$billingAddress->addAttribute('Key', '...');

$billingAddress->addChild('AddressName', 'Hello');
$billingAddress->addChild('Street', 'Hello');
$billingAddress->addChild('City', 'Hello');
$billingAddress->addChild('State', 'Hello');
$billingAddress->addChild('PostalCode', '50156');
$billingAddress->addChild('Country', 'US');

//=== Form of Payment

//=== AirPricingSolution

$airPricingSolution = $airCreateReservationReq->addChild('AirPricingSolution', '', 'http://www.travelport.com/schema/air_v33_0');
$airPricingSolution->addAttribute('Key', 'NU3Gb39dRmWIDDcb6EVcdQ==');
$airPricingSolution->addAttribute('TotalPrice', 'GBP598.20');
$airPricingSolution->addAttribute('BasePrice', 'JPY83600');
$airPricingSolution->addAttribute('ApproximateTotalPrice', 'GBP598.20');
$airPricingSolution->addAttribute('ApproximateBasePrice', 'GBP449.00');
$airPricingSolution->addAttribute('EquivalentBasePrice', 'GBP449.00');
$airPricingSolution->addAttribute('Taxes', 'GBP149.20');

$airSegment = $airPricingSolution->addChild('AirSegment');
$airSegment->addAttribute('Key', '9HeaLdIbSaSknrWBbeuVmw==');
$airSegment->addAttribute('OptionalServicesIndicator', 'false');
$airSegment->addAttribute('AvailabilityDisplayType', 'Fare Specific Fare Quote Unbooked');
$airSegment->addAttribute('Group', 0);
$airSegment->addAttribute('Carrier', 'SU');
$airSegment->addAttribute('FlightNumber', '261');
$airSegment->addAttribute('Origin', 'NRT');
$airSegment->addAttribute('Destination', 'SVO');
$airSegment->addAttribute('DepartureTime', '2015-12-15T13:10:00.000+09:00');
$airSegment->addAttribute('ArrivalTime', '2015-12-15T17:35:00.000+03:00');
$airSegment->addAttribute('FlightTime', '625');
$airSegment->addAttribute('Distance', '4664');
$airSegment->addAttribute('ProviderCode', '1G');
$airSegment->addAttribute('ClassOfService', 'T');

$airPricingInfo = $airPricingSolution->addChild('AirPricingInfo');
$airPricingInfo->addAttribute('PricingMethod', 'Auto');
$airPricingInfo->addAttribute('Taxes', 'GBP51.60');
$airPricingInfo->addAttribute('Key', '8n7Du2wCR7CB6hENs+wEag==');
$airPricingInfo->addAttribute('TotalPrice', 'GBP214.60');
$airPricingInfo->addAttribute('BasePrice', 'JPY30400');
$airPricingInfo->addAttribute('ApproximateTotalPrice', 'GBP214.60');
$airPricingInfo->addAttribute('ApproximateBasePrice', 'GBP163.00');
$airPricingInfo->addAttribute('ProviderCode', '1G');

$fareInfo = $airPricingInfo->addChild('FareInfo');
$fareInfo->addAttribute('PromotionalFare', 'false');
$fareInfo->addAttribute('FareFamily', '');
$fareInfo->addAttribute('Amount', '');
$fareInfo->addAttribute('DepartureDate', 'DepartureDate');
$fareInfo->addAttribute('EffectiveDate', '2015-12-14T07:30:00.000+00:00');
$fareInfo->addAttribute('Destination', 'IST');
$fareInfo->addAttribute('Origin', 'NRT');
$fareInfo->addAttribute('PassengerTypeCode', 'ADT');
$fareInfo->addAttribute('FareBasis', 'TPXOW');
$fareInfo->addAttribute('Key', 'RCcEvv6lSZ6xNTiV/EUb8w==');

$fareRuleKey = $fareInfo->addChild('FareRuleKey', '6UUVoSldxwhIjdMOso0Z2sbKj3F8T9EyxsqPcXxP0TIjSPOlaHfQe5cuasWd6i8Dly5qxZ3qLwOXLmrFneovA5cuasWd6i8Dly5qxZ3qLwOXLmrFneovAz+h4HL8/lD9M3ExqSoG051ZYJWJHEWKGJLYkVtcVqgTQu0ZscBMSQ4zlTqIWoxcTtdpt3EZnTu6cc5hHtDx8xuF/oTXxxF6MeJYtF79PC3YfoLT9JoAKrO7eP3a4bhHZNndpxuHcfNSCkJQE184nnbg2BMJ0qOmdTyy/Q52QOiIeGkxAlW4WMTWqy44qLn8S/wBShF29N4Sv4Xvb2u1Qx+/he9va7VDH7+F729rtUMfv4Xvb2u1Qx8Qxibp/OJehpo2LrM59tO1jp8ZENljzx735+mk06MHbNbph6R864Mapb/JUnrGwUseyuta94zhnYIbenQB1hM0');
$fareRuleKey->addAttribute('FareInfoRef', 'RCcEvv6lSZ6xNTiV/EUb8w==');
$fareRuleKey->addAttribute('ProviderCode', '1G');

$brand = $fareInfo->addChild('Brand');
$brand->addAttribute('Key', '');
$brand->addAttribute('BrandId', '8318');
$brand->addAttribute('Name', '');

//=== AirPricingSolution

//=== BookingInfo
$bookingInfo = $airPricingInfo->addChild('BookingInfo');
$bookingInfo->addAttribute('BookingCode', 'T');
$bookingInfo->addAttribute('CabinClass', 'Economy');
$bookingInfo->addAttribute('FareInfoRef', 'RCcEvv6lSZ6xNTiV/EUb8w==');
$bookingInfo->addAttribute('SegmentRef', '9HeaLdIbSaSknrWBbeuVmw==');

$bookingInfo = $airPricingInfo->addChild('BookingInfo');
$bookingInfo->addAttribute('BookingCode', 'T');
$bookingInfo->addAttribute('CabinClass', 'Economy');
$bookingInfo->addAttribute('FareInfoRef', 'RCcEvv6lSZ6xNTiV/EUb8w==');
$bookingInfo->addAttribute('SegmentRef', 'SRCSZgd3RZyhpuYG9k+VUA==');

$taxInfo = $airPricingInfo->addChild('TaxInfo');
$taxInfo->addAttribute('Key', 'dqPGA/jbScyhb0YA3Jc83Q==');
$taxInfo->addAttribute('Category', 'OI');
$taxInfo->addAttribute('Amount', 'GBP2.80');

$taxInfo = $airPricingInfo->addChild('TaxInfo');
$taxInfo->addAttribute('Key', 'vmX+9CudSbSgW6Bi/ZUrYg==');
$taxInfo->addAttribute('Category', 'SW');
$taxInfo->addAttribute('Amount', 'GBP11.20');

$taxInfo = $airPricingInfo->addChild('TaxInfo');
$taxInfo->addAttribute('Key', '1NVi6qaiSPSdYtlpUUowAw==');
$taxInfo->addAttribute('Category', 'YQ');
$taxInfo->addAttribute('Amount', 'GBP37.60');

$passengerType = $airPricingInfo->addChild('passengerType');
$passengerType->addAttribute('Code', 'ADT');
$passengerType->addAttribute('Age', '40');
$passengerType->addAttribute('BookingTravelerRef', 'dlRFSVREWWNRYklnd1dFaw==');

$passengerType = $airPricingInfo->addChild('passengerType');
$passengerType->addAttribute('Code', 'ADT');
$passengerType->addAttribute('Age', '40');
$passengerType->addAttribute('BookingTravelerRef', 'a1h3SDJuVW9NcTZVZm95SQ==');

$accountStatus = $airCreateReservationReq->addChild('AccountStatus', '', 'http://www.travelport.com/schema/common_v33_0');
$accountStatus->addAttribute('Type', 'ACTIVE');
$accountStatus->addAttribute('TicketDate', 'T*');
$accountStatus->addAttribute('ProviderCode', '1G');

$airService = "https://emea.universal-api.pp.travelport.com/B2BGateway/connect/uAPI/AirService";

echo $xml->asXML();

//$request = $client->__doRequest($xml->asXML(), $airService, null, null);

//echo $request;
