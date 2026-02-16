
# TestSprite AI Testing Report(MCP)

---

## 1️⃣ Document Metadata
- **Project Name:** crm_imob
- **Date:** 2026-02-15
- **Prepared by:** TestSprite AI Team

---

## 2️⃣ Requirement Validation Summary

#### Test TC001 test_user_login_with_valid_credentials
- **Test Code:** [TC001_test_user_login_with_valid_credentials.py](./TC001_test_user_login_with_valid_credentials.py)
- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/da950a5f-5529-40c7-8a8f-96503e370394/ff61b897-a466-4bd6-a37b-5f677e8dbe49
- **Status:** ✅ Passed
- **Analysis / Findings:** {{TODO:AI_ANALYSIS}}.
---

#### Test TC002 test_create_property_with_valid_data
- **Test Code:** [TC002_test_create_property_with_valid_data.py](./TC002_test_create_property_with_valid_data.py)
- **Test Error:** Traceback (most recent call last):
  File "/var/task/handler.py", line 258, in run_with_retry
    exec(code, exec_env)
  File "<string>", line 45, in <module>
  File "<string>", line 38, in test_create_property_with_valid_data
AssertionError: Expected redirect after property creation, got 200

- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/da950a5f-5529-40c7-8a8f-96503e370394/cba81128-5c0c-4dba-9152-98f8f1354ee4
- **Status:** ❌ Failed
- **Analysis / Findings:** {{TODO:AI_ANALYSIS}}.
---

#### Test TC003 test_import_clients_with_valid_csv
- **Test Code:** [TC003_test_import_clients_with_valid_csv.py](./TC003_test_import_clients_with_valid_csv.py)
- **Test Error:** Traceback (most recent call last):
  File "/var/task/handler.py", line 258, in run_with_retry
    exec(code, exec_env)
  File "<string>", line 38, in <module>
  File "<string>", line 19, in test_import_clients_with_valid_csv
AssertionError: Expected redirect on login, got 404

- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/da950a5f-5529-40c7-8a8f-96503e370394/de375dd1-dc73-46bb-bd23-ef342ef4f343
- **Status:** ❌ Failed
- **Analysis / Findings:** {{TODO:AI_ANALYSIS}}.
---

#### Test TC004 test_create_proposal_for_available_property
- **Test Code:** [TC004_test_create_proposal_for_available_property.py](./TC004_test_create_proposal_for_available_property.py)
- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/da950a5f-5529-40c7-8a8f-96503e370394/c3ee8bf4-b8af-4345-801e-af434758c6d0
- **Status:** ✅ Passed
- **Analysis / Findings:** {{TODO:AI_ANALYSIS}}.
---

#### Test TC005 test_send_whatsapp_campaign_with_valid_recipients
- **Test Code:** [TC005_test_send_whatsapp_campaign_with_valid_recipients.py](./TC005_test_send_whatsapp_campaign_with_valid_recipients.py)
- **Test Error:** Traceback (most recent call last):
  File "/var/task/handler.py", line 258, in run_with_retry
    exec(code, exec_env)
  File "<string>", line 49, in <module>
  File "<string>", line 24, in test_send_whatsapp_campaign_with_valid_recipients
AssertionError: Login failed: Expected 302 redirect, got 200

- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/da950a5f-5529-40c7-8a8f-96503e370394/2046f8a7-4af5-4bdc-867f-0c41f0cdc971
- **Status:** ❌ Failed
- **Analysis / Findings:** {{TODO:AI_ANALYSIS}}.
---

#### Test TC006 test_public_site_property_search_with_filters
- **Test Code:** [TC006_test_public_site_property_search_with_filters.py](./TC006_test_public_site_property_search_with_filters.py)
- **Test Error:** Traceback (most recent call last):
  File "<string>", line 15, in test_public_site_property_search_with_filters
  File "/var/task/requests/models.py", line 1024, in raise_for_status
    raise HTTPError(http_error_msg, response=self)
requests.exceptions.HTTPError: 404 Client Error: Not Found for url: http://localhost:8000/site/properties?city=S%C3%A3o+Paulo&type=Casa

During handling of the above exception, another exception occurred:

Traceback (most recent call last):
  File "/var/task/handler.py", line 258, in run_with_retry
    exec(code, exec_env)
  File "<string>", line 22, in <module>
  File "<string>", line 20, in test_public_site_property_search_with_filters
AssertionError: Request failed: 404 Client Error: Not Found for url: http://localhost:8000/site/properties?city=S%C3%A3o+Paulo&type=Casa

- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/da950a5f-5529-40c7-8a8f-96503e370394/e2946ff5-179e-48a1-ac93-a8116c0995d6
- **Status:** ❌ Failed
- **Analysis / Findings:** {{TODO:AI_ANALYSIS}}.
---

#### Test TC007 test_admin_role_creation_and_permission_assignment
- **Test Code:** [TC007_test_admin_role_creation_and_permission_assignment.py](./TC007_test_admin_role_creation_and_permission_assignment.py)
- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/da950a5f-5529-40c7-8a8f-96503e370394/dfb04e9d-d489-4cc1-8de8-41beea3ef82c
- **Status:** ✅ Passed
- **Analysis / Findings:** {{TODO:AI_ANALYSIS}}.
---


## 3️⃣ Coverage & Matching Metrics

- **42.86** of tests passed

| Requirement        | Total Tests | ✅ Passed | ❌ Failed  |
|--------------------|-------------|-----------|------------|
| ...                | ...         | ...       | ...        |
---


## 4️⃣ Key Gaps / Risks
{AI_GNERATED_KET_GAPS_AND_RISKS}
---