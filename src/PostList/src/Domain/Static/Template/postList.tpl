<style>
    .logo {
        width: 150px;
        height: 30px;
    }
    .table, .footer {
        width: 1px;
        margin-left: 55px;
        border-collapse: collapse;
    }
    .footer {
        width: 625px;
    }
    .header th {
        padding: 10px;
    }
    .header-title span {
        margin-left: 60px;
        font-weight: bold;
        font-size: 15px;
        width: 1px;
    }
    .header th {
        border-bottom: 1px solid black;
    }
    .postage-title th {
        border-left: 1px solid black;
        border-right: 1px solid black;
        text-align: center;
        font-weight: bold;
        font-size: 12px;
        padding: 5px;
    }
    .body {
        border: 1px solid black;
        position: relative;
        height: 1px;
    }
    .bold {
        font-weight: bold;
    }
    .body-text {
        font-size: 11px;
        margin-bottom: 3px;
        height: 1px;
        padding-right: 50px;
    }
    .body .list-number {
        margin-left: 5px;
    }
    .body .contract {
        margin-left: 16px;
    }
    .body .administrative-code {
        margin-left: 9px;
    }
    .body .card {
        margin-left: 26px;
    }
    .body .receiver {
        margin-left: 10px;
    }
    .body .client {
        margin-left: 29.5px;
    }
    .body .address {
        margin-left: 16px;
    }
    .body .telephone-number {
        margin-left: 16px;
    }
    .telephone {
        width: 0px;
        position: absolute;
        top: 20px;
        left: 70px;
    }
    .footer {
        border: 1px solid black;
        font-size: 10px;
        position: relative;
    }
    .footer .science {
        font-size: 9px;
    }
    .footer .signature-field {
        margin-top: 5px;
        margin-left: 10px;
    }
    .footer td {
        padding-bottom: 3px;
    }
    .footer .signature-title {
        margin-left: 95px;
    }
    .footer .obs {
        margin-left: 65px;
    }
    .field-stamp {
        position: absolute;
        right: 170px;
        top: 2px;
    }
    .shippings {
        margin-left: 57px;
        border-collapse: collapse;
    }
    .list-shippings-header {
        font-size: 10px;
    }
    .list-shippings-header th {
        border-bottom: 1px solid black;
        padding: 3px;
        padding-right: 10px;
    }
    .list-shippings-header .zipcode {
        margin-left: 30px;
    }
    .post-objects .zipcode {
        margin-left: 20px;
    }
    .list-shippings-header .weight {
        margin-left: 20px;
    }
    .post-objects {
        background: #EEEEFF;
    }
    .post-objects .weight {
        margin-left: 27px;
    }
    .list-shippings-header .ar {
        margin-left: 5px;
    }
    .list-shippings-header .object-number {
        margin-left: 0px;
    }
    .post-objects .object-number {
        margin-left: 0px;
    }
    .list-shippings-header .declared-value,
    .list-shippings-header .invoice,
    .list-shippings-header .additional {
        margin-left: 10px;
    }
    .list-shippings-header .service-header {
        width: 145px;
    }
    .post-objects .additional {
        margin-left: 8px;
    }
    .post-objects .ar {
        margin-left: 8px;
    }
    .post-objects .invoice {
        margin-left: 15px;
    }
    .post-objects .declared-value {
        margin-left: 15px;
    }
    .shippings .receiver,
    .shippings .post-objects {
        font-size: 10px;
        background-color: #EEEEFF;
        padding: 10px;
    }
    .receiver td {
        padding-bottom: 7px;
    }
</style>

<table class="table">
    <tr class="header">
        <th colspan="3">
            <div class="header-title">
                <img class="logo" src="{{correiosLogo}}" />
                <span>EMPRESA BRASILEIRA DE CORREIOS E TELÉGRAFOS</span>
            </div>
        </th>
    </tr>
    <tr class="postage-title">
        <th colspan="3">
            LISTA DE POSTAGEM
        </th>
    </tr>
    <tr>
        <td class="body" colspan="3">
            <table>
                <tr>
                    <td class="body-text">
                        <span class="bold">Nº da Lista:</span><span class="list-number">{{prePostingList}}</span>
                    </td>
                    <td class="body-text">
                        <span class="bold">Remetente:</span><span class="receiver">{{senderName}}</span>
                    </td>
                </tr>
                <tr>
                    <td class="body-text">
                        <span class="bold">Contrato:</span><span class="contract">{{contract}}</span>
                    </td>
                    <td class="body-text">
                        <span class="bold">Cliente:</span><span class="client">{{clientName}}</span>
                    </td>
                </tr>
                <tr>
                    <td class="body-text">
                        <span class="bold">Cód Adm.:</span><span class="administrative-code">{{administrativeCode}}</span>
                    </td>
                    <td class="body-text">
                        <span class="bold">Endereço:</span><span class="address">{{address}}</span>
                    </td>
                </tr>
                <tr>
                    <td class="body-text">
                        <span class="bold">Cartão:</span><span class="card">{{postCardId}}</span>
                    </td>
                    <td class="body-text">
                        {{city}}
                    </td>
                </tr>
            </table>
            <div class="telephone body-text">
                <span class="bold">Telefone:</span><span class="telephone-number">{{telephone}}</span>
            </div>
        </td>
    </tr>
</table>
<table class="shippings">
    <tr class="list-shippings-header">
        <th>
            <span class="bold object-number">Nº do Objeto</span>
        </th>
        <th>
            <span class="bold zipcode">CEP</span>
        </th>
        <th>
            <span class="bold weight">Peso</span>
        </th>
        <th>
            <span class="bold ar">AR</span>
        </th>
        <th>
            <span class="bold additional">MP</span>
        </th>
        <th>
            <span class="bold additional">VD</span>
        </th>
        <th>
            <span class="bold declared-value">V. Declarado</span>
        </th>
        <th>
            <span class="bold invoice">N. Fiscal</span>
        </th>
        <th class="service-header">
            <span class="bold service">Serviço</span>
        </th>
    </tr>
    {{postObjects}}
</table>
<table class="footer">
    <tr>
        <td class="footer">
            <table>
                <tr>
                    <td>
                        <span class="bold">Quantidade de Objetos:</span> {{packagesQuantity}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Data de fechamento: {{postDate}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="bold">APRESENTAR ESTA LISTA EM CASO DE PEDIDO DE INFORMAÇÕES</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="bold science">Estou ciente do disposto na cláusula terceira do contrato de prestação de Serviços.</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="bold signature-field">__________________________________________________________</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="bold signature-title">ASSINATURA DO REMETENTE</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="bold science obs">Obs. 1ª via Unidade de Postagem e 2ª via Cliente</span>
                    </td>
                </tr>
            </table>
            <div class="field-stamp">
                <span class="bold">Carimbo e Assinatura / Matricula dos Correios</span>
            </div>
        </td>
    </tr>
</table>