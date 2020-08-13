<style>
    .logo {
        width: 110px;
        height: 20px;
    }
    .table, .footer {
        width: 1px;
        height: 1px;
        border-collapse: collapse;
    }
    .subtitle {
        font-size: 10px;
    }
    .body {
        font-size: 11px;
    }
    .body td {
        vertical-align: top;
    }
    .header th {
        padding: 3px;
    }
    .border,
    .header,
    .cole-aqui {
        border: 1px solid black;
        padding: 0;
        margin: 0;
    }
    .header .title {
        font-size: 25px;
        margin-left: 80px;
    }
    .header .contract {
        font-weight: normal;
        margin-left: 30px;
        font-size: 12px;
    }
    .object-table {
        border-right: 1px solid black;
        border-bottom: 1px solid black;
    }
    .dates-table {
        border-bottom: 1px solid black;
    }
    .data-object {
        width: 200px;
    }
    .data-object div {
        padding-left: 5px;
    }
    .observation {
        border-top: 1px solid black;
        width: 335px;
    }
    .bold {
        font-weight: bold;
    }
    .data-object .receiver-title {
        padding: 5px;
    }
    .data-object .receiver-name {
        padding: 5px;
    }
    .data-object .shipping-label {
        padding-top: 15px;
        padding-bottom: 5px;
        font-weight: bold;
        text-align: center;
    }
    .data-object .barcode {
        text-align: center;
        padding-bottom: 10px;
    }
    .data-object .observation {
        margin-top: 1px;
        font-size: 8px;
        padding-top: 2px;
    }
    .dates {
        width: 200px;
        vertical-align: top;
        padding: 5px;
    }
    .dates .date-title {
        padding-bottom: 15px;
    }
    .dates .date-field {
        padding-bottom: 5px;
        font-weight: bold;
    }
    .dates .field-margin {
        margin-left: 5px;
    }
    .dates .devolution-title {
        padding-top: 30px;
        padding-bottom: 10px;
    }
    .dates .justification {
        font-size: 8px;
        padding-bottom: 0px;
    }
    .dates .justification td {
        padding: 5px;
    }
    .dates .justification-text {
        margin-left: 15px;
        margin-right: 20px;
    }
    .dates .number-spacing {
        margin-left: 20px;
    }
    .dates .justification-others {
        padding-top: 5px;
    }
    .receiver-data-table,
    .signature-table {
        font-size: 8px;
        border-collapse: collapse;
    }
    .receiver-border {
        border-top: 1px solid black;
    }
    .receiver-signature .signature {
        padding-right: 300px;
        padding-bottom: 5px;
    }
    .receiver-data-table .name {
        padding-right: 340px;
        padding-bottom: 5px;
    }
    .receiver-data-table .document,
    .receiver-signature .date {
        padding-bottom: 10px;
        border-left: 1px solid black;
        padding-left: 5px;
    }
    .stamp-table {
        vertical-align: top;
        border: 1px solid black;
        font-size: 8px;
    }
    .stamp-data div {
        width: 140px;
        text-align: center;
    }
    .stamp-data .stamp-unit-delivery {
        border-bottom: 1px solid black;
        padding-bottom: 150px;
    }
    .imagem {
        position: absolute;
        height: 10px;
    }
    .cole-aqui {
        width: 20px;
        height: 360px;
    }
    .dates {
        position: relative;
    }
    .justification {
        position: absolute;
        top: 135px;
    }
