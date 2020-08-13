<style>
    .logo {
        width: 150px;
        height: 30px;
    }
    .table {
        border-collapse: collapse;
        width: 1px;
        margin-left: 55px;
    }
    .header th {
        padding: 10px;
    }
    .header-title span {
        margin-left: 60px;
        font-weight: bold;
        font-size: 15px;
    }
    .header th {
        border-bottom: 1px solid black;
    }
    .postage-title th {
        border: 1px solid black;
        text-align: center;
        font-weight: bold;
        font-size: 15px;
        padding: 5px;
    }
    .body {
        border: 1px solid black;
        position: relative;
        font-size: 11px;
        width: 1px;
    }
    .body div {
        margin-left: 10px;
        margin-bottom: 5px;
    }
    .body .title {
        font-weight: bold;
    }
    .body .plp {
        font-weight: bold;
        position: absolute;
        top: 30px;
        left: -20px;
    }
    .body .barcode {
        position: absolute;
        top: 50px;
        left: -60px;
    }
    .body .email {
        margin-bottom: -20px;
    }
    .bold {
        font-weight: bold;
    }
    .text-center {
        text-align: center;
    }
    .service-list th {
        padding: 7px;
    }
    .service-list .contract {
        padding-left: 6px;
    }
    .signature {
        margin-left: 63%;
    }
    .signature .line {
        margin-top: 10px;
    }
    .separator {
        padding-top: 20px;
        padding-left: 30px;
        padding-right: 30px;
        font-size: 10px;
        width: 90%;
    }
    .separator .line {
        border: 1px dashed black;
        margin-top: 5px;
    }
    .separator .text-right {
        text-align: right;
    }
</style>

<table class="table">
    <tr class="header">
        <th>
            <div class="header-title">
                <img class="logo" src="{{correiosLogo}}" />
                <span>EMPRESA BRASILEIRA DE CORREIOS E TELÉGRAFOS</span>
            </div>
        </th>
    </tr>
    <tr class="postage-title">
        <th>
            PRÉ - LISTA DE POSTAGEM - PLP - SIGEP WEB
        </th>
    </tr>
    <tr>
        <td class="body">
            <div class="title">
                SIGEP WEB - Gerenciador de Postagens dos Correios
            </div>
            <div>
                <span class="bold">Contrato:</span> {{contract}}
            </div>
            <div>
                <span class="bold">Cliente</span>: {{senderName}}
            </div>
            <div>
                <span class="bold">Telefone de contato:</span> {{telephone}}
            </div>
            <div class="email">
                <span class="bold">Email de contato:</span> {{email}}
            </div>
            <div class="plp">
                Nº PLP: {{prePostingList}}
            </div>
            <div class="barcode">
                <img src="{{barcode}}" />
            </div>
        </td>
    </tr>
    <tr>
        <td class="body">
            <table class="service-list">
                <tr>
                    <th class="bold">
                        Quantidade de Objetos:
                    </th>
                    <th class="bold">
                        Serviço:
                    </th>
                </tr>
                {{services}}
            </table>
            <div>
                Data de fechamento: 30/03/2020
            </div>
            <div class="signature">
                <div class="text-center">
                    <span class="bold">Data de entrega:</span> _____/_____/______
                </div>
                <div class="line">
                    ____________________________________
                </div>
                <div class="text-center">
                    Assinatura / Matrícula dos Correios
                </div>
            </div>
        </td>
    </tr>
</table>

<div class="separator">
    <div class="text-right">1ª via - Correios</div>
    <div class="line"></div>
    <div class="text-right">2ª via - Cliente</div>
</div>

<table class="table">
    <tr class="header">
        <th>
            <div class="header-title">
                <img class="logo" src="{{correiosLogo}}" />
                <span>EMPRESA BRASILEIRA DE CORREIOS E TELÉGRAFOS</span>
            </div>
        </th>
    </tr>
    <tr class="postage-title">
        <th>
            PRÉ - LISTA DE POSTAGEM - PLP - SIGEP WEB
        </th>
    </tr>
    <tr>
        <td class="body">
            <div class="title">
                SIGEP WEB - Gerenciador de Postagens dos Correios
            </div>
            <div>
                <span class="bold">Contrato:</span> {{contract}}
            </div>
            <div>
                <span class="bold">Cliente</span>: {{clientName}}
            </div>
            <div>
                <span class="bold">Telefone de contato:</span> {{telephone}}
            </div>
            <div class="email">
                <span class="bold">Email de contato:</span> {{email}}
            </div>
            <div class="plp">
                Nº PLP: {{prePostingList}}
            </div>
            <div class="barcode">
                <img src="{{barcode}}" />
            </div>
        </td>
    </tr>
    <tr>
        <td class="body">
            <table class="service-list">
                <tr>
                    <th class="bold">
                        Quantidade de Objetos:
                    </th>
                    <th class="bold">
                        Serviço:
                    </th>
                </tr>
                {{services}}
            </table>
            <div>
                Data de fechamento: 30/03/2020
            </div>
            <div class="signature">
                <div class="text-center">
                    <span class="bold">Data de entrega:</span> _____/_____/______
                </div>
                <div class="line">
                    ____________________________________
                </div>
                <div class="text-center">
                    Assinatura / Matrícula dos Correios
                </div>
            </div>
        </td>
    </tr>
</table>