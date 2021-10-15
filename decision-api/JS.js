fetch("https://decision.flagship.io/v2/{{ENV_ID}}/campaigns", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'x-api-key': '{{API_KEY}}'
        },
        body: JSON.stringify({
          visitor_id: "YOUR_VISITOR_ID",
          context: {
              
          },
          // For the Decision API to trigger a campaign activation hit, use
          trigger_hit: true,
          // Optional : see https://developers.flagship.io/docs/decision-api/v2#decision-group for more details
          decision_group: null
        })
  })
.then(response => response.json())
.then(data => console.log(data));
