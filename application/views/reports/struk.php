<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Bengkel Irfan Motor</title>
    <style type="text/css">
        html {
            font-family: "Verdana, Arial";
        }

        .content {
            width: 90mm;
            font-size: 12px;
            padding: 5px;
        }

        .title {
            text-align: center;
            font-size: 13px;
            padding-bottom: 5px;
            border-bottom: 1px dashed;
        }

        .head {
            margin-top: 5px;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid;
        }

        table {
            width: 100%;
            font-size: 12px;
        }

        .thanks {
            margin-top: 10px;
            padding-top: 10px;
            text-align: center;
            border-top: 1px dashed;
        }

        @media print {
            @page {
                width: 90mm;
                margin: 0mm;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="content">
        <div class="title">
            <b>Struk Bengkel Ifran Motor</b>
            <br>
            Majalengka
            <br>
        </div>

        <div class="head">
            <table cellspacing="0" cellpadding="0">
                <tr>
                    <td style="width:200px;">
                        <?= date('d/m/Y', strtotime($sale->date)) . " " . date('H:i', strtotime($sale->sale_created)); ?>
                    </td>
                    <td>Kasir</td>
                    <td style="text-align: center;width:10px;">:</td>
                    <td style="text-align: right;">
                        <?= ucfirst($sale->user_name); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?= $sale->invoice; ?>
                    </td>
                    <td>Pembeli</td>
                    <td style="text-align: center;">:</td>
                    <td style="text-align: right;">
                        <?= $sale->customer_id != null ? $sale->customer_name : "Umum" ?>
                    </td>
                </tr>
            </table>
        </div>

        <div class="transaction">
            <table class="transaction-table" cellspacing="0" cellpadding="0">
                <?php $arr_discount = [];
                foreach ($sale_detail as $sd) { ?>
                    <tr>
                        <td style="width: 165px;"><?= $sd->item_name; ?></td>
                        <td><?= $sd->qty; ?></td>
                        <td style="text-align: right;width:80px; padding-right:10px;"><?= indo_currency($sd->price); ?></td>
                        <td style="text-align: right;width:80px;">
                            <?= indo_currency(($sd->price - $sd->discount_item) * $sd->qty); ?>
                        </td>
                    </tr>
                    <?php
                    if ($sd->discount_item > 0) {
                        $arr_discount[] = $sd->discount_item;
                    }
                }
                foreach ($arr_discount as $ad) { ?>
                    <tr>
                        <td></td>
                        <td colspan="2" style="text-align: right; padding-right:10px;">Disc. <?= $ad + 1; ?></td>
                        <td style="text-align: right;"><?= indo_currency($ad); ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="4" style="border-bottom: 1px dashed;padding-top:5px;"></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right; padding-top:5px; padding-right:10px;">Sub Total:</td>
                    <td style="text-align: right; padding-top:5px;">
                        <?= indo_currency($sale->total_price); ?>
                    </td>
                </tr>
                <?php if ($sale->discount > 0) { ?>
                    <tr>
                        <td colspan="2"></td>
                        <td style="text-align: right; padding-top:5px; padding-right:10px;">Potongan:</td>
                        <td style="text-align: right; padding-top:5px;">
                            <?= indo_currency($sale->discount); ?>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right; padding-top:5px; padding-right:10px;">Total:</td>
                    <td style="text-align: right; padding-top:5px;">
                        <?= indo_currency($sale->final_price); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right; padding-top:5px;padding-right:10px;">Uang:</td>
                    <td style="text-align: right; padding-top:5px;">
                        <?= indo_currency($sale->cash); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right; padding-right:10px;">Kembalian:</td>
                    <td style="text-align: right;">
                        <?= indo_currency($sale->uang_kembalian); ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="thanks">
            ---Terimakasih---
        </div>
    </div>
</body>

</html>