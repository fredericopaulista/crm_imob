import requests
from io import BytesIO

BASE_URL = "http://localhost:8000"
LOGIN_URL = f"{BASE_URL}/login"
IMPORT_URL = f"{BASE_URL}/painel/marketing/processar-importacao"

def test_import_clients_with_valid_csv():
    session = requests.Session()
    timeout = 30

    # Login as admin
    login_data = {
        "email": "admin@imobhub.com",
        "password": "password"
    }
    try:
        login_response = session.post(LOGIN_URL, data=login_data, timeout=timeout, allow_redirects=False)
        assert login_response.status_code in (302, 303), f"Expected redirect on login, got {login_response.status_code}"
        location = login_response.headers.get("Location", "")
        assert location.startswith("/painel"), f"Expected redirect to /painel, got {location}"

        # Prepare CSV file in-memory
        csv_content = "Name,Phone,Email\nJohn Doe,1234567890,john@example.com\nJane Smith,0987654321,jane@example.com"
        files = {
            "csv_file": ("clients.csv", BytesIO(csv_content.encode("utf-8")), "text/csv")
        }

        # Import clients with CSV file
        import_response = session.post(IMPORT_URL, files=files, timeout=timeout, allow_redirects=False)
        assert import_response.status_code in (302, 303), f"Expected redirect on import, got {import_response.status_code}"
        redirect_location = import_response.headers.get("Location", "")
        assert "success" in redirect_location.lower(), f"Expected 'success' in redirect URL, got {redirect_location}"

    finally:
        session.close()

test_import_clients_with_valid_csv()