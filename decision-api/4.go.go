body := strings.NewReader(`{
    "visitor_id": "YOUR_VISITOR_ID",
    "context": {
        
    },
    "trigger_hit": true,
    "decision_group": null
}`)
req, err := http.NewRequest("POST", "https://decision.flagship.io/v2/{{ENV_ID}}/campaigns", body)
if err != nil {
	// handle err
}
req.Header.Set("Content-Type", "application/json")
req.Header.Set("X-Api-Key", "{{API_KEY}}")
resp, err := http.DefaultClient.Do(req)
if err != nil {
	// handle err
}
defer resp.Body.Close()
