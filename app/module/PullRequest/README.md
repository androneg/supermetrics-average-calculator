# Review Pull Request

You have a pull request to review,
Documentation states the following:

ENDPOINT: https://api.supermetrics.com/assignment/register

METHOD: POST
PARAMS:
	client_id: clientId
	email: your@email.address
	name: Your Name
RETURNS:
	sl_token: This token string should be used in the subsequent query. Please
	from when the REGISTER call happens. You will need to register and fetch
	client_id: returned for informational purposes only
	email: returned for informational purposes only

You receive a pull request with the following line of code. Please review the code.

```
<?php

$tokenInfo = ﬁle_get_contents('https://api.supermetrics.com/assignment/register?
client_id=clientId&email=my@name.com&name=My%20Name');

```


##### Table of Contents

- app/module/PullRequest/pullRequest.php has been added


For receiving token info we need to use POST method:
- "Content-Type: application/x-www-form-urlencoded" since we need to send encoded key and values
- 'method' => 'POST'











