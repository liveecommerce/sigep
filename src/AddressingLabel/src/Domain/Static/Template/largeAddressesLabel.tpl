<style>
    body {
        font-family: Arial;
    }
    .store-logo img {
        width: 25mm;
        height: 25mm;
        margin-left: 10px;
    }
    .store-data-items {
        margin-top: 10px;
        margin-left: 10px;
        font-size: 12px;
    }
    .container {
        padding: 3px;
        margin-top: 5px;
    }
    .label-container {
        border: 1px solid black;
        height: 70mm;
        width: 93mm;
        float: left;
    }
    .data-matrix {
        margin-left: 40px;
    }
    .correios-logo {
        margin-top: 1px;
    }
    .contract, .shipping-type {
        margin-top: 3px;
        text-align: center;
        font-size: 12px;
        margin-left: 30px;
    }
    .shipping-logo img {
        width: 70px;
        margin-left: 25px;
    }
    .shipping-data {
        width: 50px;
    }
    .shipping-info {
        width: 90px;
        margin-top: 30px;
        margin-left: 20px;
        font-size: 11px;
    }
    .shipping-label {
        margin-left: 100px;
    }
    .bold {
        font-weight: bold;
    }
    .order-section {
        font-size: 11px;
    }
    .order-data {
        margin: 3px;
    }
    .barcode-shipping .barcode img {
        margin-left: 10px;
        margin-top: 2px;
    }
    .barcode-shipping .addicional-service .addicional-service-data {
        margin-left: 10px;
    }
    .barcode-shipping .addicional-service .addicional-service-data tr td {
        font-size: 12px;
        width: 25px;
        font-weight: bold;
    }
    .client {
        margin-left: 8px;
        margin-bottom: 8px;
    }
    .receiver, .signature, .document {
        font-size: 11px;
        margin-top: 3px;
        position: relative;
    }
    .receiver .item {
        margin-bottom: 8px;
    }
    .receiver .line {
        width: 295px;
        height: 5px;
        left: 55px;
        position: absolute;
    }
    .signature .line {
        width: 140px;
        left: 60px;
        position: relative;
    }
    .document .line {
        width: 90px;
        left: 60px;
        position: relative;
    }
    .line {
        border-bottom: 1px solid black;
    }
    .receiver-data {
        border-collapse: collapse;
        border: 1px solid black;
        position: relative;
        width: 99%;
    }
    .receiver-title {
        position: relative;
        font-size: 12px;
        background-color: black;
        color: white;
        padding: 2px 15px;
        font-weight: bold;
        width: 90px;
    }
    .receiver-fields {
        padding-top: 5px;
        font-size: 13px;
        font-weight: 500;
    }
    .receiver-fields .row div {
        padding-left: 20px;
        padding-right: 5px;
        margin-bottom: 5px;
    }
    .receiver-barcode {
        padding-left: 20px;
        padding-right: 5px;
        margin-top: 5px;
        margin-bottom: 10px;
    }
    .correios-logo {
        position: absolute;
        top: 5px;
        right: 15px;
    }
    .receiver-obs {
        position: absolute;
        bottom: 55px;
        right: 160px;
    }
    .correios-logo img {
        width: 70px;
        height: 15px;
    }
    .sender-data {
        font-size: 12px;
        padding: 5px;
    }
    .sender-data .row {
        padding-right: 10px;
    }
</style>
<td class="label-container">
    <div class="container">
        <div class="data-label">
            <table class="content">
                <tr>
                    <td class="store-data">
                        <div class="store-logo">
                            <img src="{{storeLogo}}" />
                        </div>
                        <div class="store-data-items">
                            <div class="invoice">NF: {{invoice}}</div>
                            <div class="order">Pedido: {{orderId}}</div>
                        </div>
                    </td>
                    <td class="contract-data">
                        <div class="data-matrix">
                            <img src="{{datamatrix}}" />
                        </div>
                        <div class="contract">
                            Contrato: <span class="bold">{{contract}}</span>
                        </div>
                        <div class="shipping-type">
                            <span class="bold">{{shippingType}}</span>
                        </div>
                    </td>
                    <td class="shipping-data">
                        <div class="shipping-logo">
                            <img src="{{shippingLogo}}" />
                        </div>
                        <div class="shipping-info">
                            <div class="order">Volume: 1/1</div>
                            <div class="order">Peso (g): <span class="bold">{{weight}}</span></div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <div>
                <div class="shipping-label bold">{{shippingLabel}}</div>
            </div>
            <table class="barcode-shipping">
                <tr>
                    <td class="barcode">
                        <div class="barcode-img">
                            <img src="{{barcodeShipping}}" />
                        </div>
                    </td>
                    <td class="addicional-service">
                        <table class="addicional-service-data">
                            {{addicionalService}}
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <table class="client">
            <tr>
                <td class="receiver">
                    <div class="item">Recebedor:</div><div class="line"></div>
                </td>
            </tr>
            <tr>
                <td class="signature">
                    <div class="item">Assinatura:</div> <div class="line"></div>
                </td>
                <td class="document">
                    <div class="item">Documento:</div><div class="line"></div>
                </td>
            </tr>
        </table>
    </div>
    <div class="receiver-data">
        <div>
            <div class="receiver-title">
                DESTINATÁRIO
            </div>
            <div class="receiver-fields">
                <div class="row">
                    <div class="receiver-name">{{receiverName}}</div>
                </div>
                <div class="row">
                    <div class="receiver-street">{{receiverStreet}}, {{receiverNumber}}</div>
                </div>
                <div class="row">
                    <div class="receiver-complement">{{receiverComplement}} {{receiverDistrict}}</div>
                </div>
                <div class="row">
                    <div class="receiver-zipcode"><span class="bold">{{receiverZipCode}} </span>{{receiverCity}}/{{receiverState}}</div>
                </div>
                <div class="correios-logo">
                    <img src="{{correiosLogo}}" />
                </div>
            </div>
        </div>
        <div class="receiver-barcode">
            <img src="{{zipcodeBarcode}}" />
        </div>
        <div class="receiver-obs">
            Obs:
        </div>
    </div>
    <div class="sender-data">
        <div class="row">
            <div class="sender-title"><span class="bold">Remetente: </span>{{senderName}}</div>
        </div>
        <div class="row">
            <div class="sender-address">{{senderStreet}} {{senderNumber}}</div>
        </div>
        <div class="row">
            <div class="sender-address">{{senderComplement}} {{senderDistrict}}</div>
        </div>
        <div class="row">
            <div class="sender-zipcode"><span class="bold">{{senderZipCode}} </span>{{senderCity}}/{{senderState}}</div>
        </div>
    </div>
</td>