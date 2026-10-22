<?php
require_once 'assets/includes/db.php';
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include("assets/css/style.php");
    ?>

    <title>Website Analytics | Platinum Interiors LLC</title>
</head>

<body>

    <?php include("assets/content/navbar.php") ?>
    <section class="home">
        <div class="text">
            <div class="admin-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-10">
                                <h4 class="card-title ms-0 fw-bold mb-0">Website Analytics</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card custom-card-2 mt-3">
                <div class="card-body">
                    <div class="row">
                        <?php


                        require dirname(__DIR__, 4) . '/shared-libs/vendor/autoload.php';

                        use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
                        use Google\Analytics\Data\V1beta\DateRange;
                        use Google\Analytics\Data\V1beta\Dimension;
                        use Google\Analytics\Data\V1beta\Metric;
                        use Google\Analytics\Data\V1beta\RunReportRequest;

                        putenv('GOOGLE_APPLICATION_CREDENTIALS=credentials.json');
                        $property_id = '468365792';

                        $client = new BetaAnalyticsDataClient([
                            'transport' => 'rest',
                            'httpHandler' => function ($request) {
                                return (new GuzzleHttp\Client())->send($request, ['verify' => false]);
                            },
                        ]);

                        $request = (new RunReportRequest())
                            ->setProperty('properties/' . $property_id)
                            ->setDateRanges([
                                new DateRange([
                                    'start_date' => '2020-03-31',
                                    'end_date' => 'today',
                                ]),
                            ])
                            ->setMetrics([
                                new Metric([
                                    'name' => 'totalUsers',
                                ])
                            ]);

                        $request2 = (new RunReportRequest())
                            ->setProperty('properties/' . $property_id)
                            ->setDateRanges([
                                new DateRange([
                                    'start_date' => '2020-03-31',
                                    'end_date' => 'today',
                                ]),
                            ])
                            ->setDimensions([
                                new Dimension([
                                    'name' => 'country',
                                ]),
                            ])
                            ->setMetrics([
                                new Metric([
                                    'name' => 'totalUsers',
                                ])
                            ]);

                        $request3 = (new RunReportRequest())
                            ->setProperty('properties/' . $property_id)
                            ->setDateRanges([
                                new DateRange([
                                    'start_date' => '2020-03-31',
                                    'end_date' => 'today',
                                ]),
                            ])
                            ->setDimensions([
                                new Dimension([
                                    'name' => 'deviceCategory',
                                ]),
                            ])
                            ->setMetrics([
                                new Metric([
                                    'name' => 'totalUsers',
                                ])
                            ]);

                        $request4 = (new RunReportRequest())
                            ->setProperty('properties/' . $property_id)
                            ->setDateRanges([
                                new DateRange([
                                    'start_date' => '2020-03-31',
                                    'end_date' => 'today',
                                ]),
                            ])
                            ->setDimensions([
                                new Dimension([
                                    'name' => 'pageTitle',
                                ]),
                            ])
                            ->setMetrics([
                                new Metric([
                                    'name' => 'screenPageViews',
                                ])
                            ]);

                        $users = 0;
                        $response = $client->runReport($request);
                        $response2 = $client->runReport($request2);
                        $response3 = $client->runReport($request3);
                        $response4 = $client->runReport($request4);

                        foreach ($response->getRows() as $row) {
                            $users = (int)$row->getMetricValues()[0]->getValue() . PHP_EOL;
                        }

                        $mobile = 0;
                        $mobilePer = 0;
                        $tablet = 0;
                        $tabletPer = 0;
                        $desktop = 0;
                        $desktopPer = 0;

                        foreach ($response3->getRows() as $row) {
                            if ($row->getDimensionValues()[0]->getValue() == "mobile") {
                                $mobile = (int)$row->getMetricValues()[0]->getValue() . PHP_EOL;
                            } else if ($row->getDimensionValues()[0]->getValue() == "desktop") {
                                $desktop = $row->getMetricValues()[0]->getValue() . PHP_EOL;
                            } else if ($row->getDimensionValues()[0]->getValue() == "tablet") {
                                $tablet = $row->getMetricValues()[0]->getValue() . PHP_EOL;
                            }
                        }

                        if ((int)$users > 0) {
                            $mobilePer = round((int)$mobile / (int)$users * 100, 2);
                            $desktopPer = round((int)$desktop / (int)$users * 100, 2);
                            $tabletPer = round((int)$tablet / (int)$users * 100, 2);
                        } else {
                            $mobilePer = $desktopPer = $tabletPer = 0;
                        }
                        
                        ?>

                        <div class="col-md-6 mt-3">
                            <h6 class="bg-theme p-2 text-white text-center">Website Analytics</h6>
                            <div class="row mt-3">
                                <div class="col-md-12 text-center text-dark">
                                    <div class="row justify-content-center">
                                        <div class="col-md-4">
                                            <h1 class="fw-bold mb-0"><?php echo $users; ?></h1>
                                            <p class="mb-0">Total Users</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="d-flex justify-content-around mt-3">
                                                <div class="progress-label">
                                                    <div class="progress-icon bg-primary"></div>
                                                    <p>Mobile : <?php echo $mobile ?></p>
                                                </div>

                                                <div class="progress-label">
                                                    <div class="progress-icon bg-warning"></div>
                                                    <p>Tablet : <?php echo $tablet ?></p>
                                                </div>

                                                <div class="progress-label">
                                                    <div class="progress-icon bg-success"></div>
                                                    <p>Computer : <?php echo $desktop ?></p>
                                                </div>
                                            </div>

                                            <div class="progress mt-3">
                                                <div class="progress-bar" role="progressbar" style="width: <?php echo $mobilePer ?>%" aria-valuenow="<?php echo $mobilePer ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $tabletPer ?>%" aria-valuenow="<?php echo $tabletPer ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $desktopPer ?>%" aria-valuenow="<?php echo $desktopPer ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12 mt-3">
                                    <table class="table table-striped table-bordered table-hover" id="countries-sources">
                                        <thead>
                                            <tr>
                                                <th>Country</th>
                                                <th>Source</th>
                                                <th>Users</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            foreach ($response2->getRows() as $row) {
                                                $country = $row->getDimensionValues()[0]->getValue();
                                                $count = $row->getMetricValues()[0]->getValue() . PHP_EOL;
                                            ?>

                                                <tr>
                                                    <td><?php echo $country; ?></td>
                                                    <td><?php echo 0 ?></td>
                                                    <td><?php echo $count ?></td>
                                                </tr>

                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <h6 class="bg-theme p-2 text-white text-center">Page Visits</h6>
                            <div class="row mt-3">
                                <div class="col-md-12 mt-2">
                                    <table class="table table-striped table-bordered table-hover datatable">
                                        <thead>
                                            <tr>
                                                <th>Page</th>
                                                <th>Views</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            foreach ($response4->getRows() as $row) {
                                                $pagega = $row->getDimensionValues()[0]->getValue();
                                                $countga = $row->getMetricValues()[0]->getValue() . PHP_EOL;
                                            ?>

                                                <tr>
                                                    <td><?php echo strip_tags($pagega); ?></td>
                                                    <td><?php echo strip_tags($countga); ?></td>
                                                </tr>

                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <?php include("assets/content/script.php"); ?>
    <script>
        changeNav("analytics-nav");
    </script>
</body>

</html>