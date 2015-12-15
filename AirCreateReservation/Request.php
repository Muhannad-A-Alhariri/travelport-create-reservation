<?php

$config = require(__DIR__.'/../config.php');

header('Content-Type: text/xml; charset=utf-8');

$client = new SoapClient(__DIR__.'/../travelport/air_v34_0/Air.wsdl', ([
    'login' => $config['username'], 'password' => $config['password']
]));

$request = $client->__doRequest("
<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\">
    <soapenv:Header/>
    <soapenv:Body>
      <AirCreateReservationReq xmlns=\"http://www.travelport.com/schema/universal_v33_0\" TraceId=\"60ae1bcf-7c85-40a2-b804-98ea15d876bd\" AuthorizedBy=\"Travelport\" TargetBranch=\"P105219\" ProviderCode=\"1G\" RetainReservation=\"Both\">
      <BillingPointOfSaleInfo xmlns=\"http://www.travelport.com/schema/common_v33_0\" OriginApplication=\"UAPI\" />
      <BookingTraveler xmlns=\"http://www.travelport.com/schema/common_v33_0\" Key=\"TkZKR0MxV01Hc3NUT1BFdQ==\" TravelerType=\"ADT\" Age=\"40\" DOB=\"1975-12-15\" Gender=\"M\" Nationality=\"US\">
        <BookingTravelerName Prefix=\"Mr\" First=\"John\" Last=\"Smith\" />
        <DeliveryInfo>
          <ShippingAddress Key=\"TkZKR0MxV01Hc3NUT1BFdQ==\">
            <Street>Via Augusta 59 5</Street>
            <City>Madrid</City>
            <State>IA</State>
            <PostalCode>50156</PostalCode>
            <Country>US</Country>
          </ShippingAddress>
        </DeliveryInfo>
        <PhoneNumber Location=\"DEN\" CountryCode=\"1\" AreaCode=\"303\" Number=\"123456789\" />
        <Email EmailID=\"johnsmith@travelportuniversalapidemo.com\" />
        <Address>
          <AddressName>DemoSiteAddress</AddressName>
          <Street>Via Augusta 59 5</Street>
          <City>Madrid</City>
          <State>IA</State>
          <PostalCode>50156</PostalCode>
          <Country>US</Country>
        </Address>
      </BookingTraveler>
      <FormOfPayment xmlns=\"http://www.travelport.com/schema/common_v33_0\" IsAgentType=\"true\" Type=\"Cash\"></FormOfPayment>
      <AirPricingSolution xmlns=\"http://www.travelport.com/schema/air_v33_0\" Key=\"sXIxoxuFQcWOcFiKzw91Rw==\" TotalPrice=\"GBP214.60\" BasePrice=\"JPY30400\" ApproximateTotalPrice=\"GBP214.60\" ApproximateBasePrice=\"GBP163.00\" EquivalentBasePrice=\"GBP163.00\" Taxes=\"GBP51.60\">
        <AirSegment Key=\"N5kG5xhmSoSB4BVRCVB9IA==\" OptionalServicesIndicator=\"false\" AvailabilityDisplayType=\"Fare Specific Fare Quote Unbooked\" Group=\"0\" Carrier=\"SU\" FlightNumber=\"261\" Origin=\"NRT\" Destination=\"SVO\" DepartureTime=\"2015-12-16T13:10:00.000+09:00\" ArrivalTime=\"2015-12-16T17:35:00.000+03:00\" FlightTime=\"625\" TravelTime=\"625\" Distance=\"4664\" ProviderCode=\"1G\" ClassOfService=\"T\" />
        <AirSegment Key=\"Wejc2CxISvWriiYx/dERgg==\" OptionalServicesIndicator=\"false\" AvailabilityDisplayType=\"Fare Specific Fare Quote Unbooked\" Group=\"0\" Carrier=\"SU\" FlightNumber=\"2134\" Origin=\"SVO\" Destination=\"IST\" DepartureTime=\"2015-12-16T21:45:00.000+03:00\" ArrivalTime=\"2015-12-17T00:30:00.000+02:00\" FlightTime=\"225\" TravelTime=\"225\" Distance=\"1089\" ProviderCode=\"1G\" ClassOfService=\"T\" />
        <AirPricingInfo PricingMethod=\"Auto\" Taxes=\"GBP51.60\" Key=\"ccr+Gop4QsCRZMeKXALfDg==\" TotalPrice=\"GBP214.60\" BasePrice=\"JPY30400\" ApproximateTotalPrice=\"GBP214.60\" ApproximateBasePrice=\"GBP163.00\" ProviderCode=\"1G\">
          <FareInfo PromotionalFare=\"false\" FareFamily=\"\" Amount=\"GBP163.00\" DepartureDate=\"2015-12-16\" EffectiveDate=\"2015-12-15T07:38:00.000+00:00\" Destination=\"IST\" Origin=\"NRT\" PassengerTypeCode=\"ADT\" FareBasis=\"TPXOW\" Key=\"e2QiHR9QRmCzyTWXpfgOXw==\">
            <FareRuleKey FareInfoRef=\"e2QiHR9QRmCzyTWXpfgOXw==\" ProviderCode=\"1G\">6UUVoSldxwjlyt4REEYEFMbKj3F8T9EyxsqPcXxP0TIjSPOlaHfQe5cuasWd6i8Dly5qxZ3qLwOXLmrFneovA5cuasWd6i8Dly5qxZ3qLwOXLmrFneovAz+h4HL8/lD9M3ExqSoG051ZYJWJHEWKGJLYkVtcVqgTQu0ZscBMSQ4zlTqIWoxcTtdpt3EZnTu6NZVgvZw4iOeF/oTXxxF6MeJYtF79PC3YfoLT9JoAKrO7eP3a4bhHZNndpxuHcfNSCkJQE184nnbg2BMJ0qOmdTyy/Q52QOiIeGkxAlW4WMTWqy44qLn8S/wBShF29N4Sv4Xvb2u1Qx+/he9va7VDH7+F729rtUMfv4Xvb2u1Qx8Qxibp/OJehpo2LrM59tO1jp8ZENljzx735+mk06MHbNbph6R864Mapb/JUnrGwUseyuta94zhnYIbenQB1hM0</FareRuleKey>
          </FareInfo>
          <BookingInfo BookingCode=\"T\" CabinClass=\"Economy\" FareInfoRef=\"e2QiHR9QRmCzyTWXpfgOXw==\" SegmentRef=\"N5kG5xhmSoSB4BVRCVB9IA==\" />
          <BookingInfo BookingCode=\"T\" CabinClass=\"Economy\" FareInfoRef=\"e2QiHR9QRmCzyTWXpfgOXw==\" SegmentRef=\"Wejc2CxISvWriiYx/dERgg==\" />
          <TaxInfo Key=\"4TPYWdKtTtOYOEa76yTZnw==\" Category=\"OI\" Amount=\"GBP2.80\" />
          <TaxInfo Key=\"YwNv2MqbRSeu9q0QOj7hlg==\" Category=\"SW\" Amount=\"GBP11.20\" />
          <TaxInfo Key=\"ZuipTMG1SCexfJGwr2biEA==\" Category=\"YQ\" Amount=\"GBP37.60\" />
          <PassengerType Code=\"ADT\" Age=\"40\" BookingTravelerRef=\"TkZKR0MxV01Hc3NUT1BFdQ==\" />
        </AirPricingInfo>
      </AirPricingSolution>
      <ActionStatus xmlns=\"http://www.travelport.com/schema/common_v33_0\" Type=\"ACTIVE\" TicketDate=\"T*\" ProviderCode=\"1G\" />
    </AirCreateReservationReq>
    </soapenv:Body>
</soapenv:Envelope>
", $config['endpoint'], false, false);

echo $request;
