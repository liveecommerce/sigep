# Live eCommerce - SIGEP WEB PHP

Repositório de integração com o Sigep WEB dos Correios, para plataformas utilizando a linguagem PHP, administrado pela [Live eCommerce](https://www.liveecommerce.com.br).

## Instalação

**Composer**

```
composer require liveecommerce/sigep
```

**GIT**

Via SSH:
```
git clone git@github.com:liveecommerce/sigep.git
```

Via HTTPs:
```
git clone https://github.com/liveecommerce/sigep.git
```


## Utilização

Para um melhor aproveitamento do Live-sigep, recomendamos seguir o [Manual de integração do SIGEP WEB](http://www.corporativo.correios.com.br/encomendas/sigepweb/doc/Manual_de_Implementacao_do_Web_Service_SIGEP_WEB.pdf).

_Obs. Os tópicos do processo de utilização da biblioteca terão como referência o manual informado acima no decorrer da utilização, seguindo os passos do processo de integração, informado na seção 2 do documento._

_Os dados de homologação do SIGEP WEB também podem ser encontrados no manual._

## Menu
- [Verificar o Status do cartão de postagem](#verificar-o-status-do-cartão-de-postagem)
- [Verificar Disponibilidade dos cartões de postagem](#verificar-disponibilidade-dos-cartões-de-postagem)
- [Solicitação de Faixa de Etiquetas para Postagem](#solicitação-de-faixa-de-etiquetas-para-postagem)
- [Consulta Endereço via CEP](#consulta-endereço-via-cep)
- [Verificar disponibilidade de envio para CEP destino](#verificar-disponibilidade-de-envio-para-cep-destino)
- [Objeto de Endereço](#objeto-de-endereço)
- [Fechar a Pré-Lista de Postagem](#fechar-a-pré-lista-de-postagem)
- [Solicitação de XML da PLP](#solicitação-de-xml-da-plp)
- [Solicitação de Suspensão de entrega de encomenda ao Destinatário](#solicitação-de-suspensão-de-entrega-de-encomenda-ao-destinatário)
- [Gerar Rótulo de Endereçamento](#gerar-rótulo-de-endereçamento)
- [Gerar Voucher de postagem](#gerar-voucher-de-postagem)
- [Gerar lista de postagem](#gerar-lista-de-postagem)
- [Gerar aviso de recebimento](#gerar-aviso-de-recebimento)

### Verificar o Status do cartão de postagem

1. Classes utilizadas no serviço.
```php
use Live\Sigep\PostCard\Application\Service\GetPostCardStatusService;
use Live\Sigep\PostCard\Application\Service\GetPostCardStatusRequest;
use Live\Sigep\PostCard\Application\Service\GetPostCardStatusResponse;
use Live\Sigep\PostCard\Domain\Model\PostCardStatus;
```

2. Requisição do serviço

Atributos:
- _obrigatório_ (string) Usuário
- _obrigatório_ (string) Senha
- _obrigatório_ (string) Cartão de postagem
- _opcional_ (boolean) Sandbox

```php
$user = '';
$password = '';
$postCard = '';

$postCardStatusRequest = new GetPostCardStatusRequest($usuario, $password, $postCard);

// Setter para utilizar caso esteja em homologação
$postCardStatusRequest->setSandbox(true);
```

3. Invocação o serviço
```php
$postCardStatusService = new GetPostCardStatusService();
$postCardStatusResponse = $postCardStatusService($postCardStatusRequest);
```

4. Resultado do serviço
```php
$postCardStatus = $postCardStatusResponse->getObject();

$status = $postCardStatus->getStatus();
```

5. Objeto retornado
```
PostCardStatus
└── status
```
#### [Voltar ao topo](#menu)

### Verificar Disponibilidade dos cartões de postagem

1. Classes utilizadas no serviço.
```php
use Live\Sigep\PostCard\Application\Service\GetPostCardAvaliableServicesService;
use Live\Sigep\PostCard\Application\Service\GetPostCardAvaliableServicesRequest;
use Live\Sigep\PostCard\Application\Service\GetPostCardAvaliableServicesResponse;
use Live\Sigep\PostCard\Domain\Model\PostCardAvaliableServices
```

2. Requisição do serviço

Atributos:
- _obrigatório_ (string) Usuário
- _obrigatório_ (string) Senha
- _obrigatório_ (string) Cartão de postagem
- _obrigatório_ (string) Contrato
- _opcional_ (boolean) Sandbox

```php
$user = '';
$password = '';
$postCard = '';
$contract = '';

$postCardAvaliableServicesRequest = new GetPostCardAvaliableServicesRequest(
    $user,
    $password,
    $postcard,
    $contract
);

// Setter para utilizar caso esteja em homologação
$postCardAvaliableServicesRequest->setSandbox(true);
```

3. Invocação do serviço
```php
$postCardAvaliableServicesService = new GetPostCardAvaliableServicesService();
$postCardAvaliableServicesResponse = $postCardStatusService($postCardAvaliableServicesRequest);
```

4. Resultado do serviço
```php
$postCardAvaliableServices = $postCardAvaliableServicesResponse->getObject();

$postCardNumber = $postCardAvaliableServices->getPostCardNumber();
$administrativeCode = $postCardAvaliableServices->getAdministrativeCode();
$cnpj =  $postCardAvaliableServices->getCnpj();
$services =  $postCardAvaliableServices->getServices();

foreach ($services as $service) {
    $id = $service->getId();
    $serviceCode = $service->getServiceCode();
    $description = $service->getDescription();
    $packagesQuantity = $service->getPackagesQuantity();
}
```

5. Objeto retornado
```
PostCardAvaliableServices
├── postCardNumber
├── administrativeCode
├── cnpj
└── services (array)
    └── PostCardService
        ├── id
        ├── serviceCode
        ├── description
        └── packagesQuantity
```
#### [Voltar ao topo](#menu)

###  Solicitação de Faixa de Etiquetas para Postagem

1. Classes utilizadas no serviço.
```php
use Live\Sigep\ShippingLabel\Application\Service\GetShippingLabelsRequest;
use Live\Sigep\ShippingLabel\Application\Service\GetShippingLabelsService;
use Live\Sigep\ShippingLabel\Application\Service\GetShippingLabelsResponse;
use Live\Sigep\ShippingLabel\Domain\Model\ShippingLabel
```

2. Requisição do serviço

Atributos:
- _obrigatório_ (string) Usuário
- _obrigatório_ (string) Senha
- _obrigatório_ (string) Id do serviço
- _obrigatório_ (string) Tipo de destinatário
- _obrigatório_ (string) Cnpj _(somente numeros)_
- _obrigatório_ (integer) Quantidade de etiquetas
- _opcional_ (boolean) Sandbox

```php
$user = '';
$password = '';
$serviceId = '';
$receiverType = 'C';
$cnpj = '';
$quantityLabels = 1;

$getShippingLabelsRequest = new GetShippingLabelsRequest(
    $user,
    $password,
    $serviceId,
    $receiverType,
    $cnpj,
    $quantityLabels
);

// Setter para utilizar caso esteja em homologação
$getShippingLabelsRequest->setSandbox(true);
```

3. Invocação do serviço
```php
$getShippingLabelsService = new GetShippingLabelsService();
$getShippingLabelsResponse = $getShippingLabelsService($getShippingLabelsRequest);
```

4. Resultado do serviço
```php
$shippingLabels = $getShippingLabelsResponse->getData();

foreach ($shippingLabels as $shippingLabel) {
    $label = $shippingLabel->getLabel();
}
```

5. Objeto retornado
```
ShippingLabel (array)
└── label
```
#### [Voltar ao topo](#menu)

### Consulta Endereço via CEP

1. Classes utilizadas no serviço.
```php
use Live\Sigep\Address\Application\Service\GetAddressByZipCodeRequest;
use Live\Sigep\Address\Application\Service\GetAddressByZipCodeService;
use Live\Sigep\Address\Application\Service\GetAddressByZipCodeResponse;
use Live\Sigep\Address\Domain\Model\Address
```
2. Requisição do serviço

Atributos:
- _obrigatório_ (string) Cep _(somente números)_
- _opcional_ (boolean) Sandbox

```php
$cep = '';

$getAddressByZipCodeRequest = new GetAddressByZipCodeRequest('07124610');

// Setter para utilizar caso esteja em homologação
$getAddressByZipCodeRequest->setSandbox(true);
```

3. Invocação do serviço
```php
$getAddressByZipCodeService = new GetAddressByZipCodeService();
$getAddressByZipCodeResponse = $getAddressByZipCodeService($getAddressByZipCodeRequest);
```

4. Resultado do serviço
```php
$address = $getAddressByZipCodeResponse->getObject();

$zipCode = $address->getZipCode();
$street = $address->getStreet();
$district = $address->getDistrict();
$state = $address->getState();
$complement = $address->getComplement();
$additionalComplement = $address->getAdditionalComplement();
$number = $address->getNumber();
$zipCodeComplement = $address->getZipCodeComplement();
```

5. Objeto retornado
```
Address
├── zipCode
├── street
├── district
├── state
├── complement
├── additionalComplement
├── number
└── zipCodeComplement
```

#### [Voltar ao topo](#menu)

### Verificar disponibilidade de envio para CEP destino

1. Classes utilizadas no serviço.
```php
use Live\Sigep\DeliveryAvailability\Application\Service\GetDeliveryAvailabilityRequest;
use Live\Sigep\DeliveryAvailability\Application\Service\GetDeliveryAvailabilityService;
use Live\Sigep\DeliveryAvailability\Application\Service\GetDeliveryAvailabilityResponse;
use Live\Sigep\DeliveryAvailability\Domain\Model\DeliveryAvailability;
```
2. Requisição do serviço

Atributos:
- _obrigatório_ (string) Usuário
- _obrigatório_ (string) Senha
- _obrigatório_ (string) Código administrativo
- _obrigatório_ (string) Serviço
- _obrigatório_ (string) CEP do remetente
- _obrigatório_ (string) CEP do destinatário
- _opcional_ (boolean) Sandbox

```php
$cep = '';

$getDeliveryAvailabilityRequest = new GetDeliveryAvailabilityRequest(
    $user,
    $password,
    $administrativeCode,
    $service,
    $senderZipCode,
    $receiverZipCode
);

// Setter para utilizar caso esteja em homologação
$getDeliveryAvailabilityRequest->setSandbox(true);
```

3. Invocação do serviço
```php
$getDeliveryAvailabilityService = new GetDeliveryAvailabilityService();
$getDeliveryAvailabilityResponse = $getDeliveryAvailabilityService($getDeliveryAvailabilityRequest);
```

4. Resultado do serviço
```php
$deliveryAvailability = $getDeliveryAvailabilityResponse->getObject();

$id = $deliveryAvailability->getId();
$message = $deliveryAvailability->getMessage();
```

5. Objeto retornado
```
DeliveryAvailability
├── id
└── message
```

#### [Voltar ao topo](#menu)

### Objeto de Endereço

1. Classes utilizadas no serviço.
```php
use Live\Sigep\Address\Domain\Model\Address;
```

2. Dados do objeto

Atributos:
- _obrigatório_ (string) CEP
- _obrigatório_ (string) Rua
- _obrigatório_ (string) Bairro / Distrito
- _obrigatório_ (string) Cidade
- _obrigatório_ (string) Estado
- _opcional_ (string) Número
- _opcional_ (string) Complemento
- _opcional_ (string) Complemento adicional
- _opcional_ (string) CEP adicional

```php
$zipCode = '';
$street = '';
$district = '';
$city = '';
$state = '';
$number = '';
$complement = '';
$additionalComplement = '';
$zipCodeComplement = '';

$address = new Address(
    $zipCode,
    $street,
    $district,
    $city,
    $state
);

$address->setNumber($number);
$address->setComplement($complement);
$address->setAdditionalComplement($additionalComplement);
$address->setZipCodeComplement($zipCodeComplement);
```

3. Objeto
```
Address
├── zipCode
├── street
├── district
├── state
├── complement
├── additionalComplement
├── number
└── zipCodeComplement
```

#### [Voltar ao topo](#menu)

### Objeto Postal

1. Classes utilizadas no serviço.
```php
use Live\Sigep\Address\Domain\Model\Address;
use Live\Sigep\ShippingLabel\Domain\Model\ShippingLabel;
use Live\Sigep\PrePostingList\Domain\Model\PrePostingList;
use Live\Sigep\PrePostingList\Domain\Model\AdditionalServiceType;
```

2. Dados do objeto

Atributos:
- _obrigatório_ (Address) Endereço
- _obrigatório_ (ShippingLabel) Etiqueta 
- _obrigatório_ (string) Código de serviço
- _obrigatório_ (string) Peso
- _obrigatório_ (string) Nome do remetente
- _obrigatório_ (string) Largura
- _obrigatório_ (string) Altura
- _obrigatório_ (string) Comprimento
- _obrigatório_ (string) Diâmetro
- _opcional_ (string) Nota fiscal
- _opcional_ (AdditionalServiceType) Serviços adicionais
- _opcional_ (string) Valor declarado
- _opcional_ (string) Endereço do Vizinho

```php
$address = '';
$shippingLabel = '';
$serviceCode = '';
$weight = '';
$receiverName = '';
$objectType = '';
$height = '';
$width = '';
$length = '';
$diameter = '';
$invoiceNumber = '';
$additionalService = AdditionalServiceType::NATIONALREGISTRATION;
$declaredValue = '';
$neighborAddress = '';

$address = new PrePostingList(
    $address,
    $shippingLabel,
    $serviceCode,
    $weight,
    $receiverName,
    $objectType,
    $height,
    $width,
    $length,
    $diameter,
    $invoiceNumber,
    $additionalService,
    $declaredValue,
    $neighborAddress
);
```

3. Objeto
```
Address
├── address
├── shippingLabel
├── weight
├── weigth
├── receiverName
├── objectType
├── height
├── width
├── length
├── diameter
├── invoiceNumber
├── additionalService
├── declaredValue
└── neighborAddress
```

#### [Voltar ao topo](#menu)

### Fechar a Pré-Lista de Postagem

1. Classes utilizadas no serviço.
```php
use Live\Sigep\PrePostingList\Application\Service\ClosePrePostingListRequest;
use Live\Sigep\PrePostingList\Application\Service\ClosePrePostingListService;
use Live\Sigep\PrePostingList\Application\Service\ClosePrePostingListResponse;
use Live\Sigep\Address\Domain\Model\Address;
use Live\Sigep\ShippingLabel\Domain\Model\ShippingLabel;
use Live\Sigep\PrePostingList\Domain\Model\PostalObject;
use Live\Sigep\PrePostingList\Domain\Model\PostalObjectType;
use Live\Sigep\PrePostingList\Domain\Model\AdditionalServiceType;
use Live\Sigep\PrePostingList\Domain\Model\RegionalCodeBoardType;
use Live\Sigep\PrePostingList\Domain\Model\PrePostingList;
```
2. Requisição do serviço

Atributos:
- _obrigatório_ (string) Usuário
- _obrigatório_ (string) Senha
- _obrigatório_ (Address) Endereço do destinatário
- _obrigatório_ (array)[PostalObject] Objetos Postais
- _obrigatório_ (integer) Id do cliente da pré-lista de postagem
- _obrigatório_ (string) Id do cartão de postagem
- _obrigatório_ (string) Contrato
- _obrigatório_ (string) Código administrativo
- _obrigatório_ (array)[ShippingLabel] Etiquetas
- _obrigatório_ (string) Nome do remetente
- _obrigatório_ (RegionalCodeBoardType) Código da diretoria regional
- _opcional_ (boolean) Sandbox

```php
$user = '';
$password = '';
$senderAddress = '';
$postalObjects = [];
$prePostingListClientId = '';
$postCardId = '';
$contract = '';
$administrativeCode = '';
$shippingLabels = [];
$senderName = '';
$regionalCodeBoard = RegionalCodeBoardType::SAOPAULO;

$closePrePostingListRequest = new ClosePrePostingListRequest(
    $user,
    $password,
    $senderAddress,
    $postalObjects,
    $prePostingListClientId,
    $postCardId,
    $contract,
    $administrativeCode,
    $shippingLabels,
    $senderName,
    $regionalCodeBoard
);

// Setter para utilizar caso esteja em homologação
$closePrePostingListRequest->setSandbox(true);
```

3. Invocação do serviço
```php
$closePrePostingListService = new ClosePrePostingListService();
$closePrePostingListResponse = $closePrePostingListService($closePrePostingListRequest);
```

4. Resultado do serviço
```php
$prePostingList = $closePrePostingListResponse->getObject();

$id = $prePostingList->getId();
```

5. Objeto retornado
```
PrePostingList
└── id
```

#### [Voltar ao topo](#menu)

### Solicitação de XML da PLP

1. Classes utilizadas no serviço.
```php
use Live\Sigep\PrePostingList\Application\Service\GetPrePostingListXmlFromCorreiosRequest;
use Live\Sigep\PrePostingList\Application\Service\GetPrePostingListXmlFromCorreiosService;
use Live\Sigep\PrePostingList\Application\Service\GetPrePostingListXmlFromCorreiosResponse;
```
2. Requisição do serviço

Atributos:
- _obrigatório_ (string) Usuário
- _obrigatório_ (string) Senha
- _obrigatório_ (integer) Número da plp
- _opcional_ (boolean) Sandbox

```php
$user = '';
$password = '';
$plpNumber = 0;


$getPrePostingListXmlFromCorreiosRequest = new GetPrePostingListXmlFromCorreiosRequest(
    $user,
    $password,
    $plpNumber
);

// Setter para utilizar caso esteja em homologação
$getPrePostingListXmlFromCorreiosRequest->setSandbox(true);
```

3. Invocação do serviço
```php
$getPrePostingListXmlFromCorreiosService = new GetPrePostingListXmlFromCorreiosService();
$getPrePostingListXmlFromCorreiosResponse = $getPrePostingListXmlFromCorreiosService($getPrePostingListXmlFromCorreiosRequest);
```

4. Resultado do serviço
```php
$getPrePostingListXmlFromCorreios = $getPrePostingListXmlFromCorreiosResponse->getData();

$xml = $getPrePostingListXmlFromCorreios['xml'];
```

#### [Voltar ao topo](#menu)

### Solicitação de Suspensão de entrega de encomenda ao Destinatário

1. Classes utilizadas no serviço.
```php
use Live\Sigep\DeliverySuspension\Application\Service\GetDeliverySuspensionRequest;
use Live\Sigep\DeliverySuspension\Application\Service\GetDeliverySuspensionService;
use Live\Sigep\DeliverySuspension\Application\Service\GetDeliverySuspensionResponse;
use Live\Sigep\PrePostingList\Domain\Model\PrePostingList;
use Live\Sigep\ShippingLabel\Domain\Model\ShippingLabel;
```
2. Requisição do serviço

Atributos:
- _obrigatório_ (string) Usuário
- _obrigatório_ (string) Senha
- _obrigatório_ (ShippingLabel) etiqueta
- _obrigatório_ (PrePostingList) prePostingList
- _opcional_ (boolean) Sandbox

```php
$user = '';
$password = '';
$label = '';
$plp = 0;
$shippingLabel = new ShippingLabel($label);
$prePostingList = new PrePostingList($plp);

$getDeliverySuspensionRequest = new GetDeliverySuspensionRequest(
    $user,
    $password,
    $shippingLabel,
    $prePostingList
);

// Setter para utilizar caso esteja em homologação
$getDeliverySuspensionRequest->setSandbox(true);
```

3. Invocação do serviço
```php
$getDeliverySuspensionService = new GetDeliverySuspensionService();
$getDeliverySuspensionResponse = $getDeliverySuspensionService($getDeliverySuspensionRequest);
```

4. Resultado do serviço
```php
$getDeliverySuspension = $getDeliverySuspensionResponse->getData();

$data = $getDeliverySuspension['data'];
```

#### [Voltar ao topo](#menu)

### Gerar Rótulo de Endereçamento

1. Classes utilizadas no serviço.
```php
use Live\Sigep\AddressingLabel\Application\Service\GetAddressingLabelRequest;
use Live\Sigep\AddressingLabel\Application\Service\GetAddressingLabelService;
use Live\Sigep\AddressingLabel\Application\Service\GetAddressingLabelResponse;
use Live\Sigep\Address\Domain\Model\Address;
use Live\Sigep\ShippingLabel\Domain\Model\ShippingLabel;
```
2. Requisição do serviço

Atributos:
- _obrigatório_ (string) Formato do rótulo
- _obrigatório_ (Address) Endereço do destinatário
- _obrigatório_ (Address) Endereço do remetente
- _obrigatório_ (ShippingLabel) etiqueta
- _obrigatório_ (integer) Peso
- _obrigatório_ (string) Nota fiscal
- _obrigatório_ (integer) Tipo de serviço de entrega
- _obrigatório_ (string) Id do pedido
- _obrigatório_ (string) Nome do destinatário
- _obrigatório_ (string) Nome do remetente
- _obrigatório_ (string) Contrato
- _obrigatório_ (string) Cartão de postagem
- _obrigatório_ (string) código de serviço
- _obrigatório_ (integer) Valor declarado
- _opcional_ (string) Url do logo
- _opcional_ (string) Informação de agrupamento
- _opcional_ (array) Serviço adicional
- _opcional_ (string) Identificador de dados variádveis

```php
$format = "1";
$receiverAddress = '';
$senderAddress = '';
$shippingLabel = '';
$weight = '';
$invoice = '';
$shippingType = '';
$orderId = '';
$receiverName = '';
$senderName = '';
$contract = '';
$postCard = '';
$serviceCode = '';
$declaredValue = '';
$logoUrl = '';
$groupingInformation = '00';
$additionalServices = [];
$variableDataIdentifier = '51';

$request = [];
$request[] = new GetAddressingLabelRequest(
    $format,
    $receiverAddress,
    $senderAddress,
    $shippingLabel,
    $weight,
    $invoice,
    $shippingType,
    $orderId,
    $receiverName,
    $senderName,
    $contract,
    $postCard,
    $serviceCode,
    $declaredValue,
    $logoUrl,
    $groupingInformation,
    $additionalServices,
    $variableDataIdentifier
);
```

3. Invocação do serviço
```php
$getAddressingLabelService = new GetAddressingLabelService();
$getAddressingLabelResponse = $getAddressingLabelService($request);
```

4. Resultado do serviço
```
Executa o download do PDF
```

#### [Voltar ao topo](#menu)

### Gerar Voucher de postagem

1. Classes utilizadas no serviço.
```php
use Live\Sigep\PostList\Application\Service\GetPostageVoucherRequest;
use Live\Sigep\PostList\Application\Service\GetPostageVoucherService;
use Live\Sigep\PostList\Application\Service\GetPostageVoucherResponse;
use Live\Sigep\PrePostingList\Domain\Model\PrePostingList;
```
2. Requisição do serviço

Atributos:
- _obrigatório_ (PrePostingList) Pré-lista de postagem
- _obrigatório_ (string) Contrato
- _obrigatório_ (array) Serviços do cartão de postagem
- _obrigatório_ (string) Data de postagem
- _obrigatório_ (string) telefone do remetente
- _obrigatório_ (string) Nome do remetente
- _opcional_ (string) Nome do cliente do Sigep
- _opcional_ (string) Email

```php
$prePostingList = '';
$contract = '';
$postCardServices = '';
$postDate = '';
$telephone = '';
$senderName = '';
$clientName = 'ECT';
$email = '';

$getPostageVoucherRequest = new GetPostageVoucherRequest(
    $prePostingList,
    $contract,
    $postCardServices,
    $postDate,
    $telephone,
    $senderName,
    $clientName,
    $email
);
```

3. Invocação do serviço
```php
$getPostageVoucherService = new GetPostageVoucherService();
$getPostageVoucherResponse = $getPostageVoucherService($getPostageVoucherRequest);
```

4. Resultado do serviço
```
Executa o download do PDF
```

#### [Voltar ao topo](#menu)

### Gerar lista de postagem

1. Classes utilizadas no serviço.
```php
use Live\Sigep\PostList\Application\Service\GetPostListRequest;
use Live\Sigep\PostList\Application\Service\GetPostListService;
use Live\Sigep\PostList\Application\Service\GetPostListResponse;
use Live\Sigep\PostList\Domain\Model\PrePostingList;
use Live\Sigep\Address\Domain\Model\Address;
use Live\Sigep\PrePostingList\Domain\Model\PostalObject;
```
2. Requisição do serviço

Atributos:
- _obrigatório_ (PrePostingList) Pré-lista de postagem
- _obrigatório_ (Address) Endereço do remetente
- _obrigatório_ (string) Nome do remetente
- _obrigatório_ (string) Contrato
- _obrigatório_ (string) Código adminitrativo
- _obrigatório_ (string) Id do cartão de postagem
- _obrigatório_ (array)[PostCardServices] Serviços do cartão de postagem
- _obrigatório_ (array)[PostalObject] Objetos postais
- _obrigatório_ (string) Data de postagem
- _obrigatório_ (string) Telefone
- _opcional_ (string) Nome do cliente do Sigep

```php
$prePostingList = '';
$senderAddress = '';
$senderName = '';
$contract = '';
$adminitrativeCode = '';
$postCardId = '';
$postCardServices = '';
$postalObjects = '';
$postDate = '';
$telephone = '';
$clientName = 'ECT';

$getPostListRequest = new GetPostListRequest(
    $prePostingList,
    $senderAddress,
    $senderName,
    $contract,
    $adminitrativeCode,
    $postCardId,
    $postCardServices,
    $postalObjects,
    $postDate,
    $telephone,
    $clientName
);
```

3. Invocação do serviço
```php
$getPostListService = new GetPostListService();
$getPostListResponse = $getPostListService($getPostListRequest);
```

4. Resultado do serviço
```
Executa o download do PDF
```

#### [Voltar ao topo](#menu)


### Gerar aviso de recebimento

1. Classes utilizadas no serviço.
```php
use Live\Sigep\PostList\Application\Service\GetProofOfDeliveryRequest;
use Live\Sigep\PostList\Application\Service\GetProofOfDeliveryService;
use Live\Sigep\PostList\Application\Service\GetProofOfDeliveryResponse;
use Live\Sigep\PrePostingList\Domain\Model\PostalObject;
use Live\Sigep\Address\Domain\Model\Address;
```
2. Requisição do serviço

Atributos:
- _obrigatório_ (Address) Endereço do remetente
- _obrigatório_ (string) Contrato
- _obrigatório_ (string) Nome do remetente
- _obrigatório_ (PostalObject) Objeto postal

```php
$senderAddress = '';
$contract = '';
$senderName = '';
$postalObject = '';

$getProofOfDeliveryRequest = new GetProofOfDeliveryRequest(
    $senderAddress,
    $contract,
    $senderName,
    $postalObject
);
```

3. Invocação do serviço
```php
$getProofOfDeliveryService = new GetProofOfDeliveryService();
$getProofOfDeliveryResponse = $getProofOfDeliveryService($getProofOfDeliveryRequest);
```

4. Resultado do serviço
```
Executa o download do PDF
```

#### [Voltar ao topo](#menu)