</style>
<table class="table">
    <tr>
        <th colspan="1" rowspan="6">
            <div class="cole-aqui"></div>
        </th>
        <th class="header" colspan="2" rowspan="1">
            <div class="header-title">
                <table>
                    <tr>
                        <th>
                            <img class="logo" src="{{correiosLogo}}" />
                        </th>
                        <th>
                            <span class="title">SIGEP</span>
                        </th>
                        <th>
                            <div class="subtitle">
                                <table>
                                    <tr>
                                        <td>
                                            AVISO DE
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            RECEBIMENTO
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </th>
                        <th>
                            <span class="contract">CONTRATO: {{contract}}</span>
                        </th>
                    </tr>
                </table>
            </div>
        </th>
    </tr>
    <tr>
        <td colspan="1" rowspan="1" class="border">
            <table class="body">
                <tr>
                    <td class="object-table">
                        <div class="data-object">
                            <div class="bold receiver-title">
                                DESTINATÁRIO:
                            </div>
                            <div class="receiver-name">
                                {{receiverName}}
                            </div>
                            <div class="receiver-address">
                                {{receiverStreet}}, {{receiverNumber}}
                            </div>
                            <div class="receiver-district">
                                {{receiverComplement}} {{receiverDistrict}}
                            </div>
                            <div class="receiver-city">
                                {{receiverZipcode}} {{receiverCity}}-{{receiverState}}
                            </div>
                            <div class="shipping-label">
                                {{shippingLabel}}
                            </div>
                            <div class="barcode">
                                <img src="{{shippingBarcode}}"/>
                            </div>
                            <div class="sender-name">
                                <span class="bold">REMETENTE:</span> {{senderName}}
                            </div>
                            <div class="bold sender-info">
                                ENDEREÇO PARA DEVOLUÇÃO DO OBJETO:
                            </div>
                            <div class="sender-address">
                                {{senderStreet}}, {{senderNumber}}
                            </div>
                            <div class="sender-district">
                                {{senderComplement}} {{senderDistrict}}
                            </div>
                            <div class="sender-city">
                                {{senderZipcode}} {{senderCity}}-{{senderState}}
                            </div>
                            <div class="observation">OBSERVAÇÃO:</div>
                        </div>
                    </td>
                    <td class="dates-table">
                        <div class="dates">
                            <div class="bold date-title">
                                TENTATIVAS DE ENTREGA
                            </div>
                            <div class="date-field">
                                <span>1º _____/______/______</span> <span class="field-margin">_____:______h</span>
                            </div>
                            <div class="date-field">
                                <span>2º _____/______/______</span> <span class="field-margin">_____:______h</span>
                            </div>
                            <div class="date-field">
                                <span>3º _____/______/______</span> <span class="field-margin">_____:______h</span>
                            </div>
                            <div class="devolution-title">
                                MOTIVO DE DEVOLUÇÃO:
                            </div>
                            <div class="justification">
                                <table class="justification-table">
                                    <tr>
                                        <td>
                                            <span>1</span> <span class="justification-text">Mudou-se</span>
                                        </td>
                                        <td>
                                            <span class="number-spacing">5</span> <span class="justification-text">Recusado</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span>2</span> <span class="justification-text">Endereço Insuficiente</span>
                                        </td>
                                        <td>
                                            <span class="number-spacing">6</span> <span class="justification-text">Não Procurado</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span>3</span> <span class="justification-text">Não Existe o Número</span>
                                        </td>
                                        <td>
                                            <span class="number-spacing">7</span> <span class="justification-text">Ausente</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span>4</span> <span class="justification-text">Desconhecido</span>
                                        </td>
                                        <td>
                                            <span class="number-spacing">8</span> <span class="justification-text">Falecido</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="justification-others">
                                            <span>9</span> <span class="justification-text">Outros _____________________________________</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="signature-table">
                    <td class="signature-border" colspan="2">
                        <table class="receiver-signature">
                            <tr>
                                <td class="signature">
                                    ASSINATURA DO RECEBEDOR
                                </td>
                                <td class="date">
                                    DATA DE ENTREGA
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="receiver-data-table">
                    <td class="receiver-border" colspan="2">
                        <table>
                            <tr>
                                <td class="name">
                                    NOME LEGÍVEL DO RECEBEDOR
                                </td>
                                <td class="document">
                                    Nº DOC. DE IDENTIDADE
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
        <td colspan="1" rowspan="1" class="stamp-table">
            <div class="stamp-data">
                <table>
                    <tr>
                        <td class="stamp-unit-delivery">
                            <div>CARIMBO</div>
                            <div>UNIDADE DE ENTREGA</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="rubric-postman">
                            <div>RUBRICA E MATRICULA DO CARTEIRO</div>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
</table>