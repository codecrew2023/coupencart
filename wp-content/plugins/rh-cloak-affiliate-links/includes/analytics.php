<?php

 $context = new \Google\Site_Kit\Context( GOOGLESITEKIT_PLUGIN_BASENAME );
 $client = new \Google\Site_Kit\Core\Authentication\Clients\OAuth_Client( $context );
//  rh_loger( $client );
// $analytics = new \Google\Site_Kit\Modules\Analytics( $context );
// $response = getReport( $analytics );

// printResults($response);


/**
 * Queries the Analytics Reporting API V4.
 *
 * @param service An authorized Analytics Reporting API V4 service object.
 * @return The Analytics Reporting API V4 response.
 */
function getReport( $analytics ) {
	
  // Replace with your view ID, for example XXXX.
  $property_id = $analytics->get_data( 'property-id' );

  // Create the DateRange object.
  $dateRange = new \Google\Site_Kit_Dependencies\Google_Service_AnalyticsReporting_DateRange();
  $dateRange->setStartDate("7daysAgo");
  $dateRange->setEndDate("today");

  // Create the Metrics object.
  $sessions = new \Google\Site_Kit_Dependencies\Google_Service_AnalyticsReporting_Metric();
  $sessions->setExpression("ga:sessions");
  $sessions->setAlias("sessions");

  // Create the ReportRequest object.
  $request = new \Google\Site_Kit_Dependencies\Google_Service_AnalyticsReporting_ReportRequest();
  $request->setViewId($property_id);
  $request->setDateRanges($dateRange);
  $request->setMetrics(array($sessions));

  $body = new \Google\Site_Kit_Dependencies\Google_Service_AnalyticsReporting_GetReportsRequest();
  $body->setReportRequests( array( $request) );

  return $analytics->reports->batchGet( $body );
}

/**
 * Parses and prints the Analytics Reporting API V4 response.
 *
 * @param An Analytics Reporting API V4 response.
 */
function printResults( $reports ) {
  for ( $reportIndex = 0; $reportIndex < count( $reports ); $reportIndex++ ) {
    $report = $reports[ $reportIndex ];
    $header = $report->getColumnHeader();
    $dimensionHeaders = $header->getDimensions();
    $metricHeaders = $header->getMetricHeader()->getMetricHeaderEntries();
    $rows = $report->getData()->getRows();

    for ( $rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
      $row = $rows[ $rowIndex ];
      $dimensions = $row->getDimensions();
      $metrics = $row->getMetrics();
      for ($i = 0; $i < count($dimensionHeaders) && $i < count($dimensions); $i++) {
        print($dimensionHeaders[$i] . ": " . $dimensions[$i] . "\n");
      }

      for ($j = 0; $j < count($metrics); $j++) {
        $values = $metrics[$j]->getValues();
        for ($k = 0; $k < count($values); $k++) {
          $entry = $metricHeaders[$k];
          print($entry->getName() . ": " . $values[$k] . "\n");
        }
      }
    }
  }
}
