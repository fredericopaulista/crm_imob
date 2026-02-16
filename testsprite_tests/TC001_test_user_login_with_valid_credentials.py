import requests

def test_user_login_with_valid_credentials():
    base_url = "http://localhost:8000"
    login_url = f"{base_url}/acesso/autenticar"
    session = requests.Session()
    payload = {
        "email": "admin@imobhub.com",
        "password": "password"
    }
    try:
        response = session.post(login_url, data=payload, allow_redirects=False, timeout=30)
        # Check for either 302 redirect to /painel or successful session creation (status code 200)
        assert response.status_code in (200, 302), f"Unexpected status code: {response.status_code}"
        if response.status_code == 302:
            location = response.headers.get("Location", "")
            assert location.endswith("/painel"), f"Redirect location expected to end with '/painel', got '{location}'"
        else:
            # If no redirect, verify some session property or content indicative of logged-in user
            # For example, presence of a session cookie
            assert response.cookies or session.cookies, "No session cookies set on successful login"
    except requests.RequestException as e:
        assert False, f"Request failed: {e}"
    finally:
        session.close()

test_user_login_with_valid_credentials()