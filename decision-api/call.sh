curl -X POST \
    https://decision.flagship.io/v2/{{ENV_ID}}/campaigns \
    -H 'Content-Type: application/json' \
    -H 'x-api-key: {{API_KEY}}' \
    -d '{
        "visitor_id": "YOUR_VISITOR_ID",
        "context": {
          
        },
        "trigger_hit": true,
        "decision_group": null
    }'