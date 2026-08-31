<?php

$phpVersion = PHP_VERSION;
$serverTime = date("Y-m-d H:i:s");

/*
 * Application Insights connection string.
 *
 * The value is stored in Azure App Service Environment Variables
 * rather than hardcoded into the PHP source code.
 */
$appInsightsConnectionString = getenv('APPLICATIONINSIGHTS_CONNECTION_STRING') ?: '';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IT Support PHP Portal</title>


    <!-- ========================================================= -->
    <!-- APPLICATION INSIGHTS                                      -->
    <!-- ========================================================= -->

    <?php if (!empty($appInsightsConnectionString)): ?>

    <script type="text/javascript">

        /*
         * Microsoft Application Insights JavaScript SDK
         *
         * The SDK is loaded from Microsoft's official Azure Monitor CDN.
         */

        (function () {

            var connectionString =
                <?php echo json_encode($appInsightsConnectionString); ?>;

            /*
             * Create the Application Insights loader.
             *
             * The SDK automatically sends page-view telemetry
             * after initialization.
             */

            var script = document.createElement("script");

            script.type = "text/javascript";

            script.src =
                "https://js.monitor.azure.com/scripts/b/ai.3.gbl.min.js";

            script.crossOrigin = "anonymous";

            script.onload = function () {

                if (
                    window.Microsoft &&
                    window.Microsoft.ApplicationInsights &&
                    window.Microsoft.ApplicationInsights.ApplicationInsights
                ) {

                    var appInsights =
                        new window.Microsoft.ApplicationInsights.ApplicationInsights({
                            config: {
                                connectionString: connectionString
                            }
                        });

                    appInsights.loadAppInsights();

                    appInsights.trackPageView({
                        name: document.title
                    });

                    /*
                     * Make Application Insights available globally
                     * for additional testing from the browser console.
                     */

                    window.appInsights = appInsights;

                }

            };

            script.onerror = function () {

                console.warn(
                    "Application Insights SDK could not be loaded."
                );

            };

            document.head.appendChild(script);

        })();

    </script>

    <?php endif; ?>


    <!-- ========================================================= -->
    <!-- PAGE STYLING                                              -->
    <!-- ========================================================= -->

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }


        body {

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background: #f4f7fb;

            color: #172033;

            line-height: 1.5;
        }


        header {

            background: #172033;

            color: white;

            padding: 22px 8%;

            display: flex;

            justify-content: space-between;

            align-items: center;
        }


        header h2 {

            font-size: 22px;

            font-weight: 600;
        }


        header span {

            color: #65d6a0;

            font-size: 14px;

            font-weight: bold;

            letter-spacing: 1px;
        }


        .hero {

            background:
                linear-gradient(
                    135deg,
                    #172033,
                    #263b63
                );

            color: white;

            padding: 90px 8%;
        }


        .hero-content {

            max-width: 850px;
        }


        .badge {

            display: inline-block;

            background:
                rgba(
                    101,
                    214,
                    160,
                    0.15
                );

            color: #65d6a0;

            padding: 8px 14px;

            border-radius: 20px;

            font-size: 13px;

            margin-bottom: 20px;

            font-weight: bold;
        }


        .hero h1 {

            font-size: 48px;

            margin-bottom: 18px;

            line-height: 1.15;
        }


        .hero p {

            font-size: 18px;

            line-height: 1.7;

            color: #d7deeb;

            max-width: 700px;
        }


        .container {

            width: 84%;

            max-width: 1200px;

            margin: 50px auto;
        }


        .section-title {

            margin-bottom: 25px;
        }


        .section-title span {

            color: #3478f6;

            font-size: 13px;

            font-weight: bold;

            letter-spacing: 1px;
        }


        .section-title h2 {

            font-size: 32px;

            margin-top: 8px;
        }


        .status {

            background: white;

            border-radius: 15px;

            padding: 25px;

            display: flex;

            justify-content: space-between;

            align-items: center;

            box-shadow:
                0 5px 20px
                rgba(
                    0,
                    0,
                    0,
                    0.06
                );

            margin-bottom: 50px;
        }


        .status-left {

            display: flex;

            align-items: center;

            gap: 15px;
        }


        .indicator {

            width: 14px;

            height: 14px;

            background: #35c875;

            border-radius: 50%;

            box-shadow:
                0 0 0 5px
                rgba(
                    53,
                    200,
                    117,
                    0.12
                );
        }


        .online {

            color: #35a866;

            font-weight: bold;

            letter-spacing: 1px;
        }


        .cards {

            display: grid;

            grid-template-columns:
                repeat(
                    3,
                    1fr
                );

            gap: 22px;
        }


        .card {

            background: white;

            padding: 30px;

            border-radius: 15px;

            box-shadow:
                0 5px 20px
                rgba(
                    0,
                    0,
                    0,
                    0.06
                );

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }


        .card:hover {

            transform:
                translateY(-5px);

            box-shadow:
                0 12px 30px
                rgba(
                    0,
                    0,
                    0,
                    0.10
                );
        }


        .card h3 {

            margin:
                15px 0 10px;

            font-size: 20px;
        }


        .card p {

            color: #667085;

            line-height: 1.6;
        }


        .icon {

            font-size: 32px;
        }


        .info {

            margin-top: 45px;

            background: #172033;

            color: white;

            padding: 35px;

            border-radius: 15px;
        }


        .info h2 {

            font-size: 26px;

            margin-bottom: 10px;
        }


        .info-grid {

            display: grid;

            grid-template-columns:
                repeat(
                    3,
                    1fr
                );

            gap: 25px;

            margin-top: 25px;
        }


        .info-item {

            min-width: 0;
        }


        .info-item span {

            display: block;

            color: #aeb9cc;

            font-size: 13px;

            margin-bottom: 8px;

            letter-spacing: 0.5px;
        }


        .info-item strong {

            font-size: 18px;

            word-break: break-word;
        }


        footer {

            text-align: center;

            padding: 30px;

            color: #667085;

            font-size: 14px;
        }


        @media (max-width: 800px) {

            .cards,
            .info-grid {

                grid-template-columns:
                    1fr;
            }


            .hero {

                padding:
                    70px 8%;
            }


            .hero h1 {

                font-size: 36px;
            }


            .status {

                align-items:
                    flex-start;

                gap: 20px;

                flex-direction:
                    column;
            }

        }

    </style>

</head>


<body>


<!-- ============================================================= -->
<!-- HEADER                                                        -->
<!-- ============================================================= -->

<header>

    <h2>
        IT Support PHP Portal
    </h2>

    <span>
        AZURE CLOUD
    </span>

</header>


<!-- ============================================================= -->
<!-- HERO                                                          -->
<!-- ============================================================= -->

<section class="hero">

    <div class="hero-content">

        <div class="badge">

            PHP 8.x • AZURE APP SERVICE

        </div>


        <h1>

            IT Support Service Portal

        </h1>


        <p>

            A cloud-hosted PHP application designed to provide
            IT support information, service monitoring and
            essential system diagnostics.

        </p>

    </div>

</section>


<!-- ============================================================= -->
<!-- MAIN CONTENT                                                  -->
<!-- ============================================================= -->

<div class="container">


    <!-- SYSTEM STATUS -->

    <div class="section-title">

        <span>
            LIVE MONITORING
        </span>

        <h2>
            System Status
        </h2>

    </div>


    <div class="status">


        <div class="status-left">

            <div class="indicator"></div>


            <div>

                <h3>
                    System Operational
                </h3>

                <p>
                    PHP application is running successfully.
                </p>

            </div>

        </div>


        <div class="online">

            ONLINE

        </div>


    </div>


    <!-- SERVICES -->

    <div class="section-title">

        <span>
            SUPPORT SERVICES
        </span>

        <h2>
            Available Services
        </h2>

    </div>


    <div class="cards">


        <div class="card">

            <div class="icon">
                🖥️
            </div>

            <h3>
                System Information
            </h3>

            <p>
                View application runtime and server information.
            </p>

        </div>


        <div class="card">

            <div class="icon">
                🌐
            </div>

            <h3>
                Network Diagnostics
            </h3>

            <p>
                Monitor network connectivity and application availability.
            </p>

        </div>


        <div class="card">

            <div class="icon">
                📊
            </div>

            <h3>
                System Monitoring
            </h3>

            <p>
                Monitor application activity and operational status.
            </p>

        </div>


    </div>


    <!-- APPLICATION INFORMATION -->

    <div class="info">


        <h2>
            Application Information
        </h2>


        <div class="info-grid">


            <div class="info-item">

                <span>
                    PLATFORM
                </span>

                <strong>
                    PHP
                </strong>

            </div>


            <div class="info-item">

                <span>
                    PHP VERSION
                </span>

                <strong>
                    <?php
                    echo htmlspecialchars(
                        $phpVersion,
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    ?>
                </strong>

            </div>


            <div class="info-item">

                <span>
                    HOSTING
                </span>

                <strong>
                    Azure App Service
                </strong>

            </div>


        </div>


        <div class="info-grid">


            <div class="info-item">

                <span>
                    SERVER TIME
                </span>

                <strong>
                    <?php
                    echo htmlspecialchars(
                        $serverTime,
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    ?>
                </strong>

            </div>


            <div class="info-item">

                <span>
                    APPLICATION STATUS
                </span>

                <strong>
                    Operational
                </strong>

            </div>


            <div class="info-item">

                <span>
                    MONITORING
                </span>

                <strong>
                    Application Insights
                </strong>

            </div>


        </div>


    </div>


</div>


<!-- ============================================================= -->
<!-- FOOTER                                                        -->
<!-- ============================================================= -->

<footer>

    IT Support PHP Portal
    •
    Azure Cloud Deployment
    •
    Application Insights Monitoring

</footer>


</body>

</html>