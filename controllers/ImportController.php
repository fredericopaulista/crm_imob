<?php

class ImportController {
    private $conn;
    private $propertyModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . APP_URL . '/acesso/login');
            exit;
        }
        $this->conn = Database::getInstance()->getConnection();
        $this->propertyModel = new Property();
    }

    public function index() {
        // Render the import view
        $pageTitle = 'Importar Imóveis XML';
        require 'views/properties/import.php';
    }

    public function process() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . APP_URL . '/painel/imoveis/importar');
            exit;
        }

        $xmlUrl = $_POST['xml_url'] ?? '';
        
        if (empty($xmlUrl)) {
            $_SESSION['error'] = 'Por favor, informe a URL do XML.';
            header('Location: ' . APP_URL . '/painel/imoveis/importar');
            exit;
        }

        try {
            $xmlContent = @file_get_contents($xmlUrl);
            if ($xmlContent === false) {
                throw new Exception("Não foi possível acessar a URL do XML.");
            }

            $xml = new SimpleXMLElement($xmlContent);
            $importedCount = 0;
            $updatedCount = 0;

            foreach ($xml->Listings->Listing as $listing) {
                $externalId = (string) $listing->ListingID;
                $title = (string) $listing->Title;
                
                // Map Transaction Type
                $transactionType = (string) $listing->TransactionType; // For Sale, For Rent
                $purpose = 'sale';
                if (stripos($transactionType, 'Rent') !== false) {
                    $purpose = 'rent';
                }

                // Map Details
                $price = 0;
                if (isset($listing->Details->ListPrice)) {
                    $price = (float) $listing->Details->ListPrice;
                } elseif (isset($listing->Details->RentalPrice)) {
                    $price = (float) $listing->Details->RentalPrice;
                }

                // Location
                $address = (string) $listing->Location->Address . ', ' . (string) $listing->Location->StreetNumber;
                $neighborhood = (string) $listing->Location->Neighborhood;
                $city = (string) $listing->Location->City;
                
                // Features
                $bedrooms = (int) $listing->Details->Bedrooms;
                $bathrooms = (int) $listing->Details->Bathrooms;
                $garages = (int) $listing->Details->Garage;
                $area = (float) $listing->Details->LivingArea;
                $description = (string) $listing->Details->Description;
                
                // Type Mapping
                $propertyTypeRaw = (string) $listing->Details->PropertyType;
                $type = 'Casa'; // Default
                if (stripos($propertyTypeRaw, 'Apartment') !== false) {
                    $type = 'Apartamento';
                } elseif (stripos($propertyTypeRaw, 'Commercial') !== false) {
                    $type = 'Comercial';
                } elseif (stripos($propertyTypeRaw, 'Land') !== false || stripos($propertyTypeRaw, 'Lot') !== false) {
                    $type = 'Terreno';
                }

                // Images
                $images = [];
                if (isset($listing->Media->Item)) {
                    $count = 0;
                    foreach ($listing->Media->Item as $media) {
                        if ($count >= 5) break; // Limit to 5 images
                        $imageUrl = (string) $media;
                        
                        // Download image
                        $imageName = 'import_' . md5($imageUrl) . '.jpg';
                        $uploadDir = 'assets/uploads/';
                        
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                        }
                        
                        $uploadPath = $uploadDir . $imageName;
                        
                        if (!file_exists($uploadPath)) {
                            $imageContent = @file_get_contents($imageUrl);
                            if ($imageContent) {
                                @file_put_contents($uploadPath, $imageContent);
                                $images[] = $imageName;
                            }
                        } else {
                             $images[] = $imageName;
                        }
                        $count++;
                    }
                }

                // Check if exists
                $stmt = $this->conn->prepare("SELECT id FROM properties WHERE external_id = :external_id");
                $stmt->execute([':external_id' => $externalId]);
                $existing = $stmt->fetch(PDO::FETCH_ASSOC);

                $data = [
                    'title' => $title,
                    'type' => $type,
                    'purpose' => $purpose,
                    'price' => $price,
                    'address' => $address,
                    'neighborhood' => $neighborhood,
                    'city' => $city,
                    'area' => $area,
                    'bedrooms' => $bedrooms,
                    'bathrooms' => $bathrooms,
                    'garages' => $garages,
                    'description' => $description,
                    'status' => 'available',
                    'images' => json_encode($images),
                    'owner_id' => null // Or a default mock owner
                ];

                if ($existing) {
                    $data['title'] = $title; // Ensure title is passed for slug generation if needed, though update logic in model might handle it.
                    // IMPORTANT: The Property model's update method requires 'title' to regenerate slug.
                    // We need to be careful not to overwrite manual changes if that's desired, but for sync, we usually overwrite.
                    
                    // Direct update query to avoid Property model complexity loop if not needed, 
                    // OR use Property model. Let's use Property model but we need to inject external_id handling.
                    // Since Property model doesn't know about external_id in update(), we will update standard fields.
                    
                    $this->propertyModel->update($existing['id'], $data);
                    $updatedCount++;
                } else {
                    $this->propertyModel->create($data);
                    // Update the newly created property with external_id
                    // We need the ID of the inserted property. 
                    // Property::create returns bool. We should fetch the last inserted ID via DB connection.
                    $lastId = $this->conn->lastInsertId();
                    
                    $upd = $this->conn->prepare("UPDATE properties SET external_id = :external_id WHERE id = :id");
                    $upd->execute([':external_id' => $externalId, ':id' => $lastId]);
                    
                    $importedCount++;
                }
            }

            $_SESSION['success'] = "Importação concluída! $importedCount novos imóveis, $updatedCount atualizados.";

        } catch (Exception $e) {
            $_SESSION['error'] = 'Erro na importação: ' . $e->getMessage();
        }

        header('Location: ' . APP_URL . '/painel/imoveis/importar');
        exit;
    }
}
