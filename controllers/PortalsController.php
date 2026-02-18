<?php

class PortalsController {

    public function __construct() {
        if (php_sapi_name() !== 'cli' && !isset($_SESSION['user_id']) && strpos($_SERVER['REQUEST_URI'], '/feed/') === false) {
             header('Location: ' . APP_URL . '/acesso/login');
             exit;
        }
    }

    public function index() {
        $pageTitle = 'Integração com Portais - ' . company_name();
        $feedZapUrl = APP_URL . '/feed/zap';
        $feedOlxUrl = APP_URL . '/feed/olx';
        
        require_once 'views/layout/header.php';
        require_once 'views/settings/portals.php';
        require_once 'views/layout/footer.php';
    }

    public function feedZap() {
        header('Content-Type: application/xml; charset=utf-8');
        
        $cachedFile = BASE_PATH . '/assets/feeds/zap.xml';
        if (file_exists($cachedFile)) {
            readfile($cachedFile);
            return;
        }

        $propertyModel = new Property();
        // Fetch all available properties
        $properties = $propertyModel->getAll(['status' => 'available']);
        
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><ListingDataFeed xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xsi:schemaLocation="http://www.vivareal.com.br/schemas/listings/v3/Listing.xsd"></ListingDataFeed>');
        
        $header = $xml->addChild('Header');
        $header->addChild('Provider', company_name());
        $header->addChild('Email', 'contato@corretapro.com.br'); // Ideally from settings
        $header->addChild('ContactName', company_name());
        $header->addChild('PublishDate', date('c'));
        
        $listings = $xml->addChild('Listings');
        
        foreach ($properties as $property) {
            $listing = $listings->addChild('Listing');
            
            $listing->addChild('ListingID', $property['id']);
            $listing->addChild('Title', htmlspecialchars($property['title']));
            $listing->addChild('TransactionType', $property['purpose'] == 'sale' ? 'For Sale' : 'For Rent');
            
            $details = $listing->addChild('Details');
            $details->addChild('PropertyType', $this->mapPropertyType($property['type']));
            $details->addChild('Description', htmlspecialchars($property['description']));
            $details->addChild('ListPrice', $property['price']);
            $details->addChild('LivingArea', $property['area']);
            $details->addChild('Bedrooms', $property['bedrooms']);
            $details->addChild('Bathrooms', $property['bathrooms']);
            $details->addChild('Garage', $property['garages']);
            
            $location = $listing->addChild('Location');
            $location->addChild('Country', 'BR');
            $location->addChild('City', htmlspecialchars($property['city']));
            $location->addChild('Neighborhood', htmlspecialchars($property['neighborhood']));
            $location->addChild('Address', htmlspecialchars($property['address']));
            
            $media = $listing->addChild('Media');
            $images = json_decode($property['images'], true);
            if ($images) {
                foreach ($images as $img) {
                    $item = $media->addChild('Item');
                    $item->addChild('ItemUrl', APP_URL . '/assets/uploads/' . $img);
                    $item->addChild('ItemCaption', htmlspecialchars($property['title']));
                }
            }
            
            $contact = $listing->addChild('ContactInfo');
            $contact->addChild('Name', company_name());
            $contact->addChild('Email', 'contato@corretapro.com.br');
            $contact->addChild('Website', APP_URL . '/imovel/' . $property['slug']);
        }
        
        echo $xml->asXML();
    }

    public function feedOlx() {
        header('Content-Type: application/xml; charset=utf-8');
        
        $cachedFile = BASE_PATH . '/assets/feeds/olx.xml';
        if (file_exists($cachedFile)) {
            readfile($cachedFile);
            return;
        }

        // OLX often accepts standard Zap format, but let's create a specific one if needed.
        // For now, we reuse Zap format as it's the market standard.
        $this->feedZap();
    }
    
    private function mapPropertyType($type) {
        $map = [
            'Casa' => 'Residential / Home',
            'Apartamento' => 'Residential / Apartment',
            'Terreno' => 'Residential / Land Lot',
            'Comercial' => 'Commercial / Office',
        ];
        return $map[$type] ?? 'Residential / Home';
    }
}
