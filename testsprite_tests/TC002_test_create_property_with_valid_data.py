import requests

BASE_URL = "http://localhost:8000"
LOGIN_URL = f"{BASE_URL}/acesso/autenticar"
PROPERTY_SAVE_URL = f"{BASE_URL}/painel/imoveis/salvar"

def test_create_property_with_valid_data():
    session = requests.Session()
    try:
        # Login as admin
        login_payload = {
            "email": "admin@imobhub.com",
            "password": "password"
        }
        login_resp = session.post(LOGIN_URL, data=login_payload, timeout=30, allow_redirects=False)
        assert login_resp.status_code == 200, f"Expected 200 on login, got {login_resp.status_code}"

        # Prepare images for upload (mock file upload)
        # Create a simple in-memory file to simulate image upload
        files = {
            "images[]": ("test_image.jpg", b"fake-image-content", "image/jpeg")
        }

        # Prepare property payload
        property_payload = {
            "title": "Test Property",
            "type": "Casa",
            "purpose": "sale",
            "price": "500000",
            "address": "Rua Teste",
            "neighborhood": "Centro",
            "city": "São Paulo",
            "status": "available",
            "owner_id": "1"
        }

        response = session.post(PROPERTY_SAVE_URL, data=property_payload, files=files, timeout=30, allow_redirects=False)
        assert response.status_code in (301, 302), f"Expected redirect after property creation, got {response.status_code}"
        redirect_location = response.headers.get("Location", "")
        assert redirect_location == "/painel/imoveis", f"Expected redirect to /painel/imoveis, got {redirect_location}"

    finally:
        pass

test_create_property_with_valid_data()
