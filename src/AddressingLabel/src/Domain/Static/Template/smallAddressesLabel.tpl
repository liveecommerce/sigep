<style>
    body {
        font-family: Arial;
    }
    .label-container {
        border: 1px solid black;
        height: 70mm;
        width: 94mm;
        float: left;
    }
    .container {
        padding: 6px;
    }
    .content {
        display: inline-flex;
    }
    .data-matrix {
        display: inline-block;
    }
    .correios-logo {
        margin-top: 1px;
        display: block;
    }
    .correios-logo img {
        width: 80px;
        margin-bottom: 10px;
    }
    .data-label {
        display: block;
        position: relative;
    }
    .contract-section {
        display: inline-block;
        font-size: 11px;
        margin-left: 5px;
        margin-top: 1px;
        position: relative;
    }
    .contract {
        margin-top: 3px;
    }
    .bold {
        font-weight: bold;
    }
    .shipping-label {
        margin-top: 33px;
    }
    .order-section {
        font-size: 11px;
        display: inline-flex;
    }
    .order-data {
        display: inline-block;
        margin: 3px;
    }
    .shipping-info {
        display: inline-block;
    }
    .shipping-logo {
        width: 50px;
    }
    .barcode-shipping {
        display: inline-flex;
    }
    .barcode-shipping .barcode img {
        margin-left: 8px;
        margin-right: 10px;
        display: inline-flex;
    }
    .barcode-shipping .addicional-service {
        display: inline-flex;
        position: relative;
    }
    .barcode-shipping .addicional-service .addicional-service-data tr td {
        font-size: 11px;
        font-weight: bold;
    }
    .receiver, .signature, .document {
        font-size: 9px;
        margin-top: 2px;
        position: relative;
    }
    .receiver .item {
        display: inline-block;
    }
    .receiver .line {
        width: 310px;
        height: 5px;
        left: 50px;
        position: absolute;
    }
    .signature .line {
        width: 175px;
        left: 45px;
        position: relative;
    }
    .document .line {
        width: 83px;
        left: 50px;
        position: relative;
    }
    .line {
        border-bottom: 1px solid black;
    }
    .receiver-data {
        border: 1px solid black;
        position: relative;
        width: 98.5%;
        height: 73px;
    }
    .receiver-title {
        position: relative;
        font-size: 11px;
        background-color: black;
        color: white;
        padding: 1px 5px;
        font-weight: bold;
        width: 85px;
    }
    .receiver-fields {
        padding-left: 5px;
        padding-top: 2px;
        font-size: 11px;
        font-weight: 500;
    }
    .receiver-fields .row div {
        padding-right: 5px;
        margin-bottom: 1px;
    }
    .receiver-barcode {
        position: absolute;
        right: 20px;
        top: 8px;
    }
    .sender-data {
        font-size: 9px;
        padding: 5px;
    }
    .sender-data .row {
        padding-right: 5px;
    }
</style>

<td class="label-container">
    <div class="container">
        <div class="data-label">
            <table class="content">
                <tr>
                    <td>
                        <div class="data-matrix">
                            <img src="{{datamatrix}}" />
                        </div>
                    </td>
                    <td>
                        <div class="contract-section">
                            <div class="correios-logo">
                                <img src="{{correiosLogo}}" />
                            </div>
                            <div class="contract">
                                Contrato: <span class="bold">{{contract}}</span>
                            </div>
                            <div class="shipping-type">
                                <span class="bold">{{shippingType}}</span>
                            </div>
                            <div class="shipping-label bold">{{shippingLabel}}</div>
                        </div>
                    </td>
                    <td>
                        <div class="order-section">
                            <div class="order-data">
                                <div class="invoice">NF: {{invoice}}</div>
                                <div class="order">Pedido: {{orderId}}</div>
                                <div class="order">Volume: 1/1</div>
                                <div class="order">Peso (g): <span class="bold">{{weight}}</span></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="shipping-info">
                            <img src="{{shippingLogo}}" class="shipping-logo" />
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <table class="barcode-shipping">
            <tr class="content">
                <td class="barcode">
                    <img src="{{barcodeShipping}}" />
                </td>
                <td class="addicional-service">
                    <table class="addicional-service-data">
                        {{addicionalService}}
                    </table>
                </td>
            </tr>
        </table>
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
        </div>
        <div class="receiver-barcode">
            <img src="{{zipcodeBarcode}}" />
        </div>
    </div>
    <div class="sender-data">
        <div class="row">
            <div class="sender-title"><span class="bold">Remetente: </span>{{senderName}}</div>
        </div>
        <div class="row">
            <div class="sender-address">{{senderStreet}} {{senderNumber}} {{senderComplement}} - {{senderDistrict}}</div>
        </div>
        <div class="row">
            <div class="sender-zipcode"><span class="bold">{{senderZipCode}} </span>{{senderCity}}/{{senderState}}</div>
        </div>
    </div>
</td>