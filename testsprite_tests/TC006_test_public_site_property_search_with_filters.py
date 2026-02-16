import requests

def test_public_site_property_search_with_filters():
    base_url = "http://localhost:8000"
    endpoint = "/site/properties"
    params = {
        "city": "São Paulo",
        "type": "Casa"
    }
    headers = {
        "Accept": "application/json"
    }
    try:
        response = requests.get(f"{base_url}{endpoint}", params=params, headers=headers, timeout=30)
        response.raise_for_status()
        assert response.status_code == 200
        data = response.json()
        assert isinstance(data, list) or isinstance(data, dict)
    except requests.exceptions.RequestException as e:
        assert False, f"Request failed: {e}"

test_public_site_property_search_with_filters()
