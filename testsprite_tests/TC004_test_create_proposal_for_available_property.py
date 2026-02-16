import requests

BASE_URL = "http://localhost:8000"
LOGIN_URL = f"{BASE_URL}/acesso/autenticar"
PROPOSAL_SAVE_URL = f"{BASE_URL}/painel/propostas/salvar"
TIMEOUT = 30

def test_create_proposal_for_available_property():
    session = requests.Session()
    try:
        # Login as admin
        login_payload = {
            'email': 'admin@imobhub.com',
            'password': 'password'
        }
        login_response = session.post(LOGIN_URL, data=login_payload, timeout=TIMEOUT, allow_redirects=False)
        assert login_response.status_code in (302, 200), f"Login failed with status {login_response.status_code}"
        if login_response.status_code == 302:
            redirect_location = login_response.headers.get('Location', '')
            assert redirect_location.startswith('/painel'), f"Unexpected login redirect: {redirect_location}"

        # Create a new proposal
        proposal_payload = {
            'client_id': 1,
            'property_id': 1,
            'value': 450000,
            'commission': 4500.0,
            'conditions': 'Cash',
            'observations': 'Test'
        }

        proposal_response = session.post(PROPOSAL_SAVE_URL, data=proposal_payload, timeout=TIMEOUT, allow_redirects=False)
        assert proposal_response.status_code in (200, 302), f"Expected status 200 or 302, got {proposal_response.status_code}"

        if proposal_response.status_code == 302:
            location = proposal_response.headers.get('Location', '')
            assert location == '/painel/propostas', f"Unexpected redirect location: {location}"
        else:
            # If 200, check for expected success indication in response content
            # Since PRD doesn't specify exact response, check if 'Sent' status likely present - it's assumed JSON
            try:
                json_data = proposal_response.json()
                # Check the proposal status in response if present
                assert 'status' in json_data, "Response JSON missing 'status'"
                assert json_data['status'] == 'Sent', f"Proposal status expected 'Sent', got {json_data['status']}"
            except ValueError:
                # If response not JSON, just ensure content present
                assert len(proposal_response.content) > 0, "Empty response content on status 200"

    finally:
        session.close()

test_create_proposal_for_available_property()