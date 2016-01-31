#!/bin/sh
export PRIVATE_KEY="9c2057734ec05dd90967892a640b9cca"
export API_KEY="a0198e401d7a2257aa9cf8001476e925"
export TIMESTAMP=$(date -u +%Y-%m-%dT%H:%M:%SZ)
export BODY=$(mktemp payload.XXXXX)
echo -n $(iconv -c -f UTF-8 -t US-ASCII <<EOF
{
  "username":"abc@newsint.co.uk",
  "shareURL":"http://www.uat-thesun.co.uk/sol/homepage/showbiz/tv/article5412798.ece",
  "articleId":"5412798",
  "shareStartDate":"${TIMESTAMP}",
  "maxHitsCount": 10,
  "timestamp":"${TIMESTAMP}"
}
EOF
) >${BODY}

cat $BODY

export SIG=$(cat ${BODY} | openssl dgst -sha1 -hmac ${PRIVATE_KEY} -binary | openssl enc -base64)

echo $SIG

curl -v -i --connect-timeout 5 -X POST \
-H "Content-Type: application/json" \
-H "X-NI-signatureType: 2" \
-H "X-NI-signatureHash: ${SIG}" \
-H "X-NI-apiKey: ${API_KEY}" \
-H "X-NI-apiVersion: 1" \
-H "X-Fowarded-Protocol: https" \
-H "X-Fowarded-For: 10.198.10.78" \
-d @${BODY} \
https://acs-uat.newsint.co.uk/sharing/generateToken 2>&1
rm ${BODY}


--------------------------------------------------
curl -X POST "https://acs-uat.newsint.co.uk/sharing/generateToken 2>&1" --verbose