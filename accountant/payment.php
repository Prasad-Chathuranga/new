<?php
        namespace _PhpScoperf859eabf1411;
        session_start();
        include_once "include/connection.php";

        /*
         * How to prepare a new payment with the Mollie API.
        */
        
        try {
                /*
                 * Initialize the Mollie API library with your API key.
                 * 
                 * See: https://www.mollie.com/dashboard/developers/api-keys
                */
                require "./payment/initialize.php";

                /*
                 * Generate a unique order id for this example. It is important to include this unique attribute
                 * in the redirectUrl (below) so a proper return page can be shown to the customer.
                */
                $orderId = time();
                $packageId= $_GET["package"];
                $query = 'SELECT * FROM `packages` WHERE pid = '.$packageId.'';
                $package = mysqli_query($conn,$query);
                $package_data = mysqli_fetch_array($package);
                // echo "<pre>";print_r($package_data);die;
                /*
                 * Determine the url parts to these example files.
                */
                $protocol = isset($_SERVER['HTTPS']) && \strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
                $hostname = $_SERVER['HTTP_HOST'];
                $path = \dirname(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']);

                /*
                 * Payment parameters:
                 *   amount        Amount in EUROs. This example creates a € 10,- payment.
                 *   description   Description of the payment.
                 *   redirectUrl   Redirect location. The customer will be redirected there after the payment.
                 *   webhookUrl    Webhook location, used to report when the payment changes state.
                 *   metadata      Custom metadata that is stored with the payment.
                */
                $payment = $mollie->payments->create([
                        "amount" => [
                                "currency" => "EUR", 
                                "value" => !empty($package_data["pamount"]) ? number_format($package_data["pamount"],2,'.','') : null
                        ],
                        "description" => ucfirst($package_data["ptitle"])." Plan Order #{$orderId}", 
                        "redirectUrl" => "{$protocol}://{$hostname}{$path}/buycredit.php?order_id={$orderId}&package={$packageId}",
                        // "webhookUrl" => "{$protocol}://{$hostname}{$path}/webhook.php", 
                        "metadata" => [
                                "order_id" => $orderId,
                                "Aid"   => $_SESSION["id"],
                                "Pid"   => $packageId
                        ],
                        // "locale" => isset($_COOKIE["lang"]) ? ($_COOKIE["lang"] == "nl" ? "nl_NL" : "en_US") : "en_US"
                ]);

                /*
                 * In this example we store the order with its payment status in a database.
                */

                // $json = array(
                //     'resource' => $payment->resource,
                //     'id' => $payment->id,
                //     'mode' => $payment->mode,
                //     'amount' => [
                //         'value' => $payment->amount->value,
                //         'currency' => $payment->amount->currency,
                //     ],
                //     'settlementAmount' => $payment->settlementAmount ?? null,
                //     'amountRefunded' => $payment->amountRefunded ?? null,
                //     'amountRemaining' => $payment->amountRemaining ?? null,
                //     'amountChargedBack' => $payment->amountChargedBack ?? null,
                //     'description' => $payment->description ?? null,
                //     'method' => $payment->method ?? null,
                //     'status' => $payment->status ?? null,
                //     'createdAt' => $payment->createdAt ?? null,
                //     'paidAt' => $payment->paidAt ?? null,
                //     'canceledAt' => $payment->canceledAt ?? null,
                //     'expiresAt' => $payment->expiresAt ?? null,
                //     'failedAt' => $payment->failedAt ?? null,
                //     'dueDate' => $payment->dueDate ?? null,
                //     'billingEmail' => $payment->billingEmail ?? null,
                //     'profileId' => $payment->profileId ?? null,
                //     'sequenceType' => $payment->sequenceType ?? null,
                //     'redirectUrl' => $payment->redirectUrl ?? null,
                //     'webhookUrl' => $payment->webhookUrl ?? null,
                //     'mandateId' => $payment->mandateId ?? null,
                //     'subscriptionId' => $payment->subscriptionId ?? null,
                //     'orderId' => $payment->orderId ?? null,
                //     'settlementId' => $payment->settlementId ?? null,
                //     'locale' => $payment->locale ?? null,
                //     'metadata' => [
                //         'order_id' => $payment->metadata->order_id ?? null,
                //         'Aid' => $payment->metadata->Aid ?? null,
                //         'Pid' => $payment->metadata->Pid ?? null,
                //     ],
                //     'details' => $payment->details ?? null,
                //     'restrictPaymentMethodsToCountry' => $payment->restrictPaymentMethodsToCountry ?? null,
                // );
                // echo "<pre>";print_r(json_encode($json));die;
                // echo "<pre>";var_dump($json);die;
                // \_PhpScoperf859eabf1411\database_write($orderId, $payment->status);
                $payment_log_query = "INSERT INTO `payment`(`Aid`, `Pid`, `order_id`, `payment_id`, `amount`, `currency`, `message`) VALUES ('".$payment->metadata->Aid."','".$payment->metadata->Pid."','".$payment->metadata->order_id."','".$payment->id."','".$payment->amount->value."','".$payment->amount->currency."','".json_encode($payment)."')";
                $run = mysqli_query($conn,$payment_log_query);
                /*
                 * Send the customer off to complete the payment.
                 * This request should always be a GET, thus we enforce 303 http response code
                */
                header("Location: " . $payment->getCheckoutUrl(), \true, 303);
        }
        catch (\Mollie\Api\Exceptions\ApiException $e) {
                echo "API call failed: " . \htmlspecialchars($e->getMessage());
                echo "<script>alert('error to processing your request please try again later');</script>";
                // echo "<script>window.location.href = 'buycredit.php';</script>";
        }
?>