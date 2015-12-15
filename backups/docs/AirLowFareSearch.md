
    $search = $client->lowFareSearch();

    $search->setDeparture('1990-12-23')
        ->setTo('TYO')
        ->setFrom('IST')
        ->nonStopDirects(true)
        ->setMaxJourneyTime(13)
        ->setCabinClass('Economy');
