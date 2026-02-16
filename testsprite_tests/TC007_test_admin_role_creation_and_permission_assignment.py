import requests

BASE_URL = "http://localhost:8000"
LOGIN_URL = f"{BASE_URL}/acesso/autenticar"
ROLE_SAVE_URL = f"{BASE_URL}/painel/perfis/salvar"
PROFILE_LIST_PATH = "/painel/perfis"

def test_admin_role_creation_and_permission_assignment():
    session = requests.Session()
    try:
        # Login as admin
        login_payload = {
            "email": "admin@imobhub.com",
            "password": "password"
        }
        login_resp = session.post(LOGIN_URL, data=login_payload, timeout=30, allow_redirects=False)
        assert login_resp.status_code in (302, 200), f"Unexpected login status code: {login_resp.status_code}"
        # If redirect, location should be /painel or similar
        if login_resp.status_code == 302:
            location = login_resp.headers.get("Location", "")
            assert location.startswith("/painel"), f"Unexpected redirect after login: {location}"

        # Create new role
        role_payload = {
            "name": "New Role",
            "description": "Test Role",
            "permissions[]": ["view_dashboard"]
        }

        role_resp = session.post(ROLE_SAVE_URL, data=role_payload, timeout=30, allow_redirects=False)
        assert role_resp.status_code in (200, 302, 303), f"Unexpected status code on role creation: {role_resp.status_code}"
        if role_resp.status_code in (302, 303):
            redirect_location = role_resp.headers.get("Location")
            assert redirect_location is not None, "No redirect location header found after role creation"
            assert redirect_location.endswith(PROFILE_LIST_PATH), f"Expected redirect to {PROFILE_LIST_PATH}, got {redirect_location}"

    finally:
        pass

test_admin_role_creation_and_permission_assignment()