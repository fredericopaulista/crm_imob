import requests
from requests.exceptions import RequestException
from datetime import datetime, timezone, timedelta

BASE_URL = "http://localhost:8000"
LOGIN_URL = f"{BASE_URL}/acesso/autenticar"
CAMPAIGN_URL = f"{BASE_URL}/painel/marketing/enviar-disparo"

# Define Sao Paulo timezone offset (UTC-3, no DST assumed here)
SAO_PAULO_TZ = timezone(timedelta(hours=-3))

def test_send_whatsapp_campaign_with_valid_recipients():
    session = requests.Session()
    session.headers.update({"Content-Type": "application/json"})

    # Login as admin
    login_payload = {
        "email": "admin@imobhub.com",
        "password": "password"
    }
    try:
        login_resp = session.post(LOGIN_URL, json=login_payload, timeout=30, allow_redirects=False)
        # Should redirect to /painel on success with status code 302
        assert login_resp.status_code == 302, f"Login failed: Expected 302 redirect, got {login_resp.status_code}"
        assert "/painel" in login_resp.headers.get("Location", ""), f"Login redirect location unexpected: {login_resp.headers.get('Location')}"

        # Check current time is within business hours 08:00 - 18:00
        now = datetime.now(SAO_PAULO_TZ)
        if not (8 <= now.hour < 18):
            assert False, f"Test must run within business hours (08:00-18:00). Current time: {now.strftime('%H:%M')}."

        # Send WhatsApp campaign
        campaign_payload = {
            "client_id": 1,
            "message": "Test Message"
        }
        resp = session.post(CAMPAIGN_URL, json=campaign_payload, timeout=30)
        resp.raise_for_status()
        json_resp = resp.json()
        assert json_resp == {"status": "success"}, f"Unexpected response JSON: {json_resp}"

    except RequestException as e:
        assert False, f"Request failed: {e}"
    except AssertionError:
        raise
    except Exception as e:
        assert False, f"Unexpected error: {e}"

test_send_whatsapp_campaign_with_valid_recipients()